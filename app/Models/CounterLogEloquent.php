<?php
/**
 * Created by PhpStorm.
 * User: Seth Phat
 * Date: 3/19/2019
 * Time: 8:45 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class CounterLogEloquent extends Model
{
    protected $table = "counter_log";
    protected $primaryKey = "id";
    public $timestamps = true;
    public static $snakeAttributes = false;
    protected $fillable = [
        'title', 'description', 'time'
    ];
}