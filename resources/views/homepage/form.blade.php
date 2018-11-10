@extends('layouts.app')

@section('content')
<form method="post" action="@if ($item->Title == null) {{ route('homepage.store') }} @else {{ route('homepage.update', ['Title' => $item->Title]) }} @endif" enctype="multipart/form-data">
{{csrf_field()}}

<h1>{{ __('messages.homepage.menu_title') }}</h1>

    <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
        <label for="" class="control-label">{{__('messages.homepage.title')}}</label>
        <input type="text" class="form-control" value="{{$item->Title}}" name="Title"/>
        @if ($errors->has('title'))
                <span class="help-block">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
        @endif
    </div>

        <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
        <label for="" class="control-label">{{__('messages.homepage.description')}}</label>
        <textarea type="textarea" maxlength="500" rows="8" class="form-control" name="Description">{{$item->Description}}</textarea>
        @if ($errors->has('title'))
                <span class="help-block">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
        @endif
    </div>
        <!-- Image upload -->
    <div class="form-group">
        <label for="" class="control-label">{{('Image')}}</label>
        @if ($item->image != null)
            <div class="row">
                <div class="col-xs-6">
                    <img src="{{ $item->image_url }}" alt="" class="img-responsive">
                </div>
            </div>
        @endif
        <input type="file" name="image">
    </div>

        <button type="submit" class="btn btn-primary btn-block">{{__('messages.actions.save')}}</button>
</form>

</form>
@endsection