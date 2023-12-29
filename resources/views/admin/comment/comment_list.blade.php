@extends('admin_layout')
@section('title', 'Cửa hàng bán quần áo thời trang Heaven | Danh sách bình luận')

@section('admin_content')
    @include('admin.theme.sidebar.comment')

    {!! Toastr::message() !!}

    <div id="main">
        <div class="row">
            <div id="breadcrumbs-wrapper" data-image="{!! asset('public/backend/app-assets/images/gallery/breadcrumb-bg.jpg') !!}">
                <div class="container">
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <h5 class="mt-0 mb-0 breadcrumbs-title">
                                <span>Bình luận</span>
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
                                    Danh sách bình luận
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
                                        <div class="row">
                                            <div class="col s12">
                                                <table id="page-length-option" class="display">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Tên người gửi</th>
                                                            <th>Bình luận</th>
                                                            <th>Sản phẩm</th>
                                                            <th>Ngày gửi</th>
                                                            <th>Trạng thái</th>
                                                            <th style="width: 160px;">Hành động</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $stt = 1;
                                                        @endphp
                                                        @foreach ($comments as $comment)
                                                            <tr>
                                                                <td class="pro-list-img">
                                                                    {{ $stt++ }}
                                                                </td>
                                                                <td class="pro-name">
                                                                    <span>{{ $comment->customer->customer_name }}</span>
                                                                </td>
                                                                <td>
                                                                    <span id="comment_content_{{ $comment->comment_id }}">{{ $comment->comment_content }}</span>
                                                                    @if ($comment->comment_status == 2)
                                                                        <button type="button" class="block btn btn-grd-info btn-sm m-t-5" id="show_{{ $comment->comment_id }}" onclick="setVisibility({{ $comment->comment_id }})">Hiện</button>

                                                                        <div id="comment_screen_{{ $comment->comment_id }}" style="display: none; border-bottom: 1px solid #ddd; padding-bottom: 15px; flex-direction: column;">
                                                                            <textarea rows="5" class="p-0 form-control m-t-5 reply_comment_{{ $comment->comment_id }}" style="width: 250px; height: 85px"></textarea>
                                                                            <div>
                                                                                <button class="btn btn-grd-inverse btn-sm m-t-5 reply_comment_btn" data-comment_id="{{ $comment->comment_id }}" data-comment_status="{{ $comment->comment_status }}" data-product_id="{{ $comment->product_id  }}" data-customer_id="{{ $comment->customer_id  }}" data-admin_id={{ Auth::guard('admin')->user()->id }}>Trả lời</button>
                                                                                <button type="button" class="btn btn-grd-danger btn-sm m-t-5"  onclick="hideVisibility({{ $comment->comment_id }})">Ẩn</button>
                                                                            </div>
                                                                        </div>

                                                                        <ul id="reply_{{ $comment->comment_id }}" style="display: none" class="m-t-5 m-l-5">
                                                                            <li style="color: green">{{ $comment->customer->customer_name }}: {{ $comment->comment_content }}</li>
                                                                            @foreach ($comment_reps as $comment_rep)
                                                                                @if($comment_rep->parent_id == $comment->comment_id)
                                                                                    <li style="color: red">@ {{ $comment_rep->admin->user_name }}: {{ $comment_rep->comment_content }}</li>
                                                                                @endif
                                                                            @endforeach
                                                                        </ul>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <span><a href="{{ route('product_detail', ['product_slug' => $comment->product->product_slug]) }}" target="_blank">{{ $comment->product->product_name }}</a></span>
                                                                </td>
                                                                <td>
                                                                    <span>
                                                                        @php
                                                                            date_default_timezone_set('Asia/Ho_Chi_Minh');
                                                                        @endphp
                                                                        {{ \Carbon\Carbon::parse($comment->comment_date)->diffForHumans() }}
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    @if ($comment->comment_status == 1)
                                                                        <span class="chip lighten-5 orange orange-text">Đang chờ duyệt</span>
                                                                    @elseif($comment->comment_status == 2)
                                                                        <span class="chip lighten-5 green green-text">Phê duyệt</span>
                                                                    @elseif($comment->comment_status == 3)
                                                                        <span class="chip lighten-5 red red-text">Bỏ duyệt</span>
                                                                    @endif
                                                                </td>

                                                                <td class="action-icon">
                                                                    <span>
                                                                        @if ($comment->comment_status == 1)
                                                                            <input type="button" data-comment_status="2" data-comment_id="{{ $comment->comment_id }}" class="btn btn-grd-success btn-sm comment_status_btn" value="Phê duyệt">
                                                                            <input type="button" data-comment_status="3" data-comment_id="{{ $comment->comment_id }}" class="btn btn-grd-danger btn-sm comment_status_btn" value="Bỏ Duyệt" >
                                                                        @elseif($comment->comment_status == 2)
                                                                            <input type="button" data-comment_status="3" data-comment_id="{{ $comment->comment_id }}" class="btn btn-grd-danger btn-sm comment_status_btn" value="Bỏ Duyệt" >
                                                                        @elseif($comment->comment_status == 3)
                                                                            <input type="button" data-comment_status="2" data-comment_id="{{ $comment->comment_id }}" class="btn btn-grd-success btn-sm comment_status_btn" value="Phê duyệt">
                                                                        @endif
                                                                    </span>

                                                                    @if ($comment->comment_status != 2)
                                                                        <form style="display: inline-block;">
                                                                            @csrf
                                                                            <button type="button"
                                                                                class="btn btn-grd-danger btn-sm deleteComment"
                                                                                style="outline: none"
                                                                                data-customer_id="{{ $comment->customer_id }}"
                                                                                data-product_id="{{ $comment->product_id }}"><i
                                                                                    class="fa fa-trash-o fa-fw"></i></button>
                                                                        </form>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Tên người gửi</th>
                                                            <th>Bình luận</th>
                                                            <th>Sản phẩm</th>
                                                            <th>Ngày gửi</th>
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

    <script>
        function setVisibility(comment_id) {
            document.getElementById('comment_screen_'+comment_id).style.display ='flex';
            document.getElementById('show_'+comment_id).style.display ='none';
            document.getElementById('comment_content_'+comment_id).style.display ='none';
            document.getElementById('reply_'+comment_id).style.display ='block';
        }

        function hideVisibility(comment_id) {
            document.getElementById('comment_screen_'+comment_id).style.display ='none';
            document.getElementById('show_'+comment_id).style.display ='block';
            document.getElementById('comment_content_'+comment_id).style.display ='block';
            document.getElementById('reply_'+comment_id).style.display ='none';
        }

    </script>

    <script>
        $('.comment_status_btn').click(function(){
            var comment_status = $(this).data('comment_status');
            var comment_id = $(this).data('comment_id');

            if(comment_status == 2){
                var notify = 'Thay đổi thành phê duyệt thành công';
            }else if(comment_status == 3){
                var notify = 'Thay đổi thành hủy duyệt thành công';
            }

            $.ajax({
                url: '{{ route('comment.approve') }}',
                method:"POST",
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{comment_status:comment_status,comment_id:comment_id},

                success:function(data){
                    location.reload();
                    $('#notify_comment').html(`
                        <div class="alert alert-success icons-alert" role="alert" style="margin: 0 30px">
                            <li style="display: block">${notify}</li>
                        </div>
                    `);
                }
            });
        });

        $('.reply_comment_btn').click(function(){
            var comment_id        = $(this).data('comment_id');
            var comment_content   = $('.reply_comment_'+comment_id).val();
            var product_id        = $(this).data('product_id');
            var customer_id       = $(this).data('customer_id');
            var admin_id          = $(this).data('admin_id');
            var comment_status    = $(this).data('comment_status');
            var notify            = 'Trả lời bình luận thành công';


            $.ajax({
                url: '{{ route('comment.reply_comment') }}',
                method:"POST",
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{comment_id:comment_id, comment_content:comment_content, product_id:product_id, customer_id:customer_id, admin_id:admin_id, comment_status:comment_status},

                success:function(data){
                    $('.reply_comment_'+comment_id).val('');

                    $('#notify_comment').html(`
                        <div class="alert alert-success icons-alert" role="alert" style="margin: 0 30px">
                            <li style="display: block">${notify}</li>
                        </div>
                    `);

                    $(".alert").fadeTo(2500, 500).slideUp(500, function () {
                        $(".alert").slideUp(500);
                    });

                    setTimeout(function(){
                        location.reload();
                    }, 1000)
                },

                error:function(){
                    $('.reply_comment_'+comment_id).css('border', '1px solid red');
                    $('.reply_comment_'+comment_id).keydown(function(){
                        $('.reply_comment_'+comment_id).css('border', '1px solid green');
                    });

                }
            });
        });
    </script>

    <script type="text/javascript">
        $('.deleteComment').click(function() {
            var _token = $('input[name="_token"]').val();
            var customer_id = $(this).data('customer_id');
            var product_id = $(this).data('product_id');

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
                    url: '{{ route('comment.delete') }}',
                    method: 'POST',
                    data: {
                        customer_id: customer_id,
                        product_id: product_id,
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
        });
    </script>
@endpush
