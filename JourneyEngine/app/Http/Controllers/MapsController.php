<?php

namespace App\Http\Controllers;

use App\Http\Requests\MapsValidator;
use App\Services\MapsService;
use FFI\Exception;

class MapsController extends Controller
{
    protected $mapsService;

    public function __construct(MapsService  $mapsService)
    {
        $this->mapsService = $mapsService;
    }

    public function getTraffic(MapsValidator $request)
    {
        $query = $request->validated();

        try {
            $traffic = $this->mapsService->getTraffic($query);

            return response()->json($traffic, 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500, JSON_PRETTY_PRINT);
        }
    }
}
