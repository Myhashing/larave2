<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $fillable=['product_id','quantity','order_date'];
    public function products(){
        return $this->belongsTo('App\Product','foreign_key');
    }
}
