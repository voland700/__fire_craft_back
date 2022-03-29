<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;


class DropZoneController extends Controller
{
    public function removeOne(Request $request)
    {
        if (Storage::disk('public')->exists(str_replace('storage', '', $request->path))){
            Storage::disk('public')->delete(str_replace('storage', '', $request->path));
        }
        return response()->json(['success'=>200]);
    }
}
