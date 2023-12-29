@extends('layout')

@push('css')
    <style>
        p {
            font-size: 1.4rem;
        }
    </style>
@endpush

@section('main')
    <section class="bg-img1 txt-center p-lr-15 p-tb-92"
        style="background-image: url('http://heavenshop.vn/public/frontend/images/bg-02.jpg');">
        <h2 class="ltext-105 cl0 txt-center">
            {{ $category_post_name }}
        </h2>
    </section>

    <section class="bg0 p-t-62 p-b-60">
        <div class="container">
            <div class="row">
                <div class="m-12 col l-9 c-12 p-b-20">
                    <div class="p-r-45 p-r-0-lg">

                        @foreach ($posts as $post)
                            <div class="p-b-63">
                                <a href="{{ route('blog_detail', ['post_slug' => $post->post_slug]) }}" class="hov-img0 how-pos5-parent">
                                    <img src="{{ asset('public/uploads/blog/'.$post->post_image) }}" alt="IMG-BLOG">

                                    <div class="flex-col-c-m size-123 bg9 how-pos5">
                                        <span class="ltext-107 cl2 txt-center">
                                            {{ date('d', strtotime($post->post_date)) }}
                                        </span>

                                        <span class="stext-109 cl3 txt-center">
                                            {{ date('M', strtotime($post->post_date)) }} {{ date('Y', strtotime($post->post_date)) }}
                                        </span>
                                    </div>
                                </a>

                                <div class="p-t-32">
                                    <h4 class="p-b-15">
                                        <a href="{{ route('blog_detail', ['post_slug' => $post->post_slug]) }}" class="ltext-108 cl2 hov-cl1 trans-04" style="font-family: Roboto,sans-serif; font-weight: bold;">
                                            {{ $post->post_title }}
                                        </a>
                                    </h4>

                                    <p class="stext-117 cl6">
                                        {!! $post->post_description !!}
                                    </p>

                                    <div class="flex-w flex-sb-m p-t-18">
                                        <span class="flex-w flex-m stext-111 cl2 p-r-30 m-tb-10">
                                            <span>
                                                <span class="cl4">By</span> {{ $post->post_author }}
                                                <span class="cl12 m-l-4 m-r-6">|</span>
                                            </span>

                                            <span>
                                                {{ $post->cate_post->category_post_name }}
                                                <span class="cl12 m-l-4 m-r-6">|</span>
                                            </span>

                                            <span>
                                                <i class="fa fa-eye" aria-hidden="true"></i> {{ $post->post_view }}
                                            </span>
                                        </span>

                                        <a href="{{ route('blog_detail', ['post_slug' => $post->post_slug]) }}"
                                            class="stext-101 cl2 hov-cl1 trans-04 m-tb-10">
                                            Tiếp tục đọc

                                            <i class="fa fa-long-arrow-right m-l-9"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {!! $posts->links() !!}
                    </div>
                </div>

                <div class="m-12 col l-3 c-12 p-b-80">
                    <div class="side-menu">
                        <div class="bor17 of-hidden pos-relative">
                            <form action="{{ route('blog_search') }}" method="GET">
                                <input class="stext-103 cl2 plh4 size-116 p-l-28 p-r-55" type="text" name="keyword"
                                    placeholder="Tìm kiếm">

                                <button class="flex-c-m size-122 ab-t-r fs-18 cl4 hov-cl1 trans-04">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                        </div>

                        <div class="p-t-55">
                            <h4 class="mtext-112 cl2 p-b-33" style="font-family: Roboto,sans-serif; font-weight: bold">
                                Danh mục tin tức
                            </h4>

                            <ul>
                                @foreach ($category_post as $cate_post)
                                    <li class="bor18">
                                        <a href="{{ route('blog_category', ['category_post_slug' => $cate_post->category_post_slug]) }}" class="dis-block stext-115 cl6 hov-cl1 trans-04 p-tb-8 p-lr-4">
                                            {{ $cate_post->category_post_name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        {{-- <div class="p-t-55">
                            <h4 class="mtext-112 cl2 p-b-20">
                                Archive
                            </h4>

                            <ul>
                                <li class="p-b-7">
                                    <a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">
                                        <span>
                                            July 2018
                                        </span>

                                        <span>
                                            (9)
                                        </span>
                                    </a>
                                </li>

                                <li class="p-b-7">
                                    <a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">
                                        <span>
                                            June 2018
                                        </span>

                                        <span>
                                            (39)
                                        </span>
                                    </a>
                                </li>

                                <li class="p-b-7">
                                    <a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">
                                        <span>
                                            May 2018
                                        </span>

                                        <span>
                                            (29)
                                        </span>
                                    </a>
                                </li>

                                <li class="p-b-7">
                                    <a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">
                                        <span>
                                            April 2018
                                        </span>

                                        <span>
                                            (35)
                                        </span>
                                    </a>
                                </li>

                                <li class="p-b-7">
                                    <a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">
                                        <span>
                                            March 2018
                                        </span>

                                        <span>
                                            (22)
                                        </span>
                                    </a>
                                </li>

                                <li class="p-b-7">
                                    <a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">
                                        <span>
                                            February 2018
                                        </span>

                                        <span>
                                            (32)
                                        </span>
                                    </a>
                                </li>

                                <li class="p-b-7">
                                    <a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">
                                        <span>
                                            January 2018
                                        </span>

                                        <span>
                                            (21)
                                        </span>
                                    </a>
                                </li>

                                <li class="p-b-7">
                                    <a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">
                                        <span>
                                            December 2017
                                        </span>

                                        <span>
                                            (26)
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="p-t-50">
                            <h4 class="mtext-112 cl2 p-b-27">
                                Tags
                            </h4>

                            <div class="flex-w m-r--5">
                                <a href="#"
                                    class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                    Fashion
                                </a>

                                <a href="#"
                                    class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                    Lifestyle
                                </a>

                                <a href="#"
                                    class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                    Denim
                                </a>

                                <a href="#"
                                    class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                    Streetstyle
                                </a>

                                <a href="#"
                                    class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                    Crafts
                                </a>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
