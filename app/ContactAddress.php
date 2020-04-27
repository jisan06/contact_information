<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactAddress extends Model
{
    protected $fillable = [
        'contact_information_id', 'address_name', 'street','zip_code','state','city','country'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function ContactInformation(){
    	return $this->belongsTo('App\ContactInformation', 'id');
	}

}
