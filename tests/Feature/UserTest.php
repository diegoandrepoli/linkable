<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

/**
 * User test
 * @author Diego Andre Poli <diegoandrepoli@gmail.com>
 */
class UserTest extends TestCase {
	
    /**
     * Create user API test
     * @test
     */	
    public function testUserApi(){
    
    	//create input data
    	$id = rand(); 		   	
    	$input = ['id' => $id];    	    	
 		
    	//insert user
    	$response = $this->json('POST', '/users', $input);    	
    	
    	//check response
    	$response->assertStatus(200);
    }
    
    /**
     * Delete user API test
     * @test
     */  
    public function testDeleteUrlApi(){
    	//create imput data
    	$id = rand();
    	$input = ['id' => $id];
    	
    	//insert user
    	$response = $this->json('POST', '/users', $input);
    	
  		//delete user
    	$response = $this->json('DELETE', sprintf('/user/%s', $id), []);
    	
    	//check response
    	$response->assertStatus(200);    	    	
    }       
}
