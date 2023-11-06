@extends('frontend.home')

@section('style')
    <style>
    </style>
@endsection


@section('content')
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

                            @foreach ($review as $item)
                                <li class="comment">
                                    <div class="comment_container">
                                        <div class="comment-text" style="padding-left: 0;">
                                            <div class="star-rating">
                                                <div data-rating="2">
                                                    <i class="fa fa-star text-yellow" data-alt="1"
                                                        title="regular"></i>
                                                    <i class="fa fa-star text-yellow" data-alt="2"
                                                        title="regular"></i>
                                                    <i class="far fa-star text-yellow" data-alt="3"
                                                        title="regular"></i>
                                                    <i class="far fa-star text-yellow" data-alt="4"
                                                        title="regular"></i>
                                                    <i class="far fa-star text-yellow" data-alt="5"
                                                        title="regular"></i>
                                                </div>
                                            </div>
                                            <p class="meta">
                                                <strong class="author">{{$item->name}}</strong>
                                                <span><i class="fa fa-clock-o"></i> {{$item->created_at}}</span>
                                            </p>
                                            <div class="description">
                                                <p>{{$item->comment}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach

                            {{-- <li class="comment">
                                <div class="comment_container">
                                    <div class="comment-text" style="padding-left: 0;">
                                        <div class="star-rating">
                                            <div data-rating="4">
                                                <i class="fa fa-star text-yellow" data-alt="1"
                                                    title="regular"></i>
                                                <i class="fa fa-star text-yellow" data-alt="2"
                                                    title="regular"></i>
                                                <i class="fa fa-star text-yellow" data-alt="3"
                                                    title="regular"></i>
                                                <i class="fa fa-star text-yellow" data-alt="4"
                                                    title="regular"></i>
                                                <i class="far fa-star text-yellow" data-alt="5"
                                                    title="regular"></i>
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
                                                <i class="fa fa-star text-yellow" data-alt="1"
                                                    title="regular"></i>
                                                <i class="fa fa-star text-yellow" data-alt="2"
                                                    title="regular"></i>
                                                <i class="fa fa-star text-yellow" data-alt="3"
                                                    title="regular"></i>
                                                <i class="far fa-star text-yellow" data-alt="4"
                                                    title="regular"></i>
                                                <i class="far fa-star text-yellow" data-alt="5"
                                                    title="regular"></i>
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
                            </li> --}}
                        </ol>
                    </div>
                    {{ $review->links('frontend.layout.pagination_custom') }}
                    {{-- <nav aria-label="Blog Pagination">
                        <ul class="pagination text-center m-b30 m-t50">
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
                    </nav> --}}
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
                                        <i class="far fa-star text-yellow" data-alt="4"
                                            title="regular"></i>
                                        <i class="far fa-star text-yellow" data-alt="5"
                                            title="regular"></i>
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
                                            <div class="progress-bar bg-success" role="progressbar"
                                                style="width:90%"></div>
                                        </div>
                                    </div>
                                </li>
                                <li class="rating-bar">
                                    <div class="rating-left">
                                        <span> 4 <i class="fa fa-star"></i></span>
                                    </div>
                                    <div class="rating-body">
                                        <div class="progress ">
                                            <div class="progress-bar bg-success" role="progressbar"
                                                style="width:75%"></div>
                                        </div>
                                    </div>
                                </li>
                                <li class="rating-bar">
                                    <div class="rating-left">
                                        <span> 3 <i class="fa fa-star"></i></span>
                                    </div>
                                    <div class="rating-body">
                                        <div class="progress ">
                                            <div class="progress-bar bg-warning" role="progressbar"
                                                style="width:30%"></div>
                                        </div>
                                    </div>
                                </li>
                                <li class="rating-bar">
                                    <div class="rating-left">
                                        <span> 2 <i class="fa fa-star"></i></span>
                                    </div>
                                    <div class="rating-body">
                                        <div class="progress ">
                                            <div class="progress-bar bg-danger" role="progressbar"
                                                style="width:20%"></div>
                                        </div>
                                    </div>
                                </li>
                                <li class="rating-bar">
                                    <div class="rating-left">
                                        <span> 1 <i class="fa fa-star"></i></span>
                                    </div>
                                    <div class="rating-body">
                                        <div class="progress ">
                                            <div class="progress-bar bg-danger" role="progressbar"
                                                style="width:10%"></div>
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
                                        <input type="text" placeholder="กรุณากรอกชื่อที่ต้องการแสดง"
                                            class="form-control input-review" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="m-b10 font-weight-600">คะแนนโดยรวม</label>

                                        <div class="input-star-rating star-rating m-b10">
                                            <div data-rating="3">
                                                <i class="fa fa-star text-yellow" data-alt="1"
                                                    title="regular"></i>
                                                <i class="fa fa-star text-yellow" data-alt="2"
                                                    title="regular"></i>
                                                <i class="fa fa-star text-yellow" data-alt="3"
                                                    title="regular"></i>
                                                <i class="far fa-star text-yellow" data-alt="4"
                                                    title="regular"></i>
                                                <i class="far fa-star text-yellow" data-alt="5"
                                                    title="regular"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="m-b10 font-weight-600">ความคิดเห็นของคุณ</label>
                                        <textarea
                                            placeholder="กรุณากรอกความคิดเห็นของคุณ"
                                            class="form-control input-review"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="text-center">
                                        <button class="btn btn-primary d-block w-100"
                                            type="button">ส่งรีวิว</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
@endsection
