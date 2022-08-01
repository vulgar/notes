<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description'];

    /**
     * Get all of the tags for the note.
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

}
