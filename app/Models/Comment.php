<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['text', 'rating'];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function avgRating($id){
        $product = Product::find($id);
        $avg = $product->comments()->avg('rating');
        return $avg;
    }

}
