<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiResponse;
use App\Http\Controllers\Api\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Core\InvoiceCore;
use App\Http\Controllers\Core\CreditNoteCore;
use App\Http\Controllers\Core\DebitNoteCore;
use App\Http\Controllers\Core\SummaryDocumentsCore;
use App\Http\Controllers\Core\VoidedDocumentsCore;
use App\Http\Controllers\Sunat\Envioxmlsunat;

class ProcessController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');

    }
    public function Process()
    {
		$tipodocumento='RA';
		$envio=new Envioxmlsunat();
		
		switch ($tipodocumento) {
			case '01':
				 $core = new InvoiceCore();
				 $filename=$core->Invoice();
				 
				 $message=$envio->EnvioDocumentos($filename);
				 return $message;
				break;
			case '03':
				$core = new InvoiceCore();
				$filename=$core->Invoice();
				
				 $message=$envio->EnvioDocumentos($filename);
				 return $message;
				break;
			case '07':
				$core = new CreditNoteCore();
				$filename=$core->CreditNote();	
				
				 $message=$envio->EnvioDocumentos($filename);
				 return $message;				
				break;
			case '08':
				$core = new DebitNoteCore();
				$filename=$core->DebitNote();
				
				 $message=$envio->EnvioDocumentos();
				 return $message;
				break;
			case 'RC':
				$core = new SummaryDocumentsCore();
				$filename=$core->SummaryDocuments();
				 
				 $message=$envio->EnvioResumen($filename);
				 return $message;
				break;
			case 'RA':
				$core = new VoidedDocumentsCore();
				$filename=$core->VoidedDocuments();
				 
				 $message=$envio->EnvioComunicacionBaja($filename);
				 return $message;
				break;
		}
		
		
       
		
	
		
		
		
		
		
		// 
		
		
    }
}
