<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function colors()
    {
        return $this->hasMany(ProductColor::class, "id_product");
    }
    public function sizes()
    {
        return $this->hasMany(ProductSize::class, "id_product");
    }
    public function ocassions()
    {
        return $this->hasMany(ProductOcassion::class, "id_product");
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, "id_brand");
    }
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, "id_product_category");
    }
    public function cutting()
    {
        return $this->belongsTo(Cutting::class, "id_cutting");
    }
}
