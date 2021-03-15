<?php

namespace App\Exports;

use App\Models\Auction;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class AuctionsExport implements FromQuery
{
    use Exportable;
    
    public function __construct(string $tgl1, string $tgl12)
    {
        $this->tgl1 = $tgl1;
        $this->tgl2 = $tgl1;
    }

    public function query()
    {
        return Auction::query();
    }
}
