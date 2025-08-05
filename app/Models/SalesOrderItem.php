<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\SalesOrderItem
 *
 * @property int $id
 * @property int $sales_order_id
 * @property int $product_id
 * @property int $quantity
 * @property int $shipped_quantity
 * @property string $unit_price
 * @property string $total_price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\SalesOrder $salesOrder
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|SalesOrderItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SalesOrderItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SalesOrderItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|SalesOrderItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesOrderItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesOrderItem whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesOrderItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesOrderItem whereSalesOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesOrderItem whereShippedQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesOrderItem whereTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesOrderItem whereUnitPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesOrderItem whereUpdatedAt($value)

 * 
 * @mixin \Eloquent
 */
class SalesOrderItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'sales_order_id',
        'product_id',
        'quantity',
        'shipped_quantity',
        'unit_price',
        'total_price',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'quantity' => 'integer',
        'shipped_quantity' => 'integer',
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the sales order that owns the item.
     */
    public function salesOrder(): BelongsTo
    {
        return $this->belongsTo(SalesOrder::class);
    }

    /**
     * Get the product that owns the item.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}