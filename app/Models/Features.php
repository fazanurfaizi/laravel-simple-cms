<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Features extends Model
{
    protected $fillable = [
        'user_id', 'title', 'slug', 'body', 'image'
    ];

    protected $hidden = [
        'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function getImageUrl() {
        return asset('storage/images/features/' . $this->image);
    }
}
