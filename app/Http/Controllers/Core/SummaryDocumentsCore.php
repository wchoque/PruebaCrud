<?php
namespace App\Http\Controllers\Core;

use App\Http\Controllers\Sunat\Zipeoxml;
use Greenter\XMLSecLibs\Sunat\SignedXml;

class SummaryDocumentsCore
{
	 
	public function SummaryDocuments()
    {
		$objzip = new Zipeoxml;
		$UblVersionId ='2.0';
		$CustomizationId ='1.1';
		$writer = new \XMLWriter();
		$writer->openMemory();
		$writer->setIndent(true);
		$writer->setIndentString(" ");
		$writer->startDocument('1.0','ISO-8859-1');		
		$writer->startElement('SummaryDocuments');
		$writer->writeAttribute('xmlns','urn:sunat:names:specification:ubl:peru:schema:xsd:SummaryDocuments-1');
		$writer->writeAttributeNS('xmlns','cac', null, 'urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2');
		$writer->writeAttributeNS('xmlns','cbc', null, 'urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2');
		$writer->writeAttributeNS('xmlns','ds', null,'http://www.w3.org/2000/09/xmldsig#');
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
		
		//Versión del UBL utilizado para establecer el formato XML
		$writer->writeElementNS('cbc','UBLVersionID', null,'RC-20171227-00001');
		//Versión de la estructura del documento
		$writer->writeElementNS('cbc','CustomizationID', null,$CustomizationId);
		//Identificador del resumen
		$writer->writeElementNS('cbc','ID', null,'RC-20171227-00001');
		//Fecha de generación del resumen
		$writer->writeElementNS('cbc','IssueDate', null,$UblVersionId);
		//Fecha de emisión de los documentos
		$writer->writeElementNS('cbc','ReferenceDate', null,$UblVersionId);
		
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
		
		//Número de RUC
		//Apellidos y nombres o denominación o razón social
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
		$writer->startElementNS('sac','SummaryDocumentsLine',null);
		// Número de fila
		// Serie y número de comprobante de pago
		// Tipo de comprobante de pago
		$writer->writeElementNS('cbc','LineID', null,'04');
		$writer->writeElementNS('cbc','ID', null,'04');
		$writer->writeElementNS('cbc','DocumentTypeCode', null,'04');
		
		$writer->writeElementNS('sac','DocumentSerialID', null,'04');
		$writer->writeElementNS('sac','StartDocumentNumberID', null,'04');
		$writer->writeElementNS('sac','EndDocumentNumberID', null,'04');
		
		//Número de documento de identidad del adquiriente o usuario
		//Tipo de documento de identidad del adquiriente o usuario

		$writer->startElementNS('cac','AccountingCustomerParty',null);
		$writer->writeElementNS('cbc','CustomerAssignedAccountID', null,'04');
		$writer->writeElementNS('cbc','AdditionalAccountID', null,'04');
		$writer->endElement();
		
		//Serie y Número de la boleta de venta que modifica
		//Tipo de documento que modifica
		$writer->startElementNS('cac','BillingReference',null);
		$writer->startElementNS('cac','InvoiceDocumentReference',null);
		$writer->writeElementNS('cbc','ID', null,'04');
		$writer->writeElementNS('cbc','DocumentTypeCode', null,'04');
		$writer->endElement();
		$writer->endElement();
		
		//Estado del ítem
		$writer->startElementNS('cac','Status',null);
		$writer->writeElementNS('cbc','ConditionCode', null,'04');
		$writer->endElement();
		
		//Importe total de la venta, cesión en uso o del servicio prestado
		$writer->startElementNS('sac','TotalAmount', null);
		$writer->writeAttribute('currencyID','02');
		$writer->text('F100-10');
		$writer->endElement();
		
			//for
			//Total valor de venta - operaciones gravadas
			//Total valor de venta - operaciones exoneradas
			//Total valor de venta - operaciones inafectas
			//Total valor de venta - operaciones gratuitas
			$writer->startElementNS('sac','BillingPayment', null);
			$writer->startElementNS('cbc','PaidAmount', null);
			$writer->writeAttribute('currencyID','02');
			$writer->text('F100-10');
			$writer->endElement();
			$writer->writeElementNS('cbc','InstructionID', null,'04');
			$writer->endElement();
			//
		
		//Importe total de sumatoria otros cargos del ítem
		$writer->startElementNS('cac','AllowanceCharge', null);
		$writer->writeElementNS('cbc','ChargeIndicator', null,'04');
		$writer->startElementNS('cbc','Amount', null);
		$writer->writeAttribute('currencyID','02');
		$writer->text('F100-10');
		$writer->endElement();
		$writer->endElement();
		
			//for
			//Total ISC
			//Total IGV
			//Total Otros tributos
			$writer->startElementNS('cac','TaxTotal', null);
			$writer->startElementNS('cbc','TaxAmount', null);
			$writer->writeAttribute('currencyID','02');
			$writer->text('F100-10');
			$writer->endElement();
			
			$writer->startElementNS('cac','TaxSubtotal', null);
			$writer->startElementNS('cbc','TaxAmount', null);
			$writer->writeAttribute('currencyID','02');
			$writer->text('F100-10');
			$writer->endElement();
			
			$writer->startElementNS('cac','TaxCategory', null);
			$writer->startElementNS('cac','TaxScheme', null);
			$writer->writeElementNS('cbc','ID', null,'04');
			$writer->writeElementNS('cbc','Name', null,'04');
			$writer->writeElementNS('cbc','TaxTypeCode', null,'04');
			$writer->endElement();
			$writer->endElement();
			$writer->endElement();
			
			$writer->endElement();

		$writer->endElement();		
		
		$writer->endElement();
		$writer->endDocument();
		//header('Content-type: text/xml');
		//echo $writer->outputMemory();
		$carpeta="XML/";
		 $filename = "example4";
		 $extension=".xml";
		 $file = $writer->outputMemory();
		
		\Storage::disk('local')->put($carpeta.$filename.$extension, $file);
		
		$xmlPath = storage_path('app/'.$carpeta.$filename.'.xml');
		$certPath = storage_path('app/key/LLAMA-PE-CERTIFICADO-DEMO-10765604945.pem'); // Convertir pfx to pem 

		$signer = new SignedXml();
		$signer->setCertificateFromFile($certPath);

		$xmlSigned = $signer->signFromFile($xmlPath);
		\Storage::disk('local')->put($carpeta.$filename.$extension, $xmlSigned);
		//file_put_contents($carpeta.$filename.$extension,$file);
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
		return $filename;
	}
}
?>