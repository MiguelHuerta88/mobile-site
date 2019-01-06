<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Helpers\OxfordApi;
use App\Http\Controllers\Gates\WordsGate;
use App\Models\WordLexiStats;
use App\Models\Words;

class RegenerateLexiStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'regenerate:lexiStats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Artisan command that will run through any words we currently have and regenerate lexiStats based on updated code';

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

    const CHUNK_LIMIT = 50;

    /**
     * RegenerateLexiStats constructor.
     * @param WordsGate $wordsGate
     * @param OxfordApi $oxfordApi
     */
    public function __construct(
        WordsGate $wordsGate,
        OxfordApi $oxfordApi
    ){
        parent::__construct();
        $this->wordsGate = $wordsGate;
        $this->oxfordApi = $oxfordApi;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info("Starting regeneration command");

        // pull all active words we have
        $this->info("Pulling all words we currently have");

        Words::chunk(self::CHUNK_LIMIT, function($words){
            foreach($words as $word) {
                $this->info("Working through: {$word->word} at the moment");
                // pull categories associated with word
                $categories = $this->oxfordApi->getLexicalCategoriesFromResponse($word->json_data);
                $this->info("\tlexical categories associated with word are " . implode(",", $categories));
                $this->info("\tregenerating lexistat object based on these categories");
                $response = $this->oxfordApi->callApi('lexi-stat', $word->word, $categories);
                if ($response->success && $response->data) {
                    // run update query on this word
                    $attributes = [
                        'json_data' => $response->data
                    ];

                    list($passed, $message, $model) = $this->wordsGate->tryMassUpdate(WordLexiStats::byWordId($word->id), $attributes);
                    if ($passed) {
                        $this->info("\tUpdate for: {$word->word} successful");
                    } else [
                        $this->warn("\tUpdate for: {$word->word} did not complete");
                    ]
                }
            }
        });

    }
}
