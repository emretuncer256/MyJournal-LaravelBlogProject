@extends('front.layouts.main')
@section('title', $page->title)

@section('bg-image', $page->image)

@section('content')
    <!-- Main Content-->
    <main class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-12">
                    <p>{!! $page->content !!}</p>
                </div>
            </div>
        </div>
    </main>
@endsection
