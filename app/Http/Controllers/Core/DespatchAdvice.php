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
		$writer->startElement('DespatchAdvice');
		$writer->writeAttribute('xmlns',$obj->xmlnsDespatchAdvice);
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
		$writer->writeElementNS('cbc','ID', null,$UblVersionId);
		$writer->writeElementNS('cbc','IssueDate', null,$UblVersionId);
		$writer->writeElementNS('cbc','DespatchAdviceTypeCode', null,$UblVersionId);
		$writer->writeElementNS('cbc','Note', null,$UblVersionId);
		
		$writer->startElementNS('cac','OrderReference',null);
		$writer->writeElementNS('cbc','ID', null,'04');
		$writer->startElementNS('cbc','OrderTypeCode', null);
		$writer->writeAttribute('name','02');
		$writer->text('F100-10');
		$writer->endElement();
		$writer->endElement();
		
		$writer->startElementNS('cac','AdditionalDocumentReference',null);
		$writer->writeElementNS('cbc','ID', null,'04');
		$writer->writeElementNS('cbc','DocumentTypeCode', null,'04');
		$writer->endElement();
		
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
		
		$writer->startElementNS('cac','DespatchSupplierParty',null);
		$writer->startElementNS('cbc','CustomerAssignedAccountID', null);
		$writer->writeAttribute('schemeID','02');
		$writer->text('F100-10');
		$writer->endElement();
		$writer->startElementNS('cac','Party',null);
		$writer->startElementNS('cac','PartyLegalEntity',null);
		$writer->writeElementNS('cbc','RegistrationName', null,'04');
		$writer->endElement();
		$writer->endElement();
		$writer->endElement();
		
		$writer->startElementNS('cac','DeliveryCustomerParty',null);
		$writer->startElementNS('cbc','CustomerAssignedAccountID', null);
		$writer->writeAttribute('schemeID','02');
		$writer->text('F100-10');
		$writer->endElement();
		$writer->startElementNS('cac','Party',null);
		$writer->startElementNS('cac','PartyLegalEntity',null);
		$writer->writeElementNS('cbc','RegistrationName', null,'04');
		$writer->endElement();
		$writer->endElement();
		$writer->endElement();
		
		$writer->startElementNS('cac','SellerSupplierParty',null);
		$writer->startElementNS('cbc','CustomerAssignedAccountID', null);
		$writer->writeAttribute('schemeID','02');
		$writer->text('F100-10');
		$writer->endElement();
		$writer->startElementNS('cac','Party',null);
		$writer->startElementNS('cac','PartyLegalEntity',null);
		$writer->writeElementNS('cbc','RegistrationName', null,'04');
		$writer->endElement();
		$writer->endElement();
		$writer->endElement();
		
		$writer->startElementNS('cac','Shipment',null);
		$writer->writeElementNS('cbc','HandlingCode', null,'04');
		$writer->writeElementNS('cbc','Information', null,'04');
		$writer->writeElementNS('cbc','SplitConsignmentIndicator', null,'04');
		$writer->startElementNS('cbc','GrossWeightMeasure', null);
		$writer->writeAttribute('unitCode','02');
		$writer->text('F100-10');
		$writer->endElement();
		$writer->writeElementNS('cbc','TotalTransportHandlingUnitQuantity', null,'04');
			//for
			$writer->startElementNS('cac','ShipmentStage',null);
			$writer->writeElementNS('cbc','ID', null,'04');
			$writer->writeElementNS('cbc','TransportModeCode', null,'04');
			$writer->startElementNS('cac','TransitPeriod',null);
			$writer->writeElementNS('cbc','StartDate', null,'04');
			$writer->endElement();
			$writer->startElementNS('cac','CarrierParty',null);
			$writer->startElementNS('cac','PartyIdentification',null);
			$writer->startElementNS('cbc','ID', null);
			$writer->writeAttribute('schemeID','02');
			$writer->text('F100-10');
			$writer->endElement();
			$writer->writeElementNS('cbc','RegistrationName', null,'04');
			$writer->endElement();
			$writer->endElement();
			$writer->startElementNS('cac','TransportMeans',null);
			$writer->startElementNS('cac','RoadTransport',null);
			$writer->writeElementNS('cbc','LicensePlateID', null,'04');
			$writer->endElement();
			$writer->endElement();
			$writer->startElementNS('cac','DriverPerson',null);
			$writer->startElementNS('cbc','ID', null);
			$writer->writeAttribute('schemeID','02');
			$writer->text('F100-10');
			$writer->endElement();
			$writer->endElement();
			$writer->endElement();
		$writer->startElementNS('cac','DeliveryAddress',null);
		$writer->writeElementNS('cbc','ID', null,'04');
		$writer->writeElementNS('cbc','StreetName', null,'04');
		$writer->endElement();
		
		$writer->startElementNS('cac','TransportHandlingUnit',null);
		$writer->writeElementNS('cbc','ID', null,'04');
		//for
			$writer->startElementNS('cac','TransportEquipment',null);
			$writer->writeElementNS('cbc','ID', null,'04');
			$writer->endElement();
		$writer->endElement();
		
		$writer->startElementNS('cac','OriginAddress',null);
		$writer->writeElementNS('cbc','ID', null,'04');
		$writer->writeElementNS('cbc','StreetName', null,'04');
		$writer->endElement();
		
		$writer->startElementNS('cac','FirstArrivalPortLocation',null);
		$writer->writeElementNS('cbc','ID', null,'04');
		$writer->endElement();
		
		$writer->endElement();
		
		//for
		$writer->startElementNS('cac','DespatchLine',null);
		$writer->writeElementNS('cbc','ID', null,'04');
		$writer->startElementNS('cbc','DeliveredQuantity', null);
		$writer->writeAttribute('unitCode','02');
		$writer->text('F100-10');
		$writer->endElement();
		$writer->startElementNS('cac','OrderLineReference',null);
		$writer->writeElementNS('cbc','LineID', null,'04');
		$writer->endElement();
		$writer->startElementNS('cac','Item',null);
		$writer->writeElementNS('cbc','Description', null,'04');
		$writer->startElementNS('cac','SellersItemIdentification',null);
		$writer->writeElementNS('cbc','ID', null,'04');
		$writer->endElement();
		$writer->endElement();
		$writer->endElement();
		
		$writer->endElement();
		$writer->endDocument();
		//header('Content-type: text/xml');
		//echo $writer->outputMemory();
		 $filename = "example6";
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