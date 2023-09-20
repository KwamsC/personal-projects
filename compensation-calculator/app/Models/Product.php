<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\MoneyCast;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'price',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'price' => MoneyCast::class . ':price',
    ];

    // 'money' => MoneyDecimalCast::class . ':USD,true',

    public function scopeFilter($query, array $filters)
    {
        if ($filters['group'] ?? false) {
            $query->where('group', 'like', '%' . request('group') . '%');
        }

        if ($filters['search'] ?? false) {
            $query->where('product', 'like', '%' . request('search') . '%')
                ->orWhere('group', 'like', '%' . request('search') . '%');
        }
    }
}
