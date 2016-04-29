<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    /**
     * @var string
     */
    protected $table = 'downloads';

    /**
     * @var array
     */

    protected $guarded = ['id'];

    /**
     * @var array
     */

    protected $fillable = [
        'name',
        'hash',
        'author',
        'version',
        'path'
    ];
}
