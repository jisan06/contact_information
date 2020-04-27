@extends('master')

@section('content')
@php
	$birth_date = Date('d-m-Y',strtotime(@$contact_information->birth_date));
@endphp
	<div class="card-header">
	    <div class="row">
	        <div class="col-md-6">
	            <h4 class="card-title">{{@$title}}</h4></div>
	        <div class="col-md-6 text-right">
	            <span class="shortlink">
	                <a class="btn btn-success" href="{{route('contact_info.index')}}">
                        <i class="fa fa-arrow-left"></i> Go Back
                    </a>
	            </span>
	        </div>
	    </div>
	</div>
	<div class="card-body">
     	<form class="form-horizontal" action="{{ route('contact_info.edit',$contact_information->id) }}" method="POST" enctype="multipart/form-data">
        	{{ csrf_field() }}

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

	        <div class="modal-body">
	        	<div class="row">
	        		<div class="col-md-6">
    					<div class="form-group {{ $errors->has('first_name') ? ' has-danger' : '' }}">
			                <label for="first_name">First Name</label>
		                    <input type="text" class="form-control form-control-danger" placeholder="first name" name="first_name" value="{{ $contact_information->first_name }}" required="">
		                    @if ($errors->has('first_name'))
			                    @foreach($errors->get('first_name') as $error)
			                    	<div class="form-control-feedback">{{ $error }}</div>
			                    @endforeach
		                    @endif
			            </div>
    				</div>

    				<div class="col-md-6">
    					<div class="form-group {{ $errors->has('last_name') ? ' has-danger' : '' }}">
			                <label for="last_name">Last Name</label>
		                    <input type="text" class="form-control form-control-danger" placeholder="last name" name="last_name" value="{{ $contact_information->last_name }}" required="">
		                    @if ($errors->has('last_name'))
			                    @foreach($errors->get('last_name') as $error)
			                    	<div class="form-control-feedback">{{ $error }}</div>
			                    @endforeach
		                    @endif
			            </div>
    				</div>
	        	</div>

	        	<div class="row">
	        		<div class="col-md-6">
    					<div class="form-group {{ $errors->has('birth_date') ? ' has-danger' : '' }}">
			                <label for="birth_date">Date of Birth</label>
		                    <input type="text" class="form-control form-control-danger datepicker" name="birth_date" value="{{ $birth_date }}" readonly="">
		                    @if ($errors->has('birth_date'))
			                    @foreach($errors->get('birth_date') as $error)
			                    	<div class="form-control-feedback">{{ $error }}</div>
			                    @endforeach
		                    @endif
			            </div>
    				</div>

    				<div class="col-md-6">
    					<div class="form-group {{ $errors->has('email') ? ' has-danger' : '' }}">
			                <label for="email">email Address</label>
		                    <input type="email" class="form-control form-control-danger" placeholder="email address" name="email" value="{{ $contact_information->email }}" required="">
		                    @if ($errors->has('email'))
			                    @foreach($errors->get('email') as $error)
			                    	<div class="form-control-feedback">{{ $error }}</div>
			                    @endforeach
		                    @endif
			            </div>
    				</div>
	        	</div>

	        	<hr>
	        	{{-- code for multiple address --}}
	        	<h5>Address(you can add multiple address):</h5>
	        	<span class="appendAddress">
	        		@php
	        			$i = 0;
	        		@endphp
	        		@foreach($contact_information->ContactAddress as $contact_address)
	        		@php
	        			$i++;
	        		@endphp
			        	<div class="addressSection extraAddress_{{$i}}" id="addressSection">
			        		<span>
			        			@if($i != 1)
			        			<div class="row">
			        				<div class="col-md-12 m-b-20 text-right"><a class="btn btn-danger" onclick="RemoveAddress({{$i}})"><i class="fa fa-trash"> Remove Address</i></a></div></div>
			        			@endif
			        		</span>
			        		<div class="row">
			        			<div class="col-md-6">
			        				<div class="form-group {{ $errors->has('address_name') ? ' has-danger' : '' }}">
						                <label for="address_name">Name</label>
					                    <input type="text" class="form-control form-control-danger" name="address_name[]" value="{{$contact_address->address_name}}" placeholder="house/office/others name" required="">
					                    @if ($errors->has('address_name'))
						                    @foreach($errors->get('address_name') as $error)
						                    	<div class="form-control-feedback">{{ $error }}</div>
						                    @endforeach
					                    @endif
						            </div>
			        			</div>
			        			<div class="col-md-6">
			        				<div class="form-group {{ $errors->has('street') ? ' has-danger' : '' }}">
						                <label for="street">Street</label>
					                    <input type="text" class="form-control form-control-danger" name="street[]" value="{{$contact_address->street}}" placeholder="stree/road no" required="">
					                    @if ($errors->has('street'))
						                    @foreach($errors->get('street') as $error)
						                    	<div class="form-control-feedback">{{ $error }}</div>
						                    @endforeach
					                    @endif
						            </div>
			        			</div>
			        		</div>

			        		<div class="row">
			        			<div class="col-md-6">
		    						<div class="form-group {{ $errors->has('zip_code') ? ' has-danger' : '' }}">
						                <label for="zip_code">Zip Code</label>
					                    <input type="text" class="form-control form-control-danger" name="zip_code[]" value="{{$contact_address->zip_code}}" placeholder="zio code" required="">
					                    @if ($errors->has('zip_code'))
						                    @foreach($errors->get('zip_code') as $error)
						                    	<div class="form-control-feedback">{{ $error }}</div>
						                    @endforeach
					                    @endif
						            </div>
		    					</div>
		    					<div class="col-md-6">
		    						<div class="form-group {{ $errors->has('state') ? ' has-danger' : '' }}">
						                <label for="state">State</label>
					                    <input type="text" class="form-control form-control-danger" name="state[]" value="{{$contact_address->state}}" placeholder="state/upzilla" required="">
					                    @if ($errors->has('state'))
						                    @foreach($errors->get('state') as $error)
						                    	<div class="form-control-feedback">{{ $error }}</div>
						                    @endforeach
					                    @endif
						            </div>
		    					</div>
		    				</div>

			        		<div class="row">
			        			<div class="col-md-6">
			        				<div class="form-group {{ $errors->has('city') ? ' has-danger' : '' }}">
						                <label for="city">City</label>
					                    <input type="text" class="form-control form-control-danger" name="city[]" value="{{$contact_address->city}}" placeholder="city/district name" required="">
					                    @if ($errors->has('city'))
						                    @foreach($errors->get('city') as $error)
						                    	<div class="form-control-feedback">{{ $error }}</div>
						                    @endforeach
					                    @endif
						            </div>
			        			</div>

			        			<div class="col-md-6">
		    						<div class="form-group {{ $errors->has('country') ? ' has-danger' : '' }}">
						                <label for="country">Country</label>
					                    <input type="text" class="form-control form-control-danger" name="country[]" value="{{$contact_address->country}}" placeholder="country name" required="">
					                    @if ($errors->has('country'))
						                    @foreach($errors->get('country') as $error)
						                    	<div class="form-control-feedback">{{ $error }}</div>
						                    @endforeach
					                    @endif
						            </div>
		    					</div>
			        		</div>
			        	</div>
		        	@endforeach
		        </span>

	        	<div class="col-md-12 m-b-20 text-right">    
	                <a class="btn btn-primary addMoreAddress"><i class="fa fa-plus"> Add More Address</i></a> 
	                <input type="hidden" class="count_address" value="{{count($contact_information->ContactAddress)}}">
	            </div>

	            <hr>

	            {{-- code for multiple contact --}}
	            <h5>Contact No(You can add multiple contact no):</h5>
	        	<span class="appendContactNumber">
	        		@php
	        			$i = 0;
	        		@endphp
	        		@foreach($contact_information->ContactNumber as $contact_number)
	        		@php
	        			$i++;
	        		@endphp
		        	<div class="contactNumberSection extraContact_{{$i}}" id="contactNumberSection">
		        		<span>
		        			@if($i != 1)
		        			<div class="row">
		        				<div class="col-md-12 m-b-20 text-right"><a class="btn btn-danger" onclick="RemoveContact({{$i}})"><i class="fa fa-trash"> Remove Contact</i></a></div></div>
		        			@endif
		        		</span>
		        		<div class="row">
		        			<div class="col-md-6">
		        				<div class="form-group {{ $errors->has('contact_name') ? ' has-danger' : '' }}">
					                <label for="contact_name">Name</label>
				                    <input type="text" class="form-control form-control-danger" name="contact_name[]" value="{{$contact_number->contact_name}}" placeholder="land/mobile/office/others name" required="">
				                    @if ($errors->has('contact_name'))
					                    @foreach($errors->get('contact_name') as $error)
					                    	<div class="form-control-feedback">{{ $error }}</div>
					                    @endforeach
				                    @endif
					            </div>
		        			</div>
		        			<div class="col-md-6">
		        				<div class="form-group {{ $errors->has('phone_no') ? ' has-danger' : '' }}">
					                <label for="phone_no">Phone No</label>
				                    <input type="text" class="form-control form-control-danger" name="phone_no[]"  value="{{$contact_number->phone_no}}" placeholder="phone no" required="">
				                    @if ($errors->has('phone_no'))
					                    @foreach($errors->get('phone_no') as $error)
					                    	<div class="form-control-feedback">{{ $error }}</div>
					                    @endforeach
				                    @endif
					            </div>
		        			</div>
		        		</div>
		        	</div>
		        	@endforeach
		        </span>

		        <div class="col-md-12 m-b-20 text-right">    
	                <a class="btn btn-primary addMoreContact"><i class="fa fa-plus"> Add More Contact</i></a> 
	                <input type="hidden" class="count_count" value="{{count($contact_information->ContactNumber)}}">
	            </div>

	            <div class="col-md-12 m-b-20 text-right">    
	                <button type="submit" class="btn btn-info waves-effect"><i class="fa fa-save"></i> UPDATE</button> 
	            </div>
	        </div>                
		</form>
    </div>

    <style type="text/css">
		.addressSection,.contactNumberSection{
		    border: 1px solid #7f7e7e;
		    padding: 15px;
		    margin-bottom: 20px;
		}
		a{
			color: #fff !important;
			cursor: pointer;
			text-transform: uppercase;
		}

		.m-b-20{
			padding-right: 0px !important;
		}

		.ui-state-default{
			color: #333 !important;
		}
	</style>
