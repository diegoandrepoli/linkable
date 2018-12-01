<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Lib\Url\ShortUrl;

/**
 * Short url test
 * @author Diego Andre Poli <diegoandrepoli@gmail.com>
 */
class ShortUrlTest extends TestCase {
    
    /**
     * Test get url
     * @test
     */
    public function testGetUrl() {    	
        $url = ShortUrl::get();
        $this->assertNotEmpty($url);      
    }

    /**
     * Test URL size
     * @test
     */
    public function testLenght(){
    	$url = ShortUrl::get();
    	
    	//string size
    	$lenght = 5;
    	
    	//check size
    	$isLenght = (strlen($url) == $lenght)
    		? true 
    		: false;
    	 
    	$this->assertTrue($isLenght);
    }
}
