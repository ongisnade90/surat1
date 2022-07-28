<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use PhpOffice\PhpWord\Settings;
use PDF;
use DB;
use Terbilang;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function clientRegister(Request $request,$id){
    	$data = DB::table('tblinvoices')->select('tblinvoices.id', 'tblclients.firstname','tblclients.lastname','tblclients.companyname','tblclients.address1')->join('tblclients','tblclients.id','=','tblinvoices.userid')->where('tblinvoices.id', $id)->get();
        // return $data;
        return view('register',compact('data'));
    }
    public function getAgreement(Request $request){
        $now = Carbon::now();
        // $header = $request->header;
        // $pt = $request->pt;
        // $address = $request->address;
        $all = $request->all();
        return view('paper',compact('now','all'));
    }
    public function readWord(Request $request){
        $company = $request->get('company');
        $client = $request->get('client');
        $pembayaran = $request->get('pembayaran');

        $PdfPath = base_path('vendor/dompdf/dompdf');
        \PhpOffice\PhpWord\Settings::setPdfRendererPath($PdfPath);
        \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');
        $template = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('perjanjian.docx'));
        $template->setValue('company_name',$company);
        $template->setValue('client_name',$client);
        $template->setValue('pembayaran',$pembayaran);
        $path = storage_path('generated.docx');
        $template->saveAs($path);
        $phpWord = \PhpOffice\PhpWord\IOFactory::load($path);
        $pdf = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord,'HTML');
        $pdf->save(storage_path('generated.html'),TRUE);
        // $phpWord = IOFactory::load('document.docx', 'Word2007');
        // $phpWord->save(storage_path('result.html'),TRUE);
        return "ok";

    }

    public function loadData(Request $request)
    {
    	if ($request->has('q')) {
    		$cari = '%'.$request->q.'%';
    		$data = DB::table('tblinvoices')->select('tblinvoices.id', 'tblclients.firstname','tblclients.lastname','tblclients.companyname','tblclients.address1')->join('tblclients','tblclients.id','=','tblinvoices.userid')->where('tblinvoices.id', 'LIKE', $cari)->get();
    		return response()->json($data);
    	}
    }
    public function storeSkp(Request $request){
         $dt = Carbon::now('Asia/Jakarta')->format('l, d F Y');
         $date = Terbilang::date($dt);
         $header = $request->header;
         $pt = $request->pt;
         $address = $request->address;
         $invoice_id = $request->invoice_id;
         $name = $request->name;
        // $all = $request->all();
        return view('paper',['pt'=>$pt, 'address'=>$address,'header'=>$header, 'invoice_id'=>$invoice_id, 'name'=>$name, 'date'=>$date]);
    }
}

?>
