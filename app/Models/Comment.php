<?php


namespace App\Models;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Comment extends Eloquent
{
    use HasApiTokens, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $connection = 'mongodb';

    protected $collection = 'TP_2';

    protected $fillable = ['commentId','postId', 'userId', 'content','createdAt'];
}
