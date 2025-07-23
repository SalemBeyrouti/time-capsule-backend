<?php

namespace App\Http\Controllers\User;

use App\Models\Capsule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\User\ZipExportService;

class CapsuleExportController extends Controller
{
    function downloadCapsuleZip($capsuleId) {
        
        $zipPath = ZipExportService::generateZipForCapsules($capsuleId);

        if (!$zipPath || !file_exists($zipPath)) {
             return $this->responseJSON('Unable to generate ZIP file', 404);
        }
        return response()->download($zipPath)->deleteFileAfterSend(true);
       
    }
}
