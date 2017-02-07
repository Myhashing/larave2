<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $fillable = ['color', 'product_id'];

    public function products()
    {
        return $this->belongsTo('App\Product', 'foreign_key');
    }
}
