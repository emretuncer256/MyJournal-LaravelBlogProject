@extends('front.layouts.main')
@section('title', 'İletişim | My Journal')

@section('content')
    <!-- Main Content-->
    <main class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    @if(session('success'))
                        <div class="alert alert-success">{{session('success')}}</div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <p>Bizimle iletişime geçebilirsiniz.</p>
                    <div class="my-5">
                        <form method="post" action="{{route('contact.post')}}">
                            @csrf
                            <div class="form-floating">
                                <input value="{{old('fullname')}}" class="form-control" required name="fullname"
                                       type="text"
                                       placeholder="İsminiz..."/>
                                <label for="name">Tam Adınız</label>
                            </div>
                            <div class="form-floating">
                                <input value="{{old('email')}}" class="form-control" name="email" type="email"
                                       placeholder="Mailinizi girin..."
                                       required/>
                                <label for="email">Email</label>
                            </div>
                            <div class="form-floating">
                                <select name="subject" required class="form-select form-select-lg py-4 rounded-3">
                                    <option value="" selected>Buradan bir konu seçin</option>
                                    <option @if(old('subject')=='Bilgi') selected @endif value="Bilgi">Bilgi</option>
                                    <option @if(old('subject')=='Destek') selected @endif value="Destek">Destek</option>
                                    <option @if(old('subject')=='Sorun') selected @endif value="Sorun">Sorun</option>
                                    <option @if(old('subject')=='Genel') selected @endif value="Genel">Genel</option>
                                </select>
                            </div>
                            <div class="form-floating">
                                <textarea class="form-control" name="message" placeholder="Mesajınızı yazın..."
                                          style="height: 12rem" required>{{old('message')}}</textarea>
                                <label for="message">Mesaj</label>
                            </div>
                            <br/>
                            <div class="d-none" id="submitSuccessMessage">
                                <div class="text-center mb-3">
                                    <div class="fw-bolder">Form submission successful!</div>
                                    To activate this form, sign up at
                                    <br/>
                                    <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                                </div>
                            </div>

                            <!-- Submit Button-->
                            <button class="btn btn-primary text-uppercase" type="submit">
                                Gönder
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
@endsection
