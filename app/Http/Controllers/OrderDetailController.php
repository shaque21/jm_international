<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\OrderMaster;
use App\Models\User;
use App\Models\Depo;
use App\Models\Warehouse;
use Carbon\Carbon;

class OrderDetailController extends Controller
{
    public function index(Request $request)
    {
        // Fetch customers (role_id = 3) and employees (role_id = 2) for filtering
        $customers = User::where('role_id', 3)->get();
        $employees = User::where('role_id', 2)->get();
        $depos = Depo::all();
        $warehouses = Warehouse::all();

        return view('admin.reports.index', compact('customers', 'employees', 'depos', 'warehouses'));
    }


    public function generateReports(Request $request)
{
    $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : null;
    $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date')) : null;
    $customerId = $request->input('customer_id');
    $depoId = $request->input('depo_id');
    $warehouseId = $request->input('warehouse_id');
    $employeeId = $request->input('employee_id');
    $productId = $request->input('product_id');

    // Main query (only delivered)
    $query = OrderDetail::with([
            'product', 
            'orderMaster.customer', 
            'orderMaster.creator', 
            'orderMaster.warehouse', 
            'orderMaster.depo'
        ])
        ->join('order_masters', 'order_details.order_master_id', '=', 'order_masters.id')
        ->select('order_details.*', 'order_masters.order_date')
        ->where('order_masters.order_status', 1); // Only delivered

    // Filters
    if ($startDate && $endDate) {
        $query->whereBetween('order_masters.order_date', [$startDate->startOfDay(), $endDate->endOfDay()]);
    }

    if ($customerId) {
        $query->where('order_masters.customer_id', $customerId);
    }

    if ($depoId) {
        $query->where('order_masters.depo_id', $depoId);
    }

    if ($warehouseId) {
        $query->where('order_masters.warehouse_id', $warehouseId);
    }

    if ($employeeId) {
        $query->where('order_masters.user_id', $employeeId);
    }

    if ($productId) {
        $query->where('order_details.product_id', $productId);
    }

    $orders = $query->orderBy('order_masters.order_date', 'desc')->get();

    // Total qty for selected product (delivered only)
    $totalQty = null;
    if ($productId) {
        $totalQty = $orders->sum('delivered_qty');
    }
    $cancelledOrders = OrderDetail::with([
        'product',
        'orderMaster.customer',
        'orderMaster.creator',
        'orderMaster.warehouse',
        'orderMaster.depo'
    ])
    ->join('order_masters', 'order_details.order_master_id', '=', 'order_masters.id')
    ->select('order_details.*', 'order_masters.order_date')
    ->where('order_masters.order_status', 0) // cancelled only
    ->when($startDate && $endDate, fn($q) => $q->whereBetween('order_masters.order_date', [$startDate->startOfDay(), $endDate->endOfDay()]))
    ->get();


    $customers = \App\Models\User::where('role_id', 3)->get();
    $employees = \App\Models\User::where('role_id', 2)->get();
    $depos = \App\Models\Depo::all();
    $warehouses = \App\Models\Warehouse::all();
    $products = \App\Models\Product::all();

    return view('admin.reports.index', compact('orders', 'customers', 'employees', 'depos', 'warehouses', 'products', 'totalQty', 'productId','cancelledOrders'));
}

    



}
