<?php
namespace App\Http\Controllers\Core;

use App\Http\Controllers\Sunat\Zipeoxml;
use Greenter\XMLSecLibs\Sunat\SignedXml;

class VoidedDocumentsCore
{
	 
	public function VoidedDocuments()
    {
		$objzip = new Zipeoxml;
		$UblVersionId ='2.0';
		$CustomizationId ='1.0';
		$writer = new \XMLWriter();
		$writer->openMemory();
		$writer->setIndent(true);
		$writer->setIndentString(" ");
		$writer->startDocument('1.0','ISO-8859-1');	
		$writer->startElement('VoidedDocuments');		
		$writer->writeAttribute('xmlns','urn:sunat:names:specification:ubl:peru:schema:xsd:VoidedDocuments-1');
		$writer->writeAttributeNS('xmlns','cac', null, 'urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2');
		$writer->writeAttributeNS('xmlns','cbc', null, 'urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2');
		$writer->writeAttributeNS('xmlns','ds', null, 'http://www.w3.org/2000/09/xmldsig#');
		$writer->writeAttributeNS('xmlns','ext', null, 'urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2');
		$writer->writeAttributeNS('xmlns','sac', null, 'urn:sunat:names:specification:ubl:peru:schema:xsd:SunatAggregateComponents-1');
		$writer->writeAttributeNS('xmlns','xsi', null, 'http://www.w3.org/2001/XMLSchema-instance');
		
		$writer->startElementNS('ext','UBLExtensions',null);
		
		$writer->startElementNS('ext','UBLExtension',null);
		
		$writer->startElementNS('ext','ExtensionContent','urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2');
		

		
		// En esta zona va el certificado digital.
		$writer->endElement();
		$writer->endElement();
		
		$writer->endElement();
		
		$writer->writeElementNS('cbc','UBLVersionID', null,$UblVersionId);
		$writer->writeElementNS('cbc','CustomizationID', null,$CustomizationId);
		$writer->writeElementNS('cbc','ID', null,$UblVersionId);
		$writer->writeElementNS('cbc','ReferenceDate', null,$UblVersionId);
		$writer->writeElementNS('cbc','IssueDate', null,$UblVersionId);
		
		
		$writer->startElementNS('cac','Signature',null);
		$writer->writeElementNS('cbc','ID', null,'04');
		
		$writer->startElementNS('cac','SignatoryParty',null);
		
		$writer->startElementNS('cac','PartyIdentification',null);
		$writer->writeElementNS('cbc','ID', null,'04');
		$writer->endElement();
		
		$writer->startElementNS('cac','PartyName',null);
		$writer->writeElementNS('cbc','Name', null,'04');
		$writer->endElement();
		
		$writer->endElement();
		
		$writer->startElementNS('cac','DigitalSignatureAttachment',null);
		
		$writer->startElementNS('cac','ExternalReference',null);
		$writer->writeElementNS('cbc','URI', null,'04');
		$writer->endElement();
		
		$writer->endElement();
		
		$writer->endElement();
		
		$writer->startElementNS('cac','AccountingSupplierParty',null);
		$writer->writeElementNS('cbc','CustomerAssignedAccountID', null,'04');
		$writer->writeElementNS('cbc','AdditionalAccountID', null,'04');
		
		
		$writer->startElementNS('cac','Party',null);
		$writer->startElementNS('cac','PartyLegalEntity',null);
		$writer->startElementNS('cac','RegistrationName',null);
		$writer->writeCData('');
		$writer->endElement();
		$writer->endElement();
		$writer->endElement();
		$writer->endElement();
		
		//for
		$writer->startElementNS('sac','VoidedDocumentsLine',null);
		$writer->writeElementNS('cbc','LineID', null,'04');
		$writer->writeElementNS('cbc','DocumentTypeCode', null,'04');
		$writer->writeElementNS('sac','DocumentSerialID', null,'04');
		$writer->writeElementNS('sac','DocumentNumberID', null,'04');
		$writer->writeElementNS('sac','VoidReasonDescription', null,'04');
		$writer->endElement();
		
		$writer->endElement();
		$writer->endDocument();
		//header('Content-type: text/xml');
		//echo $writer->outputMemory();
		 $carpeta="XML/";
		 $filename = "example2";
		 $extension=".xml";
		 $file = $writer->outputMemory();
		

		//$writer->flush();
		// $file->store('xls', storage_path('app/public/exports'));
            // $link=\Storage::url('public/exports/'.$hoy.'.xls');
            // return  $link;
		
		\Storage::disk('local')->put($carpeta.$filename.$extension, $file);
		
		$xmlPath = storage_path('app/'.$carpeta.$filename.'.xml');
		$certPath = storage_path('app/key/LLAMA-PE-CERTIFICADO-DEMO-10765604945.pem'); // Convertir pfx to pem 

		$signer = new SignedXml();
		$signer->setCertificateFromFile($certPath);

		$xmlSigned = $signer->signFromFile($xmlPath);
		\Storage::disk('local')->put($carpeta.$filename.$extension, $xmlSigned);
		//file_put_contents($filename.$extension,$file);
		// $zip = new ZipArchive();
 
		// $filenamezip = 'example3.zip';
 
		// if($zip->open($filenamezip,ZIPARCHIVE::CREATE)===true) {
				// $zip->addFile('example3.xml');
				// $zip->close();
				// echo 'Creado '.$filenamezip;
		// }
		// else {
				// echo 'Error creando '.$filenamezip;
		// }
		$objzip->ziparchivo($filename,$carpeta);
		//$writer->flush();
		$filename='10292703151-RA-20170309-6';
		
		return $filename;
	}
}
?>