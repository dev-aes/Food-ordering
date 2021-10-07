<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    /**
     * Custom Error Message
     */
    
    public function error($message, $code = 401)
    {
        abort($code, $message);
    }

    /**
     * Return all client request
     */
    public function all()
    {
        return $this->res(request()->all());
    }

    /**
     * Global Reponse Message
     */
    public function res($data)
    {
        return response()->json($data,201);
    }
}
