<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->hasOne(ArticleCategory::class, 'id', 'id_article_category');
    }
    public function getImagesNameAttribute()
    {
        return $this->attributes['images'];
    }

    public function getImagesAttribute()
    {
        $images = [];
        if( $this->attributes['images']){
            $data = json_decode($this->attributes['images']);
            foreach ($data as $key => $value) {
                $images[] = asset("image/articles/".$value);
            }
        }
        return $images;
    }
}
