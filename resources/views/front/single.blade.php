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
    <hr>
    <section class="container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 py-3">
                    <h3>Yorumlar <span class="badge bg-secondary rounded float-end">{{$comments->count()}}</span></h3>
                    <div style="max-height: 75vh; overflow-x: hidden;" class="container-fluid overflow-scroll bg-light"
                         id="comments">
                        @include('front.widgets.singleCommentWidget')
                    </div>
                </div>
                <div class="col-lg-6 py-3">
                    <div class="card rounded-3 shadow">
                        <div class="card-header border-primary">
                            <h3 class="card-title text-primary">Yorum Yap</h3>
                        </div>
                        <div class="card-body">
                            <form id="commentForm">
                                @csrf
                                <input name="article_id" type="hidden" value="{{$article->id}}">
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control rounded" placeholder="Tam Adınız"
                                           name="fullname" id="fullname" required>
                                </div>
                                <div class="form-group mb-5">
                                    <textarea maxlength="200" class="form-control rounded" placeholder="Yorumunuz"
                                              name="content"
                                              id="content" cols="30" rows="10" onkeyup="updateCount(value)"></textarea>
                                    <div id="contentLength" class="text-muted float-end">200/0</div>
                                </div>
                                <button type="submit" class="btn btn-primary float-end rounded">Gönder</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        function updateCount(value) {
            $('#contentLength').html('200/' + value.length);
        }
    </script>
    <script>
        $(function () {
            $('#commentForm').submit(function (e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "{{route('comment.store')}}",
                    data: $(this).serialize(),
                    success: (data) => {
                        if (data == 'success') {
                            toastr.success('Yorumunuz için teşekkürler.');
                        } else {
                            toastr.error('Üzgünüz bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.');
                        }
                        $("#fullname").val('');
                        $("#content").val('');
                        $('#contentLength').html('200/0');
                    }
                });
            });
        });
    </script>
@endsection
