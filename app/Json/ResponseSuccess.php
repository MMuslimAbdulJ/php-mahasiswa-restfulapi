<?php
/**
 * Json template for response success
 */
namespace muslim\restfulapi\Json;

if($data == null) {
    $json = array(
        'code' => $code,
        'status' => $status
    );
} else {
    $json = array(
        'code' => $code,
        'status' => $status,
        'data' => [
            'nim' => $data->mahasiswa->nim,
            'nama' => $data->mahasiswa->nama,
            'fakultas' => $data->mahasiswa->fakultas,
            'prodi' => $data->mahasiswa->prodi
        ]
    );
}

header('Accept : application/json');
http_response_code($code);
echo json_encode($json, JSON_PRETTY_PRINT);
?>