<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use DataTables;
class WhmController extends Controller
{
    public function getInvoices(Request $request)
    {
        if ($request->ajax()) {
    		$data = DB::table('tblinvoices')->select('tblinvoices.id', 'tblclients.firstname','tblclients.lastname','tblclients.companyname','tblclients.address1')->join('tblclients','tblclients.id','=','tblinvoices.userid')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="/client-register/'.$row->id.'" class="btn btn-primary btn-sm">Generate Perjanjian</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
