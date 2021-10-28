<?php namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'product_id',
        'user_id',
        'total_price',
        'price_per_prod',
        'quantity'
    ];

    public function product()
    {
        //hasOne, hasMany, belongsTo, belongsToMany
        return $this->hasMany(Product::class, 'product_id');
    }

    public function user()
    {
        //hasOne, hasMany, belongsTo, belongsToMany
        return $this->belongsTo(User::class, 'user_id');
    }
}
