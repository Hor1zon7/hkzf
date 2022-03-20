<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Admin;
use App\Models\User;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function adminAdd()
    {
        return view('admin.index.admin_add');
    }

    public function adminDoAdd(Request $request)
    {
        $data = $request->post();
        $this->validate($request,[
            'username'=>'unique:admin'
        ]);
        $data['password'] = bcrypt($data['password']);
        try {
            Admin::create($data);

        } catch (\Exception $e) {
            return errorX($e->getMessage());
        }

//        注册成功，向用户发送邮件
        Mail::send('mail.addAdmin', ['user' => '123'], function (Message $message) {
            $message->to('1700892756@qq.com');
            $message->subject('星球日报');
        });
        return successX($data);
    }

    public function adminEdit(Request $request)
    {
        $id = $request->all('id');
        $data = Admin::with(['getRole'])->find($id)->first()->toArray();
        return view('admin.index.admin_edit', compact('data'));
    }

    public function adminDoEdit(Request $request)
    {
        $data = $request->post();
        unset($data['_token']);
        try {
            Admin::where('id', $data['id'])->update($data);
        } catch (\Exception $e) {
            return errorX('更新失败');
        }
        return successX('成功');

    }

    public function deleteAdmin(Request $request)
    {
        $id = ($request->post('id'));
        try {
            $res = Admin::find($id)->delete();
        } catch (\Exception $e) {
            return errorX($e->getMessage());
        }
        return successX('删除成功');
    }


    public function dataDel(Request $request)
    {
        $id = $request->all('id')['id'];
        try {
            Admin::wherein('id', $id)->delete();
        } catch (\Exception $e) {
            return errorX($e->getMessage());
        }
        return successX('批量删除成功');
    }

}
