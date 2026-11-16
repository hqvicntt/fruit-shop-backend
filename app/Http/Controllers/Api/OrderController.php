<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of orders and revenue summary filtered by a specific date.
     */
    public function index(Request $request)
    {
        // Get the 'date' query parameter from the URL, default to today if not provided
        $targetDate = $request->query('date') ? Carbon::parse($request->query('date')) : Carbon::today();

        // Fetch orders created on the selected date, ordered by newest first
        $filteredOrders = Order::whereDate('created_at', $targetDate)
            ->orderBy('created_at', 'desc')
            ->get();

        // Calculate total cash, bank transfer, and overall revenue for the selected date
        $totalCash = $filteredOrders->sum('cash_amount');
        $totalTransfer = $filteredOrders->sum('transfer_amount');
        $totalRevenue = $filteredOrders->sum('total_amount');

        return response()->json([
            'success' => true,
            'message' => 'Lấy thống kê doanh thu thành công',
            'date' => $targetDate->toDateString(),
            'summary' => [
                'total_revenue' => $totalRevenue,
                'total_cash' => $totalCash,
                'total_transfer' => $totalTransfer,
            ],
            'data' => $filteredOrders
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input data from mobile app
        $validatedData = $request->validate([
            'total_amount' => 'required|integer|min:0',
            'cash_amount' => 'required|integer|min:0',
            'transfer_amount' => 'required|integer|min:0',
            'items_summary' => 'nullable|string',
        ]);

        // Create a new order record in MySQL
        $order = Order::create($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Lưu lịch sử đơn hàng thành công',
            'data' => $order
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
