@extends('layouts.app')

@section('content')
    INDEX HOMEPAGE
    @foreach($items as $item)
    <td>{{ $item->Title }}</td>
    <td>{{ $item->Description }}</td>
    @endforeach
@endsection