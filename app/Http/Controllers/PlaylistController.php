<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\playlist;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\DB;

class PlaylistController extends Controller
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
            'user_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $playlist = new playlist();
        $playlist->title = $request->title;
        $playlist->user_id = $request->user_id;

        $playlist->save();

        $data = playlist::where('id', '=', $playlist->id)->first();

        return response()->json([
            'success' => true,
            'message' => 'Data playlist berhasil ditambahkan',
            'data' => $data
        ]);
    }
    
    public function getAll()
    {
        $data = playlist::paginate(12);
        return response()->json($data);
    }

    public function getById($id)
    {
        $data = playlist::where('id', '=', $id)->first();

        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'user_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $playlist = playlist::where('id', '=', $id)->first();
        $playlist->title = $request->title;
        $playlist->user_id = $request->user_id;

        $playlist->save();

        return response()->json([
            'success' => true,
            'message' => 'Data playlist berhasil diubah'
        ]);
    }

    public function delete($id)
    {
        $delete = playlist::where('id', '=', $id)->delete();

        if ($delete) {
            return response()->json([
                'success' => true,
                'message' => "Data playlist berhasil dihapus"
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => "Data playlist gagal dihapus"
            ]);
        }
    }
}
