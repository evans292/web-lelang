<?php

namespace App\Exports;

use App\Models\Auction;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AuctionsExport implements FromView, WithColumnWidths, WithStyles
{
    use Exportable;

    public function __construct(string $tgl1, string $tgl2)
    {
        $this->tgl1 = $tgl1;
        $this->tgl2 = $tgl2;
    }

    public function view(): View
    {
        return view('operator.both.report.table', [
            'auctions' => Auction::whereBetween('auction_date', [$this->tgl1, $this->tgl2])->get(),
            'tgl1' => $this->tgl1,
            'tgl2' => $this->tgl2,
        ]);
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,            
            'B' => 20,            
            'C' => 20,            
            'D' => 20,            
            'E' => 20,            
            'F' => 20,            
            'G' => 20,            
            'H' => 20,            
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            2    => ['font' => ['bold' => true]],
        ];
    }
}
