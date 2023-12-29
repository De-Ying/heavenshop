<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Admin;
use App\Models\Comment;
use App\Models\Rating;
use Carbon\Carbon;

class CommentController extends Controller
{
    // TODO: FRONTEND
    public function load_comment(Request $request)
    {
        $product_id    = $request->product_id;
        $customer_id    = $request->customer_id;

        $comments      = Comment::where([
            ['product_id', $product_id],
            ['comment_status', 2],
            ['parent_id', NULL]
        ])->with('customer')->paginate(5);

        $comment_reps = Comment::with('admin')->where('parent_id','!=',NULL)->get();

        $star        = Rating::where([
            ['product_id', $product_id],
            ['customer_id', $customer_id]
        ])->get();

        $rating  = round($star->avg('rating'));

        $output = '';

        foreach ($comments as $comment) {

            if ($comment->customer->customer_social == 0){
                $path = asset('public/uploads/customer/'.$comment->customer->customer_image);
            }else{
                $path = $comment->customer->customer_image;
            }

            date_default_timezone_set('Asia/Ho_Chi_Minh');

            $comment_date = Carbon::parse($comment->comment_date)->diffForHumans();

            $output .= '
                <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                    <img src="'.$path.'" alt="AVATAR">
                </div>

                <div class="size-207" style="padding-bottom: 30px;">
                    <div class="flex-w flex-sb-m">
                        <span class="mtext-107 cl2 p-r-20">@'.$comment->customer->customer_name.' <i style="font-style: normal;
                        margin-left: 15px;">'.$comment_date.'</i></span>

                        <ul class="list-inline rating" style="display: flex;">
                        ';
                        if($star->count() > 0){
                            for ($count = 1; $count <= 5; $count++){

                                if ($count <= $rating) {
                                    $color = '#ffcc00;';
                                } else {
                                    $color = '#ccc;';
                                }

                                $output .= '<li style="cursor:pointer; color:'.$color.' font-size:20px;">&#9733;</li>';
                            }
                        }else{
                            for ($count = 1; $count <= 5; $count++){

                                $color = '#ccc;';

                                $output .= '<li style="cursor:pointer; color:'.$color.' font-size:20px;">&#9733;</li>';
                            }
                        }

                        $output .='
                        </ul>
                    </div>

                    <p class="stext-102 cl6">'.$comment->comment_content.'</p>
                    <div class="flex m-t-10">
                        <button type="button" style="font-size: 14px" onclick="thumbs_like('.$comment->comment_id.')" class="m-r-20"><i class="fa fa-thumbs-up"></i><span class="m-l-5 thumbs_like">'.$comment->comment_like.'</span></button>
                        <button type="button" style="font-size: 14px" onclick="thumbs_dislike('.$comment->comment_id.')" class="m-r-20"><i class="fa fa-thumbs-down"></i><span class="m-l-5 thumbs_dislike">'.$comment->comment_dislike.'</span></button>
                    </div>
                </div>
            ';

            foreach ($comment_reps as $comment_rep) {
                if($comment_rep->parent_id == $comment->comment_id){

                    $path = asset('public/uploads/avatar/'.$comment_rep->admin->avatar);

                    $comment_rep_date = Carbon::parse($comment_rep->comment_date)->diffForHumans();

                    $output .= '
                        <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6 m-l-35">
                            <img src="'.$path.'" alt="AVATAR">
                        </div>

                        <div style="padding-bottom: 30px; width: calc(96% - 78px);">
                            <div class="flex-w flex-sb-m">
                                <span class="mtext-107 cl2 p-r-20">@'.$comment_rep->admin->user_name.' <i style="font-style: normal;
                                margin-left: 15px;">'.$comment_rep_date.'</i></span>
                            </div>

                            <p class="stext-102 cl6">'.$comment_rep->comment_content.'</p>
                            <div class="flex m-t-10">
                                <input type="hidden" class="admin_id" value="'.$comment_rep->admin_id.'">
                                <button type="button" style="font-size: 14px" onclick="thumbs_admin_like('.$comment_rep->comment_id.')" class="m-r-20"><i class="fa fa-thumbs-up"></i><span class="m-l-5 thumbs_like">'.$comment_rep->comment_like.'</span></button>
                                <button type="button" style="font-size: 14px" onclick="thumbs_admin_dislike('.$comment_rep->comment_id.')" class="m-r-20"><i class="fa fa-thumbs-down"></i><span class="m-l-5 thumbs_dislike">'.$comment_rep->comment_dislike.'</span></button>
                            </div>
                        </div>
                    ';
                }
            }
        }

        echo $output;
    }

