<?php 

namespace muslim\restfulapi\Controller;
use muslim\restfulapi\App\Json;
use muslim\restfulapi\Model\CreateMahasiswaRequest;
use muslim\restfulapi\Model\DeleteMahasiswaRequest;
use muslim\restfulapi\Model\GetMahasiswaRequest;
use muslim\restfulapi\Model\UpdateMahasiswaRequest;
use muslim\restfulapi\Repository\MahasiswaRepository;
use muslim\restfulapi\Service\Impl\MahasiswaServiceImpl;
use muslim\restfulapi\Config\Database;

class MahasiswaController {
    
    private MahasiswaServiceImpl $mahasiswaService;

    public function __construct() {
        $connection = Database::getConnection();
        $mahasiswaRepository = new MahasiswaRepository($connection);
        $this->mahasiswaService = new MahasiswaServiceImpl($mahasiswaRepository);
    }

    public function createMahasiswa() {
        $data = json_decode(file_get_contents("php://input"));
        $request = new CreateMahasiswaRequest();
        $request->nim = $data->nim;
        $request->nama = $data->nama;
        $request->fakultas = $data->fakultas;
        $request->prodi = $data->prodi;
        try {
            $response = $this->mahasiswaService->create($request);
            Json::responseSuccess('Created', 201, $response);
        }catch(\Exception $exception) {
            Json::responseError('Unprocessable Entity', 422, $exception);
        }
    }

    public function getMahasiswa(string $nimMahasiswa) {
        $request = new GetMahasiswaRequest();
        $request->nim = $nimMahasiswa;
        try{
            $response = $this->mahasiswaService->get($request);
            Json::responseSuccess('OK', 200, $response);
        } catch(\Exception $exception) {
            Json::responseError('Not Found', 404, $exception);
        }
    }

    public function updateMahasiswa(string $nimMahasiswa) {
        $data = json_decode(file_get_contents("php://input"));
        $request = new UpdateMahasiswaRequest();
        $request->nama = $data->nama;
        $request->fakultas = $data->fakultas;
        $request->prodi = $data->prodi;
        try {
            $response = $this->mahasiswaService->update($request, $nimMahasiswa);
            Json::responseSuccess('Updated successfully', 200, $response);
        } catch(\Exception $exception) {
            Json::responseError('Not Acceptable', 406, $exception);
        }
    }

    public function deleteMahasiswa(string $nimMahasiswa) {
        $request = new DeleteMahasiswaRequest();
        $request->nim = $nimMahasiswa;
        try {
            $response = $this->mahasiswaService->delete($request);
            Json::responseSuccess($response, 200);
        } catch(\Exception $exception) {
            Json::responseError('Resource does not exists', 404, $exception);
        }
    }


    

}

?>