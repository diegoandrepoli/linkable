<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * User Model
 * @author Diego Andre Poli <diegoandrepoli@gmail.com>
 */
class User extends Model {
 
  	 /**
  	  * User table database
  	  */
	 protected $table = 'lk_users';
	 
	 /**
	  * Hidden fields
	  */
	 protected $hidden = [	 	
	 	'updated_at', 	 		
	 	'created_at'	 		
	 ];
	 
	 /**
	  * Save user
	  * @param string $id
	  * @return array
	  */
	 public function saveUser($id) {	 		 	
	 	$this->id = $id;	 	
	 	return $this->save();
	 }
	 
	 /**
	  * Delete user by id
	  * @param string $id
	  */
	 public function deleteById($id) {
	 	self::find($id)->delete();
	 }
}
