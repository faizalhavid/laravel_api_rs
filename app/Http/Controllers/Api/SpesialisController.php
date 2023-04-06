<?php

namespace App\Http\Controllers\Api;
use App\Helpers\ResponseFormatter;
use App\Models\Spesialis;
use App\Http\Requests\StoreSpesialisRequest;
use App\Http\Requests\UpdateSpesialisRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SpesialisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $spesialis = Spesialis::all();
        $id = $request->input('id');
        if ($id) {
            $spesialis = Spesialis::find($id);
            if ($spesialis) {
                return ResponseFormatter::success([
                    'data' => $spesialis,
                    'message' => 'Data Spesialis Berhasil diambil',
                ]);
            } else {
                return ResponseFormatter::error(404, 'Data Thematic tidak ditemukan');
            }
        }
        return ResponseFormatter::success([
            'data' => $spesialis,
            'message' => 'Data Berhasil diambil',
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'nama' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation',
                'error' => $validator->errors(),
            ], 422);
        }

        $spesialis = Spesialis::create([
            'id' => $request->id,
            'nama' => $request->nama,
        ]);

        return response()->json([
            'message' => 'Create Spesialis Data successful',
            'data' => $spesialis,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request,$id)
    {
        $spesialis = Spesialis::findOrFail($id);
        // $error = ResponseFormatter::error();
        if (is_null($spesialis)){
            return ResponseFormatter::error([                'message' => 'something went wrong',
        ], 'Spesialis data is null ', 422);
        }else {
            return response()->json([
                'message' => 'Show Spesialis data Successful',
                'data' => $spesialis,
            ], 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Spesialis $spesialis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSpesialisRequest $request, Spesialis $spesialis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Spesialis $spesialis)
    {
        //
    }
}
