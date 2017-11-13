<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Product;

class ProductTest extends TestCase
{
//    /**
//     * A basic functional test example.
//     *
//     * @return void
//     */
//    public function testCreateRoute()
//    {
//        $response = $this->json('POST', '/api/product', ['title' => 'Ulala','price' => '2.99 USD']);
//        $response->assertStatus(201)
//                ->assertJson([
//                    'product' => ['title' => 'Ulala','price' => '2.99 USD']
//                ]);
//        // make some test for validate fields
//        $this->validateFields('POST','/api/product');
//    }
//    public function testIndexRoute()
//    {
//        $response = $this->json('GET', '/api/products');
//        $response->assertStatus(200);
//    }
//    public function testUpdateRoute()
//    {
//        $lastProduct = Product::orderBy('id','DESC')->first();
//        $response = $this->json('PUT', '/api/product/'.$lastProduct->id,['title' => 'alla', 'price' => '6.99 USD']);
//        $response->assertStatus(200)
//                    ->assertJson(['product' => ['title' => 'alla', 'price' => '6.99 USD']]);
//
//        $responseWrong = $this->json('PUT', '/api/product/9999');
//        $responseWrong->assertStatus(404)
//                        ->assertJson(['message' => 'Cannot find product']);
//
//        $responseWrong2 = $this->json('PUT', '/api/product/'.$lastProduct->id,['title' => 'alla', 'price' => '6.99 USD']);
//        $responseWrong2->assertStatus(404)
//                        ->assertJson(['message' => 'Nothing has been changed.']);
//        //validate fields
//        $this->validateFields('PUT','/api/product/'.$lastProduct->id);
//    }
//    public function testDeleteRoute()
//    {
//        $lastProduct = Product::orderBy('id','DESC')->first();
//        $response = $this->json('DELETE', '/api/product/'.$lastProduct->id);
//        $response->assertStatus(200)
//                    ->assertJson(['message' => 'Product deleted']);
//        $responseWrong = $this->json('DELETE', '/api/product/9999');
//        $responseWrong->assertStatus(404)
//                        ->assertJson(['message' => 'Cannot find product']);
//    }
//    private function validateFields($method,$url)
//    {
//        //incorect title field - is not present
//        $responseWrong = $this->json($method, $url,['title' => 'Ulala']);
//        $responseWrong->assertStatus(422)
//            ->assertJson(['message' => 'The given data was invalid.','errors' => ['price' => [trans('lang.validate_price.required')]]]);
//        //incorect price field - is regex not match
//        $responseWrong = $this->json($method, $url,['title' => 'Uasd','price' => 'hjgjhg']);
//        $responseWrong->assertStatus(422)
//            ->assertJson(['message' => 'The given data was invalid.','errors' => ['price' => [trans('lang.validate_price.regex')]]]);
//        //incorect title field - is not present
//        $responseWrong = $this->json($method, $url,['price' => '2.99 USD']);
//        $responseWrong->assertStatus(422)
//            ->assertJson(['message' => 'The given data was invalid.','errors' => ['title' => [trans('lang.validate_title.required')]]]);
//        //incorect title field - is not string
//        $responseWrong = $this->json($method, $url,['title' => 2.99,'price' => '2.99 USD']);
//        $responseWrong->assertStatus(422)
//            ->assertJson(['message' => 'The given data was invalid.','errors' => ['title' => [trans('lang.validate_title.string')]]]);
//        //incorect title field - is to short
//        $responseWrong2 = $this->json($method, $url,['title' => 'U','price' => '3.89 USD']);
//        $responseWrong2->assertStatus(422)
//            ->assertJson(['message' => 'The given data was invalid.','errors' => ['title' => [trans('lang.validate_title.min')]]]);
//
//        //incorect title field - is to long
//        $string160length = '0q4wqDCluNSnN4KFDXzubdCdhXlEAFejoDoZFrRVQ5PsTwPaoysXsUk9jmf5X1WtSztfsz9WdqsqUurkjEenWs2mIeZF6dy7dpe35j56aI3hAihdqxcgjcOfGCPJyV09n0YBk6WDIB3tnA4PoKIkhBqZA13E9Rkr';
//        $responseWrong2 = $this->json($method, $url,['title' => $string160length,'price' => '3.89 USD']);
//        $responseWrong2->assertStatus(422)
//            ->assertJson(['message' => 'The given data was invalid.','errors' => ['title' => [trans('lang.validate_title.max')]]]);
//    }
}
