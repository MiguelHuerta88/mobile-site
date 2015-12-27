<?php
/**
 * Social Media model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Social media table
 * 
 * @author Miguel Huerta <guelme88@gmail.com>
 */
class Social extends Model
{
    /**
     * The database table used by the model
     * 
     * @var string
     */
    protected $table = 'socials';
    
    /**
     * The attributes that are mass assignable
     * 
     * @var array
     */
    protected $fillable = ['title', 'url'];
}

