<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug'
    ];
    public function product()
    {
        //hasOne, hasMany, belongsTo, belongsToMany
        return $this->hasMany(Product::class);
    }
}
