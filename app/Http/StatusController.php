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
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $params = $this->toValidate($request);
            $data = $this->status->store($params);

            return response()->json($this->sendResponse($data, 1), 200);
        } catch (\Throwable $throwable) {
            return $this->handleException($throwable);
        }
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        try {
            $data = $this->status->show($id);

            return response()->json($this->sendResponse($data, 1), 200);
        } catch (\Throwable $throwable) {
            return $this->handleException($throwable);
        }
    }

    /**
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, int $id)
    {
        try {
            $params = $this->toValidate($request);
            $data = $this->status->update($id, $params);

            return response()->json($this->sendResponse($data, 1), 200);
        } catch (\Throwable $throwable) {
            return $this->handleException($throwable);
        }
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(int $id)
    {
        try {
            $this->status->delete($id);

            $data = [
                'id' => $id,
                'deleted' => true
            ];

            return response()->json($this->sendResponse($data, 1), 200);
        } catch (\Throwable $throwable) {
            return $this->handleException($throwable);
        }
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    private function toValidate(Request $request)
    {
        $validation = $this->validate($request, [
            'status' => 'required|max:65535',
        ]);

        if (empty($validation['error']) === false) {
            throw new \InvalidArgumentException($validation['error']);
        }

        return $validation;
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