@endsection

@section('custom_js')
	{{-- script for multiple address --}}
	<script>
		$(document).ready(function(){
		  $(".addMoreAddress").click(function(){
		  	var count_address = parseInt($('.count_address').val()) + 1;
		  	var remove_link = '<div class="row">'+
		        			'<div class="col-md-12 m-b-20 text-right">'+    
				                '<a class="btn btn-danger" onclick="RemoveAddress('+count_address+')">'+
				                	'<i class="fa fa-trash"> Remove Address</i></a>'+ 
				            '</div>'+
		        		'</div>';

		    $("#addressSection").clone().addClass('extraAddress_'+count_address).appendTo(".appendAddress");
		     $('.extraAddress_'+count_address).find("input").val("");
		    $('.extraAddress_'+count_address).children('span').append(remove_link);

		    $('.count_address').val(count_address);
		  });
		});

		function RemoveAddress(i){
			var count_address = parseInt($('.count_address').val()) - 1;
			$('.extraAddress_'+i).remove();

		    $('.count_address').val(count_address);
		}
	</script>

	{{-- script for multiple contact --}}
	<script>
		$(document).ready(function(){
		  $(".addMoreContact").click(function(){
		  	var count_count = parseInt($('.count_count').val()) + 1;
		  	var remove_link = '<div class="row">'+
		        			'<div class="col-md-12 m-b-20 text-right">'+    
				                '<a class="btn btn-danger" onclick="RemoveContact('+count_count+')">'+
				                	'<i class="fa fa-trash"> Remove Contact</i></a>'+ 
				            '</div>'+
		        		'</div>';

		    $("#contactNumberSection").clone().addClass('extraContact_'+count_count).appendTo(".appendContactNumber");
		    $('.extraContact_'+count_count).find("input").val("");
		    $('.extraContact_'+count_count).children('span').append(remove_link);

		    $('.count_count').val(count_count);
		  });
		});

		function RemoveContact(i){
			var count_count = parseInt($('.count_count').val()) - 1;
			$('.extraContact_'+i).remove();

		    $('.count_count').val(count_count);
		}
	</script>
@endsection