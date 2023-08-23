<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
{

    public function multipleUpload($files, $file_path)
    {
        $data = [];
        if(count($files) > 0){
            foreach($files as $file) {
                $path = $file->store( $file_path, 'public' );
                $bind = array(
                    'filename' => $file->getClientOriginalName(),
                    'file_path' => $path
                );
                array_push($data, $bind);
            }
        }
        return $data;
    }
}

?>
