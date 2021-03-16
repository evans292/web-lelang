<?php

namespace App\Http\Controllers\Operator;

use App\Models\Auction;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use App\Exports\AuctionsExport;
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
        return (new AuctionsExport($tgl1, $tgl2))->download("Laporan-Lelang-$tgl1-$tgl2.xlsx");
    }

    public function exportPdf($tgl1, $tgl2)
    {
    // retreive all records from db
      $auctions = Auction::whereBetween('auction_date', [$tgl1, $tgl2])->get();

      // share auctions to view
      view()->share('auctions',$auctions);
      view()->share('tgl1',$tgl1);
      view()->share('tgl2',$tgl2);
      $pdf = PDF::loadView('operator.both.report.table');

      // download PDF file with download method
      return $pdf->download("Laporan-Lelang-$tgl1-$tgl2.pdf");
    }
}
