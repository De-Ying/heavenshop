@extends('layout')
@section('main')
    @push('css')
        <link rel="stylesheet" href="{!! asset('public/frontend/css/customs/profile.css') !!}">
    @endpush

    <style>
        .pagination {
            justify-content: center;
            margin: 10px;
        }
    </style>

    <div class="container">
        <div class="bread-crumb flex-w p-r-15 p-t-30 p-lr-0-lg">
            <a href="{{ route('home_page') }}" class="stext-109 cl8 hov-cl1 trans-04">
                @lang('lang.home')
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="uppercase stext-109 cl4 text-red">
                Danh sách yêu thích
            </span>
        </div>
    </div>

    <div class="bg0 m-t-30 p-b-140">
        <div class="container">

            <div class="row">
                <div class="m-12 col l-3 c-12 p-b-30">
                    <div class="row">
                        <div class="m-12 col l-12 c-12">
                            <div class="order-user">
                                @if (Session::has('customer_image'))
                                    <img class="img-radius img-40 radius-50 w-70 h-70"
                                        src="{{ url('public/uploads/customer/' . Session::get('customer_image')) }}"
                                        alt="profile-user">
                                @elseif (Session::has('customer_image_social'))
                                    <img class="img-radius img-40 radius-50"
                                        src="{{ Session::get('customer_image_social') }}" alt="profile-user">
                                @endif

                                <div class="m-t-30 m-l-50">
                                    <h5 class="m-b-5 fs-20">
                                        @if (Session::get('customer_id') != null)
                                            {{ Session::get('customer_name') }}
                                        @endif
                                    </h5>

                                    <span>
                                        <a class="text-black-36 fs-14" href="{{ route('account.profile') }}"><i
                                                class="icofont icofont-edit"></i> Sửa hồ sơ</a>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="m-12 col l-12 c-12">
                            <div class="p-t-50">
                                <div class="panel-group" id="accordian">
                                    <div class="panel panel-default">
                                        <div class="panel-heading m-b-10">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordian"
                                                    class="uppercase text-black-36 fs-14" href="#account" id="profile">
                                                    <span class="caret"></span>
                                                    <i class="icofont icofont-user-alt-2"></i> Tài khoản của tôi
                                                </a>
                                            </h4>
                                        </div>

                                        <div id="account" class="panel-collapse collapse">
                                            <div class="panel-body m-b-5 m-l-15">
                                                <ul>
                                                    <li>
                                                        <a class="text-black-36 account-link fs-14"
                                                            href="{{ route('account.profile') }}">Hồ sơ</a>
                                                    </li>
                                                    <li>
                                                        <a class="text-black-36 account-link fs-14"
                                                            href="{{ route('account.password') }}">Đổi mật khẩu</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel-group" id="accordian">
                                    <div class="panel panel-default">
                                        <div class="panel-heading m-b-10">
                                            <h4 class="panel-title">
                                                <a class="uppercase text-black-36 order-link fs-14"
                                                    href="{{ route('purchase') }}"><i class="zmdi zmdi-assignment"></i>
                                                    Lịch sử
                                                    mua hàng</a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel-group" id="accordian">
                                    <div class="panel panel-default">
                                        <div class="panel-heading m-b-10">
                                            <h4 class="panel-title">
                                                <a class="uppercase text-black-36 wishlist-link fs-14"
                                                    href="{{ route('wishlist') }}"><i class="fa fa-heart-o"
                                                        aria-hidden="true"></i> Danh sách yêu thích</a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel-group" id="accordian">
                                    <div class="panel panel-default">
                                        <div class="panel-heading m-b-10">
                                            <h4 class="panel-title">
                                                <a class="uppercase text-black-36 order-link fs-14"
                                                    href="{{ route('buyer.logout') }}"><i
                                                        class="icofont icofont-logout"></i> Đăng
                                                    xuất</a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="m-12 col l-9 c-12 p-b-20">
                    <h5 class="fs-16">Danh sách sản phẩm yêu thích</h5>

                    {{-- <div class="data_table_main table-responsive dt-responsive">
                        <div class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                @if ($wishlists->count() > 0)
                                    @foreach ($wishlists as $wishlist)

                                    <div class="card" style="width:20rem; margin: 20px 16px 0 16px">
                                        <img class="card-img-top m-t-15 m-b-5" src="{{ url('public/uploads/product/'.$wishlist->product->product_image) }}" alt="image" style="width:100%">
                                        <div class="card-body">
                                        <h4 class="card-title">{{ $wishlist->product->product_name }}</h4>
                                        <p class="card-text">Some example text some example text. John Doe is an architect and engineer</p>
                                        <a href="{{ route('product_detail', ['product_slug' => $wishlist->product->product_slug]) }}" class="btn btn-primary">Xem chi tiết</a>

                                        <form style="display: inline-block;">
                                            @csrf
                                            <button type="button"
                                                class="btn btn-danger"
                                                style="outline: none" data-toggle="tooltip"
                                                data-placement="top"
                                                data-original-title="Delete"
                                                onclick="deleteWishlist({{ $wishlist->wishlist_id }})">Xóa</button>
                                        </form>
                                        </div>
                                    </div>
                                    @endforeach
                                @else
                                    <div class="text-center col-sm-12 m-tb-200">
                                        <img class="wishlist_img" width="200px" height="150px"
                                            src="{{ url('public/frontend/images/icons/wishlist.jpg') }}"
                                            alt="#">
                                        <p class="text-black m-t-5 fs-16">Sản phẩm yêu thích đang trống</p>
                                    </div>
                                @endif
                            </div>

                            <div class="row">
                                <div class="l-12">
                                    {{ $wishlists->links() }}
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <div class="row p-t-30">
                        @if ($wishlists->count() > 0)
                            @foreach ($wishlists as $wishlist)
                                <div class="m-6 col l-2-4 lg-4 c-12 p-b-35 p-tb-8">
                                    <img class="m-t-15 m-b-5" src="{{ url('public/uploads/product/'.$wishlist->product->product_image) }}" alt="image" style="width:100%">
                                    <div class="card-body">
                                        <h4 class="card-title">{{ $wishlist->product->product_name }}</h4>
                                        <p class="card-text fs-12">{!! $wishlist->product->product_content !!}</p>
                                        <a href="{{ route('product_detail', ['product_slug' => $wishlist->product->product_slug]) }}" class="btn btn-primary fs-14">Xem chi tiết</a>

                                        <form style="display: inline-block;">
                                            @csrf
                                            <button type="button"
                                                class="btn btn-danger fs-14"
                                                style="outline: none" data-toggle="tooltip"
                                                data-placement="top"
                                                data-original-title="Delete"
                                                onclick="deleteWishlist({{ $wishlist->wishlist_id }})">Xóa</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        @else
                        <div class="text-center col-sm-12 m-tb-200">
                            <img class="wishlist_img" width="200px" height="150px"
                                src="{{ url('public/frontend/images/icons/wishlist.jpg') }}"
                                alt="#">
                            <p class="text-black m-t-5 fs-16">Sản phẩm yêu thích đang trống</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')

    <script type="text/javascript">
        const currentLocationWishlist = location.href;
        const filterWishlist = document.querySelectorAll('.wishlist-link');
        const filterLengthWishlist = filterWishlist.length;
        for (let i = 0; i < filterLengthWishlist; i++) {
            if (filterWishlist[i].href === currentLocationWishlist) {
                filterWishlist[i].className = "wishlist-link-active";
            }
        }
    </script>

    <script>
        function deleteWishlist(wishlist_id) {
            var _token = $('input[name="_token"]').val();

            swal({
                title: "Bạn có chắc xóa không?",
                text: "Bạn sẽ không thể khôi phục lại tệp này!",
                type: "warning",
                showCancelButton: true,
                cancelButtonText: "Huỷ",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Vâng, xóa nó!",
                closeOnConfirm: false
            }, function(isConfirm) {
                if (!isConfirm) return;
                $.ajax({
                    url: '{{ route('wishlist.deleteWishlist') }}',
                    method: 'POST',
                    data: {
                        wishlist_id: wishlist_id,
                        _token: _token
                    },
                    dataType: "html",
                    success: function() {
                        setTimeout(function() {
                            location.reload();
                        }, 1000)
                    },
                });
            });
        }
    </script>

@endpush
