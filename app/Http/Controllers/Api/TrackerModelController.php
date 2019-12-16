<?php

namespace App\Http\Controllers\Api;

use App\TrackerModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\TrackerModelResource;

class TrackerModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trackerModels = TrackerModel::all();
        return TrackerModelResource::collection($trackerModels);
    }
}
