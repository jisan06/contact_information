<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\ContactInformation;
use App\ContactAddress;
use App\ContactNumber;

class ContactController extends Controller
{
    public function index(){
        $title = "Contact Information";
    	$contact_information_list = ContactInformation::with('ContactAddress','ContactNumber')->get();
    	return view('home.index')->with(compact('title','contact_information_list'));
    }

    public function add(Request $request){
        $title = 'Add New Contact Information';
        if(count($request->all()) > 0){
           $this->validate(request(), [       
               'first_name' => 'required',  
               'last_name' => 'required',  
               'birth_date' => 'required',  
               'email' => 'required',  
           ]);

           $birth_date = date('Y-m-d', strtotime($request->birth_date));
           $contact_info = ContactInformation::create( [
                'first_name' => $request->first_name,            
                'last_name' => $request->last_name ,            
                'birth_date' => $birth_date,            
                'email' => $request->email             
            ]);

            if($contact_info){
                $countContactAddress = count($request->address_name);
                if($request->address_name){
                    for ($i=0; $i <$countContactAddress ; $i++) { 
                        $contact_address = ContactAddress::create( [
                            'contact_information_id' => $contact_info->id,            
                            'address_name' => $request->address_name[$i],            
                            'street' => $request->street[$i],            
                            'zip_code' => $request->zip_code[$i],             
                            'state' => $request->state[$i],             
                            'city' => $request->city[$i],             
                            'country' => $request->country[$i]           
                        ]);
                    }
                }

                $countContactPhone = count($request->contact_name);
                if($request->contact_name){
                    for ($i=0; $i <$countContactPhone ; $i++) { 
                        $contact_phone = ContactNumber::create( [
                            'contact_information_id' => $contact_info->id,            
                            'contact_name' => $request->contact_name[$i],            
                            'phone_no' => $request->phone_no[$i],                     
                        ]);
                    }
                }
            }

           return redirect(route('contact_info.index'))->with('msg','Contact Information Created Successfully');
        }else{
            return view('home.add')->with(compact('title'));
        }
        
    }

    public function edit(Request $request,$id){
        $title = 'Edit Contact Information';
        $contact_information = ContactInformation::with('ContactAddress','ContactNumber')->find($id);
        if(count($request->all()) > 0){
           $this->validate(request(), [       
               'first_name' => 'required',  
               'last_name' => 'required',  
               'birth_date' => 'required',  
               'email' => 'required',  
           ]);

           $birth_date = date('Y-m-d', strtotime($request->birth_date));
           $contact_information->update( [
                'first_name' => $request->first_name,            
                'last_name' => $request->last_name ,            
                'birth_date' => $birth_date,            
                'email' => $request->email             
            ]);

            if($contact_information){
                $countContactAddress = count($request->address_name);
                DB::table('contact_addresses')->where('contact_information_id', $contact_information->id)->delete();
                if($request->address_name){
                    for ($i=0; $i <$countContactAddress ; $i++) { 
                        $contact_address = ContactAddress::create( [
                            'contact_information_id' => $contact_information->id,            
                            'address_name' => $request->address_name[$i],            
                            'street' => $request->street[$i],            
                            'zip_code' => $request->zip_code[$i],             
                            'state' => $request->state[$i],             
                            'city' => $request->city[$i],             
                            'country' => $request->country[$i]           
                        ]);
                    }
                }

                $countContactPhone = count($request->contact_name);
                DB::table('contact_numbers')->where('contact_information_id', $contact_information->id)->delete();
                if($request->contact_name){
                    for ($i=0; $i <$countContactPhone ; $i++) { 
                        $contact_phone = ContactNumber::create( [
                            'contact_information_id' => $contact_information->id,            
                            'contact_name' => $request->contact_name[$i],            
                            'phone_no' => $request->phone_no[$i],                     
                        ]);
                    }
                }
            }

           return redirect(route('contact_info.index'))->with('msg','Contact Information Updated Successfully');
        }else{
            return view('home.edit')->with(compact('title','contact_information'));
        }
        
    }

    public function view(Request $request,$id){
        $title = 'View Contact Information';
        $contact_information = ContactInformation::with('ContactAddress','ContactNumber')->find($id);
            return view('home.view')->with(compact('title','contact_information'));
    }

    public function destroy(Request $request){   
        ContactInformation::where('id',$request->contact_info_id)->delete();
        ContactAddress::where('contact_information_id',$request->contact_info_id)->delete();
        ContactNumber::where('contact_information_id',$request->contact_info_id)->delete();
    }
}
