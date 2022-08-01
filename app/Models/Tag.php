<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * Get all of the notes that are assigned this tag.
     */
    public function notes()
    {
        return $this->morphedByMany(Note::class, 'taggable');
    }


    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::deleting(function ($tag) {
            // removes connecting entries from the taggables table to avoid sql constraint error
            $tag->notes()->detach();
        });
    }
}
