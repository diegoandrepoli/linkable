<?php 

namespace App\Lib\Cache;

/**
 * Implement cache on URL
 * @author Diego Andre Poli <diegoandrepoli@gmail.com>
 */
class UrlCache extends SysCache {

	/**
	 * Do not send hit to cache system, the update only database
	 * @param array $url
	 */
	private static function unsetHit($url) {
		unset($url['hits']);
	}
	
	/**
	 * Get id from URL
	 * 
	 * @param array $url
	 * @return string
	 */
	private static function urlId($url) {
		return $url['id'];
	}
	
	/**
	 * Set URL in system cache 
	 * @param object $url
	 */
	public static function set($url) {
		self::unsetHit($url);
		parent::write(self::urlId($url), $url);
	}
	
	/**
	 * Get URL on cache by key
	 * @param integer $key
	 * @return array
	 */
	public static function get($key) {
		return parent::red($key);
	}
	
	/**
	 * Remove item cache
	 * @param integer $key
	 */
	public static function remove($key) {
		parent::remove($key);
	}
}