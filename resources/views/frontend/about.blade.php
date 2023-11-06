@extends('frontend.header')

@section('style')
<style>
    .btn-s-b {
        border: 0;
        border-radius: 5px !important;
    }
</style>
@endsection
@section('content')
<div class="page-content bg-white">
    <!-- Banner  -->
    <div class="dlab-bnr-inr style-1 overlay-black-middle" style="background-image: url(public/frontend/images/banner/banner_page.png);">
        <div class="container">
            <div class="dlab-bnr-inr-entry">
                <h1 class="text-white">เกี่ยวกับ</h1>
                <div class="dlab-separator"></div>
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <section class="content-inner-2 overflow-hidden">
        <div class="container">
            <div class="row about-bx1">
                <div class="col-lg-5">
                    <div class="dlab-media">
                        <img src="{{ asset('public/frontend/images/about/leftab.png') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-7 align-self-center">
                    <div class="section-head">
                        <h6 class="text-primary sub-title" style="font-size: 18px; font-family: Montserrat!important; letter-spacing: 5.4px; font-weight: 700;">
                            ABOUT</h6>
                        <h2 class="title" style="font-size: 48px; font-weight: 600;">ตลาดเทศบาล 2 นครเชียงราย</h2>
                    </div>
                    <p style="color: #212621; font-size: 18px; font-weight: 400;">
                        ตลาดเทศบาล 2 นครเชียงราย ตลาดจำหน่ายผัก ผลไม้ เนื้อสัตว์  อาหารสด อาหารสำเร็จรูป และขนมหวานต่างๆ
                        และที่ขาดไม่ได้เลย จุดเด่นของตลาดมีดอกไม้นาๆชนิดให้คนรักดอกไม้ได้เลือกซื้อ ไม่ว่าจะซื้อให้คนรัก หรือ
                        สำหรับใช้ในพิธีการต่างๆก็มีหลายร้านให้ลูกค้าได้เลือกซื้อตามใจชอบในราคาที่จับต้องได้ </p>
                    <p style="color: #212621; font-size: 18px; font-weight: 400;">
                        ตลาดเปิดทุกวัน เวลา 08.00-18.00 น.
                    </p>
                    <div class="swiper-container about-swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="icon-bx-wraper style-1 hover-overlay-effect">
                                    <div class="icon-md m-b40">
                                        <img src="{{ asset('public/frontend/images/imaimmarket/cutlery-1.png') }}" alt="" width="47" height="42">
                                        <img class="img-top" src="{{ asset('public/frontend/images/imaimmarket/cutlery-2.png') }}" alt="" width="47" height="42">
                                    </div>
                                    <div class="icon-content">
                                        <h4 class="title"><a href="services.html" class="text-effect-1" data-splitting>อาหาร</a></h4>
                                        <p>อาหารหลากหลายมีทั้งอาหาร ปิ้งย่าง 
                                                รวมไปถึงที่พลาดไม่ได้เลย 
                                                มีอาหารท้องถิ่นให้ได้ลิ้มลอง 
                                                รับรองว่าอร่อยจนหยุดกินไม่ได้...</p>
                                    </div>
                                    <div class="effect bg-dangersirikorn"></div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="icon-bx-wraper style-1 hover-overlay-effect">
                                    <div class="icon-md m-b40">
                                    <img src="{{ asset('public/frontend/images/imaimmarket/veget-1.png') }}"
                                                alt="" width="47" height="42">
                                                <img class="img-top"
                                                src="{{ asset('public/frontend/images/imaimmarket/veget-2.png') }}"
                                                alt="" width="47" height="42">
                                    </div>
                                    <div class="icon-content">
                                        <h4 class="title"><a href="services.html" class="text-effect-1" data-splitting>ขนมและเบเกอรี่</a></h4>
                                        <p>รวมขนม ไม่ว่าจะเป็นขนมไทย 
                                                เบเกอรี่ โรตี รวมถึงขนมอีกมากมาย
                                                รสชาติ หอม หวาน มัน อร่อย อยู่ที่นี่</p>
                                    </div>
                                    <div class="effect bg-warningsirikorn"></div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="icon-bx-wraper style-1 hover-overlay-effect">
                                    <div class="icon-md m-b40">
                                        <img src="{{ asset('public/frontend/images/imaimmarket/flower-1.png') }}" alt="" width="47" height="42">
                                        <img class="img-top" src="{{ asset('public/frontend/images/imaimmarket/flower-2.png') }}" alt="" width="47" height="42">
                                    </div>
                                    <div class="icon-content">
                                        <h4 class="title"><a href="services.html" class="text-effect-1" data-splitting>เสื้อผ้าให้เลือกซื้อ</a></h4>
                                        <p style="margin-bottom: 28px">
                                            เสื้อผ้าแฟชั่นให้เลือกสรรค์ 
                                            ท้าลมหนาวที่กำลังจะมาถึง 
                                            สำหรับร้านเสื้อผ้าหรือสินค้าแฟชั่น
                                        </p>

                                    </div>
                                    <div class="effect bg-dangersirikorn"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="content-inner-2">
        <div class="container">
            <div class="row features-box">
                <div class="col-lg-7 align-self-center m-b30">
                    <div class="content-box">
                        <div class="section-head mb-0">
                            <h2 class="title">ประวัติตลาดเทศบาล 2 นครเชียงราย</h2>
                        </div>
                        <p class="m-b40">
                            ตลาดสดเทศบาล 2 ได้รับมอบตลาดจากบริษัท ศิริกรณ์ จำกัด ให้กับเทศบาลฯ ดำเนินการตลาดตั้งแต่ปี 2533 
                            อายุประมาณ 29 ปี ตลาดสดเทศบาล 2 ตั้งอยู่บริเวณถนนประสพสุข เป็นอาคารหลังเดียว 2 ชั้น
                            ชั้นล่างประกอบการค้า มีผู้ประกอบการค้าประมาณ 80 ราย ชั้น 2 เป็นศูนย์กีฬาในร่ม
                            ตลาดแห่งนี้ส่วนใหญ่จะจำหน่ายผัก - ผลไม้ และดอกไม้เป็นหลัก มีพื้นที่ 1 ไร่ 99 วา 
                            โดยชำระค่าเช่าเป็นรายวัน/รายเดือน แก่เทศบาลนครเชียงราย โดยการทำสัญญาเช่าอายุ สัญญาเช่า 1 – 3 ปี
                        </p>
                    </div>
                </div>
                <div class="col-lg-5 m-b30 m-sm-b0">
                    <div class="swiper-container single-image-swiper swiper-btn-lr sticky-top m-b30">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="dlab-thum-bx">
                                    <img src="{{ asset('public/frontend/images/about/Rectangle111.png') }}" alt="">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="dlab-thum-bx">
                                    <img src="{{ asset('public/frontend/images/about/Rectangle111.png') }}" alt="">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="dlab-thum-bx">
                                    <img src="{{ asset('public/frontend/images/about/Rectangle111.png') }}" alt="">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="dlab-thum-bx">
                                    <img src="{{ asset('public/frontend/images/about/Rectangle111.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="btn-prev btn-s-b swiper-button-prev2"><i class="las la-arrow-left"></i></div>
                        <div class="btn-next btn-s-b swiper-button-next2"><i class="las la-arrow-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- อิ่มเอม มาร์เก็ต -->
    <section class="content-inner-2">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 m-b40">
                    <div class="section-head" style="display: -webkit-box;">
                        <div class="icon-full" style="margin-right:60px;">
                            <svg width="64" height="70" viewBox="0 0 64 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M24 28.4375C24 26.0217 22.2087 24.0625 20 24.0625H18C13.5813 24.0625 10 27.9795 10 32.8125V39.375C10 44.208 13.5813 48.125 18 48.125H20C22.2087 48.125 24 46.1658 24 43.75V28.4375ZM46 48.125C50.4188 48.125 54 44.208 54 39.375V32.8125C54 27.9795 50.4188 24.0625 46 24.0625H44C41.7912 24.0625 40 26.0217 40 28.4375V43.75C40 46.1658 41.7912 48.125 44 48.125H46ZM32 0C14.1475 0 0.5725 16.2463 0 35V37.1875C0 38.3961 0.895 39.375 2 39.375H4C5.105 39.375 6 38.3961 6 37.1875V35C6 19.3197 17.6637 6.5625 32 6.5625C46.3363 6.5625 58 19.3197 58 35H57.985C57.995 35.3322 58 57.657 58 57.657C58 60.8494 55.6338 63.4375 52.715 63.4375H40C40 59.8131 37.3138 56.875 34 56.875H30C26.6863 56.875 24 59.8131 24 63.4375C24 67.0619 26.6863 70 30 70H52.715C58.9475 70 64 64.4738 64 57.657V35C63.4275 16.2463 49.8525 0 32 0Z" fill="white" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="title" style="margin-bottom:20px;">ตลาดเทศบาล 2 นครเชียงราย</h2>
                            <p class="m-b50">ช่องทางการติดต่อสื่อสาร ถนนคนม่วน เชียงราย</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 m-b20">
                    <div class="icon-bx-wraper style-2">
                        <div class="icon-bx-sm radius">
                            <span class="icon-cell">
                                <img src="{{ asset('public/frontend/images/about/Rectangle 96.png') }}" alt="" width="22" height="22" style="height:auto !important;">
                            </span>
                        </div>
                        <div class="icon-content">
                            <p style="color:#212621 !important;">ถนน สันโค้งน้อย ต.รอบเวียง อ.เมืองเชียงราย จ.เชียงราย 57000</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 m-b20">
                    <div class="icon-bx-wraper style-2">
                        <div class="icon-bx-sm radius">
                            <span class="icon-cell">
                                <img src="{{ asset('public/frontend/images/about/Rectangle 98.png') }}" alt="" width="22" height="22" style="height:auto !important;">
                            </span>
                        </div>
                        <div class="icon-content">
                            <p style="color:#212621 !important;">053-711-333</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 m-b20">
                    <div class="icon-bx-wraper style-2">
                        <div class="icon-bx-sm radius">
                            <span class="icon-cell">
                                <img src="{{ asset('public/frontend/images/about/Rectangle 100.png') }}" alt="" width="22" height="22" style="height:auto !important;">
                            </span>
                        </div>
                        <div class="icon-content">
                            <p style="color:#212621 !important;">-</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 m-b20">
                    <div class="icon-bx-wraper style-2">
                        <div class="icon-bx-sm radius">
                            <span class="icon-cell">
                                <img src="{{ asset('public/frontend/images/about/Rectangle 108.png') }}" alt="" width="22" height="22" style="height:auto !important;">
                            </span>
                        </div>
                        <div class="icon-content">
                            <p style="color:#212621 !important;">-</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 m-b20">
                    <div class="icon-bx-wraper style-2">
                        <div class="icon-bx-sm radius">
                            <span class="icon-cell">
                                <img src="{{ asset('public/frontend/images/about/Rectangle 102.png') }}" alt="" width="22" height="22" style="height:auto !important;">
                            </span>
                        </div>
                        <div class="icon-content">
                            <p style="color:#212621 !important;">-</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 m-b20">
                    <div class="icon-bx-wraper style-2">
                        <div class="icon-bx-sm radius">
                            <span class="icon-cell">
                                <img src="{{ asset('public/frontend/images/about/Rectangle 104.png') }}" alt="" width="22" height="22" style="height:auto !important;">
                            </span>
                        </div>
                        <div class="icon-content">
                            <p style="color:#212621 !important;">-</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 m-b20">
                    <div class="icon-bx-wraper style-2">
                        <div class="icon-bx-sm radius">
                            <span class="icon-cell">
                                <img src="{{ asset('public/frontend/images/about/Rectangle 106.png') }}" alt="" width="22" height="22" style="height:auto !important;">
                            </span>
                        </div>
                        <div class="icon-content">
                            <p style="color:#212621 !important;">-</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="content-inner-2">
        <div class="container">
            <div class="section-head text-center head-style-2 wow fadeIn" data-wow-duration="2s" data-wow-delay="0.2s">
                <h2 class="title">ภาพลักษณ์ของตลาด</h2>
                <div class="dlab-separator-outer">
                    <div class="dlab-separator bg-primary"></div>
                </div>
                <p>ตลาดเทศบาล 2 นครเชียงราย ให้ความสำคัญการดูแลและบำรุงรักษาให้คงมาตรฐานความสะอาด ปลอดภัยอยู่เสมอ</p>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 p-1 m-0">
                    <div class="pb-2 text-center">
                        <img src="{{ asset('public/frontend/images/about/Rectangle-86.png') }}" alt="">
                    </div>
                    <div class="pb-2 text-center">
                        <img src="{{ asset('public/frontend/images/about/Rectangle-89.png') }}" alt="">
                    </div>
                    <div class="pb-2 text-center">
                        <img src="{{ asset('public/frontend/images/about/Rectangle-93.png') }}" alt="">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 p-1 m-0">
                    <div class="pb-2 text-center">
                        <img src="{{ asset('public/frontend/images/about/Rectangle-88.png') }}" alt="">
                    </div>
                    <div class="pb-2 text-center">
                        <img src="{{ asset('public/frontend/images/about/Rectangle-90.png') }}" alt="">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 p-1 m-0">
                    <div class="pb-2 text-center">
                        <img src="{{ asset('public/frontend/images/about/Rectangle-87.png') }}" alt="">
                    </div>
                    <div class="pb-2 text-center">
                        <img src="{{ asset('public/frontend/images/about/Rectangle-91.png') }}" alt="">
                    </div>
                    <div class="pb-2 text-center">
                        <img src="{{ asset('public/frontend/images/about/Rectangle-92.png') }}" alt="">
                    </div>
                    <div class="pb-2 text-center">
                        <img src="{{ asset('public/frontend/images/about/Rectangle-94.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content-inner-2">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-head row">
                        <div class="col-sm-8">
                            <h3 class="title m-b20">รางวัลและมาตรฐานที่ได้รับ</h3>
                            <p>ตลาดเทศบาล 2 นครเชียงราย ให้ความสำคัญกับมาตรฐานเพื่อดำเนินกิจการอย่างสะอาดและปลอดภัย</p>
                        </div>
                        <div class="col-sm-4 text-sm-end">
                            <div class="portfolio-pagination d-inline-block">
                                <div class="btn-prev swiper-button-prev3"><i class="las la-arrow-left"></i></div>
                                <div class="btn-next swiper-button-next3"><i class="las la-arrow-right"></i></div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade show active" id="upcoming">
                        <div class="swiper-container city-swiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="icon-bx-wraper style-1 box-sm text-center shadow-none border hover-overlay-effect m-b30">
                                        <div class="icon-md m-b20">
                                            <img src="{{ asset('public/frontend/images/Rectangle 87.png') }}" alt="">
                                        </div>
                                        <div class="icon-content">
                                            <span>มาตรฐาน</span>
                                            <h6 class="title m-t10 m-b0"><a href="used-car-search-result.html" class="text-effect-1" data-splitting>ISO 9001:2015</a></h6>
                                        </div>
                                        <div class="effect bg-primary"></div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="icon-bx-wraper style-1 box-sm text-center shadow-none border hover-overlay-effect m-b30">
                                        <div class="icon-md m-b20">
                                            <img src="{{ asset('public/frontend/images/Rectangle 89.png') }}" alt="">
                                        </div>
                                        <div class="icon-content">
                                            <span>มาตรฐาน GMP</span>
                                            <!-- <h6 class="title m-t10 m-b0"><a href="used-car-search-result.html" class="text-effect-1" data-splitting>ISO 9001:2015</a></h6> -->
                                        </div>
                                        <div class="effect bg-primary"></div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="icon-bx-wraper style-1 box-sm text-center shadow-none border hover-overlay-effect m-b30">
                                        <div class="icon-md m-b20">
                                            <img src="{{ asset('public/frontend/images/Rectangle 91.png') }}" alt="">
                                        </div>
                                        <div class="icon-content">
                                            <span>มาตรฐาน</span>
                                            <h6 class="title m-t10 m-b0"><a href="used-car-search-result.html" class="text-effect-1" data-splitting>ISO 14001:2015</a></h6>
                                        </div>
                                        <div class="effect bg-primary"></div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="icon-bx-wraper style-1 box-sm text-center shadow-none border hover-overlay-effect m-b30">
                                        <div class="icon-md m-b20">
                                            <img src="{{ asset('public/frontend/images/Rectangle 93.png') }}" alt="">
                                        </div>
                                        <div class="icon-content">
                                            <span>มาตรฐาน</span>
                                            <h6 class="title m-t10 m-b0"><a href="used-car-search-result.html" class="text-effect-1" data-splitting>HACCP</a></h6>
                                        </div>
                                        <div class="effect bg-primary"></div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="icon-bx-wraper style-1 box-sm text-center shadow-none border hover-overlay-effect m-b30">
                                        <div class="icon-md m-b20">
                                            <img src="{{ asset('public/frontend/images/Rectangle 95.png') }}" alt="">
                                        </div>
                                        <div class="icon-content">
                                            <span>มาตรฐาน Fair Trade</span>
                                            <h6 class="title m-t10 m-b0"><a href="used-car-search-result.html" class="text-effect-1" data-splitting>(การค้าที่ยุติธรรม)</a></h6>
                                        </div>
                                        <div class="effect bg-primary"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('script')
@endsection