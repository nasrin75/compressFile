<?php

namespace App\Http\Controllers;
use App\Http\Requests\CompressRequest;
use App\Jobs\CompressFile;

class UploadController extends Controller
{
    public function compress(CompressRequest $request){
        $file = $request->file('file'); // Retrieve the uploaded file from the request

        // use job to async
        dispatch(new CompressFile($file));

        return response('Upload File Successfully', 200);
    }
}
