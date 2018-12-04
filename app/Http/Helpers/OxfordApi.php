<?php
/**
 * Created by PhpStorm.
 * User: miguelhuerta
 * Date: 2018-12-03
 * Time: 17:27
 */

namespace App\Http\Helpers;

use GuzzleHttp\Client;

class OxfordApi
{
    /**
     * guzzle client
     *
     * @var \GuzzleHttp\Client
     */
    private $guzzle;

    public function __construct()
    {
        $this->guzzle = new Client();
    }

    /**
     * Call the Api
     *
     * @param $endpoint string
     * @param $method string
     *
     * @return Object
     */
    protected function call($endpoint, $method = "GET")
    {
        try {
            // Oxford api requires some headers
            $response = $this->guzzle->request($method, $endpoint, ['headers' => ['app_id' => env("OXFORD_APP_ID"), 'app_key' =>env("OXFORD_APP_KEY")]]);

            if ($response->getStatusCode() == 200) {
                // get the contents of the response
                $body = $response->getBody()->getContents();

                return (object)[
                    'success' => true,
                    'data' => $body
                ];

            }

            // if we made it here we need to alert the admin. Something went wrong
            // return the error
            return (object)[
                'success' => false,
                'data' => null
            ];
        } catch(\GuzzleHttp\Exception\TransferException $e) {
            // send email out something went wrong

            // return the error
            return (object)[
                'success' => false,
                'data' => null
            ];
        }
    }

    /*
     * CallApi function
     *
     * @param $word string
     *
     * @return Object
     */
    public function callApi($word)
    {
        $endpoint = env("OXFORD_URL") . "/entries/en/{$word}";

        return $this->call($endpoint, "GET");
    }
}