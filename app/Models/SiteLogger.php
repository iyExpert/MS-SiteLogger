<?php

namespace App\Models;

use App\Enums\LogTypes;
use Illuminate\Validation\Rules\Enum;
use Jenssegers\Mongodb\Eloquent\Model;

/**
 * Class SiteLogger
 * @package App\Models
 *
 * @property string $_id
 * @property string $title
 * @property string $action
 * @property array $tags
 * @property int $user_id
 * @property string $user_name
 * @property string $ip
 * @property LogTypes $type
 * @property array $log
 * @property string $date
 * @property string $correlation_id
 *
 */
class SiteLogger extends Model
{
    /**
     * @var string
     */
    protected $connection = 'mongodb';

    /**
     * @var string
     */
    protected $collection = 'logs';

    /**
     * @var string[]
     */
    protected $dates = ['date'];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $primaryKey = '_id';

    /**
     * @var string
     */
    protected $keyType = 'string';


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

    /**
     * Validation rules for convenient validation without FormRequests
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'action' => ['required', 'string'],
            'ip' => ['required', 'ip'],
            'type' => [new Enum(LogTypes::class)],
            'date' => ['nullable', 'date_format:Y-m-d H:i:s'],
        ];
    }
}
