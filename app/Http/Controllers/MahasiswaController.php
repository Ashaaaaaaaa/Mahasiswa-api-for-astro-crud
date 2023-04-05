<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{

    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        if($mahasiswa->count() > 0) {

            return response()->json([
                'status' => 200,
                'mahasiswa' => $mahasiswa
            ], 200);
        }else{

            return response()->json([
                'status' => 404,
                'message' => 'No Records Found'
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'npm'               => 'required|string',
            'name_mahasiswa'    => 'required|string',
            'fakultas'          => 'required|string',
            'prodi'             => 'required|string',
        ]);

        if($validator->fails()){

            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }else{

            $mahasiswa = Mahasiswa::create([
                'npm'               => $request->npm,
                'name_mahasiswa'    => $request->fakultas,
                'fakultas'          => $request->fakultas,
                'prodi'             => $request->prodi
            ]);

            if($mahasiswa){

                return response()->json([
                    'status' => 200,
                    'message' => "Mahasiswa Created Successfully"
                ], 200);
            }else{

                return response()->json([
                    'status' => 500,
                    'message' => "Something Went Wrong!"
                ], 500);
            }
        }
    }

    public function show($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        if($mahasiswa){

            return response()->json([
                'status' => 200,
                'mahasiswa' => $mahasiswa
            ], 200);
        }else{

            return response()->json([
                'status' => 404,
                'message' => 'No Such Mahasiswa Found!'
            ], 404);
        }
    }

    // public function edit($id)
    // {
    //     $mahasiswa = Mahasiswa::find($id);
    //     if($mahasiswa){

    //         return response()->json([
    //             'status' => 200,
    //             'mahasiswa' => $mahasiswa
    //         ], 200);
    //     }else{

    //         return response()->json([
    //             'status' => 404,
    //             'message' => 'No Such Mahasiswa Found!'
    //         ], 404);
    //     }
    // }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'npm'               => 'required|string',
            'name_mahasiswa'    => 'required|string',
            'fakultas'          => 'required|string',
            'prodi'             => 'required|string',
        ]);

        if($validator->fails()){

            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }else{

            $mahasiswa = Mahasiswa::find($id);

            $mahasiswa->update([
                'npm'               => $request->npm,
                'name_mahasiswa'    => $request->name_mahasiswa,
                'fakultas'          => $request->fakultas,
                'prodi'             => $request->prodi
            ]);

            if($mahasiswa){

                return response()->json([
                    'status' => 200,
                    'message' => "Mahasiswa Updated Successfully"
                ], 200);
            }else{

                return response()->json([
                    'status' => 404,
                    'message' => "No Such Mahasiswa Found!"
                ], 404);
            }
        }
    }

    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        if($mahasiswa){

            $mahasiswa->delete();
            return response()->json([
                'status' => 200,
                'message' => "Mahasiswa Deleted Successfully"
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "No Such Mahasiswa Found!"
            ], 404);
        }
    }
}
