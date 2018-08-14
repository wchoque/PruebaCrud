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
		$writer->startElement('Invoice');
		$writer->writeAttribute('xmlns',$obj->xmlnsInvoice);
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
		
		$writer->startElementNS('sac','AdditionalInformation',null);
		$writer->writeAttributeNS('xmlns','sac', null, $obj->sac);
		
		//for
		$writer->startElementNS('sac','AdditionalMonetaryTotal',null);
		
		$writer->writeElementNS('cbc','ID', null,'1001');
		
		$writer->startElementNS('cbc','PayableAmount', null);
		$writer->writeAttribute('currencyID','PEN');
		$writer->text('406779.66');
		$writer->endElement();
		$writer->writeElementNS('cbc','Percent', null,'779.66');
		$writer->endElement();
		//end for
		
		//for
		$writer->startElementNS('sac','AdditionalProperty',null);
		$writer->writeElementNS('cbc','ID', null,'1000');
		$writer->writeElementNS('cbc','Value', null,'CUATROCIENTOS OCHENTA MIL Y 00/100');		
		$writer->endElement();
		//end for
		
		//Para factura gui
		$writer->startElementNS('sac','SUNATEmbededDespatchAdvice',null);
		$writer->startElementNS('cac','DeliveryAddress',null);
		$writer->writeElementNS('cbc','ID', null,'070101');
		$writer->writeElementNS('cbc','StreetName', null,'070101');
		$writer->writeElementNS('cbc','CitySubdivisionName', null,'070101');
		$writer->writeElementNS('cbc','CityName', null,'070101');
		$writer->writeElementNS('cbc','CountrySubentity', null,'070101');
		$writer->writeElementNS('cbc','District', null,'070101');
		$writer->startElementNS('cac','Country',null);
		$writer->writeElementNS('cbc','IdentificationCode', null,'070101');
		$writer->endElement();
		$writer->endElement();
		
		$writer->startElementNS('cac','OriginAddress',null);
		$writer->writeElementNS('cbc','ID', null,'070101');
		$writer->writeElementNS('cbc','StreetName', null,'070101');
		$writer->writeElementNS('cbc','CitySubdivisionName', null,'070101');
		$writer->writeElementNS('cbc','CityName', null,'070101');
		$writer->writeElementNS('cbc','CountrySubentity', null,'070101');
		$writer->writeElementNS('cbc','District', null,'070101');
		$writer->startElementNS('cac','Country',null);
		$writer->writeElementNS('cbc','IdentificationCode', null,'070101');
		$writer->endElement();
		$writer->endElement();
		
		$writer->startElementNS('sac','SUNATCarrierParty',null);
		$writer->writeElementNS('cbc','CustomerAssignedAccountID', null,'070101');
		$writer->writeElementNS('cbc','AdditionalAccountID', null,'070101');
		$writer->startElementNS('cac','Party',null);
		$writer->startElementNS('cac','PartyLegalEntity',null);
		$writer->writeElementNS('cbc','RegistrationName', null,'070101');
		$writer->endElement();
		$writer->endElement();
		$writer->endElement();
		$writer->endElement();
		
		$writer->startElementNS('sac','DriverParty',null);
		$writer->startElementNS('cac','Party',null);
		$writer->startElementNS('cac','PartyIdentification',null);
		$writer->writeElementNS('cbc','ID', null,'070101');
		$writer->endElement();
		$writer->endElement();
		$writer->endElement();
		
		$writer->startElementNS('sac','SUNATRoadTransport',null);
		$writer->writeElementNS('cbc','LicensePlateID', null,'070101');
		$writer->writeElementNS('cbc','TransportAuthorizationCode', null,'070101');
		$writer->writeElementNS('cbc','BrandName', null,'070101');
		$writer->endElement();
		
		$writer->writeElementNS('cbc','TransportModeCode', null,'070101');
		$writer->startElementNS('cbc','GrossWeightMeasure', null);
		$writer->writeAttribute('unitCode','KG');
		$writer->text('40.00');
		$writer->endElement();
		
		$writer->startElementNS('sac','SUNATCosts',null);
		$writer->startElementNS('cac','RoadTransport',null);
		$writer->writeElementNS('cbc','LicensePlateID', null,'070101');
		$writer->endElement();
		$writer->endElement();
		
		$writer->startElementNS('sac','SUNATTransaction',null);
		$writer->writeElementNS('cbc','ID', null,'04');
		$writer->endElement();
		
		$writer->endElement();
		$writer->endElement();
		$writer->endElement();
		
		$writer->startElementNS('ext','UBLExtension',null);
		$writer->startElementNS('ext','ExtensionContent',$obj->ext);
		
		
		// En esta zona va el certificado digital.
		$writer->endElement();
		$writer->endElement();
		
		$writer->endElement();
		
		$writer->writeElementNS('cbc','UBLVersionID', null,$UblVersionId);
		$writer->writeElementNS('cbc','CustomizationID', null,$CustomizationId);
		$writer->writeElementNS('cbc','ID', null,$UblVersionId);
		$writer->writeElementNS('cbc','IssueDate', null,$UblVersionId);
		$writer->writeElementNS('cbc','InvoiceTypeCode', null,$UblVersionId);
		$writer->writeElementNS('cbc','DocumentCurrencyCode', null,$UblVersionId);
		
		$writer->startElementNS('cac','DespatchDocumentReference',null);
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
		
		$writer->startElementNS('cac','AccountingCustomerParty',null);
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
		
		//Anticipados
		$writer->startElementNS('cac','PrepaidPayment',null);
		$writer->startElementNS('cbc','ID', null);
		$writer->writeAttribute('schemeID','02');
		$writer->text('F100-10');
		$writer->endElement();
		$writer->startElementNS('cbc','PaidAmount', null);
		$writer->writeAttribute('currencyID','PEN');
		$writer->text('200.00');
		$writer->endElement();
		$writer->startElementNS('cbc','InstructionID', null);
		$writer->writeAttribute('schemeID','6');
		$writer->text('20549202960');
		$writer->endElement();
		$writer->endElement();
		
		$writer->startElementNS('cac','TaxTotal',null);
		$writer->startElementNS('cbc','TaxAmount', null);
		$writer->writeAttribute('currencyID','PEN');
		$writer->text('15.25');
		$writer->endElement();
		$writer->startElementNS('cac','TaxSubtotal',null);
		$writer->startElementNS('cbc','TaxAmount', null);
		$writer->writeAttribute('currencyID','PEN');
		$writer->text('15.25');
		$writer->endElement();
		$writer->startElementNS('cac','TaxCategory',null);
		$writer->startElementNS('cac','TaxScheme',null);
		$writer->writeElementNS('cbc','ID', null,'04');
		$writer->writeElementNS('cbc','Name', null,'04');
		$writer->writeElementNS('cbc','TaxTypeCode', null,'04');
		$writer->endElement();
		$writer->endElement();
		$writer->endElement();
		$writer->endElement();
		
		$writer->startElementNS('cac','LegalMonetaryTotal',null);
		
		$writer->startElementNS('cbc','AllowanceTotalAmount', null);
		$writer->writeAttribute('currencyID','PEN');
		$writer->text('15.25');
		$writer->endElement();
		
		$writer->startElementNS('cbc','PrepaidAmount', null);
		$writer->writeAttribute('currencyID','PEN');
		$writer->text('15.25');
		$writer->endElement();
		
		$writer->startElementNS('cbc','PayableAmount', null);
		$writer->writeAttribute('currencyID','PEN');
		$writer->text('15.25');
		$writer->endElement();
		$writer->endElement();
		
		//for
		$writer->startElementNS('cac','InvoiceLine',null);
		
		$writer->writeElementNS('cbc','ID', null,'04');
		$writer->startElementNS('cbc','InvoicedQuantity', null);
		$writer->writeAttribute('unitCode','NIU');
		$writer->text('2.00');
		$writer->endElement();
		$writer->startElementNS('cbc','LineExtensionAmount', null);
		$writer->writeAttribute('currencyID','PEN');
		$writer->text('2.00');
		$writer->endElement();
		
		$writer->startElementNS('cac','PricingReference',null);
		
			//for
			$writer->startElementNS('cac','AlternativeConditionPrice',null);
			$writer->startElementNS('cbc','PriceAmount', null);
			$writer->writeAttribute('currencyID','PEN');
			$writer->text('2.00');
			$writer->endElement();
			$writer->writeElementNS('cbc','PriceTypeCode', null,'04');
			$writer->endElement();
			
		$writer->endElement();
		
		$writer->startElementNS('cac','AllowanceCharge',null);
		$writer->writeElementNS('cbc','ChargeIndicator', null,'04');
		$writer->startElementNS('cbc','Amount', null);
		$writer->writeAttribute('currencyID','PEN');
		$writer->text('2.00');
		$writer->endElement();
		$writer->endElement();
		
			//for
			$writer->startElementNS('cac','TaxTotal',null);
			$writer->startElementNS('cbc','TaxAmount', null);
			$writer->writeAttribute('currencyID','PEN');
			$writer->text('2.00');
			$writer->endElement();
			
			$writer->startElementNS('cac','TaxSubtotal',null);
			$writer->startElementNS('cbc','TaxableAmount', null);
			$writer->writeAttribute('currencyID','PEN');
			$writer->text('2.00');
			$writer->endElement();
			$writer->startElementNS('cbc','TaxAmount', null);
			$writer->writeAttribute('currencyID','PEN');
			$writer->text('2.00');
			$writer->endElement();
			$writer->writeElementNS('cbc','Percent', null,'04');
			
			$writer->startElementNS('cac','TaxCategory',null);
			$writer->writeElementNS('cbc','TaxExemptionReasonCode', null,'04');
			$writer->writeElementNS('cbc','TierRange', null,'04');
			
			$writer->startElementNS('cac','TaxScheme',null);
			$writer->writeElementNS('cbc','ID', null,'04');
			$writer->writeElementNS('cbc','Name', null,'04');
			$writer->writeElementNS('cbc','TaxTypeCode', null,'04');
			$writer->endElement();
			
			$writer->endElement();
			
			$writer->endElement();
			$writer->endElement();
			
		$writer->startElementNS('cac','Item',null);	
		$writer->writeElementNS('cbc','Description', null,'04');
		
		$writer->startElementNS('cac','SellersItemIdentification',null);	
		$writer->writeElementNS('cbc','ID', null,'04');
		$writer->endElement();
		$writer->endElement();
		
		$writer->startElementNS('cac','Price',null);	
		$writer->startElementNS('cbc','PriceAmount', null);
		$writer->writeAttribute('currencyID','PEN');
		$writer->text('2.00');
		$writer->endElement();
		$writer->endElement();
		
		
		$writer->endElement();
			
		
		$writer->endElement();
		$writer->endDocument();
		//header('Content-type: text/xml');
		//echo $writer->outputMemory();
		 $filename = "example1";
		 $extension=".xml";
		 $file = $writer->outputMemory();
		
		file_put_contents($filename.$extension,$file);
		$objzip->ziparchivo($filename);
		//$writer->flush();

?>