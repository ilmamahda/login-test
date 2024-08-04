<?php

namespace App\Http\Controllers\Api;

//import model Post
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get all products
        $products = Product::all();

        //return collection of products as a resource
        return new ProductResource(true, 'List Data products', $products);
    }

    public function show($id)
    {
        //find post by ID
        $products = Product::find($id);

        //return single post as a resource
        return new ProductResource(true, 'Detail Data Post!', $products);
    }
}
