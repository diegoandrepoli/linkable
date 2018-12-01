<?php
namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Default app test
 * @author Diego Andre Poli <diegoandrepoli@gmail.com>
 */
class AppTest extends TestCase {

    /**
     * Defautl test.
     * @return void
     */
    public function testDefautl() {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
