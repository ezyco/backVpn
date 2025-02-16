<?php

namespace App\Http\Controllers;

use App\Http\Resources\SubscriptionResource;
use App\Models\Subscription;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subs = Subscription::all();
        return SubscriptionResource::collection($subs);
    }
}
