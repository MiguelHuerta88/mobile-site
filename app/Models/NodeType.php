<?php
/**
 * Node model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * NodeTypes table
 * 
 * @author Miguel Huerta <guelme88@gmail.com>
 */
class NodeType extends Model
{
    /**
     * The database table used by the model
     * 
     * @var string
     */
    protected $table = 'node_types';
    
    /**
     * The attributes that are mass assignable
     * 
     * @var array
     */
    protected $fillable = ['body'];
}

