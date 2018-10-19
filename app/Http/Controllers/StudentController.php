<?php

namespace App\Http\Controllers;

use App\Model\StudentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * 使用DB facade实现CURD
     */
    public function test1()
    {
        //DB查询数据
        $students = DB::select('select * from student where age > ?', [20]);
        //新增数据,返回布尔值
        //$bool = DB::insert('insert into student(name,age) values(?,?)',['account3',23]);
        //修改数据,返回修改的行数
        //$num = DB::update('update student set age=? where name=?',[33,'account']);
        //删除数据,返回影响的行数
        //$num =DB::delete('delete from student where name=?',['account']);
        dd($students);
    }

    /**
     * 查询构造器-新增数据
     */
    public function test2()
    {
        //返回布尔值
        /*$bool = DB::table('student')->insert(
            ['name' => 'lais', 'age' => 18]
        );*/
        //获取自增id
        /*$id = DB::table('student')->insertGetId(
            ['name' => 'lais', 'age' => 18]
        );*/
        //批量新增,返回布尔值
        $bool = DB::table('student')->insert(
            [
                ['name' => 'lais2', 'age' => 19],
                ['name' => 'lai23', 'age' => 16],
                ['name' => 'lais4', 'age' => 20],
                ['name' => 'lai25', 'age' => 21],
                ['name' => 'lais6', 'age' => 22],
                ['name' => 'lai27', 'age' => 23],
            ]
        );
        dd($bool);
    }

    /**
     * 查询构造器-更新数据
     */
    public function test3()
    {
        //更新指定数据,返回影响的行数
        //$num = DB::table('student')->where('id', '8')->update(['age' => 55]);
        //自增，自减,返回影响的行数
        //$num = DB::table('student')->increment('age',3);//自增,默认1
        //$num = DB::table('student')->where('id',12)->decrement('age',3);//自减,默认1
        //自增或自减，并修改其他条件
        $num = DB::table('student')->where('id', 11)->decrement('age', 3, ['name' => 'qita']);
        dd($num);
    }

    /**
     * 查询构造器-删除数据
     */
    public function test4()
    {
        //删除指定数据
        //$num = DB::table('student')->where('age', '>=', 23)->delete();
        //删除所有数据,什么都不返回
        DB::table('student')->truncate();
        //dd($num);
    }

    /**
     * 查询构造器-查询数据
     * 1.get() 获取表所有的数据
     * 2.first() 获取结果集中的第一条数据
     * 3.where() 条件 where('id', '>=', 23)
     * 4 whereRaw() 多条件 whereRaw('id >= ? and age > ?',[11,23]);
     * 5.pluck() 返回结果集中指定的字段（获取一列的值）
     * 6.select() 指定要查询的字段
     * 7.chunk() 结果分块
     */
    public function test5()
    {
        //$students = DB::table('student')->get();
        //多条件查询
        /*$students = DB::table('student')
            ->whereRaw('id >= ? and age > ?',[8,20])
            ->get();*/
        //pluck 返回所有数据中的name
        $name = DB::table('student')
            ->pluck('name', 'age');
        //chunk
        DB::table('student')->orderBy('id', 'desc')->chunk(2, function ($student) {
            echo "<pre>";
            var_dump($student);
        });
        //dd($name);
    }

    /**
     * ORM-查询
     */
    public function orm1()
    {
        //all() 查询表的所有记录
        $students = StudentModel::all();

        //find() 查询一条数据
        //$student = StudentModel::find(10);

        //findOrFail() 根据主键查找,如果没有查到就报错
        //$student = StudentModel::findOrFail(110);

        //model调用查询构造器
        //查询所有数据
        //$students = StudentModel::get();
        //查询第一条数据
        /*$students = StudentModel::where('id','>',5)
            ->orderBy('id','desc')
            ->first();*/
        echo "<pre>";
        //分块
        $students = StudentModel::chunk(2, function ($students) {
            var_dump($students);
        });
        dd($students);
    }

    /**
     * ORM--新增、自定义时间戳、批量赋值
     */
    public function orm2()
    {
        //通过模型新增数据（自定义时间戳）
        /*$student = new StudentModel();
        $student->name = '瓜娃子31';
        $student->age = 323;
        $res = $student->save();
        dd($res);*/
        //数据库时间戳自动转时间
        /*$student = StudentModel::find(19);
        echo $student->created_at;
        echo '<br>';*/
        //使用模型的Create方法新增数据(批量赋值)
        //$student = StudentModel::Create(['name' => '测试', 'age' => 12]);
        //firstOrCreate() 以属性查找用户，若没有就新增
        //$student = StudentModel::firstOrCreate(['name' => 'lai']);
        //firstOrNew() 以属性查找用户，若没有就建立新的实力，如果需要保存则save();
        $student = StudentModel::firstOrNew(['name' => '你个瓜娃子']);
        $bool = $student->save();//返回布尔值
        dump($bool);
    }

    /**
     * ORM--修改数据
     */
    public function orm3()
    {
        //通过模型更新
        /* $student = StudentModel::find(12);
         $student->name = 'hahaha';
         $bool = $student->save();
         dd($bool);*/
        //结合查询语句 批量更新
        //返回更新的行数
        $num = StudentModel::where('id', '>', 20)->update(['age' => 41]);
        dd($num);
    }

    /**
     * ORM--修改数据
     */
    public function orm4()
    {
        //通过模型删除
        /*$student = StudentModel::find(23);
        $bool = $student->delete();
        dd($bool);*/
        //通过主键值删除 返回影响行数
        /*$num = StudentModel::destroy([20,21]);
        dd($num);*/
        //根据指定条件删除
        $num = StudentModel::where('id', '>', 18)->delete();
        dd($num);
    }

    /**
     * Controller之Request
     * @param Request $request
     */
    public function request1(Request $request)
    {
        //1.取值
        $request->input('name', '默认值');
        //has('name'); //判断是否存在这个参数
        /*if($request->has('name')){
            echo $request->input('name');
        }else{
            echo '无参数';
        }*/
        /*$res = $request->all(); //所有参数
        dd($res);*/

        //2.判断请求类型
        //echo $request->method();
        /*if($request->isMethod('GET')){
            echo 'YES';
        }else{
            echo "NO";
        }*/
        //$res =  $request->ajax();
        //判断请求的路径是否符合特定的格式
        //$res = $request->is('student/*');
        //获取当前url
        echo $request->url();
        //var_dump($res);
    }

    /**
     * Controller之Session
     * @param Request $request
     */
    public function session1(Request $request)
    {
        //1.HTTP request类的session()方法
//        $request->session()->put('key1','value1'); //设置session
//        echo $request->session()->get('key1'); //获取session
        //2.session()辅助函数
//        session()->put('key2', 'value2'); //设置session
//        echo session()->get('key2'); //获取session
        //Session facade
//        \Session::put('key3','value3'); //设置session
//        echo \Session::get('key4', 'default'); //获取session,不存在默认
//        \Session::put(['key5' => 'value5', 'key6' => 'value6']); //session 以数组的形式存储数据
//        echo \Session::get('key6');
        //把数据放到Session的数组中
        \Session::push('student', 'akate');
        \Session::push('stuent', 'luanma');
        //取出数据后删除
        \Session::pull('student','default');
        $res = \Session::get('student');
        //获取session所有的数据
        $res = \Session::all();
        //判断这个session是否存在
        \Session::has('key1');
        //删除key1 session
        \Session::forget('key1');
        //删除所有session(清空所有数据)
        \Session::flush();
        //第一次访问的时候才存在（暂存数据）
        \Session::flash('key1','value2');
        dd($res);
    }

    /**
     * Controller之response
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function response1(Request $request)
    {
        //响应的常见类型
            //1.字符串
            //2.视图
            //3.json
            /*$data = [
                'code' => 1,
                'msg' => 'message',
                'date' => 'data'
            ];
            return response()->json($data);*/
            //4.重定向
            //return redirect('orm4');
            //with重定向带参数
            //return redirect('orm4')->with('message','我是快闪数据');
            //跨控制器
            //return redirect()->action('MemberController@info')->with('message','我是快闪数据');
            //route()路由别名跳转
            //return redirect()->route('memberInfo');
            //back()返回上一级页面
            return redirect()->back();
    }
    /**
     * Controller之response
     *
     */
    public function middleware1()
    {
        //中间件
    }



    //模版继承
    /**
     * 1.section
     * 2.yield
     * 3.extends
     * 4.parent
     */
}
