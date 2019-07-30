<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Manufacturers extends Model
{

	protected $table = 'manufacturers';    
    protected $fillable = [


    		'name_ar',
            'name_en',
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
}
