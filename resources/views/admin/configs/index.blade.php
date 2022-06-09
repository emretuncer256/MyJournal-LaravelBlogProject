@extends('admin.layouts.main')
@section('title', 'Ayarlar')

@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary d-inline">Site Ayarları</h6>
                </div>
                <div class="card-body">
                    <form id="siteForm" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="title">Site Adı</label>
                            <input required id="title" type="text" class="form-control" name="title"
                                   value="{{$config->title}}">
                        </div>
                        <div class="form-group">
                            <label for="status">Site Durumu</label>
                            <select required name="status" id="status" class="form-control">
                                <option @if($config->status) selected @endif value="1">Aktif</option>
                                <option @if(!$config->status) selected @endif value="0">Pasif</option>
                            </select>
                        </div>
                        <button class="btn btn-primary btn-block" type="submit">Kaydet</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary d-inline">Sosyal Link Ayarları</h6>
                        </div>
                        <div class="card-body">
                            <form id="socialForm" method="post">
                                @csrf
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fab fa-youtube"></i></div>
                                    </div>
                                    <input name="youtube" type="text" class="form-control" placeholder="YouTube"
                                           value="{{$config->youtube}}">
                                </div>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fab fa-facebook-square"></i></div>
                                    </div>
                                    <input name="facebook" type="text" class="form-control" placeholder="Facebook"
                                           value="{{$config->facebook}}">
                                </div>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fab fa-instagram"></i></div>
                                    </div>
                                    <input name="instagram" type="text" class="form-control" placeholder="Instagram"
                                           value="{{$config->instagram}}">
                                </div>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fab fa-twitter"></i></div>
                                    </div>
                                    <input name="twitter" type="text" class="form-control" placeholder="Twitter"
                                           value="{{$config->twitter}}">
                                </div>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fab fa-linkedin-in"></i></div>
                                    </div>
                                    <input name="linkedin" type="text" class="form-control" placeholder="Linkedin"
                                           value="{{$config->linkedin}}">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fab fa-github-square"></i></div>
                                    </div>
                                    <input name="github" type="text" class="form-control" placeholder="Github"
                                           value="{{$config->github}}">
                                </div>
                                <button class="btn btn-primary btn-block" type="submit">Kaydet</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary d-inline">Görsel Ayarları</h6>
                        </div>
                        <div class="card-body">
                            <form id="imagesForm" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="logo">Logo</label>
                                            <input id="logo" type="file" class="form-control" name="logo">
                                        </div>
                                        <div class="col-lg-6 text-center">
                                            <label for="logoPreview">Önizleme</label>
                                            <img id="logoPreview" class="img-fluid"
                                                 src="@if($config->logo) {{asset($config->logo)}}
                                                 @else https://via.placeholder.com/150 @endif">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="favicon">Favicon</label>
                                            <input id="favicon" type="file" class="form-control"
                                                   name="favicon">
                                        </div>
                                        <div class="col-lg-6 text-center">
                                            <label for="faviconPreview">Önizleme</label>
                                            <img id="faviconPreview" class="img-fluid"
                                                 src="@if($config->favicon) {{asset($config->favicon)}}
                                                 @else https://via.placeholder.com/150 @endif">
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-block" type="submit">Kaydet</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(function () {
            $('#logo').change(function () {
                const [file] = $(this).prop('files')
                if (file) {
                    $('#logoPreview').attr('src', URL.createObjectURL(file));
                }
            });
            $('#favicon').change(function () {
                const [file] = $(this).prop('files')
                if (file) {
                    $('#faviconPreview').attr('src', URL.createObjectURL(file));
                }
            });
        });
    </script>
    <script>
        $(function () {
            $('#siteForm').submit(function (e) {
                e.preventDefault();

                let form = $(this);
                $.ajax({
                    type: 'POST',
                    url: '{{route('admin.config.update')}}',
                    data: form.serialize(),
                    success: (data) => {
                        if (data == 'success') {
                            toastr.success('Site ayarları başarıyla güncellendi.', 'Güncelleme Başarılı');
                        } else {
                            toastr.error('Site ayarları güncellenemedi.', 'Güncelleme Başarısız');
                        }
                    }
                })
            });
            $('#socialForm').submit(function (e) {
                e.preventDefault();

                let form = $(this);
                $.ajax({
                    type: 'POST',
                    url: '{{route('admin.config.update')}}',
                    data: form.serialize(),
                    success: (data) => {
                        if (data == 'success') {
                            toastr.success('Sosyal medya linkleri başarıyla güncellendi.', 'Güncelleme Başarılı');
                        } else {
                            toastr.error('Sosyal medya linkleri güncellenemedi.', 'Güncelleme Başarısız');
                        }
                    }
                })
            });
            $('#imagesForm').submit(function (e) {
                e.preventDefault();

                let formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: '{{route('admin.config.update')}}',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        if (data == 'success') {
                            toastr.success('Görseller başarıyla güncellendi.', 'Güncelleme Başarılı');
                        } else {
                            toastr.error('Görseller güncellenemedi.', 'Güncelleme Başarısız');
                        }
                        $('input[type="file"]#logo').val('');
                        $('input[type="file"]#favicon').val('');
                    }
                })
            });
        });
    </script>
@endsection
