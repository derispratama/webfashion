<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOcassion extends Model
{
    use HasFactory;
    
    public function ocassion()
    {
        return $this->hasOne(Ocassion::class, "id", "id_ocassion");
    }
}
