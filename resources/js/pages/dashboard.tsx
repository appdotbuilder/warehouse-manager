import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';

interface StockMovement {
    id: number;
    type: string;
    quantity: number;
    movement_date: string;
    product: {
        name: string;
        sku: string;
    };
    warehouse_location: {
        name: string;
    } | null;
    [key: string]: unknown;
}

interface LowStockProduct {
    id: number;
    name: string;
    sku: string;
    stock_quantity: number;
    min_stock_level: number;
    category: {
        name: string;
    };
    [key: string]: unknown;
}

interface Props {
    metrics: {
        totalProducts: number;
        lowStockProducts: number;
        totalPurchaseOrders: number;
        totalSalesOrders: number;
    };
    recentStockMovements: StockMovement[];
    lowStockProducts: LowStockProduct[];
    [key: string]: unknown;
}

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

export default function Dashboard({ metrics, recentStockMovements, lowStockProducts }: Props) {
    const getMovementIcon = (type: string) => {
        switch (type) {
            case 'inbound':
                return '📦';
            case 'outbound':
                return '🚚';
            case 'adjustment':
                return '🔧';
            default:
                return '📋';
        }
    };

    const getMovementColor = (type: string) => {
        switch (type) {
            case 'inbound':
                return 'text-green-600 bg-green-50 dark:text-green-400 dark:bg-green-900/20';
            case 'outbound':
                return 'text-red-600 bg-red-50 dark:text-red-400 dark:bg-red-900/20';
            case 'adjustment':
                return 'text-blue-600 bg-blue-50 dark:text-blue-400 dark:bg-blue-900/20';
            default:
                return 'text-gray-600 bg-gray-50 dark:text-gray-400 dark:bg-gray-900/20';
        }
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Warehouse Dashboard" />
            <div className="flex h-full flex-1 flex-col gap-6 rounded-xl p-6 overflow-x-auto">
                {/* Header */}
                <div className="flex flex-col gap-2">
                    <h1 className="text-3xl font-bold text-gray-900 dark:text-white">📦 Warehouse Dashboard</h1>
                    <p className="text-gray-600 dark:text-gray-400">
                        Overview of your warehouse operations and inventory status
                    </p>
                </div>

                {/* Metrics Cards */}
                <div className="grid auto-rows-min gap-4 md:grid-cols-4">
                    <div className="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm">
                        <div className="flex items-center justify-between">
                            <div>
                                <p className="text-sm font-medium text-gray-600 dark:text-gray-400">Total Products</p>
                                <p className="text-3xl font-bold text-gray-900 dark:text-white">{metrics.totalProducts}</p>
                            </div>
                            <div className="text-3xl">📋</div>
                        </div>
                    </div>

                    <div className="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm">
                        <div className="flex items-center justify-between">
                            <div>
                                <p className="text-sm font-medium text-gray-600 dark:text-gray-400">Low Stock Items</p>
                                <p className="text-3xl font-bold text-red-600 dark:text-red-400">{metrics.lowStockProducts}</p>
                            </div>
                            <div className="text-3xl">⚠️</div>
                        </div>
                    </div>

                    <div className="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm">
                        <div className="flex items-center justify-between">
                            <div>
                                <p className="text-sm font-medium text-gray-600 dark:text-gray-400">Purchase Orders</p>
                                <p className="text-3xl font-bold text-blue-600 dark:text-blue-400">{metrics.totalPurchaseOrders}</p>
                            </div>
                            <div className="text-3xl">📥</div>
                        </div>
                    </div>

                    <div className="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm">
                        <div className="flex items-center justify-between">
                            <div>
                                <p className="text-sm font-medium text-gray-600 dark:text-gray-400">Sales Orders</p>
                                <p className="text-3xl font-bold text-green-600 dark:text-green-400">{metrics.totalSalesOrders}</p>
                            </div>
                            <div className="text-3xl">📤</div>
                        </div>
                    </div>
                </div>

                {/* Main Content Grid */}
                <div className="grid gap-6 lg:grid-cols-2">
                    {/* Recent Stock Movements */}
                    <div className="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
                        <div className="p-6 border-b border-gray-200 dark:border-gray-700">
                            <h2 className="text-xl font-semibold text-gray-900 dark:text-white">Recent Stock Movements</h2>
                            <p className="text-sm text-gray-600 dark:text-gray-400">Latest inventory changes</p>
                        </div>
                        <div className="p-6">
                            {recentStockMovements.length > 0 ? (
                                <div className="space-y-4">
                                    {recentStockMovements.map((movement) => (
                                        <div key={movement.id} className="flex items-center justify-between p-3 rounded-lg bg-gray-50 dark:bg-gray-700/50">
                                            <div className="flex items-center gap-3">
                                                <div className={`p-2 rounded-full ${getMovementColor(movement.type)}`}>
                                                    {getMovementIcon(movement.type)}
                                                </div>
                                                <div>
                                                    <div className="font-medium text-gray-900 dark:text-white">
                                                        {movement.product.name}
                                                    </div>
                                                    <div className="text-sm text-gray-600 dark:text-gray-400">
                                                        SKU: {movement.product.sku}
                                                        {movement.warehouse_location && ` • ${movement.warehouse_location.name}`}
                                                    </div>
                                                </div>
                                            </div>
                                            <div className="text-right">
                                                <div className={`font-semibold ${movement.type === 'inbound' ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400'}`}>
                                                    {movement.type === 'inbound' ? '+' : '-'}{movement.quantity}
                                                </div>
                                                <div className="text-xs text-gray-500 dark:text-gray-400">
                                                    {new Date(movement.movement_date).toLocaleDateString()}
                                                </div>
                                            </div>
                                        </div>
                                    ))}
                                </div>
                            ) : (
                                <div className="text-center py-8 text-gray-500 dark:text-gray-400">
                                    <div className="text-4xl mb-2">📦</div>
                                    <p>No recent stock movements</p>
                                </div>
                            )}
                        </div>
                    </div>

                    {/* Low Stock Alerts */}
                    <div className="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
                        <div className="p-6 border-b border-gray-200 dark:border-gray-700">
                            <h2 className="text-xl font-semibold text-gray-900 dark:text-white">Low Stock Alerts</h2>
                            <p className="text-sm text-gray-600 dark:text-gray-400">Products that need restocking</p>
                        </div>
                        <div className="p-6">
                            {lowStockProducts.length > 0 ? (
                                <div className="space-y-4">
                                    {lowStockProducts.map((product) => (
                                        <div key={product.id} className="flex items-center justify-between p-3 rounded-lg bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800">
                                            <div className="flex items-center gap-3">
                                                <div className="p-2 rounded-full bg-red-100 dark:bg-red-900/30">
                                                    ⚠️
                                                </div>
                                                <div>
                                                    <div className="font-medium text-gray-900 dark:text-white">
                                                        {product.name}
                                                    </div>
                                                    <div className="text-sm text-gray-600 dark:text-gray-400">
                                                        {product.category.name} • SKU: {product.sku}
                                                    </div>
                                                </div>
                                            </div>
                                            <div className="text-right">
                                                <div className="font-semibold text-red-600 dark:text-red-400">
                                                    {product.stock_quantity} / {product.min_stock_level}
                                                </div>
                                                <div className="text-xs text-red-500 dark:text-red-400">
                                                    Min stock level
                                                </div>
                                            </div>
                                        </div>
                                    ))}
                                </div>
                            ) : (
                                <div className="text-center py-8 text-gray-500 dark:text-gray-400">
                                    <div className="text-4xl mb-2">✅</div>
                                    <p>All products are well stocked</p>
                                </div>
                            )}
                        </div>
                    </div>
                </div>

                {/* Quick Actions */}
                <div className="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm p-6">
                    <h2 className="text-xl font-semibold text-gray-900 dark:text-white mb-4">Quick Actions</h2>
                    <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <a
                            href="/products"
                            className="flex flex-col items-center justify-center p-4 rounded-lg bg-blue-50 dark:bg-blue-900/20 hover:bg-blue-100 dark:hover:bg-blue-900/30 transition-colors group"
                        >
                            <div className="text-2xl mb-2 group-hover:scale-110 transition-transform">📦</div>
                            <span className="text-sm font-medium text-blue-700 dark:text-blue-300">Manage Products</span>
                        </a>
                        
                        <div className="flex flex-col items-center justify-center p-4 rounded-lg bg-green-50 dark:bg-green-900/20 hover:bg-green-100 dark:hover:bg-green-900/30 transition-colors group cursor-pointer">
                            <div className="text-2xl mb-2 group-hover:scale-110 transition-transform">📥</div>
                            <span className="text-sm font-medium text-green-700 dark:text-green-300">Purchase Orders</span>
                        </div>
                        
                        <div className="flex flex-col items-center justify-center p-4 rounded-lg bg-purple-50 dark:bg-purple-900/20 hover:bg-purple-100 dark:hover:bg-purple-900/30 transition-colors group cursor-pointer">
                            <div className="text-2xl mb-2 group-hover:scale-110 transition-transform">📤</div>
                            <span className="text-sm font-medium text-purple-700 dark:text-purple-300">Sales Orders</span>
                        </div>
                        
                        <div className="flex flex-col items-center justify-center p-4 rounded-lg bg-orange-50 dark:bg-orange-900/20 hover:bg-orange-100 dark:hover:bg-orange-900/30 transition-colors group cursor-pointer">
                            <div className="text-2xl mb-2 group-hover:scale-110 transition-transform">📊</div>
                            <span className="text-sm font-medium text-orange-700 dark:text-orange-300">Reports</span>
                        </div>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}