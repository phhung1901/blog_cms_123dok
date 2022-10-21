<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Admin\Log\LogService;
use Illuminate\Http\File;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index()
    {
        $files = LogService::getFiles();


    }
}
