<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Words;
use App\Models\WordLexiStats;

class WordsController extends Controller
{
	/**
	 * Get the word of the day.
	 *
	 * @param $date string optional
	 * @return Response
	 */
    public function index($date = null)
    {
        // 1) try to pull the word in case they supply date.
    	// we should query to try to pull the word
    	$word = Words::byDay($date)->first();

    	// 1.5) if there was no date supplied but we have no word. pull most recent. Usually because cron hasnt run
        if (is_null($date) && !$word) {
            $word = Words::orderBy('id', 'desc')->first();
        }

        //2) no word found. ping the API to pull it for taht date
        //   However, wordnik only goes back 2009-08-10.
        //   we should also not waste all api request in case someone keeps going 
        //   back in time
        // @TODO next implementation

    	// return the response
        // only return the column json_data
        $data = ($word) ? $word->json_data : null;

        // removed the json response. Since json_data column is already json encoded
    	return response($data);
    }

    /**
     * Get LexiStat record for date
     * @param null $date
     * @return Response
     */
    public function lexiStat($date = null)
    {
        // 1) try to pull the word in case they supply date.
        // we should query to try to pull the word
        $lexiStat = WordLexiStats::byDay($date)->first();

        // 1.5) if there was no date supplied but we have no word. pull most recent. Usually because cron hasnt run
        if (is_null($date) && !$lexiStat) {
            $lexiStat = WordLexiStats::orderBy('id', 'desc')->first();
        }

        //2) no word found. ping the API to pull it for taht date
        //   However, wordnik only goes back 2009-08-10.
        //   we should also not waste all api request in case someone keeps going
        //   back in time
        // @TODO next implementation

        // return the response
        // only return the column json_data
        $data = ($lexiStat) ? $lexiStat->json_data : null;

        // removed the json response. Since json_data column is already json encoded
        return response($data);
    }
}
