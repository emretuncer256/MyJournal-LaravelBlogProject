@extends('admin.layouts.main')
@section('title', 'Makaleler | Geri Dönüşüm')

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
            <a class="btn btn-outline-primary" href="{{route('admin.articles.index')}}"><i
                    class="fas fa-arrow-left"></i> Tüm Makaleler</a>
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
                        <th>Kaldırılma Tarihi</th>
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
                            <td>{{$article->deleted_at->diffForHumans()}}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{route('admin.article.recover', $article->id)}}" class="btn btn-success"
                                       data-toggle="tooltip" data-placement="top"
                                       title="Geri Yükle">
                                        <i class="fas fa-recycle"></i>
                                    </a>
                                    <a href="{{route('admin.article.deletePermanently', $article->id)}}"
                                       class="btn btn-danger"
                                       data-toggle="tooltip" data-placement="top"
                                       title="Kalıcı Sil"
                                       onclick="return confirm('Kalıcı olarak silmek istediğine emin misin?');">
                                        <i class="fas fa-trash-alt"></i>
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
