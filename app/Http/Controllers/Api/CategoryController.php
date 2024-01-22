<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoriesResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth:sanctum')->except(['index','show']);
        // $this->authorizeResource(Category::class, 'category');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    return CategoriesResource::collection(Category::all()) ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = Category::create([
    //titik 3 utk mengeluarkan data validate
            ...$request->validate([
                'name'=> 'required|string|max:20',
                'description' => 'required',
            ])

            ]);
            return $category;
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $category->load('products');
        return $category;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
       $category->update(
        //titik 3 dihapus dibagian update
        $request->validate([
            'name'=> 'required|string|max:20',
            'description' => 'required',
        ])
       );

       return $category;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([
            'status' => '200',
            'success' => true,
            'message' => "deleted category successfully"
        ]);
    }
}
