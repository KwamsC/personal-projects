<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use App\Casts\MoneyCast;
use App\Models\Compensation;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCompensationIndexRequest;

class CompensationController extends Controller
{
    public function create()
    {
        return view('compensations.create');
    }

    public function index()
    {
        return view('compensations.index', [
            'compensationList' => Compensation::latest()->get()
        ]);
    }

    public function compensate(StoreCompensationIndexRequest $request)
    {
        if
        $formFields = $request->validated();

        // request variables
        $productNames = array_map('trim', explode(',', $formFields['product']));
        $outageStartDate = $formFields['start_date'];
        $outageEndDate = $formFields['end_date'];
        $wholeMonthCalculation = request()->has('whole_month_calculation');

        $queriedProducts = $this->getQueriedProducts($productNames);

        $queriedProducts->each(function ($product) use ($outageStartDate, $outageEndDate,  $wholeMonthCalculation) {
            $compensationPrice = $wholeMonthCalculation
                ? $product->price
                : $this->calculateCompensation($product->price, $outageStartDate, $outageEndDate);

            Compensation::create([
                'product_name' =>  $product->product,
                'price' => $compensationPrice,
                'user_id' => auth()->id()
            ]);
        });

        return redirect('/compensations')->with('message', 'Compensation created succesfully');
    }

    protected function getQueriedProducts($productNames)
    {
        return Product::whereIn('product', $productNames)->get()
            ->groupBy('product')->map(function ($group) {
                return $group->sortByDesc('startDate')->first();
            })->values();
    }

    protected function calculateCompensation($price, $startDate, $endDate)
    {
        $outageStart = Carbon::parse($startDate);

        $outageEnd = Carbon::parse($endDate)->addDay();

        $daysInMonth = $outageStart->daysInMonth;
        $diffInDays = $outageStart->diffInDays($outageEnd);

        $percentage = $diffInDays / $daysInMonth;

        $parser = MoneyCast::getFormatterOrParser('parser');
        $money = $parser->parse($price);

        return intval($money->getAmount() * $percentage);
    }

    public function manage()
    {
        return view('compensations.manage', [
            'compensations' => Auth::user()->compensations()->get(),
        ]);
    }
}
