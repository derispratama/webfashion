<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    use HasFactory;

    public function size()
    {
        return $this->hasOne(Size::class, "id", "id_size");
    }

    public function sizechart()
    {
        return $this->hasMany(SizeChart::class, "id_product_size");
    }
    
}