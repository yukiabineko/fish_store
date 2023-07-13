<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ["name", "price", "stock", "category", "info"];

    /**
     * リレーション関連
     */
    public function images(){
       return $this->hasMany(Image::class);
    }
    /**
     * 関連画像の最初の画像取得(サムネイル化)
     */
    public function thumbnail(){
       $first_image = $this->images()->get()[0]->path;
       return $first_image;
    }
}
