<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use App\Url;

/**
 * URL test
 * @author Diego Andre Poli <diegoandrepoli@gmail.com>
 */
class UrlTest extends TestCase {
	
    /**
     * Create user API test
     * @test
     */	
    public function testCreateUrlApi(){        	   
    	//create input data
    	$userId = rand(); 		   	
    	$userInput = ['id' => $userId];
    	
    	$url = ['url' => rand()];
 		
    	//insert user
    	$response = $this->json('POST', '/users', $userInput);
    	
    	//insert url
    	$response = $this->json('POST', sprintf('/users/%s/urls', $userId), $url);
    	    
    	//check response    
    	$response->assertStatus(200);
    }
    
    /**
     * Delete user API test
     * @test
     */
    public function testDeleteUrlApi(){
    	//create input data
    	$userId = rand();
    	$userInput = ['id' => $userId];
    	 
    	$url = ['url' => rand()];
    		
    	//insert user
    	$response = $this->json('POST', '/users', $userInput);
    	 
    	//insert url
    	$response = $this->json('POST', sprintf('/users/%s/urls', $userId), $url);
    	
    	//get url id
    	$id = json_decode($response->getContent())->id;
    	
    	//chec exist in database
    	$this->assertDatabaseHas('lk_urls', [ 'id' => $id ]);    	        	   
    }    
}
