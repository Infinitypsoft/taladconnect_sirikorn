@extends('frontend.header')

@section('style')
    <style>
    </style>
@endsection
@section('content')
    <div class="page-content bg-white">
        <!-- Banner  -->
        <div class="dlab-bnr-inr dlab-bnr-inr-lg style-1 overlay-black-middle"
            style="background-image: url({{ asset('public/frontend/images/banner/banner-n.png') }});">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h1 class="text-white">ข่าวสารและกิจกรรม</h1>
                    <div class="dlab-separator"></div>
                    <form action="{{ route('new') }}" method="GET">
                    <div class="car-search-box row item2">                   
                        <div class="col-md-9">
                            <div class="selected-box">
                                <input type="text" class="form-control sm" placeholder="ค้นหาข่าวสารและกิจกรรม">
                            </div>
                        </div>                 
                        <div class="col-md-3">
                            <a href="javascript:void(0);" class="btn btn-lg effect-1 shadow-none btn-primary d-flex justify-content-between">
                                <span class="d-flex justify-content-between w-100">ค้นหา<i class="las la-long-arrow-alt-right"></i></span>
                            </a>
                        </div>              
                    </div>
                </form>
                </div>
            </div>
        </div>
        <!-- Banner End -->


        <section class="content-inner-2">
            <div class="container-fluid">
                <div class="section-head space-lg text-center">
                    <h2 class="title">ข่าวสารและกิจกรรมใหม่</h2>
                    <p>
                        รวม "ข่าวสารและกิจกรรม" ดีๆ ตลาดเทศบาล 2 นครเชียงราย 
                        <br>
                        คุณจะไม่พลาดทุกความเคลื่อนไหว อัพเดทข่าวสาร และกิจกรรมดีๆ ตอบรับทุกไลฟ์สไตล์ของคุณได้ที่นี่                    
                    </p>
                </div>
                <div class="swiper-container deal-swiper swiper-dots-1">
                    <div class="row">


                        @foreach ($content as $item)
                            <div class="col-6 col-md-3 col-lg-3 col-sm-3 m-b30 wow fadeInUp card-new-event"
                                data-wow-duration="2s" data-wow-delay="0.4s">
                                <div class="service-box">
                                    <div class="dlab-media">
                                        <a href="{{ route('new.detail') }}?id={{ $item->id }}"><img
                                                src="{{ asset($item->pic_path) }}"alt="">
                                        </a>
                                    </div>
                                    <div class="dlab-info">
                                        <h4 class="dlab-title m-t0 m-b10" style="font-size: 20px; font-weight: 600;">
                                            <a
                                                href="{{ route('new.detail') }}?id={{ $item->id }}">{{ $item->title_thai }}</a>
                                        </h4>
                                        <p class="m-b30" style="font-size: 18px">{{ $item->sub_title_thai }}</p>
                                        <div style="display: flex;justify-content: space-between; align-items: center;">
                                            <span
                                                style="color: #808080;font-family: Montserrat;font-size: 14px;">{{ $item->created_at }}</span>
                                            <a href="{{ route('new.detail') }}?id={{ $item->id }}"
                                                class="btn btn-primary" style="height: 40px">อ่านเพิ่มเติม</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                        {{ $content->links('frontend.layout.pagination_custom') }}

                        {{-- <div class="col-6 col-md-3 col-lg-3 col-sm-3 m-b30 wow fadeInUp card-new-event"
                            data-wow-duration="2s" data-wow-delay="0.4s">
                            <div class="service-box">
                                <div class="dlab-media">
                                    <a href="#">
                                        <img src="{{ asset('public/frontend/images/imaimmarket/382051490_298303829618244_7472630110002792441_n.jpg') }}"
                                            alt="">
                                    </a>
                                </div>
                                <div class="dlab-info">
                                    <h4 class="dlab-title m-t0 m-b10" style="font-size: 20px; font-weight: 600;">
                                        <a href="#">พาน้องมาดูหนัง 3 มิติ</a>
                                    </h4>
                                    <p class="m-b30" style="font-size: 18px">พบกับ 3 เกลอ สจ๊วต เคลวิ่น บ็อบ
                                        และแก๊งมินเนี่ยน ในรูปแบบ 3 มิติ ทะลุจอ!!</p>
                                    <div style="display: flex;justify-content: space-between; align-items: center;">
                                        <span style="color: #808080;font-family: Montserrat;font-size: 14px;">September 29,
                                            2023</span>
                                        <a href="#" class="btn btn-primary" style="height: 40px">อ่านเพิ่มเติม</a>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="col-6 col-md-3 col-lg-3 col-sm-3 m-b30 wow fadeInUp card-new-event"
                            data-wow-duration="2s" data-wow-delay="0.4s">
                            <div class="service-box">
                                <div class="dlab-media">
                                    <a href="#">
                                        <img src="{{ asset('public/frontend/images/imaimmarket/371318339_286673617447932_2730873507145654818_n.jpg') }}"
                                            alt="">
                                    </a>
                                </div>
                                <div class="dlab-info">
                                    <h4 class="dlab-title m-t0 m-b10" style="font-size: 20px; font-weight: 600;">
                                        <a href="#">พาน้องมาดูหนัง 3 มิติ</a>
                                    </h4>
                                    <p class="m-b30" style="font-size: 18px">พบกับ 3 เกลอ สจ๊วต เคลวิ่น บ็อบ
                                        และแก๊งมินเนี่ยน ในรูปแบบ 3 มิติ ทะลุจอ!!</p>
                                    <div style="display: flex;justify-content: space-between; align-items: center;">
                                        <span style="color: #808080;font-family: Montserrat;font-size: 14px;">September 29,
                                            2023</span>
                                        <a href="#" class="btn btn-primary" style="height: 40px">อ่านเพิ่มเติม</a>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="col-6 col-md-3 col-lg-3 col-sm-3 m-b30 wow fadeInUp card-new-event"
                            data-wow-duration="2s" data-wow-delay="0.4s">
                            <div class="service-box">
                                <div class="dlab-media">
                                    <a href="#">
                                        <img src="{{ asset('public/frontend/images/imaimmarket/c0060c32d11ee3b405da78e13795177d.png') }}"
                                            alt="">
                                    </a>
                                </div>
                                <div class="dlab-info">
                                    <h4 class="dlab-title m-t0 m-b10" style="font-size: 20px; font-weight: 600;">
                                        <a href="#">พาน้องมาดูหนัง 3 มิติ</a>
                                    </h4>
                                    <p class="m-b30" style="font-size: 18px">พบกับ 3 เกลอ สจ๊วต เคลวิ่น บ็อบ
                                        และแก๊งมินเนี่ยน ในรูปแบบ 3 มิติ ทะลุจอ!!</p>
                                    <div style="display: flex;justify-content: space-between; align-items: center;">
                                        <span style="color: #808080;font-family: Montserrat;font-size: 14px;">September 29,
                                            2023</span>
                                        <a href="#" class="btn btn-primary" style="height: 40px">อ่านเพิ่มเติม</a>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-6 col-md-3 col-lg-3 col-sm-3 m-b30 wow fadeInUp card-new-event"
                            data-wow-duration="2s" data-wow-delay="0.4s">
                            <div class="service-box">
                                <div class="dlab-media">
                                    <a href="#">
                                        <img src="{{ asset('public/frontend/images/imaimmarket/c0060c32d11ee3b405da78e13795177d.png') }}"
                                            alt="">
                                    </a>
                                </div>
                                <div class="dlab-info">
                                    <h4 class="dlab-title m-t0 m-b10" style="font-size: 20px; font-weight: 600;">
                                        <a href="#">พาน้องมาดูหนัง 3 มิติ</a>
                                    </h4>
                                    <p class="m-b30" style="font-size: 18px">พบกับ 3 เกลอ สจ๊วต เคลวิ่น บ็อบ
                                        และแก๊งมินเนี่ยน ในรูปแบบ 3 มิติ ทะลุจอ!!</p>
                                    <div style="display: flex;justify-content: space-between; align-items: center;">
                                        <span style="color: #808080;font-family: Montserrat;font-size: 14px;">September 29,
                                            2023</span>
                                        <a href="#" class="btn btn-primary" style="height: 40px">อ่านเพิ่มเติม</a>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-6 col-md-3 col-lg-3 col-sm-3 m-b30 wow fadeInUp card-new-event"
                            data-wow-duration="2s" data-wow-delay="0.4s">
                            <div class="service-box">
                                <div class="dlab-media">
                                    <a href="#">
                                        <img src="{{ asset('public/frontend/images/imaimmarket/c0060c32d11ee3b405da78e13795177d.png') }}"
                                            alt="">
                                    </a>
                                </div>
                                <div class="dlab-info">
                                    <h4 class="dlab-title m-t0 m-b10" style="font-size: 20px; font-weight: 600;">
                                        <a href="#">พาน้องมาดูหนัง 3 มิติ</a>
                                    </h4>
                                    <p class="m-b30" style="font-size: 18px">พบกับ 3 เกลอ สจ๊วต เคลวิ่น บ็อบ
                                        และแก๊งมินเนี่ยน ในรูปแบบ 3 มิติ ทะลุจอ!!</p>
                                    <div style="display: flex;justify-content: space-between; align-items: center;">
                                        <span style="color: #808080;font-family: Montserrat;font-size: 14px;">September 29,
                                            2023</span>
                                        <a href="#" class="btn btn-primary" style="height: 40px">อ่านเพิ่มเติม</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 col-md-3 col-lg-3 col-sm-3 m-b30 wow fadeInUp card-new-event"
                            data-wow-duration="2s" data-wow-delay="0.4s">
                            <div class="service-box">
                                <div class="dlab-media">
                                    <a href="#">
                                        <img src="{{ asset('public/frontend/images/imaimmarket/c0060c32d11ee3b405da78e13795177d.png') }}"
                                            alt="">
                                    </a>
                                </div>
                                <div class="dlab-info">
                                    <h4 class="dlab-title m-t0 m-b10" style="font-size: 20px; font-weight: 600;">
                                        <a href="#">พาน้องมาดูหนัง 3 มิติ</a>
                                    </h4>
                                    <p class="m-b30" style="font-size: 18px">พบกับ 3 เกลอ สจ๊วต เคลวิ่น บ็อบ
                                        และแก๊งมินเนี่ยน ในรูปแบบ 3 มิติ ทะลุจอ!!</p>
                                    <div style="display: flex;justify-content: space-between; align-items: center;">
                                        <span style="color: #808080;font-family: Montserrat;font-size: 14px;">September 29,
                                            2023</span>
                                        <a href="#" class="btn btn-primary" style="height: 40px">อ่านเพิ่มเติม</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 col-md-3 col-lg-3 col-sm-3 m-b30 wow fadeInUp card-new-event"
                            data-wow-duration="2s" data-wow-delay="0.4s">
                            <div class="service-box">
                                <div class="dlab-media">
                                    <a href="#">
                                        <img src="{{ asset('public/frontend/images/imaimmarket/c0060c32d11ee3b405da78e13795177d.png') }}"
                                            alt="">
                                    </a>
                                </div>
                                <div class="dlab-info">
                                    <h4 class="dlab-title m-t0 m-b10" style="font-size: 20px; font-weight: 600;">
                                        <a href="#">พาน้องมาดูหนัง 3 มิติ</a>
                                    </h4>
                                    <p class="m-b30" style="font-size: 18px">พบกับ 3 เกลอ สจ๊วต เคลวิ่น บ็อบ
                                        และแก๊งมินเนี่ยน ในรูปแบบ 3 มิติ ทะลุจอ!!</p>
                                    <div style="display: flex;justify-content: space-between; align-items: center;">
                                        <span style="color: #808080;font-family: Montserrat;font-size: 14px;">September 29,
                                            2023</span>
                                        <a href="#" class="btn btn-primary" style="height: 40px">อ่านเพิ่มเติม</a>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                    </div>

                    {{-- <div class="slider-one-pagination m-t40 m-sm-t20">
                        <!-- Add Navigation -->
                        <div class="swiper-pagination"></div>
                    </div> --}}
                </div>
            </div>

            {{-- <div class="container-fluid">
                <nav aria-label="Blog Pagination">
                    <ul class="pagination text-center m-b30">
                        <li class="page-item"><a class="page-link prev" href="javascript:void(0);"><i class="la la-angle-left"></i></a></li>
                        <li class="page-item"><a class="page-link active" href="javascript:void(0);">1</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                        <li class="page-item"><a class="page-link next" href="javascript:void(0);"><i class="la la-angle-right"></i></a></li>
                    </ul>
                </nav>
            </div> --}}

        </section>

        <section class="content-inner">
            <div class="container">
                <div class="row call-to-action-bx">
                    <div class="col-xl-5 col-lg-6 me-auto">
                        <div class="section-head">
                            <h3 class="title text-white font-42">ติดต่อประชาสัมพันธ์หรือ สอบถามเพิ่มเติม</h3>
                        </div>
                        <a href="tel:0805838888" class="btn btn-white me-3 mb-2"><i
                                class="fas fa-phone-volume me-sm-3 me-0 shake"></i><span
                                class="d-sm-inline-block d-none">080-583-8888</span></a>
                    </div>
                    <div class="col-lg-6">
                        <div class="media-box">
                            <img src="{{ asset('public/frontend/images/banner/a527b2bbe6413db3f5b52057fa1320a2.png') }}"
                                class="main-img" alt="">
                            <img src="{{ asset('public/frontend/images/pattern/pattern7.png') }}" class="pt-img move-1"
                                alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection

@section('script')
@endsection
