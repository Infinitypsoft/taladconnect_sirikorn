@extends('frontend.header')

@section('style')
<style>
    .badge.badge-success {
        border-radius: 10px;
        border: 1px solid #F67180;
        background: #F67180;
    }

    .badge.badge-warning {
        border-radius: 10px;
        border: 1px solid #BB8778;
        background: #BB8778;
    }
</style>
@endsection
@section('content')
<div class="page-content bg-white">
    <!-- Breadcrumb row -->
    <nav aria-label="breadcrumb" class="breadcrumb-row">
        <div class="container">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">หน้าแรก</a></li>
                <li class="breadcrumb-item"><a href="index.html">ร้านค้า</a></li>
                <li class="breadcrumb-item">กุ้งซิ่งสายคลอง สระบุรี</li>
            </ul>
        </div>
    </nav>
    <!-- Breadcrumb row END -->

    <section class="">
        <div class="container">
            <div class="row">
                <div class="col-xl-7 col-lg-6 m-b40">
                    <div class="product-gallery on-show-slider lightgallery" id="lightgallery">
                        <div class="swiper-container sync1">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="dlab-thum-bx">
                                        <img src="{{ asset('public/frontend/images/store_detail.png') }}" alt="">
                                        <div class="overlay-bx">
                                            <div class="overlay-icon">
                                                <span data-exthumbimage="{{ asset('public/frontend/images/store_detail.png') }}" data-src="{{ asset('public/frontend/images/store_detail.png') }}" class="view-btn lightimg">
                                                    <svg width="75" height="74" viewBox="0 0 75 74" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M44.5334 27.7473V32.3718C44.5334 33.3257 43.7424 34.106 42.7755 34.106H34.572V42.199C34.572 43.1528 33.7809 43.9332 32.8141 43.9332H28.1264C27.1595 43.9332 26.3685 43.1528 26.3685 42.199V34.106H18.1649C17.1981 34.106 16.4071 33.3257 16.4071 32.3718V27.7473C16.4071 26.7935 17.1981 26.0131 18.1649 26.0131H26.3685V17.9201C26.3685 16.9663 27.1595 16.1859 28.1264 16.1859H32.8141C33.7809 16.1859 34.572 16.9663 34.572 17.9201V26.0131H42.7755C43.7424 26.0131 44.5334 26.7935 44.5334 27.7473ZM73.9782 68.8913L69.8325 72.9812C68.4555 74.3396 66.2288 74.3396 64.8664 72.9812L50.2466 58.5728C49.5874 57.9225 49.2212 57.0409 49.2212 56.116V53.7604C44.05 57.749 37.5458 60.1191 30.4702 60.1191C13.6384 60.1191 0 46.6646 0 30.0596C0 13.4545 13.6384 0 30.4702 0C47.3021 0 60.9405 13.4545 60.9405 30.0596C60.9405 37.0397 58.538 43.4563 54.4949 48.5578H56.8827C57.8202 48.5578 58.7138 48.9191 59.373 49.5694L73.9782 63.9777C75.3406 65.3362 75.3406 67.5329 73.9782 68.8913ZM50.3931 30.0596C50.3931 19.1919 41.4864 10.4052 30.4702 10.4052C19.4541 10.4052 10.5474 19.1919 10.5474 30.0596C10.5474 40.9273 19.4541 49.7139 30.4702 49.7139C41.4864 49.7139 50.3931 40.9273 50.3931 30.0596Z" fill="white" fill-opacity="0.66" />
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="dlab-thum-bx">
                                        <img src="{{ asset('public/frontend/images/product/item/item2.jpg') }}" alt="">
                                        <div class="overlay-bx">
                                            <div class="overlay-icon">
                                                <span data-exthumbimage="{{ asset('public/frontend/images/product/item/item2.jpg') }}" data-src="{{ asset('public/frontend/images/product/item/item2.jpg') }}" class="view-btn lightimg">
                                                    <svg width="75" height="74" viewBox="0 0 75 74" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M44.5334 27.7473V32.3718C44.5334 33.3257 43.7424 34.106 42.7755 34.106H34.572V42.199C34.572 43.1528 33.7809 43.9332 32.8141 43.9332H28.1264C27.1595 43.9332 26.3685 43.1528 26.3685 42.199V34.106H18.1649C17.1981 34.106 16.4071 33.3257 16.4071 32.3718V27.7473C16.4071 26.7935 17.1981 26.0131 18.1649 26.0131H26.3685V17.9201C26.3685 16.9663 27.1595 16.1859 28.1264 16.1859H32.8141C33.7809 16.1859 34.572 16.9663 34.572 17.9201V26.0131H42.7755C43.7424 26.0131 44.5334 26.7935 44.5334 27.7473ZM73.9782 68.8913L69.8325 72.9812C68.4555 74.3396 66.2288 74.3396 64.8664 72.9812L50.2466 58.5728C49.5874 57.9225 49.2212 57.0409 49.2212 56.116V53.7604C44.05 57.749 37.5458 60.1191 30.4702 60.1191C13.6384 60.1191 0 46.6646 0 30.0596C0 13.4545 13.6384 0 30.4702 0C47.3021 0 60.9405 13.4545 60.9405 30.0596C60.9405 37.0397 58.538 43.4563 54.4949 48.5578H56.8827C57.8202 48.5578 58.7138 48.9191 59.373 49.5694L73.9782 63.9777C75.3406 65.3362 75.3406 67.5329 73.9782 68.8913ZM50.3931 30.0596C50.3931 19.1919 41.4864 10.4052 30.4702 10.4052C19.4541 10.4052 10.5474 19.1919 10.5474 30.0596C10.5474 40.9273 19.4541 49.7139 30.4702 49.7139C41.4864 49.7139 50.3931 40.9273 50.3931 30.0596Z" fill="white" fill-opacity="0.66" />
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="dlab-thum-bx">
                                        <img src="{{ asset('public/frontend/images/product/item/item3.jpg') }}" alt="">
                                        <div class="overlay-bx">
                                            <div class="overlay-icon">
                                                <span data-exthumbimage="{{ asset('public/frontend/images/product/item/item3.jpg') }}" data-src="{{ asset('public/frontend/images/product/item/item3.jpg') }}" class="view-btn lightimg">
                                                    <svg width="75" height="74" viewBox="0 0 75 74" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M44.5334 27.7473V32.3718C44.5334 33.3257 43.7424 34.106 42.7755 34.106H34.572V42.199C34.572 43.1528 33.7809 43.9332 32.8141 43.9332H28.1264C27.1595 43.9332 26.3685 43.1528 26.3685 42.199V34.106H18.1649C17.1981 34.106 16.4071 33.3257 16.4071 32.3718V27.7473C16.4071 26.7935 17.1981 26.0131 18.1649 26.0131H26.3685V17.9201C26.3685 16.9663 27.1595 16.1859 28.1264 16.1859H32.8141C33.7809 16.1859 34.572 16.9663 34.572 17.9201V26.0131H42.7755C43.7424 26.0131 44.5334 26.7935 44.5334 27.7473ZM73.9782 68.8913L69.8325 72.9812C68.4555 74.3396 66.2288 74.3396 64.8664 72.9812L50.2466 58.5728C49.5874 57.9225 49.2212 57.0409 49.2212 56.116V53.7604C44.05 57.749 37.5458 60.1191 30.4702 60.1191C13.6384 60.1191 0 46.6646 0 30.0596C0 13.4545 13.6384 0 30.4702 0C47.3021 0 60.9405 13.4545 60.9405 30.0596C60.9405 37.0397 58.538 43.4563 54.4949 48.5578H56.8827C57.8202 48.5578 58.7138 48.9191 59.373 49.5694L73.9782 63.9777C75.3406 65.3362 75.3406 67.5329 73.9782 68.8913ZM50.3931 30.0596C50.3931 19.1919 41.4864 10.4052 30.4702 10.4052C19.4541 10.4052 10.5474 19.1919 10.5474 30.0596C10.5474 40.9273 19.4541 49.7139 30.4702 49.7139C41.4864 49.7139 50.3931 40.9273 50.3931 30.0596Z" fill="white" fill-opacity="0.66" />
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-container thumb-slider sync2">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="dlab-media">
                                        <img src="{{ asset('public/frontend/images/product/thumb/thumb1.jpg') }}" alt="">
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="dlab-media">
                                        <img src="{{ asset('public/frontend/images/product/thumb/thumb2.jpg') }}" alt="">
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="dlab-media">
                                        <img src="{{ asset('public/frontend/images/product/thumb/thumb3.jpg') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-6 m-b40 m-sm-b0">
                    <div class="sticky-top">
                        <div class="dlab-post-title">
                            <h2 class="post-title mb-4"><a href="javascript:void(0);">กุ้งซิ่งสายคลอง สระบุรี</a></h2>

                            <span class="badge badge-success font-14">ร้านค้าล็อก C18</span>
                            <span class="badge badge-warning font-14">
                                <div class="star-rating ">
                                    <div data-rating="5">
                                        <i class="fa fa-star text-white" data-alt="1" title="regular"></i>
                                        <i class="fa fa-star text-white" data-alt="2" title="regular"></i>
                                        <i class="fa fa-star text-white" data-alt="3" title="regular"></i>
                                        <i class="fa fa-star text-white" data-alt="4" title="regular"></i>
                                        <i class="fa fa-star text-white" data-alt="5" title="regular"></i>
                                    </div>
                                </div>
                            </span>
                            <span class="font-14">19 รีวิว</span>

                            <p class="m-b10 mt-4">กุ้งเป็นๆ เนื้อหวาน ที่ร้านมีเมนูให้เลือกอร่อยเพียบ ทั้งกุ้งเผา แซลมอนดองซีอิ๊ว
                                กุ้งดองซีอิ๊ว ทอดมันกุ้งและกุ้งเผาเเกะเเล้วทานกับข้าวญี่ปุ่นหรือสาหร่าย
                                กินคู่กับน้ำจิ้มซีฟู้ดสุดแซ่บ</p>
                            <div class="dlab-divider bg-gray tb15">
                                <i class="icon-dot c-square"></i>
                            </div>
                        </div>
                        <div class="feature-list m-b40 m-lg-b30">
                            <div>
                                <label>ประเภทร้านค้า</label>
                                <p class="value">ร้านอาหาร</p>
                            </div>
                            <div>
                                <label>ประเภทสินค้า</label>
                                <p class="value">อาหารจานเดียว</p>
                            </div>
                            <div>
                                <label>ช่วงราคา</label>
                                <p class="value">20 - 410 บาท</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <h6 style="margin-right: 20px;">ติดต่อร้านค้า</h6>
                            <ul class="social-list style-1 ml-3">
                                <li><a href="#"><i class="fa fa-map-marker"></i></a></li>
                                <li><a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="https://www.youtube.com/"><i class="fab fa-line"></i></a></li>
                                <li><a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="https://twitter.com/"><i class="fab fa-tiktok"></i></a></li>
                            </ul>
                        </div>
                        <div class="m-b40 m-lg-b30">
                            <span class="btn btn-outline-primary font-16 m-b10 m-r10"><i class="fas fa-store" style="margin-right:10px;"></i> เปิดทุกวัน เวลา 11:00-21:00 น.</span>
                            <a href="tel:224000221133" class="btn btn-primary light shadow-none m-b10"><i class="fas fa-phone-volume me-3"></i>224 000 22 11 33</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>




    <section class="content-inner-2">
        <div class="container">
            <div class="section-head space-lg text-center">
                <h2 class="title">รายการอาหารแนะนำ</h2>
            </div>
            <div class="row">
                <div class="col-xl-3 col-lg-4 m-b30">
                    <div class="car-list-box box-sm">
                        <div class="media-box">
                            <img src="{{ asset('public/frontend/images/imaimmarket/ss1.png') }}" alt="">
                            <div class="overlay-bx">
                                <span data-exthumbimage="{{ asset('public/frontend/images/imaimmarket/ss1.png') }}" data-src="{{ asset('public/frontend/images/imaimmarket/ss1.png') }}" class="view-btn lightimg">
                                    <svg width="75" height="74" viewBox="0 0 75 74" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M44.5334 27.7473V32.3718C44.5334 33.3257 43.7424 34.106 42.7755 34.106H34.572V42.199C34.572 43.1528 33.7809 43.9332 32.8141 43.9332H28.1264C27.1595 43.9332 26.3685 43.1528 26.3685 42.199V34.106H18.1649C17.1981 34.106 16.4071 33.3257 16.4071 32.3718V27.7473C16.4071 26.7935 17.1981 26.0131 18.1649 26.0131H26.3685V17.9201C26.3685 16.9663 27.1595 16.1859 28.1264 16.1859H32.8141C33.7809 16.1859 34.572 16.9663 34.572 17.9201V26.0131H42.7755C43.7424 26.0131 44.5334 26.7935 44.5334 27.7473ZM73.9782 68.8913L69.8325 72.9812C68.4555 74.3396 66.2288 74.3396 64.8664 72.9812L50.2466 58.5728C49.5874 57.9225 49.2212 57.0409 49.2212 56.116V53.7604C44.05 57.749 37.5458 60.1191 30.4702 60.1191C13.6384 60.1191 0 46.6646 0 30.0596C0 13.4545 13.6384 0 30.4702 0C47.3021 0 60.9405 13.4545 60.9405 30.0596C60.9405 37.0397 58.538 43.4563 54.4949 48.5578H56.8827C57.8202 48.5578 58.7138 48.9191 59.373 49.5694L73.9782 63.9777C75.3406 65.3362 75.3406 67.5329 73.9782 68.8913ZM50.3931 30.0596C50.3931 19.1919 41.4864 10.4052 30.4702 10.4052C19.4541 10.4052 10.5474 19.1919 10.5474 30.0596C10.5474 40.9273 19.4541 49.7139 30.4702 49.7139C41.4864 49.7139 50.3931 40.9273 50.3931 30.0596Z" fill="white" fill-opacity="0.66" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="list-info">
                            <h5 class="title mb-0"><a href="car-details.html" class="">เกี๋ยวซ่าทอด</a></h5>
                            <p>เกี๋ยวซ่าทอด รับประกันความอร่อย กรอบนอก นุ่มใน</p>
                            <span class="badge m-b30">40-.</span>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 m-b30">
                    <div class="car-list-box box-sm">
                        <div class="media-box">
                            <img src="{{ asset('public/frontend/images/imaimmarket/ss2.png') }}" alt="">
                            <div class="overlay-bx">
                                <span data-exthumbimage="{{ asset('public/frontend/images/imaimmarket/ss2.png') }}" data-src="{{ asset('public/frontend/images/imaimmarket/ss2.png') }}" class="view-btn lightimg">
                                    <svg width="75" height="74" viewBox="0 0 75 74" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M44.5334 27.7473V32.3718C44.5334 33.3257 43.7424 34.106 42.7755 34.106H34.572V42.199C34.572 43.1528 33.7809 43.9332 32.8141 43.9332H28.1264C27.1595 43.9332 26.3685 43.1528 26.3685 42.199V34.106H18.1649C17.1981 34.106 16.4071 33.3257 16.4071 32.3718V27.7473C16.4071 26.7935 17.1981 26.0131 18.1649 26.0131H26.3685V17.9201C26.3685 16.9663 27.1595 16.1859 28.1264 16.1859H32.8141C33.7809 16.1859 34.572 16.9663 34.572 17.9201V26.0131H42.7755C43.7424 26.0131 44.5334 26.7935 44.5334 27.7473ZM73.9782 68.8913L69.8325 72.9812C68.4555 74.3396 66.2288 74.3396 64.8664 72.9812L50.2466 58.5728C49.5874 57.9225 49.2212 57.0409 49.2212 56.116V53.7604C44.05 57.749 37.5458 60.1191 30.4702 60.1191C13.6384 60.1191 0 46.6646 0 30.0596C0 13.4545 13.6384 0 30.4702 0C47.3021 0 60.9405 13.4545 60.9405 30.0596C60.9405 37.0397 58.538 43.4563 54.4949 48.5578H56.8827C57.8202 48.5578 58.7138 48.9191 59.373 49.5694L73.9782 63.9777C75.3406 65.3362 75.3406 67.5329 73.9782 68.8913ZM50.3931 30.0596C50.3931 19.1919 41.4864 10.4052 30.4702 10.4052C19.4541 10.4052 10.5474 19.1919 10.5474 30.0596C10.5474 40.9273 19.4541 49.7139 30.4702 49.7139C41.4864 49.7139 50.3931 40.9273 50.3931 30.0596Z" fill="white" fill-opacity="0.66" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="list-info">
                            <h5 class="title mb-0"><a href="car-details.html" class="">โรตีทอด</a></h5>
                            <p>โรตีทอด รับประกันความอร่อย กรอบ ฉ่ำ</p>
                            <span class="badge m-b30">10-.</span>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 m-b30">
                    <div class="car-list-box box-sm">
                        <div class="media-box">
                            <img src="{{ asset('public/frontend/images/imaimmarket/ss3.png') }}" alt="">
                            <div class="overlay-bx">
                                <span data-exthumbimage="{{ asset('public/frontend/images/imaimmarket/ss3.png') }}" data-src="{{ asset('public/frontend/images/imaimmarket/ss3.png') }}" class="view-btn lightimg">
                                    <svg width="75" height="74" viewBox="0 0 75 74" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M44.5334 27.7473V32.3718C44.5334 33.3257 43.7424 34.106 42.7755 34.106H34.572V42.199C34.572 43.1528 33.7809 43.9332 32.8141 43.9332H28.1264C27.1595 43.9332 26.3685 43.1528 26.3685 42.199V34.106H18.1649C17.1981 34.106 16.4071 33.3257 16.4071 32.3718V27.7473C16.4071 26.7935 17.1981 26.0131 18.1649 26.0131H26.3685V17.9201C26.3685 16.9663 27.1595 16.1859 28.1264 16.1859H32.8141C33.7809 16.1859 34.572 16.9663 34.572 17.9201V26.0131H42.7755C43.7424 26.0131 44.5334 26.7935 44.5334 27.7473ZM73.9782 68.8913L69.8325 72.9812C68.4555 74.3396 66.2288 74.3396 64.8664 72.9812L50.2466 58.5728C49.5874 57.9225 49.2212 57.0409 49.2212 56.116V53.7604C44.05 57.749 37.5458 60.1191 30.4702 60.1191C13.6384 60.1191 0 46.6646 0 30.0596C0 13.4545 13.6384 0 30.4702 0C47.3021 0 60.9405 13.4545 60.9405 30.0596C60.9405 37.0397 58.538 43.4563 54.4949 48.5578H56.8827C57.8202 48.5578 58.7138 48.9191 59.373 49.5694L73.9782 63.9777C75.3406 65.3362 75.3406 67.5329 73.9782 68.8913ZM50.3931 30.0596C50.3931 19.1919 41.4864 10.4052 30.4702 10.4052C19.4541 10.4052 10.5474 19.1919 10.5474 30.0596C10.5474 40.9273 19.4541 49.7139 30.4702 49.7139C41.4864 49.7139 50.3931 40.9273 50.3931 30.0596Z" fill="white" fill-opacity="0.66" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="list-info">
                            <h5 class="title mb-0"><a href="car-details.html" class="">โรตีกล้วย</a></h5>
                            <p>โรตีกล้วย ราดด้วยนมข้นหวานรับประกัน ความอร่อย กรอบ ฉ่ำ</p>
                            <span class="badge m-b30">45-.</span>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 m-b30">
                    <div class="car-list-box box-sm">
                        <div class="media-box">
                            <img src="{{ asset('public/frontend/images/imaimmarket/ss4.png') }}" alt="">
                            <div class="overlay-bx">
                                <span data-exthumbimage="{{ asset('public/frontend/images/imaimmarket/ss4.png') }}" data-src="{{ asset('public/frontend/images/imaimmarket/ss4.png') }}" class="view-btn lightimg">
                                    <svg width="75" height="74" viewBox="0 0 75 74" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M44.5334 27.7473V32.3718C44.5334 33.3257 43.7424 34.106 42.7755 34.106H34.572V42.199C34.572 43.1528 33.7809 43.9332 32.8141 43.9332H28.1264C27.1595 43.9332 26.3685 43.1528 26.3685 42.199V34.106H18.1649C17.1981 34.106 16.4071 33.3257 16.4071 32.3718V27.7473C16.4071 26.7935 17.1981 26.0131 18.1649 26.0131H26.3685V17.9201C26.3685 16.9663 27.1595 16.1859 28.1264 16.1859H32.8141C33.7809 16.1859 34.572 16.9663 34.572 17.9201V26.0131H42.7755C43.7424 26.0131 44.5334 26.7935 44.5334 27.7473ZM73.9782 68.8913L69.8325 72.9812C68.4555 74.3396 66.2288 74.3396 64.8664 72.9812L50.2466 58.5728C49.5874 57.9225 49.2212 57.0409 49.2212 56.116V53.7604C44.05 57.749 37.5458 60.1191 30.4702 60.1191C13.6384 60.1191 0 46.6646 0 30.0596C0 13.4545 13.6384 0 30.4702 0C47.3021 0 60.9405 13.4545 60.9405 30.0596C60.9405 37.0397 58.538 43.4563 54.4949 48.5578H56.8827C57.8202 48.5578 58.7138 48.9191 59.373 49.5694L73.9782 63.9777C75.3406 65.3362 75.3406 67.5329 73.9782 68.8913ZM50.3931 30.0596C50.3931 19.1919 41.4864 10.4052 30.4702 10.4052C19.4541 10.4052 10.5474 19.1919 10.5474 30.0596C10.5474 40.9273 19.4541 49.7139 30.4702 49.7139C41.4864 49.7139 50.3931 40.9273 50.3931 30.0596Z" fill="white" fill-opacity="0.66" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="list-info">
                            <h5 class="title mb-0"><a href="car-details.html" class="">โรตีไข่</a></h5>
                            <p>โรตีไข่ ราดด้วยนมข้นหวานรับประกัน ความอร่อย กรอบ ฉ่ำ</p>
                            <span class="badge m-b30">20-.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="content-inner">
        <div class="container">
            <div class="section-head space-lg">
                <h2 class="title m-b20">รายละเอียดร้านค้า</h2>
            </div>
            <div>
            “ร้านโรตีสันติ โรตีทอด เกี๋ยวซ่าทอด” โรตีทอด เกี๋ยวซ่าทอด แห่งกาดนัดหลัง Big C Extra ไส้ไข่เค็มลาวาเยิ้ม รับประกันความอร่อย กรอบ ฉ่ำ เปิดทุกวัน พฤหัส ศุกร์ เสาร์เวลา 14:00-21:00 น.
            <br> <br>
            ที่ตั้ง : ถนนอนุสาวรีย์พระนครศรีบริรักษ์ ริมบึงแก่นนคร อ.เมือง จ.ขอนแก่น
            <br>
            เวลาเปิด : พฤหัส ศุกร์ เสาร์ 14:00-21:00 น.
            <br>
            ติดต่อ : -
            </div>
        </div>
    </section>


    <section class="content-inner">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 ">
                    <div class="section-head" style="margin-bottom: 60px">
                        <h2 class="title" style="font-size: 48px;font-weight: 600;">เขียนรีวิว</h2>
                        <p style="font-size: 18px; font-weight: 400;">บอกให้เรารู้เกี่ยวกับสิ่งประสบการณ์ที่คุณได้รับเพื่อให้เราสามารถปรับปรุงสิ่งที่เราแสดงได้
                        </p>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div id="reviews" class="tab-pane">
                        <ol class="commentlist">
                            <li class="comment">
                                <div class="comment_container">
                                    <div class="comment-text" style="padding-left: 0;">
                                        <div class="star-rating">
                                            <div data-rating="2">
                                                <i class="fa fa-star text-yellow" data-alt="1" title="regular"></i>
                                                <i class="fa fa-star text-yellow" data-alt="2" title="regular"></i>
                                                <i class="far fa-star text-yellow" data-alt="3" title="regular"></i>
                                                <i class="far fa-star text-yellow" data-alt="4" title="regular"></i>
                                                <i class="far fa-star text-yellow" data-alt="5" title="regular"></i>
                                            </div>
                                        </div>
                                        <p class="meta">
                                            <strong class="author">Cobus Bester</strong>
                                            <span><i class="fa fa-clock-o"></i> March 7, 2013</span>
                                        </p>
                                        <div class="description">
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                                                industry. Lorem Ipsum has been the industry's standard dummy
                                                text ever since the 1500s, when an unknown printer took a galley
                                                of type and scrambled it to make a type specimen book.</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="comment">
                                <div class="comment_container">
                                    <div class="comment-text" style="padding-left: 0;">
                                        <div class="star-rating">
                                            <div data-rating="4">
                                                <i class="fa fa-star text-yellow" data-alt="1" title="regular"></i>
                                                <i class="fa fa-star text-yellow" data-alt="2" title="regular"></i>
                                                <i class="fa fa-star text-yellow" data-alt="3" title="regular"></i>
                                                <i class="fa fa-star text-yellow" data-alt="4" title="regular"></i>
                                                <i class="far fa-star text-yellow" data-alt="5" title="regular"></i>
                                            </div>
                                        </div>
                                        <p class="meta">
                                            <strong class="author">Emilia Johnson</strong>
                                            <span><i class="fa fa-clock-o"></i> March 7, 2013</span>
                                        </p>
                                        <div class="description">
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                                                industry. Lorem Ipsum has been the industry's standard dummy
                                                text ever since the 1500s, when an unknown printer took a galley
                                                of type and scrambled it to make a type specimen book.</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="comment">
                                <div class="comment_container">
                                    <div class="comment-text" style="padding-left: 0;">
                                        <div class="star-rating">
                                            <div data-rating="3">
                                                <i class="fa fa-star text-yellow" data-alt="1" title="regular"></i>
                                                <i class="fa fa-star text-yellow" data-alt="2" title="regular"></i>
                                                <i class="fa fa-star text-yellow" data-alt="3" title="regular"></i>
                                                <i class="far fa-star text-yellow" data-alt="4" title="regular"></i>
                                                <i class="far fa-star text-yellow" data-alt="5" title="regular"></i>
                                            </div>
                                        </div>
                                        <p class="meta">
                                            <strong class="author">Mark Steven</strong>
                                            <span><i class="fa fa-clock-o"></i> March 7, 2013</span>
                                        </p>
                                        <div class="description">
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                                                industry. Lorem Ipsum has been the industry's standard dummy
                                                text ever since the 1500s, when an unknown printer took a galley
                                                of type and scrambled it to make a type specimen book.</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="comment">
                                <div class="comment_container">
                                    <div class="comment-text" style="padding-left: 0;">
                                        <div class="star-rating">
                                            <div data-rating="5">
                                                <i class="fa fa-star text-yellow" data-alt="1" title="regular"></i>
                                                <i class="fa fa-star text-yellow" data-alt="2" title="regular"></i>
                                                <i class="fa fa-star text-yellow" data-alt="3" title="regular"></i>
                                                <i class="fa fa-star text-yellow" data-alt="4" title="regular"></i>
                                                <i class="fa fa-star text-yellow" data-alt="5" title="regular"></i>
                                            </div>
                                        </div>
                                        <p class="meta">
                                            <strong class="author">Cobus Bester</strong>
                                            <span><i class="fa fa-clock-o"></i> March 7, 2013</span>
                                        </p>
                                        <div class="description">
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                                                industry. Lorem Ipsum has been the industry's standard dummy
                                                text ever since the 1500s, when an unknown printer took a galley
                                                of type and scrambled it to make a type specimen book.</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ol>
                    </div>
                    <nav aria-label="Blog Pagination">
                        <ul class="pagination text-center m-b30 m-t50">
                            <li class="page-item"><a class="page-link prev" href="javascript:void(0);"><i class="la la-angle-left"></i></a></li>
                            <li class="page-item"><a class="page-link active" href="javascript:void(0);">1</a></li>
                            <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a>
                            </li>
                            <li class="page-item"><a class="page-link next" href="javascript:void(0);"><i class="la la-angle-right"></i></a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-xl-6">
                    <div class="contact-area1 m-b30">
                        <div class="rating-info" style="justify-content: center">
                            <div class="total-rating" style="display: flex; flex-direction: column; justify-content: center; margin-right: 0">
                                <div style="display: flex; justify-content: center; align-items: center;">
                                    <span class="rate m-r10" style="font-size: 48px; font-weight: 700">4.2</span>
                                    <span style="font-size: 18px; font-weight: 400; margin-bottom: -18px">(10 รีวิว)</span>
                                </div>
                                <div class="star-rating m-b10" style="font-size: 27px">
                                    <div data-rating="3">
                                        <i class="fa fa-star text-yellow" data-alt="1" title="regular"></i>
                                        <i class="fa fa-star text-yellow" data-alt="2" title="regular"></i>
                                        <i class="fa fa-star text-yellow" data-alt="3" title="regular"></i>
                                        <i class="far fa-star text-yellow" data-alt="4" title="regular"></i>
                                        <i class="far fa-star text-yellow" data-alt="5" title="regular"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="rating-info">
                            <ul class="rating-body">
                                <li class="rating-bar">
                                    <div class="rating-left">
                                        <span> 5 <i class="fa fa-star"></i></span>
                                    </div>
                                    <div class="rating-body">
                                        <div class="progress ">
                                            <div class="progress-bar bg-success" role="progressbar" style="width:90%"></div>
                                        </div>
                                    </div>
                                </li>
                                <li class="rating-bar">
                                    <div class="rating-left">
                                        <span> 4 <i class="fa fa-star"></i></span>
                                    </div>
                                    <div class="rating-body">
                                        <div class="progress ">
                                            <div class="progress-bar bg-success" role="progressbar" style="width:75%"></div>
                                        </div>
                                    </div>
                                </li>
                                <li class="rating-bar">
                                    <div class="rating-left">
                                        <span> 3 <i class="fa fa-star"></i></span>
                                    </div>
                                    <div class="rating-body">
                                        <div class="progress ">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width:30%"></div>
                                        </div>
                                    </div>
                                </li>
                                <li class="rating-bar">
                                    <div class="rating-left">
                                        <span> 2 <i class="fa fa-star"></i></span>
                                    </div>
                                    <div class="rating-body">
                                        <div class="progress ">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width:20%"></div>
                                        </div>
                                    </div>
                                </li>
                                <li class="rating-bar">
                                    <div class="rating-left">
                                        <span> 1 <i class="fa fa-star"></i></span>
                                    </div>
                                    <div class="rating-body">
                                        <div class="progress ">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width:10%"></div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="contact-area1">
                        <form>
                            <div class="row sp10">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="m-b10 font-weight-600">ชื่อที่ต้องการแสดง</label>
                                        <input type="text" placeholder="กรุณากรอกชื่อที่ต้องการแสดง" class="form-control input-review" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="m-b10 font-weight-600">คะแนนโดยรวม</label>

                                        <div class="input-star-rating star-rating m-b10">
                                            <div data-rating="3">
                                                <i class="fa fa-star text-yellow" data-alt="1" title="regular"></i>
                                                <i class="fa fa-star text-yellow" data-alt="2" title="regular"></i>
                                                <i class="fa fa-star text-yellow" data-alt="3" title="regular"></i>
                                                <i class="far fa-star text-yellow" data-alt="4" title="regular"></i>
                                                <i class="far fa-star text-yellow" data-alt="5" title="regular"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="m-b10 font-weight-600">ความคิดเห็นของคุณ</label>
                                        <textarea placeholder="กรุณากรอกความคิดเห็นของคุณ" class="form-control input-review"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="text-center">
                                        <button class="btn btn-primary d-block w-100" type="button">ส่งรีวิว</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>


@endsection

@section('script')
@endsection
