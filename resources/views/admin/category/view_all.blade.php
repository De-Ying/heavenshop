@extends('admin_layout')
@section('title', 'Cửa hàng bán quần áo thời trang Heaven | Liệt kê danh mục')

@section('admin_content')
    @include('admin.theme.sidebar.category')

    {!! Toastr::message() !!}

    <div id="main">
        <div class="row">
            <div id="breadcrumbs-wrapper" data-image="{!! asset('public/backend/app-assets/images/gallery/breadcrumb-bg.jpg') !!}">
                <div class="container">
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <h5 class="mt-0 mb-0 breadcrumbs-title">
                                <span>Danh mục</span>
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
                                    Liệt kê danh mục
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
                                            <a href="{{ route('category.view_insert') }}"
                                            class="form-control btn btn-mat btn-info m-l-5"><i
                                                class="fa fa-plus-square"></i> Thêm</a>
                                        </h4>
                                        <div class="row">
                                            <div class="col s12">
                                                <table id="page-length-option" class="display">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Tên danh mục</th>
                                                            <th>Slug</th>
                                                            <th>Thuộc danh mục</th>
                                                            <th>Hiển thị</th>
                                                            <th style="width: 160px;">Hành động</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $stt = 1;
                                                        @endphp
                                                        @foreach ($category as $cate)
                                                            <tr>
                                                                <td class="pro-list-img">
                                                                    {{ $stt++ }}
                                                                </td>
                                                                <td class="pro-name">
                                                                    <span>{{ $cate->category_name }}</span>
                                                                </td>
                                                                <td>
                                                                    <span>{{ $cate->category_slug }}</span>
                                                                </td>
                                                                <td>
                                                                    @if ($cate->category_parent == 0)
                                                                        <span style="color:red;">Danh mục cha</span>
                                                                    @else
                                                                        @foreach ($subcategory as $sub)
                                                                            @if ($sub->category_id == $cate->category_parent)
                                                                                <span
                                                                                    style="color:green;">{{ $sub->category_name }}</span>
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <?php if ($cate->category_status == 1) { ?>
                                                                        <a href="{{ route('category.unactive_category_product', ['category_id' => $cate->category_id]) }}" class="green-text">
                                                                            <span class="chip green lighten-5">
                                                                                Hiện
                                                                            </span>
                                                                        </a>
                                                                    <?php } else { ?>
                                                                        <a href="{{ route('category.active_category_product', ['category_id' => $cate->category_id]) }}" class="orange-text">
                                                                            <span class="chip orange lighten-5">
                                                                                Ẩn
                                                                            </span>
                                                                        </a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td class="action-icon">
                                                                    @if ($cate->category_status == 1)
                                                                        <a href="{!! route('category.view_update', ['category_id' => $cate->category_id]) !!}"
                                                                            class="m-r-5 btn btn-grd-primary btn-sm"><i
                                                                                class="fa fa-edit fa-fw"></i></a>
                                                                    @endif
                                                                    <form style="display: inline-block;">
                                                                        @csrf
                                                                        <button type="button"
                                                                            class="btn btn-grd-danger btn-sm"
                                                                            style="outline: none"
                                                                            onclick="deleteCategory({{ $cate->category_id }})"><i
                                                                                class="fa fa-trash-o fa-fw"></i></button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Tên danh mục</th>
                                                            <th>Slug</th>
                                                            <th>Thuộc danh mục</th>
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
                    {{-- <div style="bottom: 50px; right: 19px;" class="fixed-action-btn direction-top"><a
                            class="btn-floating btn-large gradient-45deg-light-blue-cyan gradient-shadow"><i
                                class="material-icons">add</i></a>
                        <ul>
                            <li><a href="css-helpers.html" class="btn-floating blue"><i
                                        class="material-icons">help_outline</i></a></li>
                            <li><a href="cards-extended.html" class="btn-floating green"><i
                                        class="material-icons">widgets</i></a></li>
                            <li><a href="app-calendar.html" class="btn-floating amber"><i
                                        class="material-icons">today</i></a></li>
                            <li><a href="app-email.html" class="btn-floating red"><i
                                        class="material-icons">mail_outline</i></a></li>
                        </ul>
                    </div> --}}
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

    <!-- Xóa danh mục -->
    <script>
        function deleteCategory(category_id) {
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
                    url: '{{ route('category.delete') }}',
                    method: 'POST',
                    data: {
                        category_id: category_id,
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
