<?php

namespace App\Http\Controllers\API\v1;

use App\Services\DTO\LogDto;
use App\Http\Controllers\Controller;
use App\Http\Resources\SiteLoggerResource;
use App\Models\SiteLogger;
use App\Repositories\QueryFilters\SiteLoggerQFB;
use App\Services\SiteLoggerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class SiteLoggerController extends Controller
{
    private SiteLoggerService $service;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->service = app(SiteLoggerService::class);
    }

    /**
     * @param SiteLoggerQFB $qb
     * @return AnonymousResourceCollection
     */
    public function index(SiteLoggerQFB $qb): AnonymousResourceCollection
    {
        return SiteLoggerResource::collection($this->service->filter($qb));
    }

    /**
     * Get the specified item by ID.
     *
     * @param string $_id
     * @return SiteLoggerResource
     */
    public function show(string $_id): SiteLoggerResource
    {
        SiteLoggerResource::withoutWrapping();
        return new SiteLoggerResource($this->service->getItem($_id));
    }

    /**
     * Store Item
     *
     * @throws ValidationException
     */
    public function store(Request $request, LogDto $dto): JsonResponse
    {
        $siteLogger = new SiteLogger();
        /**
         * FormRequests are not supported by Lumen :(
         *
         * ToDO: Make own package for convenient validation
         */
        $this->validate($request, $siteLogger->rules());

        $model = $this->service->fullSave($siteLogger, $dto->createFromArray($request->toArray())->toArray());

        return response()->json([
            'status' => 'created',
            'data' => $this->show($model->_id),
        ]);
    }


    /**
     * Remove the specified items by IDs.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function destroyMultiple(Request $request): JsonResponse
    {
        /**
         * FormRequests are not supported by Lumen :(
         */
        $this->validate($request, ['ids' => ['required', 'array']]);

        $this->service->deleteMultiple($request->get('ids'));

        return response()->json(['status' => 'deleted']);
    }

    /**
     * Ping SiteLogger Microservice
     *
     * @return JsonResponse
     */
    public function ping(): JsonResponse
    {
        return response()->json('PONG: SiteLogger ping successfully');
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

    /**
     * Store Item
     *
     * @throws Exception
     */
    public function clean(Request $request): JsonResponse
    {
        $msg = $this->service->clean($request->input());
        return response()->json($msg);
    }
}
