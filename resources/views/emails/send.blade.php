<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<h2>{{ __('messages.orders.show_title', ['id' => $order->id]) }}</h2>
<p>
    <b>{{__('messages.orders.d_client_name')}}</b> {{ $order->name }}
</p>
<p>
    <b>{{__('messages.orders.d_address')}}</b> {{ $order->address }}
</p>
<p>
    <b>{{__('messages.orders.d_comment')}}</b> {{ $order->comment }}
</p>
<p>
    <b>{{__('messages.orders.d_area')}}</b>
    @if ($order->deliveryArea != null)
        {{ $order->deliveryArea->name }} ({{\App\Settings::currency($order->delivery_price)}})
    @endif
</p>
@if (\App\Settings::getSettings()->multiple_cities && $order->city != null)
    <p>
        <b>{{ __('messages.orders.f_city') }}</b> {{ $order->city->name }}
    </p>
@endif
@if (\App\Settings::getSettings()->multiple_restaurants && $order->restaurant != null)
    <p>
        <b>{{ __('messages.orders.f_restaurant') }}</b> {{ $order->restaurant->name }}
    </p>
@endif
<p>
    <b>{{__('messages.orders.d_phone')}}</b> {{ $order->phone }}
</p>
<style type="text/css">
    td {
        border: 1px solid black;
        padding: 5px 10px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid black;
    }
</style>
<table class="table table-striped table-hover" border="1" style="width: 100%; border-collapse: collapse; border: 1px solid black;">
    <thead>
    <tr>
        <th>{{__('messages.ordered_products.f_name')}}</th>
        <th>{{__('messages.ordered_products.f_price')}}</th>
        <th>{{__('messages.ordered_products.f_count')}}</th>
        <th>{{__('messages.ordered_products.f_total')}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($order->orderedProducts as $op)
        <tr>
            <td>{{ $op->product->name }}</td>
            <td>{{ \App\Settings::currency($op->price) }}</td>
            <td>{{ $op->count }}</td>
            <td>{{ \App\Settings::currency($op->price * $op->count) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@if ($order->deliveryArea != null)
    <p class="text-right">
        <b>{{ __('messages.orders.delivery_title') }}</b>
        {{\App\Settings::currency($order->delivery_price)}}
    </p>
@endif
@if ($order->promo_code != '')
    <p class="text-right">
        <b>{{ __('messages.orders.f_promo_code') }}</b>
        {{ $order->promo_code }}
    </p>
    <p class="text-right">
        <b>{{ __('messages.orders.d_promo_discount') }}</b>
        {{ \App\Settings::currency($order->promo_discount) }}
    </p>
@endif
<p class="text-right">
    <b>{{__('messages.orders.total_title')}}</b> {{ \App\Settings::currency($order->total_with_tax) }}
</p>
@if ($order->deliveryArea != null)
    <p class="text-right">
        <b>{{ __('messages.orders.grand_total_title') }}</b>
        {{\App\Settings::currency($order->getGrandTotal())}}
    </p>
@endif
</body>
</html>