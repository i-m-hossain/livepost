<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;
    protected $casts = [
        'body' => 'array',
    ];

    protected $hidden = [
        'title'
    ];

    protected $fillable = [
        'title',
        'body'
    ];

    protected $appends = [
        'title_upper_case'
    ];

    public function getTitleUpperCaseAttribute():string
    {
        return strtoupper($this->title);
    }

    public function setTitleAttribute(string $title):void
    {
        $this->attributes['title'] = strtolower($title);
    }

    public function comments(){
        return $this->hasMany(Comment::class, 'post_id', );
    }

    public function users(){
        return $this->belongsToMany(
            User::class,
            'post_user',
            'post_id',
            'user_id'
        );
    }


}
