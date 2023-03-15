<?php
namespace muslim\restfulapi\Json;

if(isset($data) && $data != null) {
    $json = array(
        'status' => $status,
        'code' => $code,
        'error' => $exception->getMessage(),
        'data' => null
    );
} else {
    $json = array(
        'status' => $status,
        'code' => $code,
        'error' => $exception->getMessage()
    );
}

header('Accept : application/json');
http_response_code($code);
echo json_encode($json, JSON_PRETTY_PRINT);
?>