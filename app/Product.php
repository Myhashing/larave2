<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=['name','supplier_id'];

    public function Suppliers(){
        return $this->belongsTo(Supplier::class);
    }
}
