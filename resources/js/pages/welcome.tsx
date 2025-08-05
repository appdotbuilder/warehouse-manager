import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';

export default function Welcome() {
    const { auth } = usePage<SharedData>().props;

    return (
        <>
            <Head title="Warehouse Management System">
                <link rel="preconnect" href="https://fonts.bunny.net" />
                <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
            </Head>
            <div className="flex min-h-screen flex-col items-center bg-gradient-to-br from-blue-50 to-indigo-100 p-6 text-gray-900 lg:justify-center lg:p-8 dark:from-gray-900 dark:to-gray-800 dark:text-gray-100">
                <header className="mb-6 w-full max-w-[335px] text-sm lg:max-w-6xl">
                    <nav className="flex items-center justify-end gap-4">
                        {auth.user ? (
                            <Link
                                href={route('dashboard')}
                                className="inline-block rounded-lg bg-blue-600 px-6 py-2.5 text-sm font-medium text-white hover:bg-blue-700 transition-colors shadow-md"
                            >
                                Go to Dashboard
                            </Link>
                        ) : (
                            <>
                                <Link
                                    href={route('login')}
                                    className="inline-block rounded-lg border border-gray-300 px-5 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700"
                                >
                                    Log in
                                </Link>
                                <Link
                                    href={route('register')}
                                    className="inline-block rounded-lg bg-blue-600 px-5 py-2 text-sm font-medium text-white hover:bg-blue-700 transition-colors shadow-md"
                                >
                                    Register
                                </Link>
                            </>
                        )}
                    </nav>
                </header>
                
                <div className="flex w-full items-center justify-center opacity-100 transition-opacity duration-750 lg:grow">
                    <main className="flex w-full max-w-6xl flex-col lg:flex-row lg:gap-12">
                        {/* Hero Section */}
                        <div className="flex-1 text-center lg:text-left lg:py-20">
                            <div className="mb-6">
                                <span className="text-6xl mb-4 block">📦</span>
                                <h1 className="text-4xl lg:text-6xl font-bold mb-4 text-gray-900 dark:text-white">
                                    Warehouse Management System
                                </h1>
                                <p className="text-xl lg:text-2xl text-gray-600 dark:text-gray-300 mb-8">
                                    Efficiently manage inventory, track product movements, and streamline warehouse operations
                                </p>
                            </div>

                            {/* Key Features */}
                            <div className="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                                <div className="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                                    <div className="text-3xl mb-3">📋</div>
                                    <h3 className="font-semibold text-lg mb-2">Product Management</h3>
                                    <p className="text-gray-600 dark:text-gray-400 text-sm">
                                        Add, edit, and track products with SKUs, pricing, and categories
                                    </p>
                                </div>
                                
                                <div className="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                                    <div className="text-3xl mb-3">📊</div>
                                    <h3 className="font-semibold text-lg mb-2">Inventory Tracking</h3>
                                    <p className="text-gray-600 dark:text-gray-400 text-sm">
                                        Real-time stock levels and location-specific inventory management
                                    </p>
                                </div>
                                
                                <div className="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                                    <div className="text-3xl mb-3">🚚</div>
                                    <h3 className="font-semibold text-lg mb-2">Order Management</h3>
                                    <p className="text-gray-600 dark:text-gray-400 text-sm">
                                        Handle purchase and sales orders with complete tracking
                                    </p>
                                </div>
                                
                                <div className="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                                    <div className="text-3xl mb-3">📈</div>
                                    <h3 className="font-semibold text-lg mb-2">Smart Reports</h3>
                                    <p className="text-gray-600 dark:text-gray-400 text-sm">
                                        Stock levels, movement history, and low stock alerts
                                    </p>
                                </div>
                            </div>

                            {/* CTA Buttons */}
                            <div className="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                                {auth.user ? (
                                    <Link
                                        href={route('dashboard')}
                                        className="inline-flex items-center justify-center rounded-lg bg-blue-600 px-8 py-4 text-lg font-medium text-white hover:bg-blue-700 transition-colors shadow-lg"
                                    >
                                        <span className="mr-2">🚀</span>
                                        Access Dashboard
                                    </Link>
                                ) : (
                                    <>
                                        <Link
                                            href={route('register')}
                                            className="inline-flex items-center justify-center rounded-lg bg-blue-600 px-8 py-4 text-lg font-medium text-white hover:bg-blue-700 transition-colors shadow-lg"
                                        >
                                            <span className="mr-2">🚀</span>
                                            Get Started
                                        </Link>
                                        <Link
                                            href={route('login')}
                                            className="inline-flex items-center justify-center rounded-lg border-2 border-blue-600 px-8 py-4 text-lg font-medium text-blue-600 hover:bg-blue-50 transition-colors dark:text-blue-400 dark:border-blue-400 dark:hover:bg-gray-800"
                                        >
                                            <span className="mr-2">👤</span>
                                            Sign In
                                        </Link>
                                    </>
                                )}
                            </div>
                        </div>

                        {/* Visual Section */}
                        <div className="flex-1 mt-12 lg:mt-0">
                            <div className="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl p-8 transform rotate-1 hover:rotate-0 transition-transform duration-300">
                                <h3 className="text-xl font-bold mb-6 text-center">System Overview</h3>
                                
                                {/* Mock Dashboard Preview */}
                                <div className="space-y-4">
                                    <div className="grid grid-cols-2 gap-4">
                                        <div className="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg">
                                            <div className="text-2xl font-bold text-blue-600 dark:text-blue-400">1,247</div>
                                            <div className="text-sm text-gray-600 dark:text-gray-400">Total Products</div>
                                        </div>
                                        <div className="bg-red-50 dark:bg-red-900/20 p-4 rounded-lg">
                                            <div className="text-2xl font-bold text-red-600 dark:text-red-400">23</div>
                                            <div className="text-sm text-gray-600 dark:text-gray-400">Low Stock</div>
                                        </div>
                                    </div>
                                    
                                    <div className="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                        <div className="text-sm font-medium mb-2">Recent Activity</div>
                                        <div className="space-y-2 text-xs text-gray-600 dark:text-gray-400">
                                            <div className="flex justify-between">
                                                <span>📦 Product ABC123 received</span>
                                                <span>2 min ago</span>
                                            </div>
                                            <div className="flex justify-between">
                                                <span>🚚 Order #1001 shipped</span>
                                                <span>1 hour ago</span>
                                            </div>
                                            <div className="flex justify-between">
                                                <span>⚠️ Low stock alert: DEF456</span>
                                                <span>3 hours ago</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </>
    );
}