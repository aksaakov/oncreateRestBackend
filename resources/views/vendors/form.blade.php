@extends('layouts.app')

@section('content')
    <form method="post" action="@if ($item->id == null) {{ route('vendors.store') }} @else {{ route('vendors.update', ['id' => $item->id]) }} @endif" enctype="multipart/form-data">
        {{ csrf_field() }}
        @if ($item->id != null)
            {{ method_field('PUT') }}
        @endif

        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="" class="control-label">{{__('messages.vendors.f_name')}}</label>
            <input type="text" class="form-control" value="{{$item->name}}" name="name"/>
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('sort') ? ' has-error' : '' }}">
            <label for="" class="control-label">{{__('messages.vendors.f_sort')}}</label>
            <input type="text" class="form-control" value="{{$item->sort}}" name="sort"/>
            @if ($errors->has('sort'))
                <span class="help-block">
                    <strong>{{ $errors->first('sort') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <label for="" class="control-label">{{__('messages.vendors.f_image')}}</label>
            @if ($item->image != null)
                <div class="row">
                    <div class="col-xs-6">
                        <img src="{{ $item->image }}" alt="" class="img-responsive">
                    </div>
                </div>
            @endif
            <input type="file" name="image">
        </div>

        <button type="submit" class="btn btn-primary btn-block">{{__('messages.actions.save')}}</button>
    </form>
@endsection