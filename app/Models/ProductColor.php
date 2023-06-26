<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProductColor extends Model
{
    use HasFactory;

    public function color()
    {
        return $this->hasOne(Color::class, "id", "id_color");
    }

    public function getImagesAttribute()
    {
        $images = [];
        if( $this->attributes['images']){
            $data = json_decode($this->attributes['images']);
            foreach ($data as $key => $value) {
                $images[] = asset("image/products/".$this->attributes['id_product']."/".$value);
            }
        }
        return $images;
    }
}
