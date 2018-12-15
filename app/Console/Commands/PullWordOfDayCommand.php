<?php

namespace App\Console\Commands;

use App\Http\Helpers\OxfordApi;
use Illuminate\Console\Command;
use App\Http\Helpers\WebsterApi;
use App\Http\Controllers\Gates\WordsGate;
use App\Models\Words;
use App\Models\WordLexiStats;



class PullWordOfDayCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'oxford:word';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Artisan command to pull down word of the day using Oxford Api';

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
     * OxfordApi instance
     *
     * @var OxfordApi
     */
    protected $oxfordApi;

    /**
     * PullWordOfDayCommand constructor.
     * @param WebsterApi $websterApi
     * @param WordsGate $wordsGate
     * @param OxfordApi $oxfordApi
     */
    public function __construct(
        WebsterApi $websterApi,
        WordsGate $wordsGate,
        OxfordApi $oxfordApi
    ) {
        $this->websterApi = $websterApi;
        $this->wordsGate = $wordsGate;
        $this->oxfordApi = $oxfordApi;
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
            // try to pull the definition from oxford
            $response = $this->oxfordApi->callApi('day-word', $wordOfDay);

            if ($response->success && $response->data) {
                // build attributes
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

                // next we try to pull the lexiStat for this word
                $this->info("Going to try to pull lexiStats for {$wordOfDay}");

                $response = $this->oxfordApi->callApi('lexi-stat', $wordOfDay);

                if ($response->success && $response->data) {
                    // build attributes
                    $attributes = [
                        'word_id' => $model->id,
                        'json_data' => $response->data
                    ];

                    list($passed, $messages, $model) = $this->wordsGate->tryInsert($attributes, new WordLexiStats());

                    if ($passed) {
                        $this->info("Successfully inserted word lexi stat into our database");
                    } else {
                        $this->error("We ran into some issues: " . $messages);
                    }
                }

            } else {
                $this->error("Oops! Looks like we had a problem retrieving the word of the day");
                // could not retrieve word of day send email to admins
                // also log
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
