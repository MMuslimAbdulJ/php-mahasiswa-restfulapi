<?php 
namespace muslim\restfulapi\Controller;
use PHPUnit\Framework\TestCase;
use muslim\restfulapi\Controller\MahasiswaController;

class MahasiswaControllerTest extends TestCase {
    private MahasiswaController $mahasiswaController;

    public function setUp() : void {
        $this->mahasiswaController = new MahasiswaController;
    }

    public function testMahasiswaController() : void {
        $this->mahasiswaController->index();
        self::expectOutputRegex("[Mahasiswa Page]");
    }
    
}

?>