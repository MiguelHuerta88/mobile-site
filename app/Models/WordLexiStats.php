<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WordLexiStats extends Model
{
    /**
     * Table to be used
     * @var string
     */
    protected $table = 'word_lexi_stats';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'word_id',
        'json_data',
        'created_at',
        'updated_at'
    ];

    /**
     * Validation rules to be used
     * @var array
     */
    protected $rules = [
        'word_id' => 'required|integer',
        'json_data' => 'required|json',
    ];

    /**
     * Get our validation rules for this model
     *
     * @return array
     */
    public function getRules()
    {
        return $this->rules;
    }
}
