@extends('layouts.app')

@section('content')
<form method="post" action="@if ($item->Title == null) {{ route('homepage.store') }} @else {{ route('homepage.update', ['Title' => $item->Title]) }} @endif" enctype="multipart/form-data">
{{csrf_field()}}

<h1>{{ __('messages.homepage.menu_title') }}</h1>
<h4>Storefront</h4>

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
    <br>

    <h4>Working Hours</h4>
    <table class="table table-striped table-hover">
    <thead>
    <tr>
            <th>Day</th>
            <th>Opening</th>
            <th>Closing</th>
        </tr>
        </thead>
        <tbody>
            
        <tr><td>Monday</td><td><input type="time" value="{{ $item->mon_open }}" name="mon_open"></td><td><input type="time" value="{{ $item->mon_close }}" name="mon_close"></td></tr>
        <tr><td>Tuesday</td><td><input type="time" value="{{ $item->tue_open }}" name="tue_open"></td><td><input type="time" value="{{ $item->tue_close }}" name="tue_close"></td></tr>
        <tr><td>Wednesday</td><td><input type="time" value="{{ $item->wed_open }}" name="wed_open"></td><td><input type="time" value="{{ $item->wed_close }}" name="wed_close"></td></tr>
        <tr><td>Thursday</td><td><input type="time" value="{{ $item->thu_open }}" name="thu_open"></td><td><input type="time" value="{{ $item->thu_close }}" name="thu_close"></td></tr>
        <tr><td>Friday</td><td><input type="time" value="{{ $item->fri_open }}" name="fri_open"></td><td><input type="time" value="{{ $item->fri_close }}" name="fri_close"></td></tr>
        <tr><td>Saturday</td><td><input type="time" value="{{ $item->sat_open }}" name="sat_open"></td><td><input type="time" value="{{ $item->sat_close }}" name="sat_close"></td></tr>
        <tr><td>Sunday</td><td><input type="time" value="{{ $item->sun_open }}" name="sun_open"></td><td><input type="time" value="{{ $item->sun_close }}" name="sun_close"></td></tr>
        </tbody>
    </table>
    <br>

    <h4>Contact Details</h4>
    <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
        <label for="" class="control-label">Address:</label>
        <input type="text" class="form-control" value="{{$item->address}}" name="address"/>
        @if ($errors->has('address'))
                <span class="help-block">
                    <strong>{{ $errors->first('address') }}</strong>
                </span>
        @endif
    </div>
    <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
        <label for="" class="control-label">Phone Number:</label>
        <input type="text" class="form-control" value="{{$item->phone}}" name="phone"/>
        @if ($errors->has('phone'))
                <span class="help-block">
                    <strong>{{ $errors->first('phone') }}</strong>
                </span>
        @endif
    </div>
    <div class="form-group {{ $errors->has('facebook') ? ' has-error' : '' }}">
        <label for="" class="control-label">Facebook:</label>
        <input type="text" class="form-control" value="{{$item->facebook}}" name="facebook"/>
        @if ($errors->has('facebook'))
                <span class="help-block">
                    <strong>{{ $errors->first('facebook') }}</strong>
                </span>
        @endif
    </div>
    <div class="form-group {{ $errors->has('twitter') ? ' has-error' : '' }}">
        <label for="" class="control-label">Twitter:</label>
        <input type="text" class="form-control" value="{{$item->twitter}}" name="twitter"/>
        @if ($errors->has('twitter'))
                <span class="help-block">
                    <strong>{{ $errors->first('twitter') }}</strong>
                </span>
        @endif
    </div>
    <div class="form-group {{ $errors->has('instagram') ? ' has-error' : '' }}">
        <label for="" class="control-label">Instagram:</label>
        <input type="text" class="form-control" value="{{$item->instagram}}" name="instagram"/>
        @if ($errors->has('instagram'))
                <span class="help-block">
                    <strong>{{ $errors->first('instagram') }}</strong>
                </span>
        @endif
    </div>
    <br>

    <button type="submit" class="btn btn-primary btn-block">{{__('messages.actions.save')}}</button>
</form>
@endsection