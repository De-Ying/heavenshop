@extends('admin_layout')
@section('title', 'Cửa hàng bán quần áo thời trang Heaven | Liệt kê ảnh bìa')

@push('css')
    <style>
        .select2-container--default .select2-selection--single {
            border-bottom: 1px solid #aaa;
            border-top: unset;
            border-left: unset;
            border-right: unset;
        }
    </style>
@endpush

@section('admin_content')
    @include('admin.theme.sidebar.slider')

    {!! Toastr::message() !!}

    <div id="main">
        <div class="row">
            <div id="breadcrumbs-wrapper" data-image="{!! asset('public/backend/app-assets/images/gallery/breadcrumb-bg.jpg') !!}">
                <div class="container">
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <h5 class="mt-0 mb-0 breadcrumbs-title">
                                <span>Slider</span>
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
                                    Liệt kê ảnh bìa
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
                                            <a href="{{ route('slider.view_insert') }}"
                                            class="form-control btn btn-mat btn-info m-l-5"><i
                                                class="fa fa-plus-square"></i> Thêm</a>
                                        </h4>

                                        <div class="row">
                                            <div class="col s12">
                                                <table id="page-length-option" class="display">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Ảnh bìa</th>
                                                            <th>Tên bìa</th>
                                                            <th>Mô tả</th>
                                                            <th>Loại</th>
                                                            <th>Trạng thái</th>
                                                            <th style="width: 160px;">Hành động</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $stt = 1;
                                                        @endphp
                                                        @foreach ($sliders as $slider)
                                                            <tr>
                                                                <td class="pro-list-img">
                                                                    {{ $stt++ }}
                                                                </td>
                                                                <td class="pro-name">
                                                                    <span><img
                                                                            src="{{ URL::to('public/uploads/slider/' . $slider->slider_image) }}"
                                                                            height="70" width="115"
                                                                            alt="{{ $slider->slider_name }}" /></span>
                                                                </td>
                                                                <td>
                                                                    <span>{{ $slider->slider_name }}</span>
                                                                </td>
                                                                <td>
                                                                    <span>{!! $slider->slider_description !!}</span>
                                                                </td>
                                                                <td>
                                                                    @if($slider->slider_type == 1)
                                                                        <span>Slide</span>
                                                                    @elseif ($slider->slider_type == 2)
                                                                        <span>Banner</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <?php if ($slider->slider_status == 1) { ?>
                                                                        <a href="{{ route('slider.unactive_slider', ['slider_id' => $slider->slider_id]) }}" class="green-text">
                                                                            <span class="chip green lighten-5">
                                                                                Hiện
                                                                            </span>
                                                                        </a>
                                                                    <?php } else { ?>
                                                                        <a href="{{ route('slider.active_slider', ['slider_id' => $slider->slider_id]) }}" class="orange-text">
                                                                            <span class="chip orange lighten-5">
                                                                                Ẩn
                                                                            </span>
                                                                        </a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td class="action-icon">
                                                                    @if ($slider->slider_status == 1)
                                                                        <a href="{!! route('slider.view_update', ['slider_id' => $slider->slider_id]) !!}" class="m-r-5 btn btn-grd-primary btn-sm"><i
                                                                                class="fa fa-edit fa-fw"></i></a>
                                                                    @endif
                                                                    <form style="display: inline-block;">
                                                                        @csrf
                                                                        <button type="button"
                                                                            class="btn btn-grd-danger btn-sm"
                                                                            style="outline: none"
                                                                            onclick="deleteSlider({{ $slider->slider_id }})"><i
                                                                                class="fa fa-trash-o fa-fw"></i></button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Ảnh bìa</th>
                                                            <th>Tên bìa</th>
                                                            <th>Mô tả</th>
                                                            <th>Loại</th>
                                                            <th>Trạng thái</th>
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

    <!-- Xóa slider -->
    <script>
        function deleteSlider(slider_id) {
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
                    url: '{{ route('slider.delete') }}',
                    method: 'POST',
                    data: {
                        slider_id: slider_id,
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