    public function load_comment_date(Request $request)
    {
        $product_id    = $request->product_id;
        $customer_id   = $request->customer_id;
        $comment_date  = $request->comment_date;

        if ($comment_date == '7days') {
            $weekends = Carbon::now('Asia/Ho_Chi_Minh')->subDay(7)->format('Y-m-d H:i:s');
            $now      = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');

            $comments      = Comment::where([
                ['product_id', $product_id],
                ['comment_status', 2],
                ['parent_id', NULL]
            ])->whereBetween('comment_date', [$weekends, $now])->with('customer')->paginate(5);

            $comment_reps = Comment::with('admin')->where('parent_id','!=',NULL)->get();

            $star        = Rating::where([
                ['product_id', $product_id],
                ['customer_id', $customer_id]
            ])->get();

            $rating  = round($star->avg('rating'));

            $output = '';

            foreach ($comments as $comment) {

                if ($comment->customer->customer_social == 0){
                    $path = asset('public/uploads/customer/'.$comment->customer->customer_image);
                }else{
                    $path = $comment->customer->customer_image;
                }

                date_default_timezone_set('Asia/Ho_Chi_Minh');

                $comment_date = Carbon::parse($comment->comment_date)->diffForHumans();

                $output .= '
                    <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                        <img src="'.$path.'" alt="AVATAR">
                    </div>

                    <div class="size-207" style="padding-bottom: 30px;">
                        <div class="flex-w flex-sb-m">
                            <span class="mtext-107 cl2 p-r-20">@'.$comment->customer->customer_name.' <i style="font-style: normal;
                            margin-left: 15px;">'.$comment_date.'</i></span>

                            <ul class="list-inline rating" style="display: flex;">
                            ';
                            if($star->count() > 0){
                                for ($count = 1; $count <= 5; $count++){

                                    if ($count <= $rating) {
                                        $color = '#ffcc00;';
                                    } else {
                                        $color = '#ccc;';
                                    }

                                    $output .= '<li style="cursor:pointer; color:'.$color.' font-size:20px;">&#9733;</li>';
                                }
                            }else{
                                for ($count = 1; $count <= 5; $count++){

                                    $color = '#ccc;';

                                    $output .= '<li style="cursor:pointer; color:'.$color.' font-size:20px;">&#9733;</li>';
                                }
                            }

                            $output .='
                            </ul>
                        </div>

                        <p class="stext-102 cl6">'.$comment->comment_content.'</p>
                        <div class="flex m-t-10">
                            <button type="button" style="font-size: 14px" onclick="thumbs_like('.$comment->comment_id.')" class="m-r-20"><i class="fa fa-thumbs-up"></i><span class="m-l-5 thumbs_like">'.$comment->comment_like.'</span></button>
                            <button type="button" style="font-size: 14px" onclick="thumbs_dislike('.$comment->comment_id.')" class="m-r-20"><i class="fa fa-thumbs-down"></i><span class="m-l-5 thumbs_dislike">'.$comment->comment_dislike.'</span></button>
                        </div>
                    </div>
                ';

                foreach ($comment_reps as $comment_rep) {
                    if($comment_rep->parent_id == $comment->comment_id){

                        $path = asset('public/uploads/avatar/'.$comment_rep->admin->avatar);

                        $comment_rep_date = Carbon::parse($comment_rep->comment_date)->diffForHumans();

                        $output .= '
                            <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6 m-l-35">
                                <img src="'.$path.'" alt="AVATAR">
                            </div>

                            <div style="padding-bottom: 30px; width: calc(96% - 78px);">
                                <div class="flex-w flex-sb-m">
                                    <span class="mtext-107 cl2 p-r-20">@'.$comment_rep->admin->user_name.' <i style="font-style: normal;
                                    margin-left: 15px;">'.$comment_rep_date.'</i></span>
                                </div>

                                <p class="stext-102 cl6">'.$comment_rep->comment_content.'</p>
                                <div class="flex m-t-10">
                                    <input type="hidden" class="admin_id" value="'.$comment_rep->admin_id.'">
                                    <button type="button" style="font-size: 14px" onclick="thumbs_admin_like('.$comment_rep->comment_id.')" class="m-r-20"><i class="fa fa-thumbs-up"></i><span class="m-l-5 thumbs_like">'.$comment_rep->comment_like.'</span></button>
                                    <button type="button" style="font-size: 14px" onclick="thumbs_admin_dislike('.$comment_rep->comment_id.')" class="m-r-20"><i class="fa fa-thumbs-down"></i><span class="m-l-5 thumbs_dislike">'.$comment_rep->comment_dislike.'</span></button>
                                </div>
                            </div>
                        ';
                    }
                }
            }

            echo $output;
        } else if ($comment_date == '30days') {
            $oneMonth = Carbon::now('Asia/Ho_Chi_Minh')->subMonth(1)->startOfMonth()->format('Y-m-d H:i:s');
            $now        = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');

            $comments      = Comment::where([
                ['product_id', $product_id],
                ['comment_status', 2],
                ['parent_id', NULL]
            ])->whereBetween('comment_date', [$oneMonth, $now])->with('customer')->paginate(5);

            $comment_reps = Comment::with('admin')->where('parent_id','!=',NULL)->get();

            $star        = Rating::where([
                ['product_id', $product_id],
                ['customer_id', $customer_id]
            ])->get();

            $rating  = round($star->avg('rating'));

            $output = '';

            foreach ($comments as $comment) {

                if ($comment->customer->customer_social == 0){
                    $path = asset('public/uploads/customer/'.$comment->customer->customer_image);
                }else{
                    $path = $comment->customer->customer_image;
                }

                date_default_timezone_set('Asia/Ho_Chi_Minh');

                $comment_date = Carbon::parse($comment->comment_date)->diffForHumans();

                $output .= '
                    <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                        <img src="'.$path.'" alt="AVATAR">
                    </div>

                    <div class="size-207" style="padding-bottom: 30px;">
                        <div class="flex-w flex-sb-m">
                            <span class="mtext-107 cl2 p-r-20">@'.$comment->customer->customer_name.' <i style="font-style: normal;
                            margin-left: 15px;">'.$comment_date.'</i></span>

                            <ul class="list-inline rating" style="display: flex;">
                            ';
                            if($star->count() > 0){
                                for ($count = 1; $count <= 5; $count++){

                                    if ($count <= $rating) {
                                        $color = '#ffcc00;';
                                    } else {
                                        $color = '#ccc;';
                                    }

                                    $output .= '<li style="cursor:pointer; color:'.$color.' font-size:20px;">&#9733;</li>';
                                }
                            }else{
                                for ($count = 1; $count <= 5; $count++){

                                    $color = '#ccc;';

                                    $output .= '<li style="cursor:pointer; color:'.$color.' font-size:20px;">&#9733;</li>';
                                }
                            }

                            $output .='
                            </ul>
                        </div>

                        <p class="stext-102 cl6">'.$comment->comment_content.'</p>
                        <div class="flex m-t-10">
                            <button type="button" style="font-size: 14px" onclick="thumbs_like('.$comment->comment_id.')" class="m-r-20"><i class="fa fa-thumbs-up"></i><span class="m-l-5 thumbs_like">'.$comment->comment_like.'</span></button>
                            <button type="button" style="font-size: 14px" onclick="thumbs_dislike('.$comment->comment_id.')" class="m-r-20"><i class="fa fa-thumbs-down"></i><span class="m-l-5 thumbs_dislike">'.$comment->comment_dislike.'</span></button>
                        </div>
                    </div>
                ';

                foreach ($comment_reps as $comment_rep) {
                    if($comment_rep->parent_id == $comment->comment_id){

                        $path = asset('public/uploads/avatar/'.$comment_rep->admin->avatar);

                        $comment_rep_date = Carbon::parse($comment_rep->comment_date)->diffForHumans();

                        $output .= '
                            <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6 m-l-35">
                                <img src="'.$path.'" alt="AVATAR">
                            </div>

                            <div style="padding-bottom: 30px; width: calc(96% - 78px);">
                                <div class="flex-w flex-sb-m">
                                    <span class="mtext-107 cl2 p-r-20">@'.$comment_rep->admin->user_name.' <i style="font-style: normal;
                                    margin-left: 15px;">'.$comment_rep_date.'</i></span>
                                </div>

                                <p class="stext-102 cl6">'.$comment_rep->comment_content.'</p>
                                <div class="flex m-t-10">
                                    <input type="hidden" class="admin_id" value="'.$comment_rep->admin_id.'">
                                    <button type="button" style="font-size: 14px" onclick="thumbs_admin_like('.$comment_rep->comment_id.')" class="m-r-20"><i class="fa fa-thumbs-up"></i><span class="m-l-5 thumbs_like">'.$comment_rep->comment_like.'</span></button>
                                    <button type="button" style="font-size: 14px" onclick="thumbs_admin_dislike('.$comment_rep->comment_id.')" class="m-r-20"><i class="fa fa-thumbs-down"></i><span class="m-l-5 thumbs_dislike">'.$comment_rep->comment_dislike.'</span></button>
                                </div>
                            </div>
                        ';
                    }
                }
            }

            echo $output;
        } else if ($comment_date == '60days') {
            $twoMonth = Carbon::now('Asia/Ho_Chi_Minh')->subMonth(2)->startOfMonth()->format('Y-m-d H:i:s');
            $now        = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');

            $comments      = Comment::where([
                ['product_id', $product_id],
                ['comment_status', 2],
                ['parent_id', NULL]
            ])->whereBetween('comment_date', [$twoMonth, $now])->with('customer')->paginate(5);

            $comment_reps = Comment::with('admin')->where('parent_id','!=',NULL)->get();

            $star        = Rating::where([
                ['product_id', $product_id],
                ['customer_id', $customer_id]
            ])->get();

            $rating  = round($star->avg('rating'));

            $output = '';

            foreach ($comments as $comment) {

                if ($comment->customer->customer_social == 0){
                    $path = asset('public/uploads/customer/'.$comment->customer->customer_image);
                }else{
                    $path = $comment->customer->customer_image;
                }

                date_default_timezone_set('Asia/Ho_Chi_Minh');

                $comment_date = Carbon::parse($comment->comment_date)->diffForHumans();

                $output .= '
                    <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                        <img src="'.$path.'" alt="AVATAR">
                    </div>

                    <div class="size-207" style="padding-bottom: 30px;">
                        <div class="flex-w flex-sb-m">
                            <span class="mtext-107 cl2 p-r-20">@'.$comment->customer->customer_name.' <i style="font-style: normal;
                            margin-left: 15px;">'.$comment_date.'</i></span>

                            <ul class="list-inline rating" style="display: flex;">
                            ';
                            if($star->count() > 0){
                                for ($count = 1; $count <= 5; $count++){

                                    if ($count <= $rating) {
                                        $color = '#ffcc00;';
                                    } else {
                                        $color = '#ccc;';
                                    }

                                    $output .= '<li style="cursor:pointer; color:'.$color.' font-size:20px;">&#9733;</li>';
                                }
                            }else{
                                for ($count = 1; $count <= 5; $count++){

                                    $color = '#ccc;';

                                    $output .= '<li style="cursor:pointer; color:'.$color.' font-size:20px;">&#9733;</li>';
                                }
                            }

                            $output .='
                            </ul>
                        </div>

                        <p class="stext-102 cl6">'.$comment->comment_content.'</p>
                        <div class="flex m-t-10">
                            <button type="button" style="font-size: 14px" onclick="thumbs_like('.$comment->comment_id.')" class="m-r-20"><i class="fa fa-thumbs-up"></i><span class="m-l-5 thumbs_like">'.$comment->comment_like.'</span></button>
                            <button type="button" style="font-size: 14px" onclick="thumbs_dislike('.$comment->comment_id.')" class="m-r-20"><i class="fa fa-thumbs-down"></i><span class="m-l-5 thumbs_dislike">'.$comment->comment_dislike.'</span></button>
                        </div>
                    </div>
                ';

                foreach ($comment_reps as $comment_rep) {
                    if($comment_rep->parent_id == $comment->comment_id){

                        $path = asset('public/uploads/avatar/'.$comment_rep->admin->avatar);

                        $comment_rep_date = Carbon::parse($comment_rep->comment_date)->diffForHumans();

                        $output .= '
                            <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6 m-l-35">
                                <img src="'.$path.'" alt="AVATAR">
                            </div>

                            <div style="padding-bottom: 30px; width: calc(96% - 78px);">
                                <div class="flex-w flex-sb-m">
                                    <span class="mtext-107 cl2 p-r-20">@'.$comment_rep->admin->user_name.' <i style="font-style: normal;
                                    margin-left: 15px;">'.$comment_rep_date.'</i></span>
                                </div>

                                <p class="stext-102 cl6">'.$comment_rep->comment_content.'</p>
                                <div class="flex m-t-10">
                                    <input type="hidden" class="admin_id" value="'.$comment_rep->admin_id.'">
                                    <button type="button" style="font-size: 14px" onclick="thumbs_admin_like('.$comment_rep->comment_id.')" class="m-r-20"><i class="fa fa-thumbs-up"></i><span class="m-l-5 thumbs_like">'.$comment_rep->comment_like.'</span></button>
                                    <button type="button" style="font-size: 14px" onclick="thumbs_admin_dislike('.$comment_rep->comment_id.')" class="m-r-20"><i class="fa fa-thumbs-down"></i><span class="m-l-5 thumbs_dislike">'.$comment_rep->comment_dislike.'</span></button>
                                </div>
                            </div>
                        ';
                    }
                }
            }

            echo $output;
        } else {
            $comments      = Comment::where([
                ['product_id', $product_id],
                ['comment_status', 2],
                ['parent_id', NULL]
            ])->with('customer')->paginate(5);

            $comment_reps = Comment::with('admin')->where('parent_id','!=',NULL)->get();

            $star        = Rating::where([
                ['product_id', $product_id],
                ['customer_id', $customer_id]
            ])->get();

            $rating  = round($star->avg('rating'));

            $output = '';

            foreach ($comments as $comment) {

                if ($comment->customer->customer_social == 0){
                    $path = asset('public/uploads/customer/'.$comment->customer->customer_image);
                }else{
                    $path = $comment->customer->customer_image;
                }

                date_default_timezone_set('Asia/Ho_Chi_Minh');

                $comment_date = Carbon::parse($comment->comment_date)->diffForHumans();

                $output .= '
                    <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                        <img src="'.$path.'" alt="AVATAR">
                    </div>

                    <div class="size-207" style="padding-bottom: 30px;">
                        <div class="flex-w flex-sb-m">
                            <span class="mtext-107 cl2 p-r-20">@'.$comment->customer->customer_name.' <i style="font-style: normal;
                            margin-left: 15px;">'.$comment_date.'</i></span>

                            <ul class="list-inline rating" style="display: flex;">
                            ';
                            if($star->count() > 0){
                                for ($count = 1; $count <= 5; $count++){

                                    if ($count <= $rating) {
                                        $color = '#ffcc00;';
                                    } else {
                                        $color = '#ccc;';
                                    }

                                    $output .= '<li style="cursor:pointer; color:'.$color.' font-size:20px;">&#9733;</li>';
                                }
                            }else{
                                for ($count = 1; $count <= 5; $count++){

                                    $color = '#ccc;';

                                    $output .= '<li style="cursor:pointer; color:'.$color.' font-size:20px;">&#9733;</li>';
                                }
                            }

                            $output .='
                            </ul>
                        </div>

                        <p class="stext-102 cl6">'.$comment->comment_content.'</p>
                        <div class="flex m-t-10">
                            <button type="button" style="font-size: 14px" onclick="thumbs_like('.$comment->comment_id.')" class="m-r-20"><i class="fa fa-thumbs-up"></i><span class="m-l-5 thumbs_like">'.$comment->comment_like.'</span></button>
                            <button type="button" style="font-size: 14px" onclick="thumbs_dislike('.$comment->comment_id.')" class="m-r-20"><i class="fa fa-thumbs-down"></i><span class="m-l-5 thumbs_dislike">'.$comment->comment_dislike.'</span></button>
                        </div>
                    </div>
                ';

                foreach ($comment_reps as $comment_rep) {
                    if($comment_rep->parent_id == $comment->comment_id){

                        $path = asset('public/uploads/avatar/'.$comment_rep->admin->avatar);

                        $comment_rep_date = Carbon::parse($comment_rep->comment_date)->diffForHumans();

                        $output .= '
                            <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6 m-l-35">
                                <img src="'.$path.'" alt="AVATAR">
                            </div>

                            <div style="padding-bottom: 30px; width: calc(96% - 78px);">
                                <div class="flex-w flex-sb-m">
                                    <span class="mtext-107 cl2 p-r-20">@'.$comment_rep->admin->user_name.' <i style="font-style: normal;
                                    margin-left: 15px;">'.$comment_rep_date.'</i></span>
                                </div>

                                <p class="stext-102 cl6">'.$comment_rep->comment_content.'</p>
                                <div class="flex m-t-10">
                                    <input type="hidden" class="admin_id" value="'.$comment_rep->admin_id.'">
                                    <button type="button" style="font-size: 14px" onclick="thumbs_admin_like('.$comment_rep->comment_id.')" class="m-r-20"><i class="fa fa-thumbs-up"></i><span class="m-l-5 thumbs_like">'.$comment_rep->comment_like.'</span></button>
                                    <button type="button" style="font-size: 14px" onclick="thumbs_admin_dislike('.$comment_rep->comment_id.')" class="m-r-20"><i class="fa fa-thumbs-down"></i><span class="m-l-5 thumbs_dislike">'.$comment_rep->comment_dislike.'</span></button>
                                </div>
                            </div>
                        ';
                    }
                }
            }

            echo $output;
        }
    }

