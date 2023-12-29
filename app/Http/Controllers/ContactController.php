<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

use App\Models\Contact;
use Brian2694\Toastr\Facades\Toastr;

class ContactController extends Controller
{
    public function view_all()
    {
        $contacts = Contact::all();

        return view('admin.contact.index', [
            'contacts' => $contacts,
        ]);
    }

    public function view_insert()
    {
        return view('admin.contact.view_insert');
    }

    public function process_insert(Request $request)
    {
        if ($request->isMethod("POST")) {
            try {
                Contact::create($request->all());
                Toastr::success('Thêm liên hệ thành công','Success');
                return redirect()->route('contact.view_all');
            } catch (\Throwable $th) {
                Toastr::error('Thêm liên hệ thất bại','Error');
                return redirect()->route('contact.view_insert');
            }
        } else {
            Toastr::warning('Phương thức truyền vào không đúng','Warning');
            return redirect()->route('contact.view_insert');
        }
    }

    // GET: Hiển thị form sửa
    public function view_update($contact_id)
    {
        $contact = Contact::find($contact_id);

        return view('admin.contact.view_update')->with('contact', $contact);
    }

    // POST: Xử lý cập nhật
    public function process_update(Request $request, $contact_id)
    {
        try {
            DB::beginTransaction();
            Contact::find($contact_id)->update($request->all());
            Toastr::success('Cập nhật liên hệ thành công','Success');
            DB::commit();
            return redirect()->route('contact.view_all');
        } catch (\Throwable $th) {
            Toastr::error('Cập nhật liên hệ thất bại','Error');
            DB::rollBack();
            return redirect()->route('contact.view_all');
        }


    }

    // GET: Un-active trạng thái
    public function unactive_contact($contact_id)
    {
        Contact::where('contact_id', $contact_id)->update(['contact_status' => 0]);
        Toastr::success('Ẩn liên hệ thành công','Success');
        return Redirect::to('admin/contact/');
    }

    // GET: Active trạng thái
    public function active_contact($contact_id)
    {
        Contact::where('contact_id', $contact_id)->update(['contact_status' => 1]);
        Toastr::success('Hiển thị liên hệ thành công','Success');
        return Redirect::to('admin/contact/');
    }

    // GET: Xoá liên lạc
    public function delete(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $contact = Contact::findOrFail($data['contact_id']);
            $contact->delete();
            Toastr::success('Xóa liên hệ thành công','Success');
            DB::commit();
        } catch (\Throwable $th) {
            Toastr::error('Xóa liên hệ thất bại','Error');
            DB::rollBack();
        }
    }
}
