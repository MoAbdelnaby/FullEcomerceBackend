<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

 protected $table = 'products';
 protected $fillable = [
		'title'
		'content'
		'photo'
		'department_id'
		'trade_id'
		'manu_id'
		'color_id'
		'size_id'
		'currency_id'
		'stock'
		'price'
		'start_at'
		'end_at'
		'start_offer_at'
		'end_offer_at'
		'price_offer'
		'other_data'
		'weight'
		'weight_id'
		'status'
		'reason'
];

}
