<?php

namespace App\Http\Controllers;

use App\Models\Billingdetails;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $status = $request->input('status');

            if (empty($startDate) && empty($endDate)) {
                $startDate = '';
                $endDate = '';
            }
            else {
                $endDate = Carbon::parse($endDate)->addDay();
                $endDate = $endDate->format('Y-m-d');
            }

            $query = Order::with('rel_to_billing')->orderBy('created_at', 'desc');

                if (!empty($startDate) && !empty($endDate)) {
                    $query->whereBetween('created_at', [$startDate, $endDate]);
                }

                if ($status === 'pending') {
                    $query->where('status', 0);
                } elseif ($status === 'hold') {
                    $query->where('status', 1);
                } elseif ($status === 'confirm') {
                    $query->where('status', 4);
                } elseif ($status === 'cancel') {
                    $query->where('status', 5);
                }

            if(!empty($startDate) && !empty($endDate)){
                // $orders = Order::with('rel_to_billing')->whereBetween('created_at', [$startDate, $endDate])->orderBy('created_at', 'desc')->get();
                $orders = $query->get();
                $total_orders = Order::whereBetween('created_at', [$startDate, $endDate])->orderBy('created_at', 'desc')->count();
                $pending_orders = Order::where('status', 0)->whereBetween('created_at', [$startDate, $endDate])->orderBy('created_at', 'desc')->count();
                $hold_orders = Order::where('status', 1)->whereBetween('created_at', [$startDate, $endDate])->orderBy('created_at', 'desc')->count();
                $confirm_orders = Order::where('status', 4)->whereBetween('created_at', [$startDate, $endDate])->orderBy('created_at', 'desc')->count();
                $cancel_orders = Order::where('status', 5)->whereBetween('created_at', [$startDate, $endDate])->orderBy('created_at', 'desc')->count();
                $total_completed = Order::where('status', 4)->whereBetween('created_at', [$startDate, $endDate])->orderBy('created_at', 'desc')->get();
            }
            else{
                // $orders = Order::with('rel_to_billing')->orderBy('created_at', 'desc')->get();
                $orders = $query->get();
                $total_orders = Order::orderBy('created_at', 'desc')->count();
                $pending_orders = Order::where('status', 0)->orderBy('created_at', 'desc')->count();
                $hold_orders = Order::where('status', 1)->orderBy('created_at', 'desc')->count();
                $confirm_orders = Order::where('status', 4)->orderBy('created_at', 'desc')->count();
                $cancel_orders = Order::where('status', 5)->orderBy('created_at', 'desc')->count();
                $total_completed = Order::where('status', 4)->get();
            }

        return view('backend.order.listorder',[
            'orders'=>$orders,
            'defaultStartDate' => $startDate,
            'defaultEndDate' => $endDate,
            'total_orders' => $total_orders,
            'pending_orders' => $pending_orders,
            'hold_orders' => $hold_orders,
            'confirm_orders' => $confirm_orders,
            'cancel_orders' => $cancel_orders,
            'total_completed' => $total_completed,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::where('status', 1)->get();
        return view('backend.order.addorder',[
            'products'=>$products,
        ]);
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $orders = Order::find($id);
        $bllingdetails = Billingdetails::where('order_id', $orders->order_id)->first();
        $orderproduct = OrderProduct::where('order_id', $orders->order_id)->get();
        return view('backend.order.editorder',[
            'orders'=>$orders,
            'bllingdetails'=>$bllingdetails,
            'orderproduct'=>$orderproduct,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */

     public function update(Request $request, string $id)
     {
         // Update Billingdetails
         if ($request->bllingdetails_id) {
             $billingdetails = Billingdetails::where('id', $request->bllingdetails_id)->first();
             $billingRules = [
                 'name' => 'required',
                 'district' => 'required',
                 'address' => 'required',
                 'mobile' => 'required',
                 'note' => 'nullable',
             ];
             $validatedData = $request->validate($billingRules);
             $billingdetails->update($validatedData);
         }

         // Update Order
         if ($request->orders_id) {
             $order = Order::where('id', $request->orders_id)->first();
             $subtotal = $request->product_price*$request->quantity;
             $subdelivary = $subtotal+$request->delivery_charge;
             $orderRules = [
                 'color' => 'required',
                 'discount' => 'required',
                 'delivery_charge' => 'required',
             ];
             $validatedOrder = $request->validate($orderRules);

             $validatedOrder['sub_total'] = $subtotal;
             $validatedOrder['total'] = $subdelivary-$request->discount;

             $order->update($validatedOrder);
         }

         // Update OrderProduct
         if ($request->orderproduct_id) {
             $orderProduct = OrderProduct::where('id', $request->orderproduct_id)->first();
             $orderProductRules = [
                 'quantity' => 'required',
             ];
             $validatedOrderProduct = $request->validate($orderProductRules);
             $orderProduct->update($validatedOrderProduct);
         }

         return back()->with('success', 'Update successfully.');
     }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $orders = Order::find($id);
        $order_id = $orders->order_id;

        Billingdetails::where('order_id', $order_id)->delete();
        OrderProduct::where('order_id', $order_id)->delete();
        $orders->delete();

        return back()->with('warning', 'Delete Successfully');
    }

        // order_status_update
        function order_status_update(Request $request){
            $after_explode = explode(',', $request->status);
            Order::where('order_id', $after_explode[0])->update([
                'status'=>$after_explode[1],
            ]);
            return back()->with('success', 'Order Status Update successfully.');
        }

        // invoice_download
        public function invoice_download($id){
            $orders = Order::find($id);
            $billingdetails = Billingdetails::where('order_id', $orders->order_id)->first();
            $order_product = OrderProduct::where('order_id', $orders->order_id)->get();
            $setting = Setting::all();

            $pdf = PDF::loadView('invoice.invoice', [
                'orders'=>$orders,
                'billingdetails'=>$billingdetails,
                'order_product'=>$order_product,
                'setting'=>$setting,
            ]);

            $pdf->getDomPDF()->getOptions()->set('fontDir', public_path('invoice/font/SutonnyMJ Regular/'));
            $pdf->getDomPDF()->getOptions()->set('fontCache', public_path('invoice/font/cache/'));
            $pdf->getDomPDF()->getOptions()->set('defaultFont', 'SutonnyMJ Regular');


            return $pdf->download('invoice.pdf');
        }

}
