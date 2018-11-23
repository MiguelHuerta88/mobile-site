<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Helpers\WebsterApi;
use App\Models\Words;
use App\Http\Controllers\Gates\WordsGate;

class DictionaryGetWordCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'webster:dayWord';

    /**
     * WebsterApi instance
     * 
     * @var WebsterApi
     */
    protected $websterApi;

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
    protected $description = 'This command will pull down the word of the day and store it';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(WebsterApi $websterApi, WordsGate $wordsGate)
    {
        $this->websterApi = $websterApi;
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
        $wordOfDay = strtolower($this->websterApi->pullDownWordOfDay());

        $this->info("Word of day: " . $wordOfDay);

        if ($wordOfDay) {
            // ping the api to get the json
            $this->info("Pinging Websters Dictionary API to get JSON response");
            $response = $this->websterApi->callApi(strtolower($wordOfDay));

            if ($response->success) {
                // save to the db
                $attributes = [
                    'word' => $wordOfDay,
                    'json_data' => $response->data
                ];
                list($passed, $messages, $model) = $this->wordsGate->tryInsert($attributes, new Words());

                if ($passed) {
                    $this->info("Successfully inserted word of the day into our database");
                } else {
                    $this->error("We ran into some issues: " . $messages);
                }
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
