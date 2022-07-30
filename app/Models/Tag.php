<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    /**
     * Get all of the notes that are assigned this tag.
     */
    public function notes()
    {
        return $this->morphedByMany(Note::class, 'taggable');
    }
}
