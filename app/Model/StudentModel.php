<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StudentModel extends Model
{
    //指定表名
    protected $table = 'student';
    //指定id
    protected $primaryKey = 'id';
    //create 指定允许批量赋值的字段
    protected $fillable = ['name', 'age'];
    //指定不允许的字段赋值
    protected $guarded = ['sex'];
    //自动维护时间戳
    public $timestamps = true;

    /**
     * @return int|string 时间戳
     */
    public function getDateFormat()
    {
        return time();
    }

   /* public function asDateTime($value)
    {
        return $value;//返回时间不做任何处理
    }*/


}
