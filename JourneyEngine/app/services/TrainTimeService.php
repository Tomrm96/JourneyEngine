<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

class TrainTimeService
{

    protected $API_KEY;
    protected $URL;
    protected $client;

    public function __construct()
    {
        $this->API_KEY = env('API_KEY');
        $this->URL = env('API_URL');
        $this->client = Http::baseUrl($this->URL);
    }

    public function getArrBoardWithDet($query)
    {
        try {
            $response = $this->client->withHeaders(
                [
                    'x-apikey' => $this->API_KEY,
                ]
            )->get(
                "/{$query['crs']}",
                [
                    'query' =>
                    [
                        'numRows' => $query['numRows'] ?? null,
                        'filterCrs' => $query['filterCrs'] ?? null,
                        'filterType' => $query['filterType'] ?? null,
                        'timeOffset' => $query['timeOffset'] ?? null,
                        'timeWindow' => $query['timeWindow'] ?? null,
                    ]
                ]
            );
            $data = json_decode($response->getBody(), true);

            if (isset($data['error_message'])) {
                throw new Exception($data['error_message']);
            }
            return $data;
        } catch (Exception $e) {
            throw new Exception('Error Fetching Data from the Train API: ' . $e->getMessage());
        }
    }
}
