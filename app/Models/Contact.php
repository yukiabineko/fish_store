<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = [ "name", "title", "email", "context", "user_id", "replay"];

    /**
     * 関連お客様
     */
    public function user(){
        return $this->belongsTo(User::class);
    }
}