    public function send_comment(Request $request)
    {
        $data = array();

        $data['comment_content']        = $request->comment_content;
        $data['product_id']             = $request->product_id;
        $data['customer_id']            = $request->customer_id;

        Comment::create($data);
    }

    public function counter_comment(Request $request)
    {
        $product_id    = $request->product_id;

        $comment_count      = Comment::where([
            ['product_id', $product_id],
            ['comment_status', 2],
            ['parent_id', NULL]
        ])->count();

        $output = '<strong style="font-size: 18px">'.$comment_count.'</strong> Bình luận';
        echo $output;
    }

    public function thumbs_like(Request $request)
    {
        $comment_id     = $request->comment_id;
        $product_id     = $request->product_id;
        $customer_id    = $request->customer_id;

        $comment   = Comment::where([
            ['comment_id', $comment_id],
            ['product_id', $product_id],
            ['customer_id', $customer_id],
            ['comment_status', 2],
            ['parent_id', NULL]
        ])->first();

        if ($comment->comment_like > 0) {
            return abort(401);
        } else {
            $comment->comment_like++;
            $comment->save();
        }

        if($comment->comment_dislike > 0){
            $comment->comment_dislike = $comment->comment_dislike - 1;
            $comment->save();
        }
    }

    public function thumbs_dislike(Request $request)
    {
        $comment_id     = $request->comment_id;
        $product_id     = $request->product_id;
        $customer_id    = $request->customer_id;

        $comment   = Comment::where([
            ['comment_id', $comment_id],
            ['product_id', $product_id],
            ['customer_id', $customer_id],
            ['comment_status', 2],
            ['parent_id', NULL]
        ])->first();

        if ($comment->comment_dislike > 0) {
            return abort(401);
        } else {
            $comment->comment_dislike++;
            $comment->save();
        }

        if($comment->comment_like > 0){
            $comment->comment_like = $comment->comment_like - 1;
            $comment->save();
        }
    }

