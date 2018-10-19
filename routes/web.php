<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::get('user/{id}', 'UserController@show');

//get请求
/*Route::get('user/{id}', function ($id) {
    return 'user:' . $id;
});*/
//post请求
/*Route::post('user/{id}', function ($id) {
    return 'user:' . $id;
});*/
//多请求路由
/*Route::match(['get', 'post'], 'user', function () {
    return '多请求路由';
});*/
/*Route::any('user', function () {
    return 'any_user';
});*/
//路由参数
/*Route::get('user/{name?}', function ($name = '默认') {
    return $name;
});*/
/*Route::get('user/{id}/{name?}', function ($id, $name = '默认') {
    return $name . ':' . $id;
})->where(['name' => '[A-Za-z]+', 'id' => '[0-9]+']);*/ //正则表达式匹配name
//路由别名
/*Route::get('user/member-center', ['as' => 'center', function () {
    return '路由别名' . route('user/center');
}]);*/
//路由群组
//Route::prefix('member')->group(function (){
//    Route::get('member-center', ['as' => 'center', function () {
//        return '路由别名' . route('center');
//    }]);
//});
/*Route::group(['prefix' => 'member'], function () {
    Route::get('member-center', ['as' => 'center', function () {
        return '路由别名' . route('center');
    }]);
});*/
//路由输出视图
/*Route::get('view', function () {
    return view('welcome');
});*/
//关联控制器
//Route::get('member/info','MemberController@info');
//Route::get('member/info', ['uses' => 'MemberController@info']); //效果同上
Route::get('member/info', [
    'uses' => 'MemberController@info',
    'as' => 'memberInfo' //别名route('memberInfo')
]); //效果同上
//参数绑定
//Route::any('member/{id}', ['uses' => 'MemberController@info'])->where('id','[0-9]+');

Route::any('member/info', 'MemberController@info');
Route::any('test1', 'StudentController@test1');
Route::any('test2', 'StudentController@test2');
Route::any('test3', 'StudentController@test3');
Route::any('test4', 'StudentController@test4');
Route::any('test5', 'StudentController@test5');
Route::any('orm1', 'StudentController@orm1');
Route::any('orm2', 'StudentController@orm2');
Route::any('orm3', 'StudentController@orm3');
Route::any('orm4', 'StudentController@orm4');
//request
Route::any('request1', 'StudentController@request1');
//session
Route::group(['middleware' => ['web']], function () {
    Route::any('session1', 'StudentController@session1');
    Route::any('session2', 'StudentController@session2');
});
//Response
Route::any('response1', 'StudentController@response1');
//middleware
Route::any('middleware1', 'StudentController@middleware1');
Route::any('request4', 'StudentController@request4');
