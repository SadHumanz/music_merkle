<?php

namespace App\Http\Controllers;

use App\Models\likes;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\DB;

class LikesController extends Controller
{
    public $user;

    public function __construct()
    {
        //$this->user = JWTAuth::parseToken()->authenticate();   
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'reference_id' => 'required|integer',
            'user_id' => 'required|integer',
            'table_reference' => 'required|smallInteger',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $likes = new likes();
        $likes->reference_id = $request->reference_id;
        $likes->user_id = $request->user_id;
        $likes->table_reference = $request->table_reference;

        $likes->save();

        $data = likes::where('id', '=', $likes->id)->first();

        return response()->json([
            'success' => true,
            'message' => 'Data likes berhasil ditambahkan',
            'data' => $data
        ]);
    }

    public function getAll()
    {
        $data = likes::get();
        return response()->json($data);
    }

    public function getById($id)
    {
        $data = likes::where('id', '=', $id)->first();

        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'reference_id' => 'required|integer',
            'user_id' => 'required|integer',
            'table_reference' => 'required|smallInteger',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $likes = likes::where('id', '=', $id)->first();
        $likes->reference_id = $request->reference_id;
        $likes->user_id = $request->user_id;
        $likes->table_reference = $request->table_reference;

        $likes->save();

        return response()->json([
            'success' => true,
            'message' => 'Data likes berhasil diubah'
        ]);
    }

    public function delete($id)
    {
        $delete = likes::where('id', '=', $id)->delete();

        if ($delete) {
            return response()->json([
                'success' => true,
                'message' => "Data likes berhasil dihapus"
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => "Data likes gagal dihapus"
            ]);
        }
    }
}
