<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
     protected $table = 'departments';
    protected $fillable = [
    	'dep_name_ar',
		'dep_name_en',
        'icon',
		'description',
		'keyword',
		'parent',
	
		

    ];

    public function parens() {

     // return $this->hasOne(\App\Model\Country::class , 'id', 'country_id'); // Or

    	return $this->hasMany('App\Model\Department', 'id', 'parent');
    }




}