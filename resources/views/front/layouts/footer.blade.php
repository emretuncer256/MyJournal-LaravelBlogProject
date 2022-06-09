<!-- Footer-->
<footer class="border-top">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <ul class="list-inline text-center">
                    @if($config->youtube)
                        <li class="list-inline-item">
                            <a href="{{$config->youtube}}">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-youtube fa-stack-1x fa-inverse"></i>
                                    </span>
                            </a>
                        </li>
                    @endif
                    @if($config->twitter)
                        <li class="list-inline-item">
                            <a href="{{$config->twitter}}">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                                    </span>
                            </a>
                        </li>
                    @endif
                    @if($config->facebook)
                        <li class="list-inline-item">
                            <a href="{{$config->facebook}}">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                                    </span>
                            </a>
                        </li>
                    @endif
                    @if($config->instagram)
                            <li class="list-inline-item">
                                <a href="{{$config->youtube}}">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-instagram fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                    @endif
                    @if($config->github)
                        <li class="list-inline-item">
                            <a href="{{$config->github}}">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                                    </span>
                            </a>
                        </li>
                    @endif
                    @if($config->linkedin)
                            <li class="list-inline-item">
                                <a href="{{$config->youtube}}">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-linkedin-in fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                    @endif
                </ul>
                <div class="small text-center text-muted fst-italic">Copyright
                    &copy; {{$config->title}} {{date('Y')}}</div>
            </div>
        </div>
    </div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="{{asset('front')}}/js/scripts.js"></script>
