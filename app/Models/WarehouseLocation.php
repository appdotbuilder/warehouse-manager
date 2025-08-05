<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\WarehouseLocation
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string|null $description
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProductLocation> $productLocations
 * @property-read int|null $product_locations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\StockMovement> $stockMovements
 * @property-read int|null $stock_movements_count
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|WarehouseLocation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WarehouseLocation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WarehouseLocation query()
 * @method static \Illuminate\Database\Eloquent\Builder|WarehouseLocation whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WarehouseLocation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WarehouseLocation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WarehouseLocation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WarehouseLocation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WarehouseLocation whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WarehouseLocation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WarehouseLocation active()
 * @method static \Database\Factories\WarehouseLocationFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class WarehouseLocation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'code',
        'name',
        'description',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the product locations for this warehouse location.
     */
    public function productLocations(): HasMany
    {
        return $this->hasMany(ProductLocation::class);
    }

    /**
     * Get the stock movements for this warehouse location.
     */
    public function stockMovements(): HasMany
    {
        return $this->hasMany(StockMovement::class);
    }

    /**
     * Scope a query to only include active warehouse locations.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}