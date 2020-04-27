@extends('master')

@section('content')
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h4 class="card-title">{{@$title}}</h4></div>
            <div class="col-md-6 text-right">
                <span class="shortlink">
                    <a class="btn btn-primary" href="{{route('contact_info.add')}}">
                        <i class="fa fa-plus"></i> Add New
                    </a>
                </span>
            </div>
        </div>
    </div>

	<div class="card-body">
        <div class="row">
            <div class="col-md-12">
                @php
                    $message = Session::get('msg');
                @endphp

                @if (isset($message))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong style="font-weight: bold;color: #0daf3f;font-size: 16px;">
                            Success!
                        </strong> 
                        <strong style="font-weight: bold;color: #097d6a;">
                            {{ $message }}
                        </strong>
                    </div>
                @endif

                @php
                    Session::forget('msg');
                @endphp

                @if( count($errors) > 0 )
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong style="font-weight: bold;color: #e4280a;font-size: 16px;">
                            Oops!
                        </strong> 
                        <strong style="font-weight: bold;color: #ca0c0c;;">
                            {{ $errors->first() }}
                        </strong>
                    </div>
                @endif
            </div>
        </div>
     	<div class="table-responsive">
        <table id="datatable" class="table table-bordered table-striped datatable">
            <thead>
                <tr>
                    <th width="5%">SL</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th width="5%">Address</th>
                    <th width="15%">Contact Number</th>
                    <th width="10%">Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                @php
                    $i = 0;
                    foreach ($contact_information_list as $contact_information) {
                        $i++;
                @endphp 
                    <tr class="row_{{$contact_information->id}}">
                        <td>{{$i}}</td>
                        <td>{{$contact_information->first_name}}</td>
                        <td>{{$contact_information->last_name}}</td>
                        <td>{{$contact_information->email}}</td>
                        <td class="text-center">
                            {{count($contact_information->ContactAddress)}}
                            <table class="addressTable">
                                 <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Stree</th>
                                        <th>Zip Code</th>
                                        <th>State</th>
                                        <th>City</th>
                                        <th>Country</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($contact_information->ContactAddress as $contact_address)
                                        <tr>
                                            <td>{{$contact_address->address_name}}</td>
                                            <td>{{$contact_address->street}}</td>
                                            <td>{{$contact_address->zip_code}}</td>
                                            <td>{{$contact_address->state}}</td>
                                            <td>{{$contact_address->city}}</td>
                                            <td>{{$contact_address->country}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                        <td class="text-center">
                            {{count($contact_information->ContactNumber)}}
                            <table class="numberTable">
                                 <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Phone No</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($contact_information->ContactNumber as $contact_number)
                                        <tr>
                                            <td>{{$contact_number->contact_name}}</td>
                                            <td>{{$contact_number->phone_no}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                        <td class="text-nowrap">
                            <a href="{{route('contact_info.view',$contact_information->id)}}" data-toggle="tooltip" data-original-title="Edit">
                                <i class="fa fa-eye text-inverse m-r-10"></i> 
                            </a>
                            <a href="{{route('contact_info.edit',$contact_information->id)}}" data-toggle="tooltip" data-original-title="Edit">
                                <i class="fa fa-pencil text-inverse m-r-10"></i> 
                            </a>
                            
                            <a href="javascript:void(0)" data-toggle="tooltip" data-original-title="Delete" data-id="{{$contact_information->id}}" data-token="{{ csrf_token() }}"> 
                                <i class="fa fa-trash text-danger"></i> 
                            </a>
                        </td>
                    </tr>
                @php } @endphp
            </tbody>
        </table>
    </div>
</div>
@endsection

<style type="text/css">
    td .addressTable {
        z-index:10;display:none; padding:10px 10px;
        margin-top:15px; margin-left:-480px;
        line-height:16px;
    }

    td:hover .addressTable{
        display:inline; position:absolute; color:#111;
        border:1px solid #DCA; background:#fffAF0;}

    .addressTable thead tr{
        background-color: #0cb188 !important;
    }

    .addressTable td{
        padding: 8px !important;
        font-size: 13px !important;
        border-bottom: 1px solid #333 !important;
    }

    .addressTable tr{
        line-height: 8px !important;
    }

    .addressTable tbody tr:nth-child(even) {
        background: #fff;
    }
</style>

<style type="text/css">
    td .numberTable {
        z-index:10;display:none; padding:10px 10px;
        margin-top:15px; margin-left:-200px;
        line-height:16px;
    }

    td:hover .numberTable{
        display:inline; position:absolute; color:#111;
        border:1px solid #DCA; background:#fffAF0;}

    .numberTable thead tr{
        background-color: #0cb188 !important;
    }

    .numberTable td{
        padding: 8px !important;
        font-size: 13px !important;
        border-bottom: 1px solid #333 !important;
    }

    .numberTable tr{
        line-height: 8px !important;
    }

    .numberTable tbody tr:nth-child(even) {
        background: #fff;
    }
</style>
@section('custom_js')
    <script>
        $(document).ready(function() {
            var updateThis ;

            //ajax delete code
            $('#dataTable tbody').on( 'click', 'i.fa-trash', function () {
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });

                contact_info_id = $(this).parent().data('id');
                swal({   
                    title: "Are you sure?",   
                    text: "You will not be able to recover this imaginary file!",   
                    type: "warning",   
                    showCancelButton: true,   
                    confirmButtonColor: "#DD6B55",   
                    confirmButtonText: "Yes, delete it!",   
                    cancelButtonText: "No, cancel plx!",   
                    closeOnConfirm: false,   
                    closeOnCancel: false 
                }, function(isConfirm){   
                    if (isConfirm) {     
                       $.ajax({
                            type: "POST",
                           url : "{{ route('contact_info.destroy') }}",
                            data : {contact_info_id:contact_info_id},
                           
                            success: function(response) {
                                swal({
                                    title: "<small class='text-success'>Success!</small>", 
                                    type: "success",
                                    text: "Deleted Successfully!",
                                    timer: 1000,
                                    html: true,
                                });
                                $('.row_'+contact_info_id).remove();
                            },
                            error: function(response) {
                                error = "Failed.";
                                swal({
                                    title: "<small class='text-danger'>Error!</small>", 
                                    type: "error",
                                    text: error,
                                    timer: 1000,
                                    html: true,
                                });
                            }
                        });    
                    } else { 
                        swal({
                            title: "Cancelled", 
                            type: "error",
                            text: "Your data is safe :)",
                            timer: 1000,
                            html: true,
                        });    
                    } 
                });
            }); 

        });
    </script> 
@endsection