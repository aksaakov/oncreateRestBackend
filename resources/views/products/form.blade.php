<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

@extends('layouts.app')

@section('content')

    <form method="post" action="@if ($item->id == null) {{ route('products.store') }} @else {{ route('products.update', ['id' => $item->id]) }} @endif" enctype="multipart/form-data">
        {{ csrf_field() }}

        <h1>Add product</h1>
        <h3>Menu item</h3>
        @if ($item->id != null)
            {{ method_field('PUT') }}
        @endif

        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="" class="control-label">{{__('messages.products.f_name')}}</label>
            <input type="text" class="form-control" value="{{$item->name}}" name="name"/>
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('sort') ? ' has-error' : '' }}">
            <label for="" class="control-label">{{__('messages.products.sort')}}</label>
            <input type="text" class="form-control" value="{{$item->sort}}" name="sort"/>
            @if ($errors->has('sort'))
                <span class="help-block">
                    <strong>{{ $errors->first('sort') }}</strong>
                </span>
            @endif
        </div>

        <div class="row">
            @if (\App\Settings::getSettings()->multiple_cities)
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="" class="control-label">{{__('messages.products.f_city')}}</label>
                        <select name="city_id" class="form-control" id="cities">
                            <option value=""></option>
                            @foreach(\App\City::policyScope()->get() as $city)
                                <option value="{{$city->id}}" @if ($item->city_id == $city->id) selected @endif>
                                    {{$city->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif
            @if (\App\Settings::getSettings()->multiple_restaurants)
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="" class="control-label">{{__('messages.products.f_restaurant')}}</label>
                        <select name="restaurant_id" class="form-control" id="restaurants">
                            <option value=""></option>
                            @foreach(\App\Restaurant::policyScope()->get() as $restaurant)
                                <option data-city="{{ $restaurant->city_id }}" value="{{$restaurant->id}}" @if ($item->restaurant_id == $restaurant->id) selected @endif>
                                    {{$restaurant->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="" class="control-label">{{__('messages.products.f_category')}}</label>
            <select name="category_id" class="form-control" id="categories">
                <option value=""></option>
                @foreach($categories as $category)
                    <option data-city="{{ $category->city }}" data-restaurant="{{ $category->restaurant_id }}" value="{{$category->id}}" @if ($item->category_id == $category->id) selected @endif>
                        @for ($i = 0; $i < $category->depth; $i++) - @endfor {{$category->name}}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="" class="control-label">{{__('messages.products.f_vendor')}}</label>
            <select name="vendor_id" class="form-control">
                <option value=""></option>
                @foreach(\App\Vendor::all() as $vendor)
                    <option value="{{$vendor->id}}" @if ($item->vendor_id == $vendor->id) selected @endif>
                        {{$vendor->name}}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="" class="control-label">{{__('messages.products.f_tax_group')}}</label>
            <select name="tax_group_id" class="form-control">
                <option value=""></option>
                @foreach(\App\TaxGroup::all() as $tg)
                    <option value="{{$tg->id}}" @if ($item->tax_group_id == $tg->id) selected @endif>
                        {{$tg->name}}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group {{ $errors->has('price') ? ' has-error' : '' }}">
                    <label for="" class="control-label">{{__('messages.products.f_price')}}</label>
                    <input type="text" class="form-control" value="{{$item->price}}" name="price"/>
                    @if ($errors->has('price'))
                        <span class="help-block">
                            <strong>{{ $errors->first('price') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group {{ $errors->has('price_old') ? ' has-error' : '' }}">
                    <label for="" class="control-label">{{__('messages.products.f_price_old')}}</label>
                    <input type="text" class="form-control" value="{{$item->price_old}}" name="price_old"/>
                    @if ($errors->has('price_old'))
                        <span class="help-block">
                            <strong>{{ $errors->first('price_old') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="" class="control-label">{{__('messages.products.f_description')}}</label>
            <textarea name="description" class="form-control">{{ $item->description }}</textarea>
            @if ($errors->has('description'))
                <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif
        </div>

        <h3>{{__('messages.products.f_image')}}</h3>
        <div class="row">
            @foreach($item->productImages as $image)
                <div class="col-sm-4 js-product-image-{{$image->id}}">
                    <div class="product-image-holder">
                        <a href="#" class="product-image-delete js-delete-product-image" data-id="{{$image->id}}">
                            <span class="glyphicon glyphicon-remove"></span>
                        </a>
                        <img src="{{$image->image}}" alt="" class="img-responsive">
                    </div>
                </div>
            @endforeach
        </div>
        <h4>{{__('messages.products.add_images')}}</h4>
        <div class="js-product-images-holder row">
            <div class="form-group js-product-image col-sm-4">
                <input type="file" name="image[]">
            </div>
        </div>
        <a href="#" class="js-add-image">
            <span class="glyphicon glyphicon-plus"></span>
            {{__('messages.products.add_image')}}
        </a>

        <br>
        <br>


        <br>
        <label for="" class="control-label">Extras:</label>
        <div class="row">
            <table id="options1" class="table table-bordered">
            @foreach(App\ProductExtras::where('extra_type', 'Extras')->get()  as $extras)

                <tr id="{{$extras->id}}">
                    <td>{{$extras->extra_name}}</td>
                    <td style="width:20%;">{{$extras->extra_price}}</td>
                    <td>
                        <a type="button" name="remove" onclick="deleteRow(this)" class="btn btn-danger btn_remove">
                            <span class="glyphicon glyphicon-remove"></span>
                        </a>
                    </td>
                </tr>
            @endforeach

            </table>
            <tr id="extra-1">
                <td><button type="button" name="addExtra" id="addExtra" class="btn btn-success">Add Option</button></td>
            </tr>
        </div>

        <br>

        <label for="" class="control-label">Exclusions:</label>
        <div class="row">
            <table id="options2" class="table table-bordered">
                @foreach(App\ProductExtras::where('extra_type', 'Exclusions')->get() as $extras)
                    <tr id="{{$extras->id}}">
                        <td>{{$extras->extra_name}}</td>
                        <td>
                            <a type="button" name="remove" onclick="deleteRow(this)" class="btn btn-danger btn_remove">
                                <span class="glyphicon glyphicon-remove"></span>
                            </a>
                        </td>
                    </tr>
                @endforeach

            </table>
            <tr id="extra-1">
                <td><button type="button" name="addExtra2" id="addExtra2" class="btn btn-success">Add Option</button></td>
            </tr>
        </div>
        <div>


            {{--<input type="button" name="submit" id="submit" class="btn btn-info" value="Submit" />--}}
        </div>

        <br>
        <br>

        <button type="submit" class="btn btn-primary btn-block">{{__('messages.actions.save')}}</button>
    </form>
    @if (\App\Settings::getSettings()->multiple_cities || \App\Settings::getSettings()->multiple_restaurants)
        <script src="/custom_js/products.js"></script>
    @endif
@endsection

<script>
    $(document).ready(function(){
        var postURL = "<?php echo url('addmore'); ?>";
        var extras= document.getElementById('options1').rows.length;
        var exclusions= document.getElementById('options2').rows.length;
        var target = [];

        $('#addExtra').click(function(){
            extras++;
            $('#options1').append('<tr id="row'+extras+'" class="dynamic-added" ><td>' +
                '<input type="text" name="extras[]" class="form-control name_list" /></td>' +
                '<td style="width:20%;"><input type="text" name="extra_price[]" value="0" class="form-control name_list" /></td>' +
                '<td><button style="margin-left: 20px;" type="button" name="remove" id="'+extras+'" class="btn btn-danger btn_remove">' +
                '<span class="glyphicon glyphicon-remove"></span>' +
                '</button></td></tr>');

            var cells = target.get("td");
            for (var i = 0; i < cells.length; i++) {
                data.push(cells[i].innerHTML);
            }
        });


        $('#addExtra2').click(function(){
            exclusions++;
            $('#options2').append('<tr id="row'+exclusions+'" class="dynamic-added" ><td>' +
                '<input style="width:80%; type="text" name="exclusions[]" class="form-control name_list" /></td>' +
                '<td><button style="margin-left: 20px;" type="button" name="remove" id="'+exclusions+'" class="btn btn-danger btn_remove">' +
                '<span class="glyphicon glyphicon-remove"></span>' +
                '</button></td></tr>');

            var cells = target.get("td");
            for (var i = 0; i < cells.length; i++) {
                data.push(cells[i].innerHTML);
            }
        });


        $(document).on('click', '.btn_remove', function(){
            var button_id = $(this).attr("id");
            $('#row'+button_id+'').remove();
        });

        $('#submit').click(function(){
            var cells = target.get("td");
            for (var i = 0; i < cells.length; i++) {
                data.push(cells[i].innerHTML);
            }
        });
    });

    function deleteRow(btn) {
        var row = btn.parentNode.parentNode;
        row.parentNode.removeChild(row);
        var id = row.id;
        {{--{{ url('product_extra', id) }}--}}
        $.get('/product_extra/' + id + '/delete');
    }

</script>