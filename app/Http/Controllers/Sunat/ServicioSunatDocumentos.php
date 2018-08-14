<?php

namespace App\Http\Controllers\Sunat;

use App\Http\Controllers\Sunat\Zipeoxml;

class CustomHeaders extends \SoapHeader
	{ 
		private $wss_ns = 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd'; 
		function __construct($user, $pass, $ns = null) 
		{ 
			if ($ns) 
			{ 
				$this->wss_ns = $ns; 
			} 
			$auth = new \stdClass; 
			$auth->Username = new \SoapVar($user, XSD_STRING, NULL, $this->wss_ns, NULL, $this->wss_ns); 
			$auth->Password = new \SoapVar($pass, XSD_STRING, NULL, $this->wss_ns, NULL, $this->wss_ns); 
			$username_token = new \stdClass(); 
			$username_token->UsernameToken = new \SoapVar($auth, SOAP_ENC_OBJECT, NULL, $this->wss_ns, 'UsernameToken', $this->wss_ns); 
			$security_sv = new \SoapVar( new \SoapVar($username_token, SOAP_ENC_OBJECT, NULL, $this->wss_ns, 'UsernameToken', $this->wss_ns), SOAP_ENC_OBJECT, NULL, $this->wss_ns, 'Security', $this->wss_ns); 
			parent::__construct($this->wss_ns, 'Security', $security_sv, true); 
		}
	}



class ServicioSunatDocumentos
{
    public function RespuestaSincronoEnviarDocumento($fileName,$contentfilezip)
			{
				$user='1111111111MODDATOS';
				$pass='MODDATOS';
				$service = 'https://e-beta.sunat.gob.pe/ol-ti-itcpfegem-beta/billService?wsdl'; 
				$headers = new CustomHeaders($user, $pass); 
				$client = new \SoapClient($service, [ 'cache_wsdl' => WSDL_CACHE_NONE, 'trace' => TRUE , 'soap_version' => SOAP_1_1 ] ); 
				$client->__setSoapHeaders([$headers]); 
				$fcs = $client->__getFunctions();
				//$fileName='10292703151-03-B001-0004078.zip';
				//$contentfilezip=file_get_contents('XML/'.$fileName);
				$params = array( 'fileName' => $fileName, 'contentFile' => $contentfilezip ); 
				$resultado = $client->sendBill($params);
				
				// $resultado = $client->getstatus([
				// 'ticket' => '10292703151 01 f001-0004995'
				// ]);
				//print_r($resultado);
				//echo $fileName;
				
				//echo $resultado->status->content;
				
				$ziprespuesta=$resultado->applicationResponse;
				
				return $ziprespuesta;
				
				//file_put_contents('CDR/'.'R-'.$fileName,$ziprespuesta);
				//echo $resultado->status->statusCode;
				// $
			}
			
			public function RespuestaAsincronoEnviarResumen($fileName,$contentfilezip)
			{
				$user='1111111111MODDATOS';
				$pass='MODDATOS';
				$service = 'https://e-beta.sunat.gob.pe/ol-ti-itcpfegem-beta/billService?wsdl'; 
				$headers = new CustomHeaders($user, $pass); 
				$client = new \SoapClient($service, [ 'cache_wsdl' => WSDL_CACHE_NONE, 'trace' => TRUE , 'soap_version' => SOAP_1_1 ] ); 
				$client->__setSoapHeaders([$headers]); 
				$fcs = $client->__getFunctions();
				//$fileName='10292703151-03-B001-0004078.zip';
				//$contentfilezip=file_get_contents('XML/'.$fileName);
				$params = array( 'fileName' => $fileName, 'contentFile' => $contentfilezip ); 
				$resultado = $client->sendSummary($params);
				
				// $resultado = $client->getstatus([
				// 'ticket' => '10292703151 01 f001-0004995'
				// ]);
				//print_r($resultado);
				//echo $fileName;
				
				//echo $resultado->status->content;
				
				$ticket=$resultado->ticket;
				
				$ziprespuesta=$this->RespuestaSincronoConsultarTicket($ticket);
				
				
				return $ziprespuesta;
				
				//file_put_contents('CDR/'.'R-'.$fileName,$ziprespuesta);
				//echo $resultado->status->statusCode;
				// $
			}
			
			public function RespuestaSincronoConsultarTicket($ticket)
			{
				$user='1111111111MODDATOS';
				$pass='MODDATOS';
				$service = 'https://e-beta.sunat.gob.pe/ol-ti-itcpfegem-beta/billService?wsdl'; 
				$headers = new CustomHeaders($user, $pass); 
				$client = new \SoapClient($service, [ 'cache_wsdl' => WSDL_CACHE_NONE, 'trace' => TRUE , 'soap_version' => SOAP_1_1 ] ); 
				$client->__setSoapHeaders([$headers]); 
				$fcs = $client->__getFunctions();
				//$fileName='10292703151-03-B001-0004078.zip';
				//$contentfilezip=file_get_contents('XML/'.$fileName);
				$params = array( 'ticket' => $ticket ); 
				//$resultado = $client->sendBill($params);
				
				$resultado = $client->getstatus($params);
				//print_r($resultado);
				//echo $fileName;
				
				//echo $resultado->status->content;
								
				$ziprespuesta=$resultado->status->content;
				
				return $ziprespuesta;
				
				//file_put_contents('CDR/'.'R-'.$fileName,$ziprespuesta);
				//echo $resultado->status->statusCode;
				// $
			}
}
