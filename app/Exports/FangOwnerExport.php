<?php

namespace App\Exports;

use App\Models\admin\FangOwner;
use Maatwebsite\Excel\Concerns\FromCollection;

class FangOwnerExport implements FromCollection
{

    public function collection()
    {
//         TODO: Implement collection() method.
        return FangOwner::all();
    }
}
