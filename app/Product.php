<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=['name','supplier_id'];

    public function suppliers(){
        return $this->belongsTo('App\Supplier','foreign_key');
    }

    public function images(){
        return $this->hasMany(Image::class);
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }
    public function remarks(){
        return $this->hasMany(Remark::class);
    }
    public function categories(){
        return $this->belongsToMany(Category::class)->withTimestamps();
    }
    public function colors(){
        return $this->hasMany(Color::class);
    }
}
