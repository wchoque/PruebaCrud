<?php
include 'espacionombres.php';
include 'Formatos.php';
include 'zipeoxml.php';

use espacionombre\espacionombres;
use Formato\Formatos;
use zipxml\zipxmls;

		$obj = new espacionombres;
		$objf = new Formatos;
		$objzip = new zipxmls;
		$UblVersionId ='2.0';
		$CustomizationId ='1.0';
		$writer = new XMLWriter();
		$writer->openMemory();
		$writer->setIndent(true);
		$writer->setIndentString(" ");
		$writer->startDocument('1.0',$objf->EncodingIso);		
		$writer->startElement('Perception');
		$writer->writeAttribute('xmlns',$obj->xmlnsPerception);
		$writer->writeAttributeNS('xmlns','cac', null, $obj->cac);
		$writer->writeAttributeNS('xmlns','cbc', null, $obj->cbc);
		$writer->writeAttributeNS('xmlns','ccts', null, $obj->ccts);
		$writer->writeAttributeNS('xmlns','ds', null, $obj->ds);
		$writer->writeAttributeNS('xmlns','ext', null, $obj->ext);
		$writer->writeAttributeNS('xmlns','qdt', null, $obj->qdt);
		$writer->writeAttributeNS('xmlns','sac', null, $obj->sac);
		$writer->writeAttributeNS('xmlns','udt', null, $obj->udt);
		$writer->writeAttributeNS('xmlns','xsi', null, $obj->xsi);
		
		$writer->startElementNS('ext','UBLExtensions',null);
		
		$writer->startElementNS('ext','UBLExtension',null);
		
		$writer->startElementNS('ext','ExtensionContent',null);
		
		// En esta zona va el certificado digital.
		$writer->endElement();
		$writer->endElement();
		
		$writer->endElement();
		
		$writer->writeElementNS('cbc','UBLVersionID', null,$UblVersionId);
		$writer->writeElementNS('cbc','CustomizationID', null,$CustomizationId);
		
		$writer->startElementNS('cac','Signature',null);
		$writer->writeElementNS('cbc','ID', null,'04');
		
		$writer->startElementNS('cac','SignatoryParty',null);
		
		$writer->startElementNS('cac','PartyIdentification',null);
		$writer->writeElementNS('cbc','ID', null,'04');
		$writer->endElement();
		
		$writer->startElementNS('cac','PartyName',null);
		$writer->startElementNS('cbc','Name',null);
		$writer->writeCData('');
		$writer->endElement();
		$writer->endElement();
		
		$writer->endElement();
		
		$writer->startElementNS('cac','DigitalSignatureAttachment',null);
		
		$writer->startElementNS('cac','ExternalReference',null);
		$writer->writeElementNS('cbc','URI', null,'04');
		$writer->endElement();
		
		$writer->endElement();
		
		$writer->endElement();
		
		$writer->writeElementNS('cbc','ID', null,'04');
		$writer->writeElementNS('cbc','IssueDate', null,'04');
		
		$writer->startElementNS('cac','AccountingSupplierParty',null);
		$writer->writeElementNS('cbc','CustomerAssignedAccountID', null,'04');
		$writer->writeElementNS('cbc','AdditionalAccountID', null,'04');
		
		$writer->startElementNS('cac','Party',null);
		
		$writer->startElementNS('cac','PartyName',null);
		
		$writer->startElementNS('cbc','Name',null);
		$writer->writeCData('');
		$writer->endElement();
		
		$writer->endElement();
		
		$writer->startElementNS('cac','PostalAddress',null);
		$writer->writeElementNS('cbc','ID', null,'04');
		$writer->writeElementNS('cbc','StreetName', null,'04');
		$writer->writeElementNS('cbc','CitySubdivisionName', null,'04');
		$writer->writeElementNS('cbc','CityName', null,'04');
		$writer->writeElementNS('cbc','CountrySubentity', null,'04');
		$writer->writeElementNS('cbc','District', null,'04');
		$writer->startElementNS('cac','Country',null);
		$writer->writeElementNS('cbc','IdentificationCode', null,'04');
		$writer->endElement();
		$writer->endElement();
		
		$writer->startElementNS('cac','PartyLegalEntity',null);
		$writer->startElementNS('cac','RegistrationName',null);
		$writer->writeCData('');
		$writer->endElement();
		$writer->endElement();
		
		$writer->endElement();
		$writer->endElement();
		
		$writer->startElementNS('cac','AgentParty',null);	
		
		$writer->startElementNS('cac','PartyIdentification',null);
		$writer->startElementNS('cbc','ID', null);
		$writer->writeAttribute('schemeID','PEN');
		$writer->text('15.25');
		$writer->endElement();
		$writer->endElement();
		
		$writer->startElementNS('cac','PartyName',null);
		
		$writer->startElementNS('cbc','Name',null);
		$writer->writeCData('');
		$writer->endElement();
		
		$writer->endElement();
				
		$writer->startElementNS('cac','PostalAddress',null);
		$writer->writeElementNS('cbc','ID', null,'04');
		$writer->startElementNS('cbc','StreetName', null);
		$writer->writeCData('');
		$writer->endElement();
		$writer->writeElementNS('cbc','CitySubdivisionName', null,'04');
		$writer->writeElementNS('cbc','CityName', null,'04');
		$writer->writeElementNS('cbc','CountrySubentity', null,'04');
		$writer->writeElementNS('cbc','District', null,'04');
		$writer->startElementNS('cac','Country',null);
		$writer->writeElementNS('cbc','IdentificationCode', null,'04');
		$writer->endElement();
		$writer->endElement();
		
		$writer->startElementNS('cac','PartyLegalEntity',null);
		$writer->startElementNS('cac','RegistrationName',null);
		$writer->writeCData('');
		$writer->endElement();
		$writer->endElement();
		
		$writer->endElement();
		
		$writer->startElementNS('cac','ReceiverParty',null);
		
		$writer->startElementNS('cac','PartyIdentification',null);
		$writer->startElementNS('cbc','ID', null);
		$writer->writeAttribute('schemeID','PEN');
		$writer->text('15.25');
		$writer->endElement();
		$writer->endElement();
		
		$writer->startElementNS('cac','PartyName',null);
		
		$writer->startElementNS('cbc','Name',null);
		$writer->writeCData('');
		$writer->endElement();
		
		$writer->endElement();
				
		$writer->startElementNS('cac','PostalAddress',null);
		$writer->writeElementNS('cbc','ID', null,'04');
		$writer->startElementNS('cbc','StreetName', null);
		$writer->writeCData('');
		$writer->endElement();
		$writer->writeElementNS('cbc','CitySubdivisionName', null,'04');
		$writer->writeElementNS('cbc','CityName', null,'04');
		$writer->writeElementNS('cbc','CountrySubentity', null,'04');
		$writer->writeElementNS('cbc','District', null,'04');
		$writer->startElementNS('cac','Country',null);
		$writer->writeElementNS('cbc','IdentificationCode', null,'04');
		$writer->endElement();
		$writer->endElement();
		
		$writer->startElementNS('cac','PartyLegalEntity',null);
		$writer->startElementNS('cac','RegistrationName',null);
		$writer->writeCData('');
		$writer->endElement();
		$writer->endElement();
		
		$writer->endElement();
		
		$writer->writeElementNS('sac','SUNATPerceptionSystemCode', null,'04');
		$writer->writeElementNS('sac','SUNATPerceptionPercent', null,'04');
		
		$writer->writeElementNS('cbc','Note', null,'04');
		
		$writer->startElementNS('cbc','TotalInvoiceAmount', null);
		$writer->writeAttribute('currencyID','02');
		$writer->text('F100-10');
		$writer->endElement();
		
		$writer->startElementNS('sac','SUNATTotalCashed', null);
		$writer->writeAttribute('currencyID','02');
		$writer->text('F100-10');
		$writer->endElement();
		
		//for
		$writer->startElementNS('sac','SUNATPerceptionDocumentReference',null);
		
		$writer->startElementNS('cbc','ID', null);
		$writer->writeAttribute('schemeID','PEN');
		$writer->text('200.00');
		$writer->endElement();
		$writer->writeElementNS('cbc','IssueDate', null,'04');
		
		$writer->startElementNS('cbc','TotalInvoiceAmount', null);
		$writer->writeAttribute('currencyID','6');
		$writer->text('20549202960');
		$writer->endElement();
		
		$writer->startElementNS('cac','Payment',null);
		$writer->writeElementNS('cbc','ID', null,'04');
		$writer->startElementNS('cbc','PaidAmount', null);
		$writer->writeAttribute('currencyID','6');
		$writer->text('20549202960');
		$writer->endElement();
		$writer->writeElementNS('cbc','PaidDate', null,'04');
		$writer->endElement();
		
		
		$writer->startElementNS('sac','SUNATPerceptionInformation',null);
		$writer->startElementNS('sac','SUNATPerceptionAmount', null);
		$writer->writeAttribute('currencyID','6');
		$writer->text('20549202960');
		$writer->endElement();
		$writer->writeElementNS('sac','SUNATPerceptionDate', null,'04');
		$writer->startElementNS('sac','SUNATNetTotalCashed', null);
		$writer->writeAttribute('currencyID','6');
		$writer->text('20549202960');
		$writer->endElement();
		$writer->startElementNS('cac','ExchangeRate', null);
		$writer->writeElementNS('cbc','SourceCurrencyCode', null,'04');
		$writer->writeElementNS('cbc','TargetCurrencyCode', null,'04');
		$writer->writeElementNS('cbc','CalculationRate', null,'04');
		$writer->writeElementNS('cbc','Date', null,'04');
		$writer->endElement();	
		$writer->endElement();	
		
		$writer->endElement();
		
		$writer->endElement();
		$writer->endDocument();
		//header('Content-type: text/xml');
		//echo $writer->outputMemory();
		 $filename = "example5";
		 $extension=".xml";
		 $file = $writer->outputMemory();
		
		file_put_contents($filename.$extension,$file);
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
		$objzip->ziparchivo($filename);
		//$writer->flush();

?>