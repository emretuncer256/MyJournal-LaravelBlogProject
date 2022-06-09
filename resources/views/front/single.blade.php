@extends('front.layouts.main')
@section('title', $article->title)
@section('category-name', $article->getCategory->name)
@section('bg-image', asset($article->image))
@section('content')
    <!-- Post Content-->
    <article class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-9 col-lg-9">
                    {!! $article->content !!}
                </div>
                <div class="col-md-3 col-lg-3">
                    @include('front.widgets.categoryWidget')
                </div>
            </div>
        </div>
    </article>
@endsection
