<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Billboards;
use Illuminate\Support\Facades\Storage;



class BillboardsController extends Controller
{
    public function index() {
        return Billboards::getBillboards();
    }

    public function uoi(Request $request) {
        return Billboards::updateOrInsert($request);
    }

    public function delete(Request $request) {
        return Billboards::deleteBillboard($request);
    }

    public function upload(Request $request) {
        $file = $request->file('file');
        $ext = $file->getClientOriginalExtension();
        $name = uniqid("art");
        if (Storage::putFileAs('/public/upload/', $file, $name.'.'.$ext)) {
            return [$request->side, "storage/upload/".$name.".".$ext];
        }
        return response()->json(false);
    }
}
