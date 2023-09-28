<?php

namespace App\Http\Controllers;

use App\Models\Compensation;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Money\Currencies\ISOCurrencies;
use Money\Parser\IntlMoneyParser;


class CompensationController extends Controller
{
    public function create()
    {
        return view('compensation.create');
    }

    public function compensate()
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

        $searchedProducts = Product::whereIn('product', $queryProducts)->get();

        $outageStartDate = request()->all()['start_date'];
        $outageEndDate = request()->all()['end_date'];

        $compensationItems = collect();

        $searchedProducts->each(function ($product) use ($outageStartDate, $outageEndDate, $compensationItems) {
            $compensationPrice = $this->calculateCompensation($product, $outageStartDate, $outageEndDate);
            $productName = $product['product'];

            $compensationItems->push([
                'product' => $productName,
                'compensation_price' => $compensationPrice,
            ]);
        });

        dd($compensationItems);
    }

    public function calculateCompensation($product, $startDate, $endDate)
    {
        $outageStart = Carbon::parse($startDate);
        $outageEnd = Carbon::parse($endDate)->addDay();

        $daysInMonth = $outageStart->daysInMonth;
        $diffInDays = $outageStart->diffInDays($outageEnd);

        $percentage = $diffInDays / $daysInMonth;

        $currencies = new ISOCurrencies();

        $numberFormatter = new \NumberFormatter('nl_NL', \NumberFormatter::CURRENCY);
        $moneyParser = new IntlMoneyParser($numberFormatter, $currencies);

        $money = $moneyParser->parse($product['price']);

        return $money->getAmount() * $percentage;
    }
}
