<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'category_id',
        'name',
        'price',
        'description',
        'image_path',
        'document_path',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
