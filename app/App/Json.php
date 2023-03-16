<?php
/**
 * This program is a helper for json response success and json response error
 */
namespace muslim\restfulapi\App;

use muslim\restfulapi\Model\MahasiswaResponse;

class Json
{
    public static function responseSuccess(string $status, int $code, ?MahasiswaResponse $data = null)
    {
        // it will require a json template that restore in Json folder and passing the data to the template
        require __DIR__ . './../Json/ResponseSuccess.php';
    }

    public static function responseError(string $status, int $code, ?\Exception $exception = null)
    {
        // it will require a json template that restore in Json folder and passing the data to the template
        require __DIR__ . './../Json/ResponseError.php';
    }

}


?>