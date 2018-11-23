<?php

namespace App\Http\Helpers;
use \GuzzleHttp\Client;

class WordnikApi
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
			$response = $this->guzzle->request($method, $endpoint);

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
				'date' => null
			];
		} catch(\GuzzleHttp\Exception\TransferException $e) {
			// send email out something went wrong

			// return the error
			return (object)[
				'success' => false,
				'date' => null
			];
		}
	}

	/*
	 * CallApi function
	 *
	 * @param $endpoint string
	 *
	 * @return Object
	 */
	public function callApi($endpoint)
	{
		$endpoint = env("WORDNIK_URL") . $endpoint . "?api_key=" . env("WORDNIK_KEY");

		return $this->call($endpoint, "GET");
	}
}