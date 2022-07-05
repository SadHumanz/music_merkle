<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\music_play_history;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\DB;

class MusicPlayHistoryController extends Controller
{
    public $user;

    public function __construct()
    {
        //$this->user = JWTAuth::parseToken()->authenticate();   
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'music_id' => 'required|integer',
            'user_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $music_play_history = new music_play_history();
        $music_play_history->music_id = $request->music_id;
        $music_play_history->user_id = $request->user_id;

        $music_play_history->save();

        $data = music_play_history::where('id', '=', $music_play_history->id)->first();

        return response()->json([
            'success' => true,
            'message' => 'Data music_play_history berhasil ditambahkan',
            'data' => $data
        ]);
    }

    public function getAll()
    {
        $data = music_play_history::get();
        return response()->json($data);
    }

    public function getById($id)
    {
        $data = music_play_history::where('id', '=', $id)->first();

        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'music_id' => 'required|integer',
            'user_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $music_play_history = music_play_history::where('id', '=', $id)->first();
        $music_play_history->music_id = $request->music_id;
        $music_play_history->user_id = $request->user_id;

        $music_play_history->save();

        return response()->json([
            'success' => true,
            'message' => 'Data music_play_history berhasil diubah'
        ]);
    }

    public function delete($id)
    {
        $delete = music_play_history::where('id', '=', $id)->delete();

        if ($delete) {
            return response()->json([
                'success' => true,
                'message' => "Data music_play_history berhasil dihapus"
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => "Data music_play_history gagal dihapus"
            ]);
        }
    }
}
