<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model


{
    /**
     * @var string
     */
    protected $table = 'images';

    /**
     * @var array
     */
    protected $guarded = [ 'id'];

    /**
     * @var array
     */

    protected $fillable = [
        'name',
        'hash'.
        'thumbnail'
    ];
}
