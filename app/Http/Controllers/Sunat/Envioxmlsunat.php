<?php

namespace App\Http\Controllers\Sunat;

use App\Http\Controllers\Sunat\ServicioSunatDocumentos;
use App\Http\Controllers\Sunat\Zipeoxml;


class Envioxmlsunat
{
    public function EnvioDocumentos($filename)
    {
		
        $serviciosunat = new ServicioSunatDocumentos;
		$objzip = new Zipeoxml;
		
		$filenamexml=$filename.'.xml';
		
		//$fileNamezip='10292703151-03-B001-0004078.zip';
		$fileNamezip=$filename.'.zip';
		
		$contentfilezip=file_get_contents(storage_path('app/XML/'.$fileNamezip));						
		$ziprespuesta=$serviciosunat->RespuestaSincronoEnviarDocumento($fileNamezip,$contentfilezip);
		$message=$objzip->leerarchivo($filenamexml,$fileNamezip,$ziprespuesta);
		return $message;

    }
    
    public function EnvioResumen($filename)
    {
        $serviciosunat = new ServicioSunatDocumentos;
		$objzip = new Zipeoxml;
		
		$filenamexml=$filename.'.xml';
		//$filenamexml='10292703151-RA-20170309-6.xml';
		
		$fileNamezip=$filename.'.zip';

		
		$contentfilezip=file_get_contents(storage_path('app/XML/'.$fileNamezip));		
		
		$ziprespuesta=$serviciosunat->RespuestaAsincronoEnviarResumen($fileNamezip,$contentfilezip);

		$message=$objzip->leerarchivo($filenamexml,$fileNamezip,$ziprespuesta);
		return $message;
    }
	
	public function EnvioComunicacionBaja($filename)
    {
        $serviciosunat = new ServicioSunatDocumentos;
		$objzip = new Zipeoxml;
		
		$filenamexml=$filename.'.xml';
		//$filenamexml='10292703151-RA-20170309-6.xml';

		
		$fileNamezip=$filename.'.zip';

		
		$contentfilezip=file_get_contents(storage_path('app/XML/'.$fileNamezip));		
		
		$ziprespuesta=$serviciosunat->RespuestaAsincronoEnviarResumen($fileNamezip,$contentfilezip);

		$message=$objzip->leerarchivo($filenamexml,$fileNamezip,$ziprespuesta);
		return $message;
    }
 
}
