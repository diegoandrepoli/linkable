<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Lib\Url\ShortUrl;
use App\Lib\Utils\UrlUtils;
use App\Lib\Cache\UrlCache;
use App\Lib\Utils\SysUtils;

/**
 * URL model
 * @author Diego Andre Poli <diegoandrepoli@gmail.com>
 */
class Url extends Model {
	
	/**
	 * Column id key
	 */
	const ID = 'id';
	
	/**
	 * Column hits key
	 */
	const HITS = 'hits'; 
	
	/**
	 * Column URL key
	 */
	const URL = 'url';
	
	/**
	 * Column shortUrl key
	 */
	const SHORTURL = 'shortUrl';
	
	/**
	 * Column user_id
	 */
	const USER_ID = 'user_id';	
 
  	 /**
  	  * User table database
  	  */
	 protected $table = 'lk_urls';
	 
	 /**
	  * Hidden fields
	  */
	 protected $hidden = [
	 	self::USER_ID,
	 	'updated_at', 	 		
	 	'created_at'	 		
	 ];
	 
	 /**
	  * User relationship
	  * @return object HasOne
	  */
	 public function user_id() {
	 	return $this->belongsTo('App\User');
	 }
	 
	 /**
	  * Get hits
	  * @return object
	  */
	 public function getHits() {
	 	return self::sum(self::ID);
	 }	 	 	 
	 
	 /**
	  * Get hits by user
	  * @return object
	  */
	 public function getHitsByUser($userId) {
	 	return self::select(self::HITS)->where(self::USER_ID, '=', $userId)->sum(self::HITS);
	 }	 
	 
	 /**
	  * Get URL count
	  * @return integer
	  */
	 public function getUrlCount() {
	 	return self::select(self::ID)->count();	
	 }
	 
	 /**
	  * Get URL count by user id
	  * @return integer
	  */
	 public function getUrlCountByUserId($userId) {	 
	 	return self::select(self::ID)->where(self::USER_ID, '=', $userId)->count();
	 }
	 
	 /**
	  * Increment hit
	  * lockForUpdate: prevent concurrency
	  * @param integer $id
	  */
	 public function incrementHit($id) {
	     $this->whereId($id)->lockForUpdate()->increment('hits');
	 }
	 
	 /**
	  * Check is short URL
	  */
	 public function isShortUrl($sh) {
	     return $this->where('shortUrl', $sh)->first();
	 }
	 
	 /**
	  * Get URL by id
	  * @param string $id
	  */
	 public function deleteById($id) {
	     $url = self::find($id);
	     $url->delete();
	 }
	 
	 /**
	  * Get URL by id
	  */
	 public function getById($id) {
	     return self::find($id);
	 }
	 
	 /**
	  * Get top URLs
	  * @return object
	  */
	 public function getTopUrls() {
	 	return self::select([self::ID, self::HITS, self::URL, self::SHORTURL])
	 		->limit(10)
	 		->orderBy(self::ID, 'DESC')
	 		->get();
	 }

	 /**
	  * Get top URLs by user
	  * @return object
	  */
	 public function getTopUrlsByUserId($userId) {
	 	return self::select([self::ID, self::HITS, self::URL, self::SHORTURL])
	 		->where(self::USER_ID, '=', $userId)
	 		->limit(10)
	 		->orderBy(self::ID, 'DESC')
	 		->get();
	 }
	 
	 /**
	  * Get stats
	  * @return object
	  */
	 public function getStats() {
	 	return $this->statsResult(
	 		$this->getHits(),
	 		$this->getUrlCount(),
	 		$this->getTopUrls()
		);
	 }
	 
	 /**
	  * Get stats by user id
	  * @return object
	  */
	 public function getStatsByUserId($userId) {
	 	return $this->statsResult(
	 		$this->getHitsByUser($userId),
	 		$this->getUrlCountByUserId($userId),
	 		$this->getTopUrlsByUserId($userId)
		);
	 }
	 
	 /**
	  * Delete url from cache and database
	  * @param integer $id
	  */
	 public function deleteByIdCached($id) {
	 	//delete item from database
	 	$this->deleteById($id);
	 	
	 	//delete item from cache
	 	UrlCache::remove($id);
	 }
	 
	 /**
	  * Add URL
	  * @param string $url
	  * @return Url $url
	  */
	 public function addUrl($url, $userId) {
	 	$this->user_id = $userId;
	 	$this->hits = 0;
	 	$this->url = $url;
	 	$this->shortUrl = SysUtils::baseUrl() . $this->shortUrlGen(0);
	 	$this->save();
	 	
	 	return $this->toArray();
	 }
	 
	 /**
	  * Add url cached
	  * @param object $url
	  * @param integer $userId
	  * @return Url
	  */
	 public function addUrlCached($url, $userId) {
	 	//add url
	 	$result = $this->addUrl($url, $userId);
	 	
	 	//set cache
	 	UrlCache::set($result);
	 	return $result;
	 }
	 
	 /**
	  * Get URL by id limited on first URL
	  */
	 public function getUrlById($id) {
	 	return self::select('url')
	 		->where('id', '=', $id)
	 		->limit(1)
	 		->get();
	 }
	 
	 /**
	  * Get shorted paramenter for URL
	  */
	 public function shortUrlGen($count) {	 	
	 	//generate URL parameter	 
	 	$sh = ShortUrl::get();	
	 	
	 	//check is exist url
	 	$exist = $this->isShortUrl($sh);
	 	
	 	//recurvive on new parameter
	 	if ($exist !== null) {
	 		return $this->shortUrlGen(1);
	 	}
	 		 	
	 	return $sh;
	 }
	 
	 /**
	  * Consulta e incrementa URL a partir do id
	  * @param integer $id
	  * @return object
	  */
	 public function getUrlForRedirect($id) {
	 	//get URL cache
	 	$url = UrlCache::get($id);
	 	
	 	//if not exist return empty
	 	if(empty($url)){
	 		$url = $this->getUrlById($id);
	 	}
	 			 	
	 	//check url
	 	UrlUtils::isEmptyUrl($url);	 
	 		
	 	//increment hit
	 	$this->incrementHit($id);
	 	
	 	return $url;
	 }
}
