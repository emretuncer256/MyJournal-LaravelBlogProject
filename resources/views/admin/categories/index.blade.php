@extends('admin.layouts.main')
@section('title', 'Kategoriler')

@section('styles')
    <!-- Custom styles for this page -->
    <link href="{{asset('admin')}}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card shadow">
                <div class="card-header border-primary py-3 d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary d-inline">
                        Kategori Ekle
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.category.create')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <input name="name" type="text" class="form-control" placeholder="Kategori adı" required>
                        </div>
                        <button class="btn btn-primary btn-block" type="submit">Ekle</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header border-primary py-3 d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary d-inline">
                        Tüm Kategoriler
                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive py-2 px-1">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>İsim</th>
                                <th>Makale Sayısı</th>
                                <th>Oluşturulma Tarihi</th>
                                <th>Durum</th>
                                <th>İşlemler</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>İsim</th>
                                <th>Makale Sayısı</th>
                                <th>Oluşturulma Tarihi</th>
                                <th>Durum</th>
                                <th>İşlemler</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{$category->id}}</td>
                                    <td>{{$category->name}}</td>
                                    <td>{{$category->articleCount()}}</td>
                                    <td>{{$category->created_at->diffForHumans()}}</td>
                                    <td>
                                        <input data-id="{{$category->id}}" class="switch" type="checkbox"
                                               @if($category->status) checked @endif
                                               data-toggle="toggle" data-onstyle="success"
                                               data-offstyle="danger" data-on="Aktiff" data-off="Pasiff">
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button data-id="{{$category->id}}"
                                                    class="btn btn-warning edit-btn"
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="Düzenle">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-danger remove-btn"
                                                    data-id="{{$category->id}}"
                                                    data-count="{{$category->articleCount()}}"
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="Kaldır">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Kategori Düzenle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('admin.category.update')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="id" name="id">
                        <div class="form-group">
                            <label for="name">Kategori Adı</label>
                            <input autocomplete="off" type="text" class="form-control" name="name" id="name">
                        </div>
                        <div class="form-group">
                            <label for="slug">Kategori Slug</label>
                            <input autocomplete="off" type="text" class="form-control" name="slug" id="slug">
                            <small class="form-text text-muted">Slug kategori adına göre otomatik
                                oluşturulacaktır. Kendiniz de düzenleyebilirsiniz.</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                        <button type="submit" class="btn btn-primary">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Remove Modal -->
    <div class="modal fade" id="removeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Kategoriyi Sil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('admin.category.delete')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="alert alert-danger" id="alert">
                            Bu kategoride toplam <strong id="article-count"></strong> makale bulunuyor.
                        </div>
                        <div class="alert alert-warning" id="warning">
                            Bu kategori silinemez. Silinen kategroilerin makaleleri bu kategoriye aktraılır.
                        </div>
                        <h5 id="deleteRequestMsg">Silmek istediğinize emin misiniz?</h5>
                        <input type="hidden" id="category-id" name="id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                        <button id="removeButton" type="submit" class="btn btn-danger">Kaldır</button>
                    </div>
                </form>
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
                $.get("{{route('admin.category.switch')}}", {id: id, status: status}, function (data, status) {
                })
            })
        })
    </script>
    <script>
        $(function () {
            $('.edit-btn').click(function () {
                let id = $(this).data('id');
                $.ajax({
                    type: 'GET',
                    url: '{{route('admin.category.getData')}}',
                    data: {id: id},
                    success: (data) => {
                        $('#name').val(data.name);
                        $('#slug').val(data.slug);
                        $('#id').val(data.id);
                        $('#editModal').modal();
                    }
                });
            });
            $('.remove-btn').click(function () {
                let count = $(this).data('count');
                let id = $(this).data('id');
                let removeBtn = $('#removeButton');
                let alert = $('#alert');
                let warning = $('#warning');
                let drMsg = $('#deleteRequestMsg');

                $('#article-count').html(count);
                $('#category-id').val(id);

                warning.hide()
                if (id == 1) {
                    removeBtn.hide();
                    alert.hide();
                    warning.show();
                    drMsg.hide();
                } else if (count > 0) {
                    alert.show();
                    removeBtn.show();
                    drMsg.show();
                } else {
                    alert.hide();
                    removeBtn.show();
                    drMsg.show();
                }
                $('#removeModal').modal();
            });
        });
    </script>
    <script>
        $(function () {
            const slugify = str =>
                str
                    .toLowerCase()
                    .trim()
                    .replaceAll('ç', 'c')
                    .replaceAll('ğ', 'g')
                    .replaceAll('ı', 'i')
                    .replaceAll('ö', 'o')
                    .replaceAll('ş', 's')
                    .replaceAll('ü', 'u')
                    .replaceAll(/[\s_-]+/g, '-')
                    .replaceAll(/^-+|-+$/g, '');

            // .replace(/[^\w\s-]/g, '')

            $('[name="name"]').keyup(function () {
                let name = $(this).val();
                $('#slug').val(slugify(name));
            });

            $('[name="slug"]').keyup(function () {
                let slug = $(this).val();
                $(this).val(slug.toLowerCase());
            });
        });
    </script>
@endsection
