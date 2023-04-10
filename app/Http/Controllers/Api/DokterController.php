<?php

namespace App\Http\Controllers\Api;
use App\Helpers\ResponseFormatter;
use App\Models\Dokter;
use App\Http\Resources\DokterResource;
use App\Http\Requests\StoreDokterRequest;
use App\Http\Requests\UpdateDokterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Database\QueryException;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $dokter = Dokter::all();
        $id = $request->input('id');


        if ($id) {
            $dokter = Dokter::find($id);
            if ($dokter) {
                return ResponseFormatter::success([
                    'data' => $dokter,
                    'message' => 'Data Dokter Data Berhasil diambil',
                ]);
            } else {
                return ResponseFormatter::error(404, 'Data Dokter tidak ditemukan');
            }
        }
        return ResponseFormatter::success([
            'data' => $dokter,
            'message' => 'Data Berhasil diambil',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'nama' => 'required:min:3',
            'email' => 'required|email',
            'alamat' => 'required',
            'fk_spesialis' => 'required',
            'fk_poli' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation',
                'error' => $validator->errors(),
            ], 422);
        }

        $dokter = Dokter::create([
            'id' => $request->id,
            'nama' => $request->nama,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'fk_spesialis' => $request->fk_spesialis,
            'fk_poli'=> $request->fk_poli
        ]);

        return response()->json([
            'message' => 'Create Dokter Data successful',
            'data' => $dokter,
        ], 200);
    }



    /**
     * Display the specified resource.
     */
    public function show(Request $request,$id)
    {
        $dokter = Dokter::findOrFail($id);
        // $error = ResponseFormatter::error();
        if (is_null($dokter)){
            return ResponseFormatter::error(['message' => 'something went wrong',
        ], 'Dokter data is null ', 422);
        }else {
            return response()->json([
                'message' => 'Show Dokter data Successful',
                'data' => $dokter,
            ], 200);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'nama' => 'required:min:3',
            'email' => 'required|email',
            'alamat' => 'required',
            'fk_spesialis' => 'required',
            'fk_poli' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation',
                'error' => $validator->errors(),
            ], 422);
        }
        $dokter = Dokter::findOrFail($id);
        $dokter->update([
            'id' => $request->id,
            'nama' => $request->nama,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'fk_spesialis' => $request->fk_spesialis,
            'fk_poli'=> $request->fk_poli
        ]);

        return response()->json([
            'message' => 'Update Dokter Data successful',
            'data' => $dokter,
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            $dokter = Dokter::find($id);
            $dokter->delete();
            return ResponseFormatter::success([
                'message' => 'Delete Dokter data successful',
            ],'Delete Dokter data successful',500);
        } catch(QueryException $error) {
            return ResponseFormatter::error([
                'message' => 'something went wrong',
                'error' => $error,
            ], 'Dokter Data not deleted', 500);
        }
    }
}
