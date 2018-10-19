<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MemberModel extends Model
{
    public static function getMember()
    {
        return 'member name is Lai';
    }
}
