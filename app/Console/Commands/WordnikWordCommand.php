<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Helpers\WordnikApi;
use App\Models\Words;
use App\Http\Controllers\Gates\WordsGate;

class WordnikWordCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wordnik:word';

    /**
     * WordnikApi instance
     * 
     * @var WordnikApi
     */
    protected $wordnikApi;

    /**
     * WordGate instance
     * 
     * @var WordGate
     */
    protected $wordsGate;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command will use Wordnik API to pull word of day';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(WordnikApi $wordnikApi, WordsGate $wordsGate)
    {
        $this->wordnikApi = $wordnikApi;
        $this->wordsGate = $wordsGate;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info("Beginning artisan command to pull down word of day " . date("Y-d-m H:i:s"));

        // call the api
        $response = $this->wordnikApi->callApi("wordOfTheDay");

        if ($response->success && $response->data) {
            // decode data and pull word
            $decodedJson = json_decode($response->data);
            
            // build attributes
            $attributes = [
                'word' => $decodedJson->word,
                'json_data' => $response->data
            ];

            list($passed, $messages, $model) = $this->wordsGate->tryInsert($attributes, new Words());

                if ($passed) {
                    $this->info("Successfully inserted word of the day into our database");
                } else {
                    $this->error("We ran into some issues: " . $messages);
                }

        } else {
            $this->error("Oops! Looks like we had a problem retrieving the word of the day");
            // could not retrieve word of day send email to admins
            // also log
        }

        // if we made it here
        $this->info("Artisan command complete " . date("Y-d-m H:i:s"));
    }
}
