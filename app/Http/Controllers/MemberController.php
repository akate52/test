<?php

namespace App\Http\Controllers;

use App\Model\MemberModel;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    //命令创建控制器 php artisan make:controller TaskController
    public function info()
    {
        #return 'member-id:' . $id;
        //return route('memberInfo');
        return MemberModel::getMember();
//        return view('member/info', ['name' => '名字']);
    }
}
