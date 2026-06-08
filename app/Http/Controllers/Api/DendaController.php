<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DendaLog;
use Illuminate\Http\Request;

class DendaController extends Controller
{
    public function indexApi(Request $request)
    {
        $penyewaId = $request->user()->penyewa->id_penyewa;

        $denda = DendaLog::whereHas('transaksi', function($q) use ($penyewaId) {
                    $q->where('id_penyewa', $penyewaId);
                 })
                 ->orderBy('created_at', 'desc')
                 ->get();

        return response()->json(['data' => $denda]);
    }
}
