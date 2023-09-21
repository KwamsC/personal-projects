<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Http;

class CompensationController extends Controller
{
    public function create()
    {
        return view('compensation.create');
    }

    public function calculateCompensation()
    {
        $formFields = request()->validate([
            'product' => 'required|min:2',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ], [
            'product.required' => 'Product field is required.',
            'product.min' => 'Invalid product name',
            'start_date.required' => 'Start date field is required.',
            'end_date.required' => 'End date field is required.',
        ]);

        $queryProducts = explode(',', request()->all()['product']);

        // Dates
        $startDate = date_create(request()->all()['start_date']);
        $endDate = date_create(request()->all()['end_date']);

        // $allProducts = collect();
        $allProducts = [];

        foreach ($queryProducts as $key) {
            $productItems = Product::whereProduct(trim($key))->get();

            // if ($productItems->contains(1)) {
            // $allProducts->push($productItems);
            array_push($allProducts, $productItems);
            // }

            // dd($productItems);

            // $product =  P
            // array_push($products, $productItem);
        }
        dd($allProducts);

        // dd($products);

        // dd(request()->all());

        // $products = Product::whereProduct('Film1')->get();

        // dd($products);
        // dd(request()->all());
    }
}
