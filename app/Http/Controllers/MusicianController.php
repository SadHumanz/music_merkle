<?php

namespace App\Http\Controllers;

use App\Models\musician;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\DB;

class MusicianController extends Controller
{
    public $user;

    public function __construct()
    {
        //$this->user = JWTAuth::parseToken()->authenticate();   
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $musician = new musician();
        $musician->name = $request->name;

        $musician->save();

        $data = musician::where('id', '=', $musician->id)->first();

        return response()->json([
            'success' => true,
            'message' => 'Data musician berhasil ditambahkan',
            'data' => $data
        ]);
    }

    public function getAll()
    {
        $data = musician::get();
        return response()->json($data);
    }

    public function getById($id)
    {
        $data = musician::where('id', '=', $id)->first();

        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $musician = musician::where('id', '=', $id)->first();
        $musician->name = $request->name;

        $musician->save();

        return response()->json([
            'success' => true,
            'message' => 'Data musician berhasil diubah'
        ]);
    }

    public function delete($id)
    {
        $delete = musician::where('id', '=', $id)->delete();

        if ($delete) {
            return response()->json([
                'success' => true,
                'message' => "Data musician berhasil dihapus"
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => "Data musician gagal dihapus"
            ]);
        }
    }
}
