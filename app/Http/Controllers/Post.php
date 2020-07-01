<?php

class Post extends Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * Define guarded columns
     *
     * @var array
     */
    protected $guarded = array('id');
}