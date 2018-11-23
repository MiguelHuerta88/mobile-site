<?php

namespace App\Http\Helpers;
use \GuzzleHttp\Client;

class WebsterApi
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
	 * pull down the word of the day
	 *
	 * @return string
	 */
	public function pullDownWordOfDay()
	{
		$content = file_get_contents(env("WORD_OF_DAY_URL"));

		// run a search
        $date = date("F d, Y");//dd($date);
        //preg_match("/Word of the Day : {$date}/", $content, $matches);
        //preg_match("'<div class=\"word-and-pronunciation\"><h1>(.*?)</h1></div>'si", $content, $matches);
         preg_match("'<title>(.*?)</title>'si", $content, $matches);

         // only continue if the array has at least 2 elements
         if ($matches && count($matches) >= 2) {
         	preg_match("/:\s(.*)\s\|/", $matches[1], $match);

   			if ($match && count($match) >= 2) {
   				return $match[1];
   			}

   			// send email to admins
   			// return the error
			return (object)[
				'success' => false,
				'date' => null
			];
         }

         // send emails to admins
         // return the error
		return (object)[
			'success' => false,
			'date' => null
		];
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
	 * @param $word string
	 *
	 * @return Object
	 */
	public function callApi($word)
	{
		$endpoint = env("WEBSTER_URL") . $word . "?key=" . env("WEBSTER_KEY");

		return $this->call($endpoint, "GET");
	}
}