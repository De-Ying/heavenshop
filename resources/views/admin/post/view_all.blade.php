@extends('admin_layout')
@section('title', 'Cửa hàng bán quần áo thời trang Heaven | Liệt kê bài viết')

@section('admin_content')
    @include('admin.theme.sidebar.posts')

    {!! Toastr::message() !!}

    <div id="main">
        <div class="row">
            <div id="breadcrumbs-wrapper" data-image="{!! asset('public/backend/app-assets/images/gallery/breadcrumb-bg.jpg') !!}">
                <div class="container">
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <h5 class="mt-0 mb-0 breadcrumbs-title">
                                <span>Bài viết</span>
                            </h5>
                        </div>
                        <div class="col s12 m6 l6 right-align-md">
                            <ol class="mb-0 breadcrumbs">
                                <li class="breadcrumb-item">
                                    <a href="{!! route('dashboard') !!}">
                                        <i class="fa fa-home"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Liệt kê bài viết
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col s12">
                <div class="container">
                    <div class="section section-data-tables">
                        <div class="row">
                            <div class="col s12">
                                <div class="card">
                                    <div class="card-content">
                                        <h4 class="card-title m-b-20">
                                            <a href="{{ route('posts.insert_post') }}"
                                            class="form-control btn btn-mat btn-info m-l-5"><i
                                                class="fa fa-plus-square"></i> Thêm</a>
                                        </h4>
                                        <div class="row">
                                            <div class="col s12">
                                                <table id="page-length-option" class="display">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Hình ảnh</th>
                                                            <th>Danh mục bài viết</th>
                                                            <th>Người đăng</th>
                                                            <th>Ngày đăng</th>
                                                            <th>Hiển thị</th>
                                                            <th style="width: 160px;">Hành động</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $stt = 1;
                                                        @endphp
                                                        @foreach ($posts as $post)
                                                            <tr>
                                                                <td class="pro-list-img">
                                                                    {{ $stt++ }}
                                                                </td>
                                                                <td>
                                                                    <img src="{{ URL::to('public/uploads/blog/' . $post->post_image) }}"
                                                                    height="80" width="120"
                                                                    alt="{{ $post->post_title }}" />
                                                                </td>
                                                                <td>
                                                                    {{ $post->cate_post->category_post_name }}
                                                                </td>
                                                                <td>
                                                                    {{ $post->post_author }}
                                                                </td>
                                                                <td>
                                                                    {{ $post->post_date }}
                                                                </td>
                                                                <td>
                                                                    <?php if ($post->post_status == 1) { ?>
                                                                        <a href="{{ route('posts.unactive_post', ['post_id' => $post->post_id]) }}" class="green-text">
                                                                            <span class="chip green lighten-5">
                                                                                Hiện
                                                                            </span>
                                                                        </a>
                                                                    <?php } else { ?>
                                                                        <a href="{{ route('posts.active_post', ['post_id' => $post->post_id]) }}" class="orange-text">
                                                                            <span class="chip orange lighten-5">
                                                                                Ẩn
                                                                            </span>
                                                                        </a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td class="action-icon">
                                                                    @if ($post->post_status == 1)
                                                                        <a href="{{ route('posts.update_post', ['post_id' => $post->post_id]) }}"
                                                                            class="m-r-5 btn btn-grd-primary btn-sm"><i
                                                                                class="fa fa-edit fa-fw"></i></a>
                                                                    @endif
                                                                    <form style="display: inline-block;">
                                                                        @csrf
                                                                        <button type="button"
                                                                            class="btn btn-grd-danger btn-sm"
                                                                            style="outline: none"
                                                                            onclick="deletePost({{ $post->post_id }})"><i
                                                                                class="fa fa-trash-o fa-fw"></i></button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Hình ảnh</th>
                                                            <th>Danh mục bài viết</th>
                                                            <th>Người đăng</th>
                                                            <th>Ngày đăng</th>
                                                            <th>Hiển thị</th>
                                                            <th style="width: 160px;">Hành động</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- START RIGHT SIDEBAR NAV -->

                   {{-- @include('admin.theme.rightsidebar') --}}
                    <!-- END RIGHT SIDEBAR NAV -->
                    {{-- @include('admin.theme.bottomsidebar') --}}
                </div>
                <div class="content-overlay"></div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')

    <script type="text/javascript" src="{!! asset('public/backend/app-assets/js/jquery.min.js') !!}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#page-length-option').DataTable({
                "processing": true,
                "oLanguage": {
                    "sSearch": '<span class="fs-14">Tỉm kiếm: </span> ',
                    "sZeroRecords": "Không có dữ liệu nào trong bảng",
                    "sLengthMenu": '<span class="fs-14">Hiển thị</span> <select style="display: none">' +
                        '<option value="10">10</option>' +
                        '<option value="20">20</option>' +
                        '<option value="30">30</option>' +
                        '<option value="40">40</option>' +
                        '<option value="50">50</option>' +
                        '<option value="-1">Tất cả</option>' +
                        '</select> <span class="fs-14">bản ghi</span>',
                    "sInfo": "Hiển thị _START_ đến _END_ trong tổng số bản ghi là _TOTAL_",
                    "sProcessing": 'Loading <i class="fa fa-spinner" style="transition: 2s;"></i>',
                    "oPaginate": {
                        "sNext": "Trang sau",
                        "sPrevious": "Trang trước",
                    }
                },
            });
        });
    </script>

    <!-- Xóa bài viết -->
    <script>
        function deletePost(post_id) {
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
                    url: '{{ route('posts.delete_post') }}',
                    method: 'POST',
                    data: {
                        post_id: post_id,
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
