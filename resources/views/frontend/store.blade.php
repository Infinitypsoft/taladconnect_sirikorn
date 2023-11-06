@extends('frontend.header')

@section('style')
    <style>
    </style>
@endsection
@section('content')
    <!-- Modal -->
    <div class="modal fade" id="storeModal" tabindex="-1" aria-labelledby="storeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="storeModalLabel">ข้อมูลร้านค้าล็อก C18</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-xl-12 col-lg-12 col-12">

                            <div class="row lightgallery">
                                <div class="col-xl-12 col-lg-12 col-md-12 m-b30 px-4">
                                    <div class="">
                                        <div class="product-gallery on-show-slider lightgallery m-b40 pe-0"
                                            id="lightgallery">

                                            <div class="swiper-container thumb-slider sync2 mt-0 ">
                                                <div class="row">
                                                    <div class="col-3 ">
                                                        <div class="dlab-media" style="height: 180px;">
                                                            <img src="{{ asset('public/frontend/images/about/23070895c7d757aa3e616b4be6edb9ab.png') }}"
                                                                alt="">
                                                        </div>
                                                    </div>
                                                    <div class="col-3 ">
                                                        <div class="dlab-media" style="height: 180px;">
                                                            <img src="{{ asset('public/frontend/images/about/23070895c7d757aa3e616b4be6edb9ab.png') }}"
                                                                alt="">
                                                        </div>
                                                    </div>
                                                    <div class="col-3 ">
                                                        <div class="dlab-media" style="height: 180px;">
                                                            <img src="{{ asset('public/frontend/images/about/23070895c7d757aa3e616b4be6edb9ab.png') }}"
                                                                alt="">
                                                        </div>
                                                    </div>
                                                    <div class="col-3 ">
                                                        <div class="dlab-media" style="height: 180px;">
                                                            <img src="{{ asset('public/frontend/images/about/23070895c7d757aa3e616b4be6edb9ab.png') }}"
                                                                alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h4 class="title mb-0"><a href="car-details.html" class="">กุ้งซิ่งสายคลอง
                                                สระบุรี</a></h4>
                                        <div class="row ">
                                            <div class="col-6 d-flex ">
                                                <div class="star-rating ">
                                                    <div data-rating="5" class="my-2">
                                                        <i class="fa fa-star text-yellow" data-alt="1"
                                                            title="regular"></i>
                                                        <i class="fa fa-star text-yellow" data-alt="2"
                                                            title="regular"></i>
                                                        <i class="fa fa-star text-yellow" data-alt="3"
                                                            title="regular"></i>
                                                        <i class="fa fa-star text-yellow" data-alt="4"
                                                            title="regular"></i>
                                                        <i class="fa fa-star text-yellow" data-alt="5"
                                                            title="regular"></i>
                                                    </div>
                                                </div>
                                                <p class="my-2" style="margin-left: 10px">19 รีวิว</p>

                                            </div>
                                            <div class="col-6 ">
                                                <p class="text-end">ราคาเริ่มต้น <span style="color:#71BF45">
                                                        20 </span> บาท</p>
                                            </div>
                                        </div>

                                        <div class="feature-list">
                                            <div>
                                                <div class=" text-16 ">กุ้งซิ่งสายคลอง สระบุรี อร่อยทุกอย่าง
                                                    ใส่ใจทุกเมนู กุ้งหน้าชีส, กุ้งเผา, กุ้งดอง, แซลมอนดอง</div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
                <div class="modal-footer text-center" style="justify-content: space-evenly;">
                    <button type="button" class="btn btn-primary">อ่านเพิ่มเติม</button>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content bg-white">
        <!-- Banner  -->
        <div class="dlab-bnr-inr dlab-bnr-inr-lg style-1 overlay-black-middle"
            style="background-image: url({{ asset('public/frontend/images/banner/bbs.png') }});">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h1 class="text-white">ร้านค้า</h1>
                    <div class="dlab-separator"></div>
                </div>
            </div>
        </div>

        <div class="section-full bg-img-fix dlab-new-work overlay-white-dark "
            style="background-image: url(images/background/bg1.jpg);">
            <div class="container-fluid p-a0">
                <div class="row spno">
                    <div class="col-lg-3 col-sm-4 no-of-item">
                        <div class="no-of-item-dtl">
                            <h2 class="text-primary" style="opacity: 1">5</h2>
                            <h3>ร้านค้าแนะนำ/ร้านดังประจำตลาด</h3>
                        </div>
                        <div class="text-sm-end text-center">
                            <div class="btn-prev swiper-button-prev6"><i class="las la-arrow-left"></i></div>
                            <div class="btn-next swiper-button-next6"><i class="las la-arrow-right"></i></div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-sm-8">
                        <div class="new-item swiper-container">
                            <div class="swiper-wrapper">
                                @foreach ($store_recommen as $item)
                                    <div class="swiper-slide dlab-new-item">
                                        <div class="dlab-box">
                                            <div class="dlab-media">
                                                <a href="{{ route('store.detail') }}?store_id={{$item->id}}">
                                                    <img src="{{ asset('public/'.$item->pic_path) }}" alt="">
                                                </a>
                                            </div>
                                            <div class="dlab-info">
                                                <p class="event-date">{{$item->created_at}}</p>
                                                <h4 class="dlab-title"><a href="{{ route('store.detail') }}?store_id={{$item->id}}">{{$item->store_name}}<i class="fa fa-angle-right float-end"></i></a></h4>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="content-inner">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 ">
                        <div class="section-head text-center" style="margin-bottom: 60px">
                            <h2 class="title" style="font-size: 48px;font-weight: 600;">ร้านค้าที่เปิดให้บริการในตลาด
                            </h2>
                            <p style="font-size: 18px; font-weight: 400;" class="mt-4">
                            มีสินค้าให้เลือกซื้อหลากหลาย ไม่ว่าจะเป็นผัก ผลไม้ อาหาร ขนม ของฝาก และร้านดอกไม้สด ซึ่งการขายสินค้าต่าง ๆ 
                            ภายในตลาดแห่งนี้มีราคาเริ่มต้นตั้งแต่ 5 บาท ไปจนถึงหลักพันบาท
                            </p>
                        </div>
                    </div>

                    <section class="content-inner-2">
                        <div class="container">
                            <div class="row">
                                <div class="col-xl-3 col-lg-3 col-12 m-b30">
                                    <aside class="side-bar  left">
                                        <div class="section-head mb-3">
                                            <h3 class="title">ตัวกรอง</h3>
                                        </div>
                                        <form>
                                            <div class="widget widget_search">
                                                <ul class="">
                                                    <h6 class="sub-title style-1">ประเภทร้านค้า</h6>

                                                    <li class="mt-3">
                                                        <input class="form-check-input me-1" type="checkbox"
                                                            value="" aria-label="...">
                                                        ร้านอาหาร
                                                    </li>
                                                    <li class="mt-3">
                                                        <input class="form-check-input me-1" type="checkbox"
                                                            value="" aria-label="...">
                                                        ร้านเสื้อผ้าแฟชั่น
                                                    </li>
                                                    <li class="mt-3">
                                                        <input class="form-check-input me-1" type="checkbox"
                                                            value="" aria-label="...">
                                                        ร้านอาหารสด
                                                    </li>

                                                </ul>
                                            </div>

                                            <div class="widget widget_search">
                                                <ul class="">
                                                    <h6 class="sub-title style-1">ประเภทสินค้า</h6>

                                                    <li class="mt-3">
                                                        <input class="form-check-input me-1" type="checkbox"
                                                            value="" aria-label="...">
                                                        อาหารตามสั่ง
                                                    </li>
                                                    <li class="mt-3">
                                                        <input class="form-check-input me-1" type="checkbox"
                                                            value="" aria-label="...">
                                                        อาหารจานเดียว
                                                    </li>
                                                    <li class="mt-3">
                                                        <input class="form-check-input me-1" type="checkbox"
                                                            value="" aria-label="...">
                                                        ก๋วยเตี๋ยว
                                                    </li>
                                                    <li class="mt-3">
                                                        <input class="form-check-input me-1" type="checkbox"
                                                            value="" aria-label="...">
                                                        ของหวาน
                                                    </li>
                                                    <li class="mt-3">
                                                        <input class="form-check-input me-1" type="checkbox"
                                                            value="" aria-label="...">
                                                        เครื่องดื่ม/น้ำผลไม้
                                                    </li>
                                                    <li class="mt-3">
                                                        <input class="form-check-input me-1" type="checkbox"
                                                            value="" aria-label="...">
                                                        เบเกอนรี่เค้ก
                                                    </li>
                                                    <li class="mt-3" style="color: #1A96D4">
                                                        ดูเพิ่มเติม (18 ประเภท)
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="widget widget_search">
                                                <ul class="">
                                                    <h6 class="sub-title style-1">ราคา</h6>

                                                    <li class="mt-3">
                                                        <input class="form-check-input me-1" type="checkbox"
                                                            value="" aria-label="...">
                                                        ถูกกว่า 100
                                                    </li>
                                                    <li class="mt-3">
                                                        <input class="form-check-input me-1" type="checkbox"
                                                            value="" aria-label="...">
                                                        100 - 250
                                                    </li>
                                                    <li class="mt-3">
                                                        <input class="form-check-input me-1" type="checkbox"
                                                            value="" aria-label="...">
                                                        251 - 500
                                                    </li>
                                                    <li class="mt-3">
                                                        <input class="form-check-input me-1" type="checkbox"
                                                            value="" aria-label="...">
                                                        มากกว่า 500
                                                    </li>
                                                    <li class="mt-3">
                                                        <input class="form-check-input me-1" type="checkbox"
                                                            value="" aria-label="...">
                                                        มากกว่า 1000
                                                    </li>

                                                </ul>
                                            </div>

                                            <div class="widget widget_search">
                                                <ul class="">
                                                    <h6 class="sub-title style-1"> การรีวิว </h6>

                                                    <li class="mt-3">
                                                        <input class="form-check-input me-1" type="checkbox"
                                                            value="" aria-label="...">
                                                        1 ดาว
                                                    </li>
                                                    <li class="mt-3">
                                                        <input class="form-check-input me-1" type="checkbox"
                                                            value="" aria-label="...">
                                                        2 ดาว
                                                    </li>
                                                    <li class="mt-3">
                                                        <input class="form-check-input me-1" type="checkbox"
                                                            value="" aria-label="...">
                                                        3 ดาว
                                                    </li>
                                                    <li class="mt-3">
                                                        <input class="form-check-input me-1" type="checkbox"
                                                            value="" aria-label="...">
                                                        4 ดาว
                                                    </li>
                                                    <li class="mt-3">
                                                        <input class="form-check-input me-1" type="checkbox"
                                                            value="" aria-label="...">
                                                        5 ดาว
                                                    </li>

                                                </ul>
                                            </div>

                                        </form>
                                    </aside>
                                </div>
                                <div class="col-xl-9 col-lg-9 col-12">
                                    <div class="catagory-result-row">
                                        <h5 class="serch-result">การแสดงข้อมูล <strong>2 จาก 10 ร้านค้า</strong></h5>
                                        <div>การเรียงข้อมูล
                                            <select class="form-control custom-select ms-3">
                                                <option>ใหม่ล่าสุด</option>
                                                <option>ใหม่ล่าสุด</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row lightgallery">

                                        <div class="col-xl-12 col-lg-12 col-md-12 m-b30">
                                            <div class="car-list-box">

                                                <div class="list-info">
                                                    <div class="product-gallery on-show-slider lightgallery m-b40"
                                                        id="lightgallery">

                                                        <div class="swiper-container thumb-slider sync2 mt-0">
                                                            <div class="swiper-wrapper">
                                                                <div class="swiper-slide">
                                                                    <div class="dlab-media" style="height: 180px;">
                                                                        <img src="{{ asset('public/frontend/images/about/23070895c7d757aa3e616b4be6edb9ab.png') }}"
                                                                            alt="">
                                                                    </div>
                                                                </div>
                                                                <div class="swiper-slide">
                                                                    <div class="dlab-media" style="height: 180px;">
                                                                        <img src="{{ asset('public/frontend/images/about/23070895c7d757aa3e616b4be6edb9ab.png') }}"
                                                                            alt="">
                                                                    </div>
                                                                </div>
                                                                <div class="swiper-slide">
                                                                    <div class="dlab-media" style="height: 180px;">
                                                                        <img src="{{ asset('public/frontend/images/about/23070895c7d757aa3e616b4be6edb9ab.png') }}"
                                                                            alt="">
                                                                    </div>
                                                                </div>
                                                                <div class="swiper-slide">
                                                                    <div class="dlab-media" style="height: 180px;">
                                                                        <img src="{{ asset('public/frontend/images/about/23070895c7d757aa3e616b4be6edb9ab.png') }}"
                                                                            alt="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h4 class="title mb-0"><a href="car-details.html"
                                                            class="">กุ้งซิ่งสายคลอง สระบุรี</a></h4>
                                                    <div class="row ">
                                                        <div class="col-6 d-flex ">
                                                            <div class="star-rating ">
                                                                <div data-rating="5" class="my-2">
                                                                    <i class="fa fa-star text-yellow" data-alt="1"
                                                                        title="regular"></i>
                                                                    <i class="fa fa-star text-yellow" data-alt="2"
                                                                        title="regular"></i>
                                                                    <i class="fa fa-star text-yellow" data-alt="3"
                                                                        title="regular"></i>
                                                                    <i class="fa fa-star text-yellow" data-alt="4"
                                                                        title="regular"></i>
                                                                    <i class="fa fa-star text-yellow" data-alt="5"
                                                                        title="regular"></i>
                                                                </div>
                                                            </div>
                                                            <p class="my-2" style="margin-left: 10px">19 รีวิว</p>

                                                        </div>
                                                        <div class="col-6 ">
                                                            <p class="text-end">ราคาเริ่มต้น <span style="color:#71BF45">
                                                                    20 </span> บาท</p>
                                                        </div>
                                                    </div>

                                                    <div class="feature-list">
                                                        <div>
                                                            <div class=" text-16 ">กุ้งซิ่งสายคลอง สระบุรี อร่อยทุกอย่าง
                                                                ใส่ใจทุกเมนู กุ้งหน้าชีส, กุ้งเผา, กุ้งดอง, แซลมอนดอง</div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <nav aria-label="Blog Pagination">
                                        <ul class="pagination text-center m-b30">
                                            <li class="page-item"><a class="page-link prev" href="javascript:void(0);"><i
                                                        class="la la-angle-left"></i></a></li>
                                            <li class="page-item"><a class="page-link active"
                                                    href="javascript:void(0);">1</a></li>
                                            <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a>
                                            </li>
                                            <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a>
                                            </li>
                                            <li class="page-item"><a class="page-link next" href="javascript:void(0);"><i
                                                        class="la la-angle-right"></i></a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>

        <section class="content-inner mt-5">
            <div class="container">
                <div class="section-head space-lg text-center">
                    <h2 class="title m-b20">ตลาดเทศบาล 2 นครเชียงราย</h2>
                    <p>แปลนตลาดและขนาดผังค้าของตลาดเทศบาล 2 นครเชียงราย</p>
                </div>
                <div class="dlab-tabs  product-description">
                    <ul class="nav nav-tabs m-b50">
                        {{-- <li><a data-bs-toggle="tab" href="#building_a" class="active" style="font-weight: 500;">อาคาร
                                A</a></li>
                        <li><a data-bs-toggle="tab" href="#building_b" style="font-weight: 500;">อาคาร B</a></li> --}}
                        @foreach ($site as $item)
                            <li><a data-bs-toggle="tab" href="#building_a" class="active" style="font-weight: 500;">{{$item->site_name}}</a></li>
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        <div id="building_a" class="tab-pane active">
                            <h6 style="font-size: 22px; font-weight: 600;">ขนาดแผงค้า</h6>
                            <div class="used-car-features grid2 clearfix m-b50 m-t15" style="gap: 20px">
                                @foreach ($stall_size as $item)
                                    <div class="car-features">
                                        <svg width="50" height="50" viewBox="0 0 50 50" fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <rect x="0.5" y="0.5" width="49" height="49"
                                                rx="4.5" fill="#C9E7DD" stroke="#C9C9C9" />
                                            <rect x="10" y="10" width="30" height="30"
                                                fill="url(#pattern0)" />
                                            <defs>
                                                <pattern id="pattern0" patternContentUnits="objectBoundingBox"
                                                    width="1" height="1">
                                                    <use xlink:href="#image0_0_1" transform="scale(0.00195312)" />
                                                </pattern>
                                                <image id="image0_0_1" width="512" height="512" src="{{ asset('public/'.$item->pic_path) }}">
                                            </defs>
                                        </svg>

                                        <h5>{{$item->name}}</h5>
                                        <span>ขนาด {{$item->size_w}} x {{$item->size_h}} เมตร</span>
                                    </div>
                                @endforeach

                            </div>

                            {{-- รูปแบบพื้นที่ใช้เช่าทั้งหมด --}}
                            <h6 style="font-size: 22px; font-weight: 600;">รูปแบบพื้นที่ใช้เช่าทั้งหมด</h6>
                            <div class="icon-bx-wraper bx-style-1" style="padding: 34px;">
                                <div class="used-car-features grid2 clearfix m-b60" data-bs-toggle="modal"
                                    data-bs-target="#storeModal">
                                    <?php for ($i=1; $i <= 24; $i++) { ?>
                                    <div class="car-features2">
                                        <h5 class="m-0">G<?= sprintf('%02d', $i) ?></h5>
                                    </div>
                                    <?php }?>
                                </div>

                                <div class="used-car-features grid2 clearfix m-b60">
                                    <?php for ($i=1; $i <= 30; $i++) { ?>
                                    <div class="car-features4">
                                        <h5 class="m-0">G<?= sprintf('%02d', $i) ?></h5>
                                    </div>
                                    <?php }?>
                                </div>

                                <div class="used-car-features grid2 clearfix m-b60">
                                    <?php for ($i=1; $i <= 30; $i++) { ?>
                                    <div class="car-features5">
                                        <h5 class="m-0">G<?= sprintf('%02d', $i) ?></h5>
                                    </div>
                                    <?php }?>
                                </div>

                                <div class="used-car-features grid2 clearfix">
                                    <?php for ($i=1; $i <= 24; $i++) { ?>
                                    <div class="car-features3">
                                        <h5 class="m-0">A<?= sprintf('%02d', $i) ?></h5>
                                    </div>
                                    <?php }?>
                                </div>
                            </div>

                        </div>
                        <div id="building_b" class="tab-pane">

                        </div>
                    </div>
                </div>
            </div>
        </section>


    </div>
@endsection

@section('script')
@endsection
