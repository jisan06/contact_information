<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactNumber extends Model
{
    protected $fillable = [
        'contact_information_id', 'contact_name', 'phone_no'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function ContactInformation(){
    	return $this->belongsTo('App\ContactInformation', 'id');
	}
}
