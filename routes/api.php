<?php 
use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/document/{id}/autosave', function (Request $request, $id) {
        $document = Document::findOrFail($id);
        
        if ($request->user()->cannot('update', $document)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $document->update(['content' => $request->input('content')]);

        broadcast(new DocumentUpdated($document))->toOthers();

        return response()->json(['message' => 'Document auto-saved']);
    });
});

Route::middleware('auth:sanctum')->post('/document/{id}/editing', function (Request $request, $id) {
    $document = Document::findOrFail($id);

    if ($request->user()->cannot('update', $document)) {
        return response()->json(['error' => 'Unauthorized'], 403);
    }

    broadcast(new UserEditingDocument($request->user(), $id))->toOthers();

    return response()->json(['message' => 'User is editing']);
});

Route::middleware('auth:sanctum')->post('/broadcasting/auth', function (Request $request) {
    return Broadcast::auth($request);
});