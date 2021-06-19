<?php

namespace App\Http;

use App\Core\Support\Controller;
use App\Core\Support\Response;
use App\Exceptions\StatusNotFoundException;
use App\Services\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    use Response;

    /**
     * @var Status
     */
    private $status;

    /**
     * StatusController constructor.
     * @param Status $status
     */
    public function __construct(Status $status)
    {
        $this->status = $status;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $params = $request->all();
            $data = $this->status->index($params);

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
            case $throwable instanceof StatusNotFoundException:
                $statusCode = 400;
                break;
            default:
                $statusCode = 500;
        }

        return response()->json($this->sendResponse($throwable->getMessage(), 0, 'error'), $statusCode);
    }
}
