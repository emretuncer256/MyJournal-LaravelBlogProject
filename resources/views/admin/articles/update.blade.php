@extends('admin.layouts.main')
@section('title', 'Düzenle | '.$article->title)

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
        <form action="{{route('admin.articles.update', $article->id)}}" method="post" enctype="multipart/form-data">
            @method('PUT')
            <div class="card-body">
                @csrf
                <div class="form-group">
                    <label for="title">Başlık</label>
                    <input value="{{$article->title}}" type="text" name="title" class="form-control" id="title"
                           required>
                </div>
                <div class="form-group">
                    <label for="category">Password</label>
                    <select class="form-control" name="category" id="category" required>
                        <option value="">Kategori Seç</option>
                        @foreach($categories as $category)
                            <option @if($article->category_id == $category->id) selected
                                    @endif value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="image">Fotoğraf</label>
                    <input type="file" name="image" id="image" class="form-control">
                    <label for="preview">Önizleme</label>
                    <img id="preview" class="img-thumbnail" src="{{asset($article->image)}}" alt="">
                </div>
                <div class="form-group">
                    <label for="articleContent">Makale</label>
                    <textarea name="content" id="articleContent" cols="30" rows="10"
                              class="form-control">{!! $article->content !!}</textarea>
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
