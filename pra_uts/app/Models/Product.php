<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['name', 'description', 'price', 'stock'])]
class Product extends Model
{
    use HasFactory;

    /**
     * Get the categories that belong to the product.
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }
}
