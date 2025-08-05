<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\SalesOrder;
use App\Models\StockMovement;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with key metrics.
     */
    public function index()
    {
        $totalProducts = Product::active()->count();
        $lowStockProducts = Product::active()->lowStock()->count();
        $totalPurchaseOrders = PurchaseOrder::whereIn('status', ['pending', 'confirmed'])->count();
        $totalSalesOrders = SalesOrder::whereIn('status', ['pending', 'confirmed'])->count();
        
        $recentStockMovements = StockMovement::with(['product', 'warehouseLocation'])
            ->latest('movement_date')
            ->limit(10)
            ->get();
            
        $lowStockProducts = Product::with('category')
            ->active()
            ->lowStock()
            ->orderBy('stock_quantity')
            ->limit(5)
            ->get();

        return Inertia::render('dashboard', [
            'metrics' => [
                'totalProducts' => $totalProducts,
                'lowStockProducts' => $lowStockProducts->count(),
                'totalPurchaseOrders' => $totalPurchaseOrders,
                'totalSalesOrders' => $totalSalesOrders,
            ],
            'recentStockMovements' => $recentStockMovements,
            'lowStockProducts' => $lowStockProducts,
        ]);
    }
}