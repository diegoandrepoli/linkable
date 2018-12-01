<?php
namespace App\Lib\Api;

/**
 * Api result
 * @author Diego Andre Poli <diegoandrepoli@gmail.com>
 */
class ApiResult {

    /**
     * Message type key
     */
    const TYPE = 'type';

    /**
     * Message code key
     */
    const CODE = 'code';

    /**
     * Message key
     */
    const MESSAGE = 'message';

    /**
     * Format API error message by error code, messa and type
     * @param string $code
     * @param string $message
     * @param string $type
     * @return string[]
     */
    public static function get($code, $message, $type = 'error') {
        return [
            self::TYPE => $type,
            self::CODE => $code,
            self::MESSAGE => $message
        ];
    }
}
