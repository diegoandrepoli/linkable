<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

/**
 * Users controller
 * @author Diego Andre Poli <diegoandrepoli@gmail.com>
 */
class UsersController extends Controller {

	/**
	 * Add user
	 * @param Request $request
	 * @return \App\User
	 */
    public function add(Request $request) {
    	try{    		 
    		//capture id
    		$id = $request->input('id');    		    
    	
    		//save user
    		$result = (new User())->saveUser($id);    
    	
    		//return user
    		return $result;
    	}catch(Exception $e){
    		return $e->getMessage();
    	}
    }
    
    /**
     * Delete user
     * @param Request $request
     * @param string $id
     */
    public function delete($id){    
    	try{
    		(new User())->deleteById($id);
    	}catch (\Exception $e){
    		return $e->getMessage();	
    	}
    }
}