@extends('admin.layouts.main')
@section('title', 'Yorumlar')

@section('styles')
    <!-- Custom styles for this page -->
    <link href="{{asset('admin')}}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary d-inline">Toplam <strong>{{$comments->count()}}</strong>
                yorum bulundu.
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>İsim</th>
                        <th>Yorum</th>
                        <th>Makale</th>
                        <th>Durum</th>
                        <th>Tarih</th>
                        <th>Başlık</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>İsim</th>
                        <th>Yorum</th>
                        <th>Makale</th>
                        <th>Durum</th>
                        <th>Tarih</th>
                        <th>Başlık</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($comments as $comment)
                        <tr>
                            <td>{{$comment->id}}</td>
                            <td>{{$comment->fullname}}</td>
                            <td>{{$comment->content}}</td>
                            <td>
                                <a target="_blank"
                                   href="{{route('single', [$comment->article->getCategory->slug, $comment->article->slug])}}"
                                   class="btn btn-outline-primary">
                                    {{$comment->article->title}}
                                </a>
                            </td>
                            <td>
                                <input data-id="{{$comment->id}}" class="switch" type="checkbox"
                                       @if($comment->status) checked @endif
                                       data-toggle="toggle" data-onstyle="success"
                                       data-offstyle="danger" data-on="Aktiff" data-off="Pasiff">
                            </td>
                            <td>{{$comment->created_at->diffForHumans()}}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button class="btn btn-warning edit-btn"
                                            data-toggle="tooltip" data-placement="top"
                                            data-id="{{$comment->id}}"
                                            title="Düzenle">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <a href="{{route('admin.comment.delete', $comment->id)}}" class="btn btn-danger"
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

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Yorumu Düzenle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editForm" action="{{route('admin.comment.update')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="id" name="id">
                        <div class="form-group">
                            <label for="fullname">İsim</label>
                            <input autocomplete="off" type="text" class="form-control" name="fullname" id="fullname">
                        </div>
                        <div class="form-group">
                            <label for="content">Yorum</label>
                            <textarea maxlength="200" class="form-control rounded"
                                      name="content"
                                      id="content" cols="30" rows="5"></textarea>
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
            $('.edit-btn').click(function () {
                let id = $(this).data('id');
                $.ajax({
                    type: 'GET',
                    url: '{{route('admin.comment.getData')}}',
                    data: {id: id},
                    success: (data) => {
                        $('#fullname').val(data.fullname);
                        $('#content textarea').val(data.content);
                        $('#id').val(data.id);
                        $('#editModal').modal();
                    }
                });
            });
        });
    </script>
    <script>
        $(function () {
            $('.switch').change(function () {
                let id = $(this).data('id');
                let status = $(this).prop('checked');
                $.get("{{route('admin.comment.switch')}}", {id: id, status: status}, function (data, status) {
                })
            })
        })
    </script>

@endsection