    public function thumbs_admin_like(Request $request)
    {
        $comment_id     = $request->comment_id;
        $product_id     = $request->product_id;
        $admin_id       = $request->admin_id;

        $comment   = Comment::where([
            ['comment_id', $comment_id],
            ['product_id', $product_id],
            ['admin_id', $admin_id],
            ['comment_status', 2],
            ['parent_id', '!=', NULL]
        ])->first();

        if ($comment->comment_like > 0) {
            return abort(401);
        } else {
            $comment->comment_like++;
            $comment->save();
        }

        if($comment->comment_dislike > 0){
            $comment->comment_dislike = $comment->comment_dislike - 1;
            $comment->save();
        }
    }

    public function thumbs_admin_dislike(Request $request)
    {
        $comment_id     = $request->comment_id;
        $product_id     = $request->product_id;
        $admin_id       = $request->admin_id;

        $comment   = Comment::where([
            ['comment_id', $comment_id],
            ['product_id', $product_id],
            ['admin_id', $admin_id],
            ['comment_status', 2],
            ['parent_id', '!=', NULL]
        ])->first();

        if ($comment->comment_dislike > 0) {
            return abort(401);
        } else {
            $comment->comment_dislike++;
            $comment->save();
        }

        if($comment->comment_like > 0){
            $comment->comment_like = $comment->comment_like - 1;
            $comment->save();
        }
    }

