<!DOCTYPE html>
<html lang="en">
<head>
    @include('front.layouts.header')
</head>
<body>
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="/">
            @if($config->logo)
                <img style="width: 17%" class="rounded-circle" src="{{asset($config->logo)}}" alt="">
            @endif
            {{$config->title}}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto py-4 py-lg-0">
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="/">Anasayfa</a></li>
                @isset($pages)
                    @foreach($pages as $page)
                        <li class="nav-item">
                            <a class="nav-link px-lg-3 py-3 py-lg-4"
                               href="{{route('page', $page->slug)}}">{{$page->title}}</a>
                        </li>
                    @endforeach
                @endisset
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="{{route('contact')}}">İletişim</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
@include('front.widgets.headWidget')
@yield('content')
@include('front.layouts.footer')
</body>
</html>
