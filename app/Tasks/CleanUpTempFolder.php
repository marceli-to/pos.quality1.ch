<?php
namespace App\Tasks;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CleanUpTempFolder
{
  public function __invoke()
  {
    $files = \Storage::listContents('public/uploads/temp');
    collect($files)->each(function($file) {
      if($file['timestamp'] < now()->subMinutes(30)->getTimestamp()) {
        \Storage::delete($file['path']);
      }
    });
  }
}