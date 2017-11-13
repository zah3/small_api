<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use JWTAuth;

class CartController extends Controller
{

    public function index(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $carts = User::getAllCarts($user->id);
        return response()->json(['carts' => $carts],200);
    }

    public function create(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $cart = new Cart();
        $cartNumbers = $cart->countCarts($user->id);
        $cart->user_id = $user->id;
        $cart->cart_number = $cartNumbers+1;
        $cart->save();
        return response()->json(['cart' => $cart,'message' => 'Created cart number '.$cart->cart_number.' go to products to add some of them.'],201);
    }
    public function addProductToCart($cart_number,$product_id,Request $request)
    {
        //check if product exist in db
        $isProductInDB = Product::getProduct($product_id);
        if(!$isProductInDB)
            return response()->json(['message' => 'Sorry there is not product with this id.'],400);
        $user = JWTAuth::parseToken()->authenticate();
        //$allCarts  = User::getAllCarts($user->id);
        $allProductOfCart = Cart::getAllProductOfCart($cart_number,$user->id);
        //if there is no any  cart number for user then return message
        if(count($allProductOfCart) <= 0)
            return response()->json(['message' => 'Sorry You have not that number of cart'],400);
        $countProducts = count($allProductOfCart);
        //if user have 3 or more products with cart_number
        if($countProducts >= 3)
            return response()->json(['message' => 'Sorry Your cart have max ( 3 ) product.You cannot add more.'],400);
        //else make add product to user
        $newProductInCart = new Cart();
        $isInDB = $newProductInCart->getInitCartIfProductIdOfNull($user->id);
        if($isInDB){
            $newProductInCart = $isInDB;
            $newProductInCart->product_id = $product_id;
        }else{
            $newProductInCart->user_id = $user->id;
            $newProductInCart->product_id = $product_id;
            $newProductInCart->cart_number = $cart_number;
        }
        $newProductInCart->save();
        return response()->json(['product' => $newProductInCart,'message' => 'Successfully added product to cart'],200);
    }
    public function deleteProductFromCart($cart_number,$product_id)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $cart = Cart::where('user_id','=',$user->id)
                    ->where('cart_number','=',$cart_number)
                    ->where('product_id','=',$product_id)
                    ->first();
        if(!$cart)
            return response()->json(['message' => $cart,'cart' => $cart_number,'uid' => $user->id,'product_id' => $product_id],400);
        $allProductOfCart = Cart::getAllProductOfCart($cart_number,$user->id);
        //if is last product of cart then we have to set it as init with null product_id
        if(count($allProductOfCart) > 1 )
            $cart->delete();
        else{
            $cart->product_id = null;
            $cart->update();
        }
        return response()->json(['message' => 'Successfully deleted.'],200);

    }
    public function deleteCart($cart_number)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $cart = Cart::where('user_id','=',$user->id)->where('cart_number','=',$cart_number)->first();
        if(!$cart)
            return response()->json(['message' => 'Your have not this kind of cart'],400);
        $allProductOfCart = Cart::getAllProductOfCart($cart_number,$user->id);
       // return response()->json(['message' => count($allProductOfCart)],400);
        if(count($allProductOfCart) > 0){
            foreach($allProductOfCart as $littleProduct){
                $littleProduct->delete();
            }
            $cart->delete();
        }else{
            return response()->json(['message' => 'Are You sure You ave this cart ?'],400);
        }

        return response()->json(['message' => 'Successfully deleted cart with all products'],200);
    }
    public function show($cart_number)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $cart = Cart::where('user_id','=',$user->id)->where('cart_number','=',$cart_number)->first();
        if(!$cart)
            return response()->json(['message' => 'Your have not this kind of cart'],400);
        $allProductOfCart = Cart::getAllProductOfCart($cart_number,$user->id,true);
        // return response()->json(['message' => count($allProductOfCart)],400);
        if(count($allProductOfCart) > 0){
            $priceOfAllProducts = 0;
            //counting price from price column - there is price and curency name so we have to cut price
            foreach($allProductOfCart as $littleProduct){
                $priceOfAllProducts += floatval(strtok($littleProduct->price,' '));
            }
            //make decimal with 2 number after point
            $priceOfAllProducts = sprintf ("%.2f", $priceOfAllProducts);
            return response()->json(['price' => $priceOfAllProducts,'products' => $allProductOfCart],200);
        }else
            return response()->json(['message' => 'Are You sure You ave this cart ?'],400);

    }

}
