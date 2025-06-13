<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasyarakatRequest;
use App\Models\Masyarakat;
use Illuminate\Http\Request;

class MasyarakatController extends Controller
{
    public function cekNik(MasyarakatRequest $request)
    {
        $nik = $request->input('nik');

        $masyarakat = Masyarakat::where('nik', $nik)->first();

        if (!$masyarakat) {
            return response()->json([
                'message' => 'NIK tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'message' => 'NIK ditemukan.',
            'data' => $masyarakat,
        ]);
    }
}
