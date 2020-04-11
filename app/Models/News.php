<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{

    protected $fillable = [
        'user_id', 'image',
        'title', 'slug', 'body'
    ];

    protected $hidden = [
        'user_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    // public function category() {
    //     return $this->belongsTo(Category::class);
    // }

    // public function tags() {
    //     return $this->belongsToMany(Tag::class, 'news_tag');
    // }

    // public function getRelatedNews() {
    //     $tagsID = $this->tags->pluck('id')->toArray();
    //     $news = collect();

    //     if(count($tagsID)) {
    //         $news = News::where('news.id', '!=', $this->id)->whereHas('tags', function($query) use ($tagsID) {
    //             $query->whereIn('tag_id', $tagsID);
    //         })->get();
    //     }

    //     return $news;
    // }

}
