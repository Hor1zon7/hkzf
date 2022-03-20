<?php

namespace App\Http\Controllers;

use App\Exports\TestExport;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Maatwebsite\Excel\Facades\Excel;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

//    导出excel
    public function excel(\Illuminate\Http\Request $request)
    {
        $type = $request->get('type');
        return Excel::download(new TestExport($type), 'test.xlsx');
    }

    public function live()
    {
        return view('common.live');
    }
}
