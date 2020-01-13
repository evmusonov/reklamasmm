<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Admin extends Model
{
    public static function getAdminData()
    {
        return [
            'login' => 'admin',
            'password' => 'admin'
        ];
    }

    public static function auth(array $data)
    {
        if (self::checkAuthData(self::getAdminData(), $data)) {
            return Auth::loginUsingId(1,isset($data['remember']) ? true : false);
        }
    }

    public static function checkAuthData(array $expected, array $actual)
    {
        $flag = true;

        foreach ($actual as $key => $value) {
            if (isset($expected[$key]) && $expected[$key] != $value) {
                $flag = false;
            }
        }

        return $flag;
    }
}