    // END FRONTEND

    // TODO: BACKEND
    public function view_all()
    {
        $comments = Comment::with('customer')->with('product')->where('parent_id','=',NULL)->orderBy('comment_status', 'ASC')->paginate(10);
        $comment_reps = Comment::with('customer')->with('product')->with('admin')->where('parent_id','!=',NULL)->get();
        return view('admin.comment.comment_list', [
            'comments'     => $comments,
            'comment_reps' => $comment_reps,
        ]);
    }

    // GET: Phê duyệt
    public function approve(Request $request)
    {
        $data = $request->all();
        $comment = Comment::find($data['comment_id']);
        $comment->comment_status = $data['comment_status'];
        $comment->save();
    }

    // POST: Trả lời bình luân admin vs khách hàng
    public function reply_comment(Request $request)
    {
        $data = $request->all();

        $comment = new Comment();
        $comment->comment_content = $data['comment_content'];
        $comment->comment_status  = $data['comment_status'];
        $comment->parent_id       = $data['comment_id'];
        $comment->admin_id        = $data['admin_id'];
        $comment->product_id      = $data['product_id'];
        $comment->customer_id     = $data['customer_id'];
        $comment->save();
    }

    // POST: Xóa bình luận
    public function delete (Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();

            Comment::where('customer_id', $data['customer_id'])->where('product_id', $data['product_id'])->delete();

            Toastr::success('Xóa bình luận thành công', 'Success');
            DB::commit();
        } catch (\Throwable $th) {
            dd($th);
            // Toastr::error('Xóa bình luận thất bại', 'Error');
            // DB::rollBack();
        }
    }

    // END BACKEND

}
