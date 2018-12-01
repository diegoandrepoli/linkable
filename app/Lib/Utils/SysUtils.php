<?php

namespace App\Lib\Utils;

/**
 * System utilities
 * @author Diego Andre Poli <diegoandrepoli@gmail.com>
 */
class SysUtils {
	
    /**
     * Get system base URL
     * @return string
     */
	public static function baseUrl() {
		return \Illuminate\Support\Facades\URL::to('/') . '/';
	}
	
}