<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactInformation extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'birth_date','email'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function ContactAddress() {
        return $this->hasMany('App\ContactAddress','contact_information_id');
    }

    public function ContactNumber() {
        return $this->hasMany('App\ContactNumber','contact_information_id');
    }
}
