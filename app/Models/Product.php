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

    public function category()
    {
        //hasOne, hasMany, belongsTo, belongsToMany
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }
}
