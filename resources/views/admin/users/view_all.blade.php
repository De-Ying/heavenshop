@extends('admin_layout')
@section('title', 'Cửa hàng bán quần áo thời trang Heaven | Danh sách người dùng')

@section('admin_content')
    @include('admin.theme.sidebar.user.list')

    {!! Toastr::message() !!}

    <div id="main">
        <div class="row">
            <div id="breadcrumbs-wrapper" data-image="{!! asset('public/backend/app-assets/images/gallery/breadcrumb-bg.jpg') !!}">
                <div class="container">
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <h5 class="mt-0 mb-0 breadcrumbs-title">
                                <span>Người dùng</span>
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
                                    Danh sách người dùng
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
                                            <a href="{{ route('users.view_insert') }}"
                                            class="form-control btn btn-mat btn-info m-l-5"><i
                                                class="fa fa-plus-square"></i> Thêm</a>
                                        </h4>
                                        <div class="row">
                                            <div class="col s12">
                                                <table id="page-length-option" class="display">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Hình đại diện</th>
                                                            <th>Tên tài khoản</th>
                                                            <th>Họ và tên</th>
                                                            <th>Vai trò</th>
                                                            <th>Trạng thái</th>
                                                            <th>Quyền</th>
                                                            <th style="width: 160px;">Hành động</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $stt = 1;
                                                        @endphp
                                                        @foreach ($listUser as $user)
                                                            <tr>
                                                                <td class="pro-list-img">
                                                                    {{ $stt++ }}
                                                                </td>
                                                                <td class="pro-name">
                                                                    @if ($user->avatar != null)
                                                                        <img width="100px" height="100px"
                                                                            class="user-img img-radius"
                                                                            src="{!! asset('public/uploads/avatar/' . $user->avatar) !!}"
                                                                            alt="user-img">
                                                                    @else
                                                                        <img width="100px" height="100px"
                                                                            class="user-img img-radius"
                                                                            src="{!! asset('public/backend/assets/images/question.png') !!}"
                                                                            alt="user-img">
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <span>{{ $user->user_name }}</span>
                                                                </td>
                                                                <td>
                                                                    <span>{{ $user->full_name }}</span>
                                                                </td>
                                                                <td>
                                                                    <ul>
                                                                        @foreach ($role_admin as $r_a)
                                                                            @if ($user->id == $r_a->admin_id)
                                                                                <li>{{ $r_a->name }}</li>
                                                                            @endif
                                                                        @endforeach
                                                                    </ul>
                                                                </td>
                                                                <td>
                                                                    @if ($user->status == 1)
                                                                        <span class="chip green lighten-5">
                                                                            <p class="green-text">Hoạt động</p>
                                                                        </span>
                                                                    @else
                                                                        <span class="chip red lighten-5">
                                                                            <p class="red-text">Tạm khóa</p>
                                                                        </span>
                                                                    @endif

                                                                </td>
                                                                <td>
                                                                    <button type="button"
                                                                        class="m-r-5 btn btn-grd-info btn-sm modal-trigger"
                                                                        href="#modal_{{ $user->id }}"><i
                                                                            class="fa fa-eye"
                                                                            aria-hidden="true"></i></button>
                                                                </td>
                                                                <td class="action-icon">

                                                                    <a href="{!! route('users.view_role', ['id' => $user->id]) !!}"
                                                                        class="m-r-5 btn btn-grd-success btn-sm">
                                                                        <i class="fa fa-user-o"></i>
                                                                    </a>

                                                                    <a href="{!! route('users.view_update', ['id' => $user->id]) !!}"
                                                                        class="m-r-5 btn btn-grd-primary btn-sm"><i
                                                                            class="fa fa-edit fa-fw"></i></a>

                                                                    <button type="button"
                                                                    class="btn btn-grd-danger btn-sm"
                                                                    style="outline: none"
                                                                    onclick="deleteUser({{ $user->id }})"><i
                                                                        class="fa fa-trash-o fa-fw"></i></button>
                                                                </td>
                                                            </tr>

                                                            <div id="modal_{{ $user->id }}"
                                                                class="modal modal-fixed-footer">
                                                                <div class="modal-content">
                                                                    @foreach ($permission_role as $p_r)
                                                                        @if ($user->id == $p_r->admin_id)
                                                                            <div class="col s12">
                                                                                <span style="
                                                                                    display: flex;
                                                                                    padding: 5px 10px;
                                                                                    border: 1px solid #ccc;
                                                                                    margin: 0 5px 10px 5px;
                                                                                    border-radius: 3px;">
                                                                                    <i class="fa fa-tag" style="margin-top: 4px; padding-right: 10px;"></i> {{ $p_r->name }}
                                                                                </span>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <a href="#!"
                                                                        class="modal-action modal-close waves-effect waves-red btn-flat btn-grd-danger">Đóng</a>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Hình đại diện</th>
                                                            <th>Tên tài khoản</th>
                                                            <th>Họ và tên</th>
                                                            <th>Vai trò</th>
                                                            <th>Trạng thái</th>
                                                            <th>Quyền</th>
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

    <!-- Xóa danh mục -->
    <script>
        function deleteUser(id) {
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
                    url: '{{ route('users.delete') }}',
                    method: 'POST',
                    data: {
                        id: id,
                        _token: _token
                    },
                    dataType: "html",
                    success: function() {
                        swal("Hoàn tất!", "Đã xoá người dùng thành công", "success");

                        setTimeout(function() {
                            location.reload();
                        }, 1000)
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        swal("Lỗi khi xoá!", "Vui lòng thử lại", "error");

                        setTimeout(function() {
                            location.reload();
                        }, 1000)
                    }
                });
            });
        }
    </script>
@endpush
