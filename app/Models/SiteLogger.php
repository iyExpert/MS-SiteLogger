<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class SiteLogger extends Model
{
    protected string $connection = 'mongodb';
    protected string $collection = 'logs';
    protected string $primaryKey = 'id';
    protected array $dates = ['date'];
    public bool $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'action',
        'tags',
        'user_id',
        'user_name',
        'ip',
        'type',
        'log',
        'date',
        'correlation_id'
    ];
}
