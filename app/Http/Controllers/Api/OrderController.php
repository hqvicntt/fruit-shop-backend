<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of today's orders and revenue summary.
     */
    public function index()
    {
        // Fetch orders created today, ordered by newest first
        $todayOrders = Order::whereDate('created_at', Carbon::today())
            ->orderBy('created_at', 'desc')
            ->get();

        // Calculate total cash and transfer revenue for today
        $totalCash = $todayOrders->sum('cash_amount');
        $totalTransfer = $todayOrders->sum('transfer_amount');
        $totalRevenue = $todayOrders->sum('total_amount');

        return response()->json([
            'success' => true,
            'message' => 'Lấy thống kê doanh thu hôm nay thành công',
            'summary' => [
                'total_revenue' => $totalRevenue,
                'total_cash' => $totalCash,
                'total_transfer' => $totalTransfer,
            ],
            'data' => $todayOrders
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
