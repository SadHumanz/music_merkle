<?php

namespace App\Http\Controllers;

use App\Models\album;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\DB;

class AlbumController extends Controller
{
    public $user;

    public function __construct()
    {
        //$this->user = JWTAuth::parseToken()->authenticate();   
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'musician_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $album = new album();
        $album->title = $request->title;
        $album->musician_id = $request->musician_id;

        $album->save();

        $data = album::where('id', '=', $album->id)->first();

        return response()->json([
            'success' => true,
            'message' => 'Data album berhasil ditambahkan',
            'data' => $data
        ]);
    }

    public function getAll()
    {
        $data = album::paginate(12);
        return response()->json($data);
    }

    public function getById($id)
    {
        $data = album::where('id', '=', $id)->first();

        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'musician_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $album = album::where('id', '=', $id)->first();
        $album->title = $request->title;
        $album->musician_id = $request->musician_id;

        $album->save();

        return response()->json([
            'success' => true,
            'message' => 'Data album berhasil diubah'
        ]);
    }

    public function delete($id)
    {
        $delete = album::where('id', '=', $id)->delete();

        if ($delete) {
            return response()->json([
                'success' => true,
                'message' => "Data album berhasil dihapus"
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => "Data album gagal dihapus"
            ]);
        }
    }
}
