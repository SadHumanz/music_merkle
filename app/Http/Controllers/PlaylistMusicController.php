<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\playlist_music;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\DB;

class PlaylistMusicController extends Controller
{
    public $user;

    public function __construct()
    {
        //$this->user = JWTAuth::parseToken()->authenticate();   
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'playlist_id' => 'required|integer',
            'music_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $playlist_music = new playlist_music();
        $playlist_music->playlist_id = $request->playlist_id;
        $playlist_music->music_id = $request->music_id;

        $playlist_music->save();

        $data = playlist_music::where('id', '=', $playlist_music->id)->first();

        return response()->json([
            'success' => true,
            'message' => 'Data member berhasil ditambahkan',
            'data' => $data
        ]);
    }

    public function getAll()
    {
        $data = playlist_music::get();
        return response()->json($data);
    }

    public function getById($id)
    {
        $data = playlist_music::where('id', '=', $id)->first();

        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'playlist_id' => 'required|integer',
            'music_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $playlist_music = playlist_music::where('id', '=', $id)->first();
        $playlist_music->playlist_id = $request->playlist_id;
        $playlist_music->music_id = $request->music_id;

        $playlist_music->save();

        return response()->json([
            'success' => true,
            'message' => 'Data playlist_music berhasil diubah'
        ]);
    }

    public function delete($id)
    {
        $delete = playlist_music::where('id', '=', $id)->delete();

        if ($delete) {
            return response()->json([
                'success' => true,
                'message' => "Data playlist_music berhasil dihapus"
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => "Data playlist_music gagal dihapus"
            ]);
        }
    }
}
