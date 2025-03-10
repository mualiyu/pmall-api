<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'store_id',
        'category_id',
        'sub_category_id',
        'brand_id',
        'name',
        'image',
        'description',
        'cost_price',
        'selling_price',
        'inStock',
        'quantity',
        'tags',
        'status',
        'more_images',
    ];

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'store_id', 'store_id');  // Assuming 'store_id' is the vendor's user ID
    }

    // brand
    public function brand(): BelongsTo
    {
        return $this->belongsTo(ProductBrand::class, 'brand_id');
    }

    // category
    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    // category
    public function sub_category(): BelongsTo
    {
        return $this->belongsTo(ProductSubCategory::class, 'sub_category_id');
    }
}
