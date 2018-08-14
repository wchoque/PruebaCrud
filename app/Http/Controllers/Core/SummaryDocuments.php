<?php
include 'espacionombres.php';
include 'Formatos.php';
include 'zipeoxml.php';

use espacionombre\espaciodenombres;
use Formato\Formatos;
use zipxml\zipxmls;

		$obj = new espaciodenombres;
		$objf = new Formatos;
		$objzip = new zipxmls;
		$UblVersionId ='2.0';
		$CustomizationId ='1.0';
		$writer = new XMLWriter();
		$writer->openMemory();
		$writer->setIndent(true);
		$writer->setIndentString(" ");
		$writer->startDocument('1.0',$objf->EncodingIso);		
		$writer->startElement('SummaryDocuments');
		$writer->writeAttribute('xmlns',$obj->xmlnsSummaryDocuments);
		$writer->writeAttributeNS('xmlns','cac', null, $obj->cac);
		$writer->writeAttributeNS('xmlns','cbc', null, $obj->cbc);
		$writer->writeAttributeNS('xmlns','ds', null, $obj->ds);
		$writer->writeAttributeNS('xmlns','ext', null, $obj->ext);
		$writer->writeAttributeNS('xmlns','sac', null, $obj->sac);
		$writer->writeAttributeNS('xmlns','xsi', null, $obj->xsi);
		
		$writer->startElementNS('ext','UBLExtensions',null);
		
		$writer->startElementNS('ext','UBLExtension',null);
		
		$writer->startElementNS('ext','ExtensionContent',$obj->ext);
		
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
		$writer->startElementNS('sac','SummaryDocumentsLine',null);
		$writer->writeElementNS('cbc','LineID', null,'04');
		$writer->writeElementNS('cbc','DocumentTypeCode', null,'04');
		
		$writer->writeElementNS('cbc','ID', null,'04');
		
		$writer->writeElementNS('sac','DocumentSerialID', null,'04');
		$writer->writeElementNS('sac','StartDocumentNumberID', null,'04');
		$writer->writeElementNS('sac','EndDocumentNumberID', null,'04');
		
		$writer->startElementNS('cac','AccountingCustomerParty',null);
		$writer->writeElementNS('cbc','CustomerAssignedAccountID', null,'04');
		$writer->writeElementNS('cbc','AdditionalAccountID', null,'04');
		$writer->endElement();
		
		$writer->startElementNS('cac','BillingReference',null);
		$writer->startElementNS('cac','InvoiceDocumentReference',null);
		$writer->writeElementNS('cbc','ID', null,'04');
		$writer->writeElementNS('cbc','DocumentTypeCode', null,'04');
		$writer->endElement();
		$writer->endElement();
		
		$writer->startElementNS('cac','Status',null);
		$writer->writeElementNS('cbc','ConditionCode', null,'04');
		$writer->endElement();
		
		$writer->startElementNS('sac','TotalAmount', null);
		$writer->writeAttribute('currencyID','02');
		$writer->text('F100-10');
		$writer->endElement();
		
			//for
			$writer->startElementNS('sac','BillingPayment', null);
			$writer->startElementNS('cbc','PaidAmount', null);
			$writer->writeAttribute('currencyID','02');
			$writer->text('F100-10');
			$writer->endElement();
			$writer->writeElementNS('cbc','InstructionID', null,'04');
			$writer->endElement();
		
		$writer->startElementNS('cac','AllowanceCharge', null);
		$writer->writeElementNS('cbc','ChargeIndicator', null,'04');
		$writer->startElementNS('cbc','Amount', null);
		$writer->writeAttribute('currencyID','02');
		$writer->text('F100-10');
		$writer->endElement();
		$writer->endElement();
		
			//for
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
		 $filename = "example3";
		 $extension=".xml";
		 $file = $writer->outputMemory();
		
		file_put_contents($carpeta.$filename.$extension,$file);
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

?>