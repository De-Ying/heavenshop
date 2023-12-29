@extends('admin_layout')
@section('title', 'Cửa hàng bán quần áo thời trang Heaven | Thên thư viện ảnh')

@section('admin_content')
    @include('admin.theme.sidebar.product')

    {!! Toastr::message() !!}

    <div id="main">
        <div class="row">
            <div id="breadcrumbs-wrapper" data-image="{!! asset('public/backend/app-assets/images/gallery/breadcrumb-bg.jpg') !!}">
                <div class="container">
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <h5 class="mt-0 mb-0 breadcrumbs-title">
                                <span>Thư viện ảnh</span>
                            </h5>
                        </div>
                        <div class="col s12 m6 l6 right-align-md">
                            <ol class="mb-0 breadcrumbs">
                                <li class="breadcrumb-item">
                                    <a href="{!! route('dashboard') !!}">
                                        <i class="fa fa-home"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('product.view_all') }}">Liệt kê sản phẩm</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Thư viện ảnh
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col s12">
                <div class="container">
                    <div class="users-list-filter section">
                        <div class="card-panel">
                            <div class="row section">
                                <form action="{{ route('gallery.insert_gallery', ['product_id' => $product_id]) }}" method="post" id="validate_form" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col s12 m12 l12">
                                        <p>THÊM THƯ VIỆN ẢNH</p>
                                    </div>
                                    <div class="col s12 m12 l12">
                                        <input
                                        type="file"
                                        id="input-file-now"
                                        class="dropify"
                                        accept="image/*"
                                        multiple
                                        name="file[]"
                                        data-default-file=""
                                        />
                                    </div>

                                    <div class="text-center col s12 m12 l12">
                                        <button type="submit" class="btn btn-grd-info m-t-20" value="submit">THÊM</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="section section-data-tables">
                        <div class="row">
                            <div class="col s12">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="row">
                                            <div class="col s12">
                                                <table id="page-length-option" class="display">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Hình ành</th>
                                                            <th>Tên hình ảnh</th>
                                                            <th style="width: 160px;">Hành động</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $stt = 1;
                                                        @endphp
                                                        @foreach ($galleries as $gallery)
                                                            @if ($galleries->count() > 0)
                                                                <tr>
                                                                    <td class="pro-list-img">
                                                                        {{ $stt++ }}
                                                                    </td>
                                                                    <td class="flex pro-list-img flex-dr-c">
                                                                        <img src="{{ URL::to('public/uploads/gallery/' . $gallery->gallery_image) }}"
                                                                            height="120" width="120" class="img-thumbnail"
                                                                            alt="{{ $gallery->gallery_name }}" />

                                                                        <div class="file-field input-field s6" style="margin-left: unset">
                                                                            <div class="btn">
                                                                                <span>Hình ảnh</span>
                                                                                <input
                                                                                    type="file"
                                                                                    name="file"
                                                                                    id="file-{{ $gallery->gallery_id }}"
                                                                                    data-gallery_id="{{ $gallery->gallery_id }}"
                                                                                    accept="image/*"
                                                                                    rules="required"
                                                                                    class="form-control pname file-image"
                                                                                >
                                                                            </div>
                                                                            <div class="file-path-wrapper">
                                                                                <input class="file-path validate" type="text">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="pro-list-img">
                                                                        {{ $gallery->gallery_name }}
                                                                    </td>

                                                                    <td class="action-icon">
                                                                        <button type="button" class="btn btn-grd-danger btn-sm delete-gallery" data-gallary_id="{{ $gallery->gallery_id }}"><i
                                                                            class="fa fa-trash-o fa-fw"></i></button>
                                                                    </td>
                                                                </tr>
                                                            @else
                                                                <tr>
                                                                    <td>Hiện tại không có dữ liệu</td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Hình ành</th>
                                                            <th>Tên hình ảnh</th>
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

                    <!-- users list ends -->
                </div>
                <div class="content-overlay"></div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        // Hiển thị thư viện ảnh

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

             // Xóa 1 ptu thư viện ảnh
            $(document).on('click', '.delete-gallery', function(){
                var gallary_id = $(this).data('gallary_id');
                var _token = $('input[name="_token"]').val();

                swal({
                    title: "Bạn muốn xóa hình ảnh này không?",
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
                        url: '{{ route('gallery.delete_gallery') }}',
                        method: 'POST',
                        data: {
                            gallary_id: gallary_id,
                            _token: _token
                        },
                        dataType: "html",
                        success: function() {
                            setTimeout(function() {
                                swal("Hoàn tất!", "Xóa hình ảnh thành công", "success");
                                location.reload();
                            }, 1000)
                        },

                        error: function (xhr, ajaxOptions, thrownError) {
                            swal("Lỗi khi xoá!", "Vui lòng thử lại", "error");
                            location.reload();
                        }
                    });
                });
            });

            // Cập nhật 1 ptu thư viện ảnh

            $(document).on('change', '.file-image', function(){
                var gallery_id = $(this).data('gallery_id');
                var image = document.getElementById('file-'+gallery_id).files[0];

                var form_data = new FormData();

                form_data.append("file", document.getElementById('file-'+gallery_id).files[0]);
                form_data.append('gallery_id', gallery_id);

                $.ajax({
                    url: '{{ route('gallery.update_gallery') }}',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,

                    success: function () {
                        swal("Hoàn tất!", "Cập nhật hình ảnh thành công", "success");
                        location.reload();
                    },

                    error: function (xhr, ajaxOptions, thrownError) {
                        swal("Lỗi khi xoá!", "Vui lòng thử lại", "error");
                        location.reload();
                    }
                });
            });

        });
    </script>
@endpush
