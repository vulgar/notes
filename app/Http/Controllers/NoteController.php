<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoteRequest;
use App\Http\Resources\NoteResource;
use App\Models\Note;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = Note::with('tags')->get();
        if(request()->expectsJson()){
            return NoteResource::collection($notes);
        }
        return response("This page is only available in JSON.",400);
    }


    /**
     * Store a newly created resource in storage.
     * The \App\Http\Requests\StoreNoteRequest handles all validation.
     *
     * @param  \App\Http\Requests\StoreNoteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNoteRequest $request)
    {
        $note = Note::create($request->safe()->only(['title','description']));
        $note->tags()->sync($request->safe()->only('tags')['tags'], true);
        return new NoteResource($note->load('tags'));
    }

}
