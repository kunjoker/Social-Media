<?php

namespace App\Models;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Posts extends Eloquent
{
    use HasApiTokens, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $connection = 'mongodb';

    protected $collection = 'TP_2';

    protected $fillable = ['postId', 'userId', 'content', 'likes','comments','createdAt'];
}
