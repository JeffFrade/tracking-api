<?php

namespace App\Http;

use App\Core\Support\Controller;
use App\Core\Support\Response;
use App\Exceptions\PackageStatusNotFoundException;
use App\Services\PackageStatus;
use Illuminate\Http\Request;

class PackageStatusController extends Controller
{
    use Response;

    /**
     * @var PackageStatus
     */
    private $packageStatus;

    /**
     * PackageStatusController constructor.
     * @param PackageStatus $packageStatus
     */
    public function __construct(PackageStatus $packageStatus)
    {
        $this->packageStatus = $packageStatus;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $params = $request->all();
            $data = $this->packageStatus->index($params);

            return response()->json($this->sendResponse($data, 1), 200);
        } catch (\Throwable $throwable) {
            return $this->handleException($throwable);
        }
    }

    /**
    * @param \Throwable $throwable
    * @return \Illuminate\Http\JsonResponse
    */
    private function handleException(\Throwable $throwable)
    {
        switch ($throwable) {
            case $throwable instanceof \InvalidArgumentException:
            case $throwable instanceof PackageStatusNotFoundException:
                $statusCode = 400;
                break;
            default:
                $statusCode = 500;
        }

        return response()->json($this->sendResponse($throwable->getMessage(), 0, 'error'), $statusCode);
    }
}
