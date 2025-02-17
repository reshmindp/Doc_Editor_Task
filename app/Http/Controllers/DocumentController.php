<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;
use App\Events\DocumentUpdated;
use App\Jobs\ProcessDocumentUpdate;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->withErrors(['error' => 'Please login first']);
        }

        $documents = Document::all(); 

        return view('documents.index', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('documents.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['title' => 'required|string|max:255']);

        Document::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => ''
        ]);

        return redirect()->route('documents.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $document = Document::find($id);

        return view('documents.edit', compact('document'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $document = Document::findOrFail($id);

        $document->update(['content' => $request->content]);

        ProcessDocumentUpdate::dispatch($document)->afterCommit();
        
        broadcast(new DocumentUpdated($document))->toOthers();

        return response()->json(['message' => 'Document updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $document = Document::find($id);

        if ($document->user_id !== Auth::id()) {
            abort(403);
        }

        $document->delete();
        return redirect()->route('documents.index');
    }
}
