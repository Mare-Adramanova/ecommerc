<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['type'];

    public function products(){
        return $this->belongsToMany(Product::class);
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

}
