<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


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

    /**
     * Scope query to pull a word of the date by date
     *
     * @param $query
     * @param $date (null | string)
     *
     * @return QueryBuilder
     */
    public function scopeByDay($query, $date = null, $format = 'Y-m-d')
    {
        // build the date
        $date = new Carbon($date);

        // build start and end for the range
        $start = $date->format($format) . " 00:00:00";
        $end = $date->format($format) . " 23:59:59";

        return $query->where('created_at', '>=', $start)
            ->where('created_at', '<=', $end);
    }

    /**
     * Scope by word id
     * @param $query
     * @param $id
     * @return mixed
     */
    public function scopeByWordId($query, $id)
    {
        return $query->where('word_id', $id);
    }
}
