<?php

namespace App\Http\Controllers;

use App\Models\music;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\DB;

class MusicController extends Controller
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
            'duration' => 'required|string',
            'mma_tbl_musiccol' => 'required|string',
            'album_id' => 'required|integer',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors());
        }
        
        $music = new music();
        $music->title = $request->title;
        $music->duration = $request->duration;
        $music->mma_tbl_musiccol = $request->mma_tbl_musiccol;
        $music->album_id = $request->album_id;
        
        $music->save();
        
        $data = music::where('id', '=', $music->id)->first();

        return response()->json([
            'success' => true,
            'message' => 'Data music berhasil ditambahkan',
            'data' => $data
        ]);
    }

    public function getAll()
    {
        $data = music::paginate(12);
        return response()->json($data);
    }

    public function getById($id)
    {
        $data = music::where('id', '=', $id)->first();

        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'duration' => 'required|string',
            'mma_tbl_musiccol' => 'required|string',
            'album_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $music = music::where('id', '=', $id)->first();
        $music->title = $request->title;
        $music->duration = $request->duration;
        $music->mma_tbl_musiccol = $request->mma_tbl_musiccol;
        $music->album_id = $request->album_id;

        $music->save();

        return response()->json([
            'success' => true,
            'message' => 'Data music berhasil diubah'
        ]);
    }

    public function delete($id)
    {
        $delete = music::where('id', '=', $id)->delete();

        if ($delete) {
            return response()->json([
                'success' => true,
                'message' => "Data music berhasil dihapus"
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => "Data music gagal dihapus"
            ]);
        }
    }
}
