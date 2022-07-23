@extends('layout.master-client')
@section('title', 'Liên hệ')
@section('content')
    <div class="page-heading contact-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-content">
                        <h4>Liên hệ với chúng tôi</h4>
                        <h2>let’s get in touch</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="find-us">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">
                        <h2>Vị trí của chúng tôi</h2>
                    </div>
                </div>
                <div class="col-md-8">
                    <div id="map">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29781.522826016153!2d105.69427192373966!3d21.0850260519318!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313455bf5790704b%3A0x338abf092a03d8f0!2zVMOibiBM4bqtcCwgxJBhbiBQaMaw4bujbmcsIEjDoCBO4buZaSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1658321193606!5m2!1svi!2s"
                            width="100%" height="330px" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="left-content">
                        <h4>Về chúng tôi</h4>
                        <p>Xuất phát từ niềm đam mê với nội thất và đam mê cái đẹp. SIXTEEN ở đây để giúp bạn tạo nên những không gian tuyệt vời nhất và tốt nhất theo cách của riêng bạn. Sứ mệnh của chúng tôi luôn tạo ra những sản phẩm đẳng cấp nhất thể hiện bản sắc và tính cách riêng của gia chủ.
                        <ul class="social-icons">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-behance"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="send-message">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">
                        <h2>Liên hệ phản hồi với chúng tôi</h2>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="contact-form">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(session()->has('success'))
                        <div class="alert alert-success">
                          {{ session()->get('success') }}
                        </div>
                      @endif
                        <form id="contact" action="{{ route('page.contacts.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <fieldset>
                                        <input name="name" type="text" value="{{ old('name') }}"
                                            class="form-control" id="name" placeholder="Tên của bạn">
                                            <input type="hidden" value="0" name="action">
                                    </fieldset>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <fieldset>
                                        <input name="email" type="text" class="form-control" id="email"
                                            placeholder="Địa chỉ E-Mail"value="{{ old('email') }}"> 
                                    </fieldset>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <fieldset>
                                        <input name="title" type="text" class="form-control" id="title"
                                            placeholder="Tiêu đề" value="{{ old('title') }}">
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <textarea name="content" rows="6" class="form-control" id="content" placeholder="Nội dung" value="{{ old('content') }}"></textarea>
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <button type="submit" id="form-submit" class="filled-button">Gửi</button>
                                    </fieldset>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="accordion">
                        <li>
                            <a>Accordion Title One</a>
                            <div class="content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisic elit. Sed voluptate nihil eumester
                                    consectetur similiqu consectetur.<br><br>Lorem ipsum dolor sit amet, consectetur
                                    adipisic elit. Et, consequuntur, modi mollitia corporis ipsa voluptate corrupti elite.
                                </p>
                            </div>
                        </li>
                        <li>
                            <a>Fourth Accordion Title</a>
                            <div class="content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisic elit. Sed voluptate nihil eumester
                                    consectetur similiqu consectetur.<br><br>Lorem ipsum dolor sit amet, consectetur
                                    adipisic elit. Et, consequuntur, modi mollitia corporis ipsa voluptate corrupti elite.
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection()
