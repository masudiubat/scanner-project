<?php

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use App\AuditLog;

if (!function_exists("ck_password"))
{

    function ck_password($password, $hash) {
        //echo "password: ".$password."<br/>Hash: ".$hash;
        if (password_verify($password, $hash))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

}

if (!function_exists("addLog"))
{
    function addLog($access_by,$description,$status)
        {
            AuditLog::create(array(
                'ip'=>Request::ip(),
                'access_by'=>$access_by,
                'description'=>$description,
                'status'=>$status
            ));
        }
}


if (!function_exists("getCurrentUrl"))
{

    function getCurrentUrl() {

        return Route::getFacadeRoot()->current()->uri();
    }

}


if (!function_exists("changeDateFormat"))
{

    function changeDateFormat($date, $format = 'Y-m-d') {
        if (!$date)
        {
            return '';
        }
        $fromDate = new DateTime($date);
        return $fromDate->format($format);
    }

}