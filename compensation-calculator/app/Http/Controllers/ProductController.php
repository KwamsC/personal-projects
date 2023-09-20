<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('products.index', [
            'products' => Product::latest()->filter(request(['group', 'search']))->get()
        ]);
    }

    public function show(string $id): View
    {
        return view('products.show', [
            'product' => Product::find($id)
        ]);
    }
}
