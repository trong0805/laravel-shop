<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'nameProduct',
        'price',
        'description',
        'avatar',
        'size_id',
        'statusPrd',
        'category_id'
    ];
    public function scopeSearch($query) {
        if($key = request()->search){
            $query = $query->where('nameProduct','like', '%'.$key.'%');
        }
        return $query;
    }
}
