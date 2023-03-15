<?php 
namespace muslim\restfulapi\Controller;
use muslim\restfulapi\Config\Database;
use muslim\restfulapi\Entity\Mahasiswa;
use muslim\restfulapi\Repository\MahasiswaRepository;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use muslim\restfulapi\Controller\MahasiswaController;
use SebastianBergmann\Type\VoidType;

class MahasiswaControllerTest extends TestCase {

    private MahasiswaRepository $mahasiswaRepository;
    private MahasiswaController $mahasiswaController;
    private Client $client;

    public function setUp() : void {
        $this->mahasiswaRepository = new MahasiswaRepository(Database::getConnection());
        $this->mahasiswaController = new MahasiswaController;
        $this->client = new Client([
            'base_uri' => 'http://localhost:8080'
        ]);

        $this->mahasiswaRepository->deleteAll();
    }

    public function testCreateMahasiswa() {
        $response = $this->client->request('POST', 'api/mahasiswa', [
            'json' => [
                'nim' => '217200099',
                'nama' => 'Eren Yeager',
                'fakultas' => 'Teknik',
                'prodi' => 'Teknik Informatika'
            ]
        ]);

        $body = $response->getBody();
        $json = json_decode($body);
        $code = $response->getStatusCode();

        self::assertEquals('Created', $json->status);
        self::assertEquals(201, $code);
        self::assertEquals('217200099', $json->data->nim);
        self::assertEquals('Eren Yeager', $json->data->nama);
        self::assertEquals('Teknik', $json->data->fakultas);
        self::assertEquals('Teknik Informatika', $json->data->prodi);
    }

    public function testGetMahasiswa() {
        $mahasiswa = new Mahasiswa();
        $mahasiswa->nim = '217200050';
        $mahasiswa->nama = 'M Muslim Abdul J';
        $mahasiswa->fakultas = 'Teknik';
        $mahasiswa->prodi = 'Teknik Informatika';
        $this->mahasiswaRepository->save($mahasiswa);

        $response = $this->client->request('GET','/api/mahasiswa/217200050', );
        $body = $response->getBody() ;
        $json = json_decode($body);
        $code = $response->getStatusCode();

        self::assertEquals(200, $code);
        self::assertEquals($mahasiswa->nim, $json->data->nim);
        self::assertEquals($mahasiswa->nama, $json->data->nama);
        self::assertEquals($mahasiswa->fakultas, $json->data->fakultas);
        self::assertEquals($mahasiswa->prodi, $json->data->prodi);
    }

    public function testUpdateMahasiswa() {
        $mahasiswa = new Mahasiswa();
        $mahasiswa->nim = '217200050';
        $mahasiswa->nama = 'M Muslim Abdul J';
        $mahasiswa->fakultas = 'Teknik';
        $mahasiswa->prodi = 'Teknik Informatika';
        $this->mahasiswaRepository->save($mahasiswa);

        $response = $this->client->request('PUT', '/api/mahasiswa/217200050', [
            'json' => [
                'nama' => 'Eren Yeager',
                'fakultas' => 'Komputer dan Teknologi Informasi',
                'prodi' => 'Ilmu Komputer'
            ]
        ]);
        $body = $response->getBody();
        $json = json_decode($body);
        $code = $response->getStatusCode();

        self::assertEquals(200, $code);
        self::assertEquals('Updated successfully', $json->status);
        self::assertEquals('217200050', $json->data->nim);
        self::assertEquals('Eren Yeager', $json->data->nama);
        self::assertEquals('Komputer dan Teknologi Informasi', $json->data->fakultas);
        self::assertEquals('Ilmu Komputer', $json->data->prodi);
    }

    public function testDeleteMahasiswa() {
        $mahasiswa = new Mahasiswa();
        $mahasiswa->nim = '217200050';
        $mahasiswa->nama = 'M Muslim Abdul J';
        $mahasiswa->fakultas = 'Teknik';
        $mahasiswa->prodi = 'Teknik Informatika';
        $this->mahasiswaRepository->save($mahasiswa);

        $response = $this->client->request('DELETE', '/api/mahasiswa/217200050');
        $body = $response->getBody();
        $json = json_decode($body);
        $code = $response->getStatusCode();

        self::assertEquals(200, $code);
        self::assertEquals('Delete success', $json->status);
    }

    public function tearDown() : void {
        $this->mahasiswaRepository->deleteAll();
    }
}

?>