<?php

namespace munkireport\controller;

use MR\Kiss\Controller;
use MR\Kiss\View;

class Error extends Controller
{
    public function __construct()
    {
    }

    /**
     * Client error, displays an http error page
     *
     **/
    public function client_error($status_code = 404)
    {
        $data = array('status_code' => $status_code);

        mr_view('error/client_error', $data);
    }
}
