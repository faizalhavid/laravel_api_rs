<?php

namespace App\Http\Controllers\Api;
use App\Helpers\ResponseFormatter;
use App\Models\Poliklinik;
use App\Http\Requests\StorePoliRequest;
use App\Http\Requests\UpdatePoliRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class PoliklinikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $poliklinik = Poliklinik::all();
        $id = $request->input('id');


        if ($id) {
            $poliklinik = Poliklinik::find($id);
            if ($poliklinik) {
                return ResponseFormatter::success([
                    'data' => $poliklinik,
                    'message' => 'Data Poliklinik Data Berhasil diambil',
                ]);
            } else {
                return ResponseFormatter::error(404, 'Data Main tidak ditemukan');
            }
        }
        return ResponseFormatter::success([
            'data' => $poliklinik,
            'message' => 'Data Berhasil diambil',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'nama' => 'required|string',
            'code_ruangan' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation',
                'error' => $validator->errors(),
            ], 422);
        }

        $poliklinik = Poliklinik::create([
            'id' => $request->id,
            'nama' => $request->nama,
            'code_ruangan' => $request->code_ruangan,
        ]);

        return response()->json([
            'message' => 'Create Poliklinik Data successful',
            'data' => $poliklinik,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $poliklinik = Poliklinik::findOrFail($id);
        // $error = ResponseFormatter::error();
        if (is_null($poliklinik)){
            return ResponseFormatter::error([                'message' => 'something went wrong',
        ], 'Poliklinik data is null ', 422);
        }else {
            return response()->json([
                'message' => 'Show Poliklinik data Successful',
                'data' => $poliklinik,
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
            'nama' => 'required|string',
            'code_ruangan' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation',
                'error' => $validator->errors(),
            ], 422);
        }
        $poliklinik = Poliklinik::findOrFail($id);
        $poliklinik->update([
            'id' => $request->id,
            'nama' => $request->nama,
            'code_ruangan' => $request->code_ruangan,
        ]);

        return response()->json([
            'message' => 'Update Poliklinik Data successful',
            'data' => $poliklinik,
        ], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            $poliklinik =Poliklinik::find($id);
            $poliklinik->delete();
            return ResponseFormatter::success([
                'message' => 'Delete poliklinik data successful',
            ],'Delete Poliklinik data successful',500);
        } catch(QueryException $error) {
            return ResponseFormatter::error([
                'message' => 'something went wrong',
                'error' => $error,
            ], 'Poliklinik Data not deleted', 500);
        }
    }
}
