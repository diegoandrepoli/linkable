<?php
namespace App\Lib\Cache;

/**
 * System cache manipulate
 * @author Diego Andre Poli <diegoandrepoli@gmail.com>
 */
class SysCache {
	
	/**
	 * Engine cache name
	 */
	const ENGINE = 'redis';	
	
	/**
	 * Write content on cache
	 * @param string $key
	 * @param string $content
	 */
	public static function write($key, $content) {
		\Cache::store(self::ENGINE)->put($key, $content, 10);
	}
		
	/**
	 * Get on cache by key
	 * @param string $key
	 * @return object
	 */
	public static function red($key) {
		return \Cache::store(self::ENGINE)->get($key);
	}
	
	/**
	 * Invalid cache node
	 * @param string $key
	 */
	public static function remove($key) {
		\Cache::store(self::ENGINE)->forget($key);		
	}
}