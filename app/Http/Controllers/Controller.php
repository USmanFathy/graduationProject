<?php

namespace App\Http\Controllers;

use App\Excel\ExcelService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public $excelService;

    public function __construct()
    {
        /**  Why ..... It maybe not required to be initialized */
        $this->excelService = new ExcelService();
    }
}
