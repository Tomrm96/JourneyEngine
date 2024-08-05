<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;


class MapsService
{

    protected $API_KEY;
    protected $API_URL;
    protected $client;


    public function __construct()
    {
        $this->API_KEY = env('google_API_Key');
        $this->API_URL = env('google_API_URL');
        $this->client = Http::baseUrl($this->API_URL);
    }



    public function getTraffic($query)
    {
        try {

            $response = $this->client->get(
                '/directions/json',
                [
                    'key' => $this->API_KEY,
                    'origin' => $query['origin'],
                    'destination' => $query['destination'],
                    'traffic_model' => $query['traffic_model'],
                    'departure_time' => $query['departure_time'],
                ]
            );


            $data = json_decode($response->getbody(), true);

            if (isset($data['error_message'])) {
                throw new Exception($data['error_message']);
            }

            return $data;
        } catch (Exception $e) {
            throw new Exception('Error Fetching Data from the Maps API: ' . $e->getMessage());
        }
    }
}
