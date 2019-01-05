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

    /**
     * @param string $method
     * @param $word
     * @param null $lexicalCategories
     * @return Object
     */
    public function callApi($method = 'day-word', $word, $lexicalCategories = null)
    {
        switch($method) {
            case 'lexi-stat':
                $endpoint = env("OXFORD_URL") . "/stats/frequency/word/en/?lemma={$word}";
                return $this->getLexStats($endpoint, $lexicalCategories);
                break;
            case 'day-word':
                $endpoint = env("OXFORD_URL") . "/entries/en/{$word}/regions=us";
                return $this->call($endpoint, "GET");
            break;
        }

        //return $this->call($endpoint, "GET");
    }

    /**
     * Pull the lexical categories from response from day-word function.
     * @NOTE this must be used only after you have pulled the word of the day response
     * @param $json
     * @return null
     */
    public function getLexicalCategoriesFromResponse($json)
    {
        $obj = json_decode($json);
        $entries = null;
        if (
            $obj && isset($obj->results)
            && count($obj->results) > 0
            && isset($obj->results[0]->lexicalEntries)
        ){
            foreach($obj->results[0]->lexicalEntries as $entry) {
                $entries[strtolower($entry->lexicalCategory)] = $entry->lexicalCategory;
            }
        }

        return $entries;
    }

    /**
     * @param $endpoint
     * @param null $lexicalCategories
     * @return object
     */
    protected function getLexStats($endpoint, $lexicalCategories = null)
    {
        // if no categories return
        if (is_null($lexicalCategories)) {
            return (object)[
                'success' => false,
                'data' => null
            ];
        }

        // final return
        $data = null;

        // next we have to loop through our categories and pull the data
        foreach($lexicalCategories as $index => $category) {
            // we will have to keep updating endpoint to pass the category &lexicalCategory=noun ect..
            $uri = $endpoint . "&lexicalCategory=" . $index;

            $response = $this->call($uri, "GET");

            if ($response->success && $response->data) {
                // we were successful lets begin building final object
                $decoded = json_decode($response->data);
                if (isset($decoded->result))
                $data['results'][] = $decoded->result;
                $data['metadata'] = [];
            }
        }

        $return = (object)[
            'success' => false,
            'data' => null
        ];

        if ($data) {
            $return->success = true;
            $return->data = json_encode($data);
        }

        return $return;
    }
}