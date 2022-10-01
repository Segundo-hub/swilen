<?php

namespace App\Shared\Http\Controller;

use Swilen\Http\Response;

abstract class Controller
{
    /**
     * Send json response
     *
     * @param string|array|object $content
     * @param int $status
     * @param array $headers
     *
     * @return \Swilen\Http\Response
     */
    protected function send($content = '', int $status = 200, array $headers = [])
    {
        return new Response($content, $status, $headers);
    }
}
