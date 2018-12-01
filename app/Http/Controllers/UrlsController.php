<?php
namespace App\Http\Controllers;

use App\Url;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Lib\Utils\UrlUtils;
use Illuminate\Support\Facades\Redis;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Lib\Api\ApiResult;
use App\Lib\Cache\SysCache;

/**
 * Urls controller
 * @author Diego Andre Poli <diegoandrepoli@gmail.com>
 */
class UrlsController extends Controller {

    /**
     * Add URL
     * @param Request $request
     * @return \App\User
     */
    public function add(Request $request, $userId) {
        try {
            //capture request URL parameter
            $url = $request->input('url');

            //add database URL and on cache service
            return (new Url())->addUrlCached($url, $userId);
        } catch (\Exception $e) {
            return ApiResult::get($e->getCode(), $e->getMessage());
        }
    }

    /**
     * Get URL stats by id
     * @param Request $request
     * @param string $id
     * @return object
     */
    public function get(Request $request, $id) {
        return (new Url())->getById($id);
    }

    /**
     * Remove URL by id
     * @param Request $request
     * @param string $id
     */
    public function delete($id) {
        try {
            (new Url())->deleteByIdCached($id);
        } catch (Exceptio $e) {
            return $e->getMessage();
        }
    }

    /**
     * Get URL stats
     * @return object
     */
    public function stats() {
        return (new Url())->getStats();
    }

    /**
     * Get stats by user id
     * @param Request $request
     * @param string $userId
     * @return object[]
     */
    public function userStats($userId) {
        return (new Url())->getStatsByUserId($userId);
    }
}