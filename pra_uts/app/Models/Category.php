<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['name', 'description'])]
class Category extends Model
{
    use HasFactory;

    /**
     * Get the products that belong to the category.
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'category_product');
    }
}
