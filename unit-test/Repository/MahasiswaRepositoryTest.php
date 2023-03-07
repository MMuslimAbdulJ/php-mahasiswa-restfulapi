<?php 

namespace muslim\restfulapi\Repository;
use PHPUnit\Framework\TestCase;
use muslim\restfulapi\Config\Database;
use muslim\restfulapi\Entity\Mahasiswa;
use muslim\restfulapi\Repository\MahasiswaRepository;

class MahasiswaRepositoryTest extends TestCase {

    private MahasiswaRepository $mahasiswaRepository;

    public function setUp() : void {
        $this->mahasiswaRepository = new MahasiswaRepository(Database::getConnection());
        $this->mahasiswaRepository->deleteAll();
    }

    public function testSave() : void {
        $mahasiswa = new Mahasiswa;
        $mahasiswa->nim = '217200035';
        $mahasiswa->nama = 'Muhammad Muslim Abdul Jabbaar';
        $mahasiswa->fakultas = 'Teknik';
        $mahasiswa->prodi = 'Teknik Informatika';

        $result = $this->mahasiswaRepository->save($mahasiswa);
        self::assertEquals($mahasiswa->nim, $result->nim);
        self::assertEquals($mahasiswa->nama, $result->nama);
        self::assertEquals($mahasiswa->fakultas, $result->fakultas);
        self::assertEquals($mahasiswa->prodi, $result->prodi);
    }

    public function testFindById() : void {
        $mahasiswa = new Mahasiswa;
        $mahasiswa->nim = '217200035';
        $mahasiswa->nama = 'Muhammad Muslim Abdul Jabbaar';
        $mahasiswa->fakultas = 'Teknik';
        $mahasiswa->prodi = 'Teknik Informatika';

        $this->mahasiswaRepository->save($mahasiswa);
    
        $result = $this->mahasiswaRepository->findByNim($mahasiswa->nim);

        self::assertEquals($mahasiswa->nim, $result->nim);
        self::assertEquals($mahasiswa->nama, $result->nama);
        self::assertEquals($mahasiswa->fakultas, $result->fakultas);
        self::assertEquals($mahasiswa->prodi, $result->prodi);
    }

    public function testFindByNimNotFound() : void {
        $result = $this->mahasiswaRepository->findByNim('notfound');
        self::assertNull($result);
    }

    public function testUpdate() : void {
        $mahasiswa = new Mahasiswa;
        $mahasiswa->nim = '217200035';
        $mahasiswa->nama = 'Muhammad Muslim Abdul Jabbaar';
        $mahasiswa->fakultas = 'Teknik';
        $mahasiswa->prodi = 'Teknik Informatika';

        $this->mahasiswaRepository->save($mahasiswa);

        $mahasiswa->fakultas = 'Ilmu Komputer';

        $this->mahasiswaRepository->update($mahasiswa);

        $update = $this->mahasiswaRepository->findByNim($mahasiswa->nim);

        self::assertEquals($mahasiswa->nim, $update->nim);
        self::assertEquals($mahasiswa->nama, $update->nama);
        self::assertEquals('Ilmu Komputer', $update->fakultas);
        self::assertEquals($mahasiswa->prodi, $update->prodi);
    }

    public function testDelete() : void {
        $mahasiswa = new Mahasiswa;
        $mahasiswa->nim = '217200035';
        $mahasiswa->nama = 'Muhammad Muslim Abdul Jabbaar';
        $mahasiswa->fakultas = 'Teknik';
        $mahasiswa->prodi = 'Teknik Informatika';

        $this->mahasiswaRepository->save($mahasiswa);
        $this->mahasiswaRepository->deleteByNim($mahasiswa->nim);

        $result = $this->mahasiswaRepository->findByNim($mahasiswa->nim);
        self::assertNull($result);
    }

}

?>