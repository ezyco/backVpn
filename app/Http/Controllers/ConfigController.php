<?php

namespace App\Http\Controllers;

use App\Http\Resources\ConfigResource;
use App\Models\Config;

class ConfigController extends Controller
{
    public function index()
    {
        $configs = Config::query()->get();
        return ConfigResource::collection($configs)->collection->groupBy('country');
    }
}
