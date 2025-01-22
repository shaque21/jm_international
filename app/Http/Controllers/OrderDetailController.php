<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\OrderMaster;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class OrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.reports.index');
    }

    public function generateReports(Request $request)
    {
        // Get report type (daily, monthly, yearly)
        // Get report type
        $reportType = $request->input('report_type', 'daily'); // Default to daily

        // Parse dates as Carbon instances or default to the current month
        $startDate = $request->input('start_date') 
            ? Carbon::parse($request->input('start_date')) 
            : Carbon::now()->startOfMonth();

        $endDate = $request->input('end_date') 
            ? Carbon::parse($request->input('end_date')) 
            : Carbon::now()->endOfMonth();

        // Fetch orders grouped by the chosen report type
        $orders = OrderDetail::with(['orderMaster.customer', 'product'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get()
            ->groupBy(function ($order) use ($reportType) {
                if ($reportType === 'daily') {
                    return $order->created_at->format('Y-m-d'); // Group by day
                } elseif ($reportType === 'monthly') {
                    return $order->created_at->format('Y-m'); // Group by month
                } elseif ($reportType === 'yearly') {
                    return $order->created_at->format('Y'); // Group by year
                }
            });


        // Return the view with data
        return view('admin.reports.index', compact('orders', 'startDate', 'endDate', 'reportType'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderDetails $orderDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrderDetails $orderDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrderDetails $orderDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderDetails $orderDetails)
    {
        //
    }
}
