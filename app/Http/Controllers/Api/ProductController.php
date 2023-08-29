<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ProductResource::collection(Product::paginate(5)) ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = Product::create([
            //titik 3 utk mengeluarkan data validate
                    ...$request->validate([
                        'name'=> 'required|string|max:20',
                        'description' => 'required',
                        'price' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
                        'image_url' => 'required',
                        'category_id' => 'required',
                    ]),
                        'user_id'=>1
                    ]);
                    return $product;
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load('category','user');
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product->update(
            //titik 3 dihapus dibagian update
            $request->validate([
                'name'=> 'required|string|max:20',
                'description' => 'required',
                'price' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
                'image_url' => 'required',
                'category_id' => 'required',
            ])
                // 'user_id'=>1
           );

           return $product;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'status' => '200',
            'success' => true,
            'message' => "deleted product successfully"
        ]);
    }
}
