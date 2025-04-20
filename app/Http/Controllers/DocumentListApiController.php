<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentListApiRequest;
use App\Models\Document;

class DocumentListApiController extends Controller
{
    public function __invoke(DocumentListApiRequest $request)
    {
        $validated = $request->validated();
        $sourceCategory = $validated['source_category'] ?? null;
        $limit = $validated['limit'] ?? 100;

        $documents = Document::getDocumentsOfSources(
            $sourceCategory ? config('const.dataSources')[$sourceCategory] : null,
            $limit
        );

        return response()->json([
            'status' => 'success',
            'data' => [
                 'documents' => $documents,
            ],
        ]);
    }
}
