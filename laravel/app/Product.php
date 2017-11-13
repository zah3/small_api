<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'title',
        'price',
        'created_at'
    ];

    protected $table = 'products';

    static public function getProduct($id)
    {
        return self::where('id','=',$id)->first();
    }

}
