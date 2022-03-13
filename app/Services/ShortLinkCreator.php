<?php

namespace App\Services;


class ShortLinkCreator
{

    public function getHash(): string
    {
        $arr = str_split("qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890");
        shuffle($arr);
        $str = implode('', $arr);
        return substr($str, 0 , 6);
    }
}
