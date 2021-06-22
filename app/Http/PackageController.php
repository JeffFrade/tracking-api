<?php

namespace App\Http;

use App\Core\Support\Controller;
use App\Core\Support\Response;
use App\Exceptions\PackageNotFoundException;
use App\Services\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    use Response;

    /**
     * @var Package
     */
    private $package;

    /**
     * PackageController constructor.
     * @param Package $package
     */
    public function __construct(Package $package)
    {
        $this->package = $package;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $params = $request->all();
            $data = $this->package->index($params);

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
            $data = $this->package->store($params);

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
            $data = $this->package->show($id);

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
            $data = $this->package->update($id, $params);

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
            $this->package->delete($id);

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
            'name' => 'required|max:255',
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
            case $throwable instanceof PackageNotFoundException:
                $statusCode = 400;
                break;
            default:
                $statusCode = 500;
        }

        return response()->json($this->sendResponse($throwable->getMessage(), 0, 'error'), $statusCode);
    }
}
