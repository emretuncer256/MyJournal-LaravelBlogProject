@extends('admin.layouts.main')
@section('title', 'Makaleler')

@section('styles')
    <!-- Custom styles for this page -->
    <link href="{{asset('admin')}}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary d-inline">Toplam <strong>{{$articles->count()}}</strong>
                makale bulundu.
            </h6>
            <a class="btn btn-outline-warning" href="{{route('admin.article.trash')}}"><i class="fas fa-trash-alt"></i>
                Geri
                dönüşüm</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Fotoğraf</th>
                        <th>Başlık</th>
                        <th>Kategori</th>
                        <th>Tık</th>
                        <th>Oluşturulma Tarihi</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Fotoğraf</th>
                        <th>Başlık</th>
                        <th>Kategori</th>
                        <th>Tık</th>
                        <th>Oluşturulma Tarihi</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($articles as $article)
                        <tr>
                            <td>{{$article->id}}</td>
                            <td>
                                <img class="img-thumbnail" src="{{asset($article->image)}}">
                            </td>
                            <td>{{$article->title}}</td>
                            <td>
                                <span class="badge badge-primary">{{$article->getCategory->name}}</span>
                            </td>
                            <td>{{$article->hit}}</td>
                            <td>{{$article->created_at->diffForHumans()}}</td>
                            <td>
                                <input data-id="{{$article->id}}" class="switch" type="checkbox"
                                       @if($article->status) checked @endif
                                       data-toggle="toggle" data-onstyle="success"
                                       data-offstyle="danger" data-on="Aktiff" data-off="Pasiff">
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a target="_blank"
                                       href="{{route('single', [$article->getCategory->slug, $article->slug])}}"
                                       class="btn btn-primary" data-toggle="tooltip" data-placement="top"
                                       title="Görüntüle">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{route('admin.articles.edit', $article->id)}}" class="btn btn-warning"
                                       data-toggle="tooltip" data-placement="top"
                                       title="Düzenle">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{route('admin.article.delete', $article->id)}}" class="btn btn-danger"
                                       data-toggle="tooltip" data-placement="top"
                                       title="Kaldır">
                                        <i class="fas fa-times"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    <!-- Page level plugins -->
    <script src="{{asset('admin')}}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('admin')}}/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('admin')}}/js/demo/datatables-demo.js"></script>

    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        $(function () {
            $('.switch').change(function () {
                let id = $(this).data('id');
                let status = $(this).prop('checked');
                $.get("{{route('admin.article.switch')}}", {id: id, status: status}, function (data, status) {
                })
            })
        })
    </script>

@endsection
