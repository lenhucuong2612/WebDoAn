@component('mail::message')

<h2 style='text-align: center: #333'>Order Invoice</h2>
<p>Dear {{$order->first_name}} {{$order->last_name}}, </p>

<p>Order Status: <b>
@if ($order->status=0)
Pedding
@elseif($order->status=1)
In Progress
@elseif($order->status=2)
Delivered
@elseif($order->status=3)
Completed
@elseif($order->status=4)
Cancelled
@endif
</p>

<h3>Order Details: </h3>
<ul>
    <li>Order Number: {{$order->order_number}}</li>
    <li>Date of Purchase: {{date('d-m-Y',strtotime($order->created_at))}}</li>
    <li>Shipping Address: {{$order->address_one}} or {{$order->address_two}}</li>
</ul>
<table style="with;100%; border-collapse; margin-bottom;20px">
    <thead>
        <tr>
            <th style="border-bottom;1px solid #ddd; padding:8px; text-align:left;">Item</th>
            <th style="border-bottom;1px solid #ddd; padding:8px; text-align:left;">Quantity</th>
            <th style="border-bottom;1px solid #ddd; padding:8px; text-align:left;">price</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($order->getItem as $item)
        <tr>
            <td style="padding: 8px; border-bottom:1px solid #ddd;">
                {{$item->getProduct->title}}
                <br>
                Color: {{$item->color_name}}
                @if (!empty($item->size_name))
                    <br>
                    Size: {{$item->size_name}}
                    <br>
                    Size Amount: ${{number_format($item->size_amount,2)}}
                @endif
            </td>
            <td style="padding: 8px; border-bottom:1px solid #ddd;">{{$item->quantity}}</td>
            <td style="padding: 8px; border-bottom:1px solid #ddd;">{{number_format($item->total_price,2)}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<p>Shipping Name: <b>{{$order->getShipping->name}}</p>
<p>Shipping Amount: <b>${{number_format($order->shipping_amount,2)}}</p>
@if (!empty($order->discount_code))
<p>Discount Code: <b>{{$order->discount_code}}</p>
<p>Discount Amount: <b>${{number_format($order->discount_amount,2)}}</p>
@endif
<p>Total Amount: <b>${{number_format($order->total_amount,2)}}</p>
<p style="text-transform:capitalize">Payment Method: {{$order->payment_method}}</p>
<p>Please find the attached invoice for your reference. If you have any questions or concerns regarding your
    order or the invoice, feel free to contact us at <strong></strong>.
</p>
<p>Thank you for choosing <strong>E-Commerce</strong>. We appreciate your  business.</p>

Thanks,<br>
{{ config("app.name") }}
@endcomponent
