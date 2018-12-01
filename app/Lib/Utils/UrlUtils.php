<?php

namespace App\Lib\Utils;

use App\Url;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * URL utils
 * @author Diego Andre Poli <diegoandrepoli@gmail.com>
 */
class UrlUtils {

    /**
     * Get URL by query result
     * @param Url $result
     * @return string
     */
    public static function getUrlByResult($result) {
        return (! empty($result['url'])) ? $result['url'] : null;
    }

    /**
     * check URL result
     * @param URL $url
     * @throws NotFoundHttpException - generated on URL is null
     */
    public static function isEmptyUrl($url) {
        if (self::getUrlByResult($url) == null) {
            throw new NotFoundHttpException('Object is empty');
        }
    }

    /**
     * Encapsulate data
     * @param integer $hits
     * @param integer $urlCount
     * @param array $topUrls
     * @return array
     */
    public static function statsResult($hits, $urlCount, $topUrls) {
        return [
            'hits' => $hits,
            'urlCount' => $urlCount,
            'topUrls' => [ $topUrls ]
        ];
    }
}