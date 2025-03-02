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
    // Get the start and end dates from the form (use current date if not set)
    $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : null;
    $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date')) : null;
    $customerId = $request->input('customer_id'); // Get selected customer id
    $depoId = $request->input('depo_id'); // Get selected depo id
    $warehouseId = $request->input('warehouse_id'); // Get selected warehouse id
    $employeeId = $request->input('employee_id'); // Get selected employee id

    // Base query with joins and selects
    $query = OrderDetail::with([
            'product', 
            'orderMaster.customer', 
            'orderMaster.creator', 
            'orderMaster.warehouse', 
            'orderMaster.depo'
        ])
        ->join('order_masters', 'order_details.order_master_id', '=', 'order_masters.id')
        ->select('order_details.*', 'order_masters.order_date'); // Add the order_date to the select

    // Apply date range filter if start and end date are provided
    if ($startDate && $endDate) {
        $query->whereBetween('order_masters.order_date', [$startDate->startOfDay(), $endDate->endOfDay()]);
    }

    // Apply customer filter if customer_id is provided
    if ($customerId) {
        $query->where('order_masters.customer_id', $customerId);
    }

    // Apply depo filter if depo_id is provided
    if ($depoId) {
        $query->where('order_masters.depo_id', $depoId);
    }

    // Apply warehouse filter if warehouse_id is provided
    if ($warehouseId) {
        $query->where('order_masters.warehouse_id', $warehouseId);
    }

    // Apply employee filter if employee_id is provided
    if ($employeeId) {
        $query->where('order_masters.user_id', $employeeId);
    }

    // Order the results in descending order based on order_date
    $orders = $query->orderBy('order_masters.order_date', 'desc')->get();

    // Fetch additional data for filtering
    $customers = \App\Models\User::where('role_id', 3)->get(); // Get customers with role_id 3
    $employees = \App\Models\User::where('role_id', 2)->get(); // Get employees with role_id 2
    $depos = \App\Models\Depo::all(); // Get all depos
    $warehouses = \App\Models\Warehouse::all(); // Get all warehouses

    // Pass the data to the view
    return view('admin.reports.index', compact('orders', 'customers', 'employees', 'depos', 'warehouses'));
}


}
