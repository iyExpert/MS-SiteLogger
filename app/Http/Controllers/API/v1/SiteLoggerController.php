<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Repositories\SiteLoggerRepository;
use App\Services\SiteLoggerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class SiteLoggerController extends Controller
{
    private SiteLoggerService $service;
    private SiteLoggerRepository $repository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->service = app(SiteLoggerService::class);
        $this->repository = app(SiteLoggerRepository::class);
    }

    /**
     * Ping SiteLogger Microservice
     *
     * @return JsonResponse
     */
    public function ping(): JsonResponse
    {
        return response()->json('SiteLogger ping successfully');
    }

    /**
     * Ping SiteLogger Microservice connection to DB
     *
     * @return JsonResponse
     */
    public function pingDB(): JsonResponse
    {
        if(DB::connection()->getDatabaseName()){
            return response()->json('SiteLogger PingDB successfully. Database: ' . DB::connection()->getDatabaseName());
        }else{
            return response()->json('Could not connect to database.', 500);
        }
    }
}
