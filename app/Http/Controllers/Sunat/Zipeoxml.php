<?php

namespace App\Http\Controllers\Sunat;

class Zipeoxml
{
	
	public function ziparchivo($filename,$carpeta)
		{
			$zip = new \ZipArchive;
			
			$filenamezip = storage_path('app/'.$carpeta.$filename.'.zip');
	 
			if($zip->open($filenamezip,\ZIPARCHIVE::CREATE)===true) {
					$zip->addFile(storage_path('app/'.$carpeta.$filename.'.xml'),$filename.'.xml');
					$zip->close();
					echo 'Creado '.$filenamezip;
			}
			else 
			{
					echo 'Error creando '.$filenamezip;
			}
		}
		
	public function leerarchivo($filenamexml,$filename,$ziprespuesta)
	{
		// $obj = new espaciodenombres;
		$filenamezip='CDR/'.'R-'.$filename;
		
		//file_put_contents($filenamezip,$ziprespuesta);
		
		\Storage::disk('local')->put($filenamezip, $ziprespuesta);
		
		// echo $filename;
		
		$zip = new \ZipArchive;
		
		//$zip = zip_open($filenamezip);
		$res = $zip->open(storage_path('app/'.$filenamezip));
		if ($res === TRUE) {
			$zip->extractTo(storage_path('app/CDR/'),'R-'.$filenamexml);				
			$zip->close();
			
			$feed = file_get_contents(storage_path('app/CDR/'.'R-'.$filenamexml));
			$sxe = new \SimpleXMLElement($feed);

				$sxe->registerXPathNamespace('c', 'urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2');
				$resultado = $sxe->xpath('//c:ResponseCode');
				$resultado1 = $sxe->xpath('//c:Description');
				foreach ($resultado as $titulo) {
						$message=$titulo;
					}
				foreach ($resultado1 as $titulo1) {
						$message=$message.$titulo1;
					}
			
			$message=$message.'ok';
		} else {
			echo 'failed';
		}
		
		return $message;
		
	}
}
