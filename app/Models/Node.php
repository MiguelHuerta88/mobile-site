<?php
/**
 * Node model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Node table
 * 
 * @author Miguel Huerta <guelme88@gmail.com>
 */
class Node extends Model
{
    /**
     * The database table used by the model
     * 
     * @var string
     */
    protected $table = 'nodes';
    
    /**
     * The attributes that are mass assignable
     * 
     * @var array
     */
    protected $fillable = ['type', 'title'];
    
    /**
     * relationship to node_types
     * 
     */
    public function nodeType()
    {
        return $this->belongsTo('App\Models\NodeType', 'id');
    }
    
    /**
     * scope node by type
     * 
     * @param $query
     * @param $type
     */
    public function scopeNodeByType($query, $type)
    {
        return $query->where('type', $type);
    }
}

