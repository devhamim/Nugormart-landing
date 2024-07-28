<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use app\Exports\OrdersExport;

class ExalController extends Controller
{
    //orders_export
    function orders_export(Request $request){
        $orderIds = explode(',', $request->input('exal_data'));
        $orders = Order::whereIn('id', $orderIds)->get();
        return Excel::download(new OrdersExport($orders), 'orders.xlsx');
    }
}
