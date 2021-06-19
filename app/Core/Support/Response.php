<?php

namespace App\Core\Support;

trait Response
{
    /**
     * Return array response
     *
     * @param $message
     * @param int $code
     * @param string $messageField
     * @return array
     */
    public function sendResponse($message, int $code = 0, string $messageField = 'data')
    {
        return [
            $messageField => $message,
            'code' => $code
        ];
    }

}
