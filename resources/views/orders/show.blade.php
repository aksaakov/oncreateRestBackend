@extends('layouts.app')

@section('content')

        @foreach(App\User::find(1)->unreadNotifications as $notification)

                {{--@php ($orders[] = $notification->data['order_id']);--}}
                @if($item->id == $notification->data['order_id'])
                    @php($notification->markAsRead())
                @endif
        @endforeach

    <p>
        <b>{{ __('messages.orders.delivery_boy') }}</b>
        <form action="{{ route('orders.update_boy', ['id' => $item->id]) }}" method="post" class="inline-form">
            {{ csrf_field() }}
            @if ($item->id != null)
                {{ method_field('PUT') }}
            @endif
            <select name="delivery_boy_id" class="js-delivery-boy">
                <option value=""></option>
                @foreach (\App\DeliveryBoy::all() as $deliveryBoy)
                    <option @if ($deliveryBoy->id == $item->delivery_boy_id) selected @endif value="{{ $deliveryBoy->id }}">{{ $deliveryBoy->name }}</option>
                @endforeach
            </select>
        </form>
    </p>
    <p>
        <b>{{__('messages.orders.d_client_name')}}</b> {{ $item->name }}
    </p>
    <p>
        <b>{{__('messages.orders.d_address')}}</b> {{ $item->address }}
    </p>
    <p>
        <b>{{__('messages.orders.d_comment')}}</b> {{ $item->comment }}
    </p>
    @if (\App\Settings::getSettings()->multiple_cities && $item->city != null)
        <p>
            <b>{{ __('messages.orders.f_city') }}</b> {{ $item->city->name }}
        </p>
    @endif
    @if (\App\Settings::getSettings()->multiple_restaurants && $item->restaurant != null)
        <p>
            <b>{{ __('messages.orders.f_restaurant') }}</b> {{ $item->restaurant->name }}
        </p>
    @endif
    <p>
        <b>{{__('messages.orders.d_area')}}</b>
        @if ($item->deliveryArea != null)
            {{ $item->deliveryArea->name }} ({{\App\Settings::currency($item->delivery_price)}})
        @endif
    </p>
    <p>
        <b>{{__('messages.orders.d_phone')}}</b> {{ $item->phone }}
    </p>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>{{__('messages.ordered_products.f_name')}}</th>
                <th>{{__('Price')}}</th>
                <th>{{__('Extras/Exclusions')}}</th>
                <th>{{__('Extra Price')}}</th>
{{--                <th>{{__('messages.ordered_products.f_count')}}</th>--}}
                <th>{{__('messages.ordered_products.f_total')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($item->orderedProducts as $op)
                <tr>
{{--                    {{ json_decode($op['extras_total'], true) }}--}}
                    <td>{{ $op->product->name }}</td>
                    <td>{{  \App\Settings::currency($op->product->price) }}</td>
                    <td>
                    @php(\App\Settings::currency($extra_price_sum = 0))
                    @foreach(json_decode($op->extras, true) as $extra)
                        {{ $extra['extra_name'] }}<br>
                    @endforeach
                    @foreach(json_decode($op->exclusions, true) as $exclusion)
                        -{{ $exclusion['extra_name'] }}<br>
                    @endforeach
                    </td>

                    <td>
                    @foreach(json_decode($op->extras, true) as $extra)
                        {{ \App\Settings::currency($extra['extra_price']) }}<br>
                            @php($extra_price_sum += $extra['extra_price'])
                    @endforeach
                    </td>
                    <td><strong>{{ \App\Settings::currency($op->price + $extra_price_sum) }}</strong></td>
                </tr>
            @endforeach
        </tbody>
    </table>
        <p class="text-right">
            <b>{{'Total:'}}</b> {{ \App\Settings::currency($item->total + $extra_price_sum) }}
        </p>
    @if ($item->deliveryArea != null)
        <p class="text-right">
            <b>{{ __('messages.orders.delivery_title') }}</b>
            {{\App\Settings::currency($item->delivery_price)}}
        </p>
    @endif
    @if ($item->promo_code != '')
        <p class="text-right">
            <b>{{ __('messages.orders.f_promo_code') }}</b>
            {{ $item->promo_code }}
        </p>
        <p class="text-right">
            <b>{{ __('messages.orders.d_promo_discount') }}</b>
            {{ \App\Settings::currency($item->promo_discount) }}
        </p>
    @endif
    <p class="text-right">
        <b>{{'Tax:'}}</b> {{ \App\Settings::currency($item->tax) }}
    </p>
    <p class="text-right">
        <b>{{ 'Grand Total:' }}</b> {{ \App\Settings::currency($item->getGrandTotal() + $extra_price_sum) }}
    </p>
@endsection