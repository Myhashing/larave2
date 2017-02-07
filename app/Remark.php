<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Remark extends Model
{

    public $fillable = ['product_id', 'remark'];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }

}
