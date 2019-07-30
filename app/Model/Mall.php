<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Mall extends Model
{
    protected $table = 'malls';    
    protected $fillable = [


    		'name_ar',
            'name_en',
            'country_id',
            'facebook',
            'twitter',
            'website',
            'lng',
            'lat',
            'address',
            'contact_name',
            'mobile',
            'email',
            'icon',

    ];

     public function country_id ()
    {
    	return $this->hasOne('App\Model\Country','id','country_id');
    }
}
