<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'product_id',
        'cart_number'
    ];

    protected $table = 'carts';

    /**
     * counting how moany carts has user
     * @param $userId
     * @return mixed
     */
    public function countCarts($userId)
    {
        return self::where('user_id','=',$userId)->count('id');
    }

    /**
     * couting number of products in current cart
     * @return mixed
     */
    public function countProductsOfCart()
    {
        return self::where('user_id','=',$this->user_id)
                    ->where('cart_number','=',$this->cart_number)
                    ->count();
    }
    static public function getAllProductOfCart($cartNumber,$userId,$flagForMakeJoinToCount=null)
    {
        if(!$flagForMakeJoinToCount)
            return self::where('user_id','=',$userId)->where('cart_number','=',$cartNumber)->get();
        else
            return self::leftJoin('products','products.id','=','carts.product_id')
                        ->where('carts.user_id','=',$userId)
                        ->where('carts.cart_number','=',$cartNumber)
                        ->select('products.price','products.title','carts.cart_number','carts.id','carts.product_id')
                        ->get();
    }
    public function getInitCartIfProductIdOfNull($userId)
    {
        return self::where('user_id','=',$userId)->whereNull('product_id')->first();
    }
}
