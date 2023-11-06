@extends('frontend.header')

@section('style')
    <style>
    </style>
@endsection
@section('content')
    <div class="page-content bg-white">

        <!-- Breadcrumb row -->
        <nav aria-label="breadcrumb" class="breadcrumb-row">
            <div class="container">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="home">หน้าแรก</a></li>
                    <li class="breadcrumb-item"><a href="new">ข่าวสารและกิจกรรม</a></li>
                    <li class="breadcrumb-item">พาน้องมาดูหนัง 3 มิติ</li>
                </ul>
            </div>
        </nav>
        <!-- Breadcrumb row END -->

        <section class="">
            <div class="container">
                {{-- แสดงรายละเอียด ตรงนี้ --}}
                <div class="row">
                    <div class="col-12">
                        <img src="{{ asset($content->pic_path) }}" alt="">
                    </div>
                    {{-- <div class="col-6">
                        <img src="{{ asset('public/frontend/images/blog/recent-blog/pic2.png') }}" alt="">
                    </div> --}}
                </div>
                <div class="row">
                    <div class="col-12 mt-4">
                        <h2>{{$content->title_thai}}</h2>
                        <p>{{$content->sub_title_thai}}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 text-center">
                        <img src="{{ asset($content->pic_path) }}" alt="">
                    </div>
                    <div class="col-12 mt-5 text-center">
                        <h3>{{$content->title_thai}}</h3>
                        {{$content->description_thai}}
                    </div>
                </div>
            </div>
        </section>


        <section class="content-inner-2">
            <div class="container-fluid">
                <div class="section-head space-lg text-start">
                    <h2 class="title">บทความและกิจกรรมอื่น ๆ ที่น่าสนใจ</h2>
                </div>
                <div class="swiper-container deal-swiper swiper-dots-1">
                    <div class="swiper-wrapper">

                        @foreach ($other as $item)
                            <div class="swiper-slide">
                                <div class="col-md-12 col-lg-12 col-sm-12 m-b30 wow fadeInUp card-new-event"
                                    data-wow-duration="2s" data-wow-delay="0.4s">
                                    <div class="service-box">
                                        <div class="dlab-media">
                                            <a href="{{ route('new.detail')}}?id={{$item->id}}">
                                                <img src="{{ asset($item->pic_path) }}" alt="">
                                            </a>
                                        </div>
                                        <div class="dlab-info">
                                            <h4 class="dlab-title m-t0 m-b10" style="font-size: 20px; font-weight: 600;">
                                                <a href="{{ route('new.detail')}}?id={{$item->id}}">{{$item->title_thai}}</a>
                                            </h4>
                                            <p class="m-b30" style="font-size: 18px">{{$item->sub_title_thai}}</p>
                                            <div style="display: flex;justify-content: space-between; align-items: center;">
                                                <span style="color: #808080;font-family: Montserrat;font-size: 14px;">{{$item->created_at}}</span>
                                                <a href="{{ route('new.detail')}}?id={{$item->id}}" class="btn btn-primary" style="height: 40px">อ่านเพิ่มเติม</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach



                    </div>
                    <div class="slider-one-pagination m-t40 m-sm-t20">
                        <!-- Add Navigation -->
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>


        </section>


    </div>


@endsection

@section('script')
@endsection
