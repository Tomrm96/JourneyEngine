<?php

namespace App\Http\Controllers;

use App\Services\TrainTimeService;
use App\Http\Requests\GetArrDepBoardWithDetValidator;
use Exception;

class TrainController extends Controller
{

    protected $trainTimeService;

    public function __construct(TrainTimeService $trainTimeService)
    {
        $this->trainTimeService = $trainTimeService;
    }

    public function getArrDepBoardWithDet(GetArrDepBoardWithDetValidator $request)
    {
        $query = $request->validated();
        try {
            $data =  $this->trainTimeService->getArrBoardWithDet($query);
            return response()->json($data, 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
