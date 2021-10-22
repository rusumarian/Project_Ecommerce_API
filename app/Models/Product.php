<?php namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'title',
        'category_id',
        'description',
        'price',
        'in_stock',
        'color',
        'quantity'
    ];

    public function scopeFilter($query, array $filters) //Product::newQuery
    {
        $query->when($filters['search'] ?? false, function ($searchQuery, $search){
            $searchQuery->where(fn($query)=>
                $query->where('title', 'like', '%'. $search . '%')
                        ->orWhere('description', 'like', '%'. $search . '%'));
        });

        $query->when($filters['category'] ?? false, fn ($categoryQuery, $category) =>
            $categoryQuery->whereHas('category', fn ($query) =>
                $query->where('category_id', $category)
            ));

        $query->when($filters['in-stock'] ?? false, fn ($stockQuery, $stock) =>
            $stockQuery->where('in_stock', true));

        $query->when($filters['out-of-stock'] ?? false, fn ($stockQuery, $stock) =>
            $stockQuery->where('in_stock', false));

        $query->when($filters['color'] ?? false, fn ($colorQuery, $color) =>
            $colorQuery->where(fn($query) =>
                $query->where('color', 'like', '%'. $color . '%')));

        $query->when($filters['price-min'] ?? false, fn ($priceQuery, $price) =>
            $priceQuery->where(fn($query) =>
                $query->where('price', '>=', $price )));

        $query->when($filters['price-max'] ?? false, fn ($priceQuery, $price) =>
            $priceQuery->where(fn($query) =>
                $query->where('price', '<=', $price )));

    }
    public function category()
    {
        //hasOne, hasMany, belongsTo, belongsToMany
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }
}
