@extends('admin.layouts.main')
@section('title', 'Sayfalar')

@section('styles')
    <!-- Custom styles for this page -->
    <link href="{{asset('admin')}}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary d-inline">Toplam <strong>{{$pages->count()}}</strong>
                makale bulundu.
            </h6>
            <button class="btn btn-outline-primary" onclick="location.reload();">
                <i class="fas fa-recycle"></i> Yenile
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Sıra</th>
                        <th>Fotoğraf</th>
                        <th>Başlık</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Sıra</th>
                        <th>Fotoğraf</th>
                        <th>Başlık</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                    </tfoot>
                    <tbody id="sorter">
                    @foreach($pages as $page)
                        <tr id="page-{{$page->id}}">
                            <td>{{$page->order}}</td>
                            <td class="text-center" style="width: 30px;">
                                <i style="cursor: grab;" class="fas fa-arrows-alt-v fa-3x handle"></i>
                            </td>
                            <td>
                                <img style="max-width: 250px;" class="img-fluid" src="{{asset($page->image)}}">
                            </td>
                            <td>{{$page->title}}</td>
                            <td>
                                <input data-id="{{$page->id}}" class="switch" type="checkbox"
                                       @if($page->status) checked @endif
                                       data-toggle="toggle" data-onstyle="success"
                                       data-offstyle="danger" data-on="Aktiff" data-off="Pasiff">
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a target="_blank"
                                       href="{{route('page', $page->slug)}}"
                                       class="btn btn-primary" data-toggle="tooltip" data-placement="top"
                                       title="Görüntüle">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{route('admin.page.edit', $page->id)}}" class="btn btn-warning"
                                       data-toggle="tooltip" data-placement="top"
                                       title="Düzenle">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{route('admin.page.delete', $page->id)}}" class="btn btn-danger"
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
                $.get("{{route('admin.page.switch')}}", {id: id, status: status}, function (data, status) {
                })
            })
        })
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"
            integrity="sha512-Eezs+g9Lq4TCCq0wae01s9PuNWzHYoCMkE97e2qdkYthpI0pzC3UGB03lgEHn2XM85hDOUF6qgqqszs+iXU4UA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script>
        $('#sorter').sortable({
            handle: '.handle',
            update: () => {
                let orders = $('#sorter').sortable('serialize');
                $.get("{{route('admin.page.orders')}}?" + orders, {}, (data, status) => {
                });
            }
        });
    </script>

@endsection
