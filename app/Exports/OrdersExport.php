<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrdersExport implements FromCollection, WithHeadings
{
    protected $orders;

    public function __construct($orders)
    {
        $this->orders = $orders;
    }

    public function collection(): Collection
    {
        return $this->orders->map(function ($order) {
            return [
                'Order ID' => $order->order_id,
                'Customer Name' => $order->rel_to_billing->name ?? 'No Billing Details',
                'Customer Mobile' => $order->rel_to_billing->mobile ?? 'No Billing Details',
                'Product' => $order->rel_to_orderpro->map(function ($OrderProduct) {
                    return $OrderProduct->rel_to_pro->name ?? '';
                })->join(', '),
                'Subtotal' => $order->sub_total,
                'Delivery Charge' => $order->delivery_charge,
                'Total' => $order->total,
                'Status' => $order->status,
                'Date' => $order->created_at->format('d-m-Y h:i:s')
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Order ID',
            'Customer Name',
            'Customer Mobile',
            'Product',
            'Subtotal',
            'Delivery Charge',
            'Total',
            'Status',
            'Date'
        ];
    }
}
