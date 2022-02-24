@extends('Builder::layouts.app')

@section('content')
        @section('page_name'){{ucwords($page->title) ?? ''}}@endsection
        @section('meta')
        <meta name="description" content="{{$page->meta_description ?? ''}}">
        <meta name="keywords" content="{{$page->keywords ?? ''}}">
        @endsection

        @if ($page->template)
        {!! $page->template->content !!}
        @else
        {!! $page->decription !!}
        @endif

@endsection
