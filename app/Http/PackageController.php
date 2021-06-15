<?php

namespace App\Http;

use App\Core\Support\Controller;
use App\Services\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
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

    public function index(Request $request)
    {
        dd("Ok");
    }
}
