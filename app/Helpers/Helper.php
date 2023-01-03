<?php


namespace App\Helpers;


use App\Models\Order;
use App\Models\OrderLine;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;

class Helper
{

    public static function PasswordValidator($password)
    {

        return ( strlen($password) < 4) ;
    }

    public static function generateApikey(){
        return md5(uniqid(rand(), true));
    }

    public static function getSqlWithBindings($query)
    {
        return vsprintf(str_replace('?', '%s', $query->toSql()), collect($query->getBindings())->map(function ($binding) {
            return is_numeric($binding) ? $binding : "'{$binding}'";
        })->toArray());
    }
}
