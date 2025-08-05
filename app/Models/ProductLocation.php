<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\ProductLocation
 *
 * @property int $id
 * @property int $product_id
 * @property int $warehouse_location_id
 * @property int $quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\WarehouseLocation $warehouseLocation
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLocation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLocation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLocation query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLocation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLocation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLocation whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLocation whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLocation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLocation whereWarehouseLocationId($value)

 * 
 * @mixin \Eloquent
 */
class ProductLocation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'product_id',
        'warehouse_location_id',
        'quantity',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'quantity' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the product that owns the product location.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the warehouse location that owns the product location.
     */
    public function warehouseLocation(): BelongsTo
    {
        return $this->belongsTo(WarehouseLocation::class);
    }
}