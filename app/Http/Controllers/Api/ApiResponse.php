<?php
/**
 * Created by PhpStorm.
 * User: gerson
 * Date: 1/05/17
 * Time: 2:40 PM
 */

namespace App\Http\Controllers\Api;


class ApiResponse
{
    public $data = [];
    public $status;

    function __construct($data = null, $statusCode = null)
    {
        if($data) $this->data = $data;
        $this->status = new Status();
        if($statusCode != null) $this->status->setStatus($statusCode);
        else $this->status->setStatus(Status::PROCESS_COMPLETE);
    }
}