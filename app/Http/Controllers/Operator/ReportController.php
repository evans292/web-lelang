<?php

namespace App\Http\Controllers\Operator;

use App\Exports\AuctionsExport;
use App\Models\Auction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ReportController extends Controller
{
    //
    public function index(Request $request)
    {
        $datas = Auction::whereBetween('auction_date', [$request->tgl1, $request->tgl2])->get();
        return view('operator.both.report.index', compact('datas', 'request'));
    }

    public function exportExcel($tgl1, $tgl2)
    {
        return (new AuctionsExport($tgl1, $tgl2))->download('invoices.xlsx');
    }
}
