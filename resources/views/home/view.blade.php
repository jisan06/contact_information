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
     	<form class="form-horizontal"  method="POST" enctype="multipart/form-data">
	        <div class="modal-body">
	        	<div class="row">
	        		<div class="col-md-6">
    					<div class="form-group {{ $errors->has('first_name') ? ' has-danger' : '' }}">
			                <label for="first_name">First Name</label>
		                    <input type="text" class="form-control form-control-danger" placeholder="first name" name="first_name" value="{{ $contact_information->first_name }}" readonly="">
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
		                    <input type="text" class="form-control form-control-danger" placeholder="last name" name="last_name" value="{{ $contact_information->last_name }}" readonly="">
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
		                    <input type="text" class="form-control form-control-danger" name="birth_date" value="{{ $birth_date }}" readonly="">
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
		                    <input type="email" class="form-control form-control-danger" placeholder="email address" name="email" value="{{ $contact_information->email }}" readonly="">
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
	        	<h5>Addresses:</h5>
	        	<span class="appendAddress">
	        		@php
	        			$i = 0;
	        		@endphp
	        		@foreach($contact_information->ContactAddress as $contact_address)
	        		@php
	        			$i++;
	        		@endphp
			        	<div class="addressSection extraAddress_{{$i}}" id="addressSection">
			        		<div class="row">
			        			<div class="col-md-6">
			        				<div class="form-group {{ $errors->has('address_name') ? ' has-danger' : '' }}">
						                <label for="address_name">Name</label>
					                    <input type="text" class="form-control form-control-danger" name="address_name[]" value="{{$contact_address->address_name}}" placeholder="house/office/others name" readonly="">
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
					                    <input type="text" class="form-control form-control-danger" name="street[]" value="{{$contact_address->street}}" placeholder="stree/road no" readonly="">
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
					                    <input type="text" class="form-control form-control-danger" name="zip_code[]" value="{{$contact_address->zip_code}}" placeholder="zio code" readonly="">
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
					                    <input type="text" class="form-control form-control-danger" name="state[]" value="{{$contact_address->state}}" placeholder="state/upzilla" readonly="">
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
					                    <input type="text" class="form-control form-control-danger" name="city[]" value="{{$contact_address->city}}" placeholder="city/district name" readonly="">
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
					                    <input type="text" class="form-control form-control-danger" name="country[]" value="{{$contact_address->country}}" placeholder="country name" readonly="">
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

	            <hr>

	            {{-- code for multiple contact --}}
	            <h5>Contact No:</h5>
	        	<span class="appendContactNumber">
	        		@php
	        			$i = 0;
	        		@endphp
	        		@foreach($contact_information->ContactNumber as $contact_number)
	        		@php
	        			$i++;
	        		@endphp
		        	<div class="contactNumberSection extraContact_{{$i}}" id="contactNumberSection">
		        		<div class="row">
		        			<div class="col-md-6">
		        				<div class="form-group {{ $errors->has('contact_name') ? ' has-danger' : '' }}">
					                <label for="contact_name">Name</label>
				                    <input type="text" class="form-control form-control-danger" name="contact_name[]" value="{{$contact_number->contact_name}}" placeholder="land/mobile/office/others name" readonly="">
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
				                    <input type="text" class="form-control form-control-danger" name="phone_no[]"  value="{{$contact_number->phone_no}}" placeholder="phone no" readonly="">
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
