<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use JWTAuth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if($request->page )
            $page = $request->page;
        else
            $page = 0;
        //return response()->json(['page' => $page],200);
        $allProducts = Product::skip($request->page*3)->take(3)->get();
        $lastProduct = Product::count();
        $lastPage = false;
        if($lastProduct <= $request->page*3 + 3)
            $lastPage = true;
        $respose = [
            'products'  => $allProducts, 'lastPage' => $lastPage
        ];
        return response()->json($respose,200);
    }
    public function create(Request $request)
    {
        $user = JWTAuth::parseToken()->toUser();
        $this->isValid($request->all());
        $product = new Product();
        $product->title = $request->title;
        $product->price = $request->price;
        $product->save();
        return response()->json(['product' => $product,'user' => $user],201);
    }

    public function update($id,Request $request)
    {
        $productFromDB = Product::where('id','=',$id)->first();
        if(!$productFromDB)
            return response()->json(['message' => 'Cannot find product'],404);
        if( $request->title != $productFromDB->title ||
            $request->price != $productFromDB->price){
            $this->isValid($request->all());
            $productFromDB->title = $request->title;
            $productFromDB->price = $request->price;
            $productFromDB->save();
            return response()->json(['product' => $productFromDB],200);
        }else
            return response()->json(['message' => 'Nothing has been changed.'],404);

    }

    public function delete($id)
    {
        $product = Product::where('id','=',$id)->first();
        if(!$product)
            return response()->json(['message' => 'Cannot find product'],404);
        $product->delete();
        return response()->json(['message' => 'Product deleted'],200);
    }
    /**
     * validate inputs in request
     * @param  $input
     */
    private function isValid($input)
    {
        $rules=[
            'title'				=> 'required|string|min:2|max:150',
            'price'	            => ['required',
                                    'max:40',
                                    'regex:/(\d+)(?:(?:[\.\s]0+|(\.\d+)))?\s?USD/']
        ];

        Validator::make($input, $rules,
            [
                'title.required'                => trans('lang.validate_title.required'),
                'title.string'                  => trans('lang.validate_title.string'),
                'title.min'                     => trans('lang.validate_title.min'),
                'title.max'                     => trans('lang.validate_title.max'),
                'price.required'                => trans('lang.validate_price.required'),
                'price.regex'                   => trans('lang.validate_price.regex'),
            ])->validate();
    }
}
