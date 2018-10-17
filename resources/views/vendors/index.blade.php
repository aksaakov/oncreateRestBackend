@extends('layouts.app')

@section('content')
    <a class="btn btn-primary" href="{{ route('vendors.create') }}">{{__('messages.vendors.new')}}</a>
    <br>
    <br>

    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>{{__('messages.vendors.f_name')}}</th>
            <th>{{ __('messages.vendors.f_image') }}</th>
            <th>{{__('messages.vendors.f_sort')}}</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>
                    @if (!empty($item->image))
                        <img src="{{ $item->image }}" alt="" height="50px">
                    @endif
                </td>
                <td>
                    {{ $item->sort }}
                </td>
                <td>
                    @can('update', $item)
                        <a href="{{ route('vendors.edit', ['id' => $item->id]) }}" class="btn btn-info btn-xs">{{__('messages.actions.edit')}}</a>
                    @endcan
                    @can('delete', $item)
                        <form action="{{ route('vendors.destroy', ['id' => $item->id]) }}" class="inline-form" method="post">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button class="btn btn-danger btn-xs" type="submit">{{__('messages.actions.delete')}}</button>
                        </form>
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $items->appends(['filter' => $filter])->links() }}
@endsection