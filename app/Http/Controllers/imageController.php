<?php

namespace App\Http\Controllers;

use App\Models\images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class imageController extends Controller
{
    function uploadimages(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'file' => 'required|array',
            'file.*' => 'mimes:jpeg,jpg,png|max:4000',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 401);
        }
        $upload = new images();
        $store = '';
        if ($request->hasFile('file')) {
            $fileExtension = ['jpeg', 'jpg', 'png', 'svg', 'JPG'];
            foreach ($request->file('file') as $files) {
                $extension = $files->getClientOriginalExtension();
                $check = in_array($extension, $fileExtension);
                if ($check) {
                    $file_name = time() . '_' . $files->getClientOriginalName();
                    $file_path = $files->storeAs('uploadImage', $file_name, 'public');
                    $store = '/storage/' . $file_path;
                    $imgData[] = $store;
                } else {
                    return response(['errors' => 'The file must be a file of type: jpeg, png, jpg, svg.'], 422);
                }
            }
            $upload->file = json_encode($imgData);
        }
        $upload->description = $request->description;
        $upload->title = $request->title;
        $upload->save();
        if ($upload) {
            return response()->json($upload, 200);
        } else {
            return response()->json(['data', "not insert data"], 422);
        }
    }
    function getall()
    {
        $data = images::all();
        return response()->json(['success' => true, 'data' => $data], 200);
    }
}
