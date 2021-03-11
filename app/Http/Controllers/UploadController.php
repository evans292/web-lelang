<?php

namespace App\Http\Controllers;

use App\Models\TemporaryFile;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    //
    public function store(Request $request) 
    {
        if ($request->hasFile('pic')) {
            $file = $request->file('pic');
            $filename = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $file->storeAs('image/tmp/' . $folder, $filename);

            TemporaryFile::create([
                'folder' => $folder,
                'filename' => $filename
            ]);

            return $folder;
        }

        return '';
    }

    public function storeMultiple(Request $request) 
    {
        if ($request->hasFile('pics')) {
            $files = $request->pics;

            foreach ($files as $file) {
                $filename = $file->getClientOriginalName();
                $folder = uniqid() . '-' . now()->timestamp;
                $file->storeAs('image/tmp/' . $folder, $filename);
    
                TemporaryFile::create([
                    'folder' => $folder,
                    'filename' => $filename
                ]);
    
                return $folder;
            }
        }

        return '';
    }
}
