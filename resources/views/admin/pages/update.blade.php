@extends('admin.layouts.main')
@section('title', 'Düzenle | '.$page->title)

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 border-primary">
            <h6 class="m-0 font-weight-bold text-primary">Düzenle</h6>
        </div>
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </div>
        @endif
        <form action="{{route('admin.page.update', $page->id)}}" method="post" enctype="multipart/form-data">
            <div class="card-body">
                @csrf
                <div class="form-group">
                    <label for="title">Başlık</label>
                    <input value="{{$page->title}}" type="text" name="title" class="form-control" id="title"
                           required>
                </div>
                <div class="form-group">
                    <label for="image">Fotoğraf</label>
                    <input type="file" name="image" id="image" class="form-control">
                    <label for="preview">Önizleme</label>
                    <img id="preview" class="img-thumbnail" src="{{asset($page->image)}}" alt="">
                </div>
                <div class="form-group">
                    <label for="articleContent">İçerik</label>
                    <textarea name="content" id="articleContent" cols="30" rows="10"
                              class="form-control">{!! $page->content !!}</textarea>
                </div>
            </div>
            <div class="card-footer border-primary py-0">
                <button type="submit" class="btn btn-primary float-right my-3 px-5 py-3">Kaydet</button>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#articleContent').summernote({
                'height': 300
            });
        });
    </script>
@endsection
