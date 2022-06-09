@extends('front.layouts.main')
@section('title', 'Kategori | '.$category->name)

@section('content')
    <!-- Main Content-->
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-9">
                @include('front.widgets.articleListWidget')
            </div>
            <div class="col-md-3">
                @include('front.widgets.categoryWidget')
            </div>
        </div>
    </div>
@endsection
