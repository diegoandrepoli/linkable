<?php

namespace App\Lib\Url;

/**
 * This class generate short url paramter for url encoded
 * @author Diego Andre Poli <diegoandrepoli@gmail.com>
 */
class ShortUrl {
	
	/**
	 * String delimiter
	 * @var string
	 */
	const DELIMITER = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	
	/**
	 * Alpha substring
	 * @var string
	 */
	const ALPHA = '0';
	
	/**
	 * Non aplha substring
	 * @var string
	 */
	const NON_ALPHA = '5';
	
	/**
	 * String shufle by delimiter
	 */
	private static function shufle() {
		return str_shuffle(self::DELIMITER);
	}
	
	/**
	 * Split string from splited range
	 */
	private static function substring() {
		return substr(self::shufle(), self::ALPHA, self::NON_ALPHA);
	}
	
	/**
	 * Return the shorted url
	 */
	public static function get() {
		return self::substring();
	}
}


