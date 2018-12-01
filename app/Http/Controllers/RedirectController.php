<?php
namespace App\Http\Controllers;

use App\Url;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Lib\Utils\UrlUtils;

/**
 * Redirect controller
 * @author Diego Andre Poli <diegoandrepoli@gmail.com>
 */
class RedirectController extends Controller {
	
	/**
	 * Redirect to shorted url
	 * @param Request $request
	 * @param string $id
	 */
	public function redirect(Request $request, $id){
		//get url from redirect and hit increment
		$url = (new Url())->getUrlForRedirect($id);
		 				
		//redirect on type 301
		return Redirect::to(UrlUtils::getUrlByResult($url), 301);
	}	
}
