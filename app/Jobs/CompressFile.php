<?php

namespace App\Jobs;

use App\Models\Podcast;
use App\Services\AudioProcessor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use ZipArchive;
use File;

class CompressFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function handle()
    {
        // Process Compress File...
        $zip = new ZipArchive();
        $fileName = 'myZip.' . config('app.compress_file_type'); // can set from config
        if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE) {

            $zip->addFile($this->file, basename($this->file));
            $zip->close();
        }

        // can download uploaded compress file
        response()->download(public_path($fileName));
    }
}
