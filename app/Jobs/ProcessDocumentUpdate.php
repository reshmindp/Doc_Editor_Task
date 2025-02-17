<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\Document;

class ProcessDocumentUpdate implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(Document $document)
    {
        $this->document = $document;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        \Log::info("Document updated: " . $this->document->id);
    }
}
