<?php

namespace muslim\restfulapi\App;

use muslim\restfulapi\Entity\Mahasiswa;
use muslim\restfulapi\Model\MahasiswaResponse;

class Json
{
    public static function responseSuccess(string $status, int $code, ?MahasiswaResponse $data = null)
    {
        require __DIR__ . './../Json/ResponseSuccess.php';
    }

    public static function responseError(string $status, int $code, ?\Exception $exception = null)
    {
        require __DIR__ . './../Json/ResponseError.php';
    }

}


?>