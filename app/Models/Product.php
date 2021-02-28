<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use NumberFormatter;
use App\Models\Comment;
use App\Models\Category;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'price', 'picture'];

    public function presentPrice(){
       
        $oFormatter = new \NumberFormatter('de_DE', \NumberFormatter::CURRENCY);
        return $oFormatter->formatCurrency($this->price / 100, 'EUR');
      
       
    }

    public function comments(){
      return $this->hasMany(Comment::class);
      
  }

  public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function avgRating($id){
        $product = Product::find($id);
        $avg = $product->comments()->avg('rating');
        return $avg;
    }

    public function averages(){
        return $this->belongsToMany(Average::class);
    }

    public function color_product_sizes(){
        return $this->hasMany(ColorProductSize::class);
    }

    public function order(){
        return $this->belongsToMany(Order::class, 'order_products');
    }

}
