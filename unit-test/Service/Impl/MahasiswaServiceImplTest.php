<?php 

namespace muslim\restfulapi\Service\Impl;
use muslim\restfulapi\Config\Database;
use muslim\restfulapi\Entity\Mahasiswa;
use muslim\restfulapi\Exception\validationException;
use muslim\restfulapi\Model\CreateMahasiswaRequest;
use muslim\restfulapi\Model\DeleteMahasiswaRequest;
use muslim\restfulapi\Model\GetMahasiswaRequest;
use muslim\restfulapi\Model\UpdateMahasiswaRequest;
use muslim\restfulapi\Repository\MahasiswaRepository;
use muslim\restfulapi\Service\Impl\MahasiswaServiceImpl;
use PHPUnit\Framework\TestCase;

class MahasiswaServiceImplTest extends TestCase {

    private MahasiswaServiceImpl $mahasiswaService;
    private MahasiswaRepository $mahasiswaRepository;

    public function setUp() : void {
        $this->mahasiswaRepository = new MahasiswaRepository(Database::getConnection());
        $this->mahasiswaService = new MahasiswaServiceImpl($this->mahasiswaRepository);

        $this->mahasiswaRepository->deleteAll();
    }

    public function testCreateMahasiswaSuccess() {
        $request = new CreateMahasiswaRequest();
        $request->nim = '217200035';
        $request->nama = 'M Muslim Abdul J';
        $request->fakultas = 'Teknik';
        $request->prodi = 'Teknik Informatika';
        $response = $this->mahasiswaService->create($request);

        self::assertEquals($request->nim, $response->mahasiswa->nim);
        self::assertEquals($request->nama, $response->mahasiswa->nama);
        self::assertEquals($request->fakultas, $response->mahasiswa->fakultas);
        self::assertEquals($request->prodi, $response->mahasiswa->prodi);
    }

    public function testCreateBodyBlank() {
        self::expectException(validationException::class);
        $request = new CreateMahasiswaRequest();
        $request->nim = '';
        $request->nama = '';
        $request->fakultas = '';
        $request->prodi = '';
        $this->mahasiswaService->create($request);
    }

    public function testCreateAlreadyExists() {
        $mahasiswa = new Mahasiswa();
        $mahasiswa->nim = '217200035';
        $mahasiswa->nama = 'M Muslim Abdul J';
        $mahasiswa->fakultas = 'Teknik';
        $mahasiswa->prodi = 'Teknik Informatika';
        $this->mahasiswaRepository->save($mahasiswa);

        self::expectException(validationException::class);

        $request = new CreateMahasiswaRequest();
        $request->nim = '217200035';
        $request->nama = 'M Muslim Abdul J';
        $request->fakultas = 'Teknik';
        $request->prodi = 'Teknik Informatika';
        $this->mahasiswaService->create($request);
    }

    public function testGetSuccess() {
        $mahasiswa = new Mahasiswa();
        $mahasiswa->nim = '217200035';
        $mahasiswa->nama = 'M Muslim Abdul J';
        $mahasiswa->fakultas = 'Teknik';
        $mahasiswa->prodi = 'Teknik Informatika';
        $this->mahasiswaRepository->save($mahasiswa);

        $request = new GetMahasiswaRequest();
        $request->nim = '217200035';
        $result = $this->mahasiswaService->get($request);

        self::assertNotNull($result);

    }

    public function testGetBlank() {
        self::expectException(validationException::class);
        $request = new GetMahasiswaRequest();
        $request->nim = '';
        $this->mahasiswaService->get($request);
    }

    public function testGetNotFound()
    {
        self::expectException(validationException::class);
        $request = new GetMahasiswaRequest();
        $request->nim = '217200035';
        $this->mahasiswaService->get($request);
    }

    public function testUpdateSuccess() {
        $mahasiswa = new Mahasiswa();
        $mahasiswa->nim = '217200035';
        $mahasiswa->nama = 'M Muslim Abdul J';
        $mahasiswa->fakultas = 'Teknik';
        $mahasiswa->prodi = 'Teknik Informatika';
        $this->mahasiswaRepository->save($mahasiswa);

        $request = new UpdateMahasiswaRequest();
        $request->nama = 'M Muslim Abdul J';
        $request->fakultas = 'Teknik';
        $request->prodi = 'Ilmu Komputer';
        $response = $this->mahasiswaService->update($request, '217200035');

        self::assertEquals('217200035', $response->mahasiswa->nim);
        self::assertEquals('M Muslim Abdul J', $response->mahasiswa->nama);
        self::assertEquals('Teknik', $response->mahasiswa->fakultas);
        self::assertEquals('Ilmu Komputer', $response->mahasiswa->prodi);
    }

    public function testUpdateBlank() {
        self::expectException(validationException::class);
        $request = new UpdateMahasiswaRequest();
        $request->nama = '';
        $request->fakultas = '';
        $request->prodi = '';
        $this->mahasiswaService->update($request, 'blank');
    }

    public function testUpdateNotFound() {
        self::expectException(validationException::class);
        $request = new UpdateMahasiswaRequest();
        $request->nama = 'M Muslim Abdul J';
        $request->fakultas = 'Teknik';
        $request->prodi = 'Ilmu Komputer';
        $this->mahasiswaService->update($request, '217200035');
    }

    public function testDeleteSuccess() {
        $mahasiswa = new Mahasiswa();
        $mahasiswa->nim = '217200035';
        $mahasiswa->nama = 'M Muslim Abdul J';
        $mahasiswa->fakultas = 'Teknik';
        $mahasiswa->prodi = 'Teknik Informatika';
        $this->mahasiswaRepository->save($mahasiswa);

        $request = new DeleteMahasiswaRequest();
        $request->nim = '217200035';
        $response = $this->mahasiswaService->delete($request);
        
        self::assertEquals('Delete success', $response);
    }

    public function testDeleteBlank() {
        self::expectException(validationException::class);
        $request = new DeleteMahasiswaRequest();
        $request->nim = '';
        $this->mahasiswaService->delete($request);
    }

    public function testDeleteNotFound() {
        self::expectException(validationException::class);
        $request = new DeleteMahasiswaRequest();
        $request->nim = '217200035';
        $this->mahasiswaService->delete($request);
    }

}

?>