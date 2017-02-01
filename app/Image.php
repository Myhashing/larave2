<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable=['file','caption','description','product_id'];
    public function products(){
        return $this->belongsTo(Product::class);
    }
}
