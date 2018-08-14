<?php
namespace App\Http\Controllers\Core;

use App\Http\Controllers\Sunat\Zipeoxml;
use Greenter\XMLSecLibs\Sunat\SignedXml;

class CreditNoteCore
{
	 
	public function CreditNote()
    {
		$objzip = new Zipeoxml;
		$UblVersionId ='2.1';
		$CustomizationId ='2.0';
		$writer = new \XMLWriter();
		$writer->openMemory();
		$writer->setIndent(true);
		$writer->setIndentString(" ");
		$writer->startDocument('1.0','ISO-8859-1');		
		$writer->startElement('CreditNote');
		$writer->writeAttribute('xmlns','urn:oasis:names:specification:ubl:schema:xsd:CreditNote-2');
		$writer->writeAttributeNS('xmlns','cac', null, 'urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2');
		$writer->writeAttributeNS('xmlns','cbc', null, 'urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2');
		$writer->writeAttributeNS('xmlns','ccts', null, 'urn:un:unece:uncefact:documentation:2');
		$writer->writeAttributeNS('xmlns','ds', null, 'http://www.w3.org/2000/09/xmldsig#');
		$writer->writeAttributeNS('xmlns','ext', null, 'urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2');
		$writer->writeAttributeNS('xmlns','qdt', null, 'urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2');
		$writer->writeAttributeNS('xmlns','sac', null, 'urn:sunat:names:specification:ubl:peru:schema:xsd:SunatAggregateComponents-1');
		$writer->writeAttributeNS('xmlns','udt', null, 'urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2');
		$writer->writeAttributeNS('xmlns','xsi', null, 'http://www.w3.org/2001/XMLSchema-instance');
		
		$writer->startElementNS('ext','UBLExtensions',null);
		
		$writer->startElementNS('ext','UBLExtension',null);
		$writer->startElementNS('ext','ExtensionContent','urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2');
		
		
		// En esta zona va el certificado digital.
		$writer->endElement();
		$writer->endElement();
		
		$writer->endElement();
		
		//Versión del UBL
		$writer->writeElementNS('cbc','UBLVersionID', null,$UblVersionId);
		//Versión de la estructura del documento
		$writer->writeElementNS('cbc','CustomizationID', null,$CustomizationId);
		//Numeración, conformada por serie y número correlativo
		$writer->writeElementNS('cbc','ID', null,'FC02-10');
		//Fecha de emisión
		$writer->writeElementNS('cbc','IssueDate', null,$UblVersionId);
		// Leyendas
			// Ejemplo:
		// Importes Totales y Código interno generado por el software de facturación
		//Notas adicionales
		
		$writer->startElementNS('cbc','Note', null);
		$writer->writeAttribute('languageLocaleID', '3000');
		$writer->text('05010020170628000785');
		$writer->endElement();
		//
		
		//Tipo de moneda en la cual se emite la nota de crédito electrónica
		$writer->writeElementNS('cbc','DocumentCurrencyCode', null,$UblVersionId);
		
		
			//Código del tipo de nota de crédito electrónica
			$writer->startElementNS('cac','DiscrepancyResponse',null);
			$writer->writeElementNS('cbc','ReferenceID', null,'04');
			$writer->writeElementNS('cbc','ResponseCode', null,'04');
			//Motivo o Sustento
			$writer->startElementNS('cbc','Description',null);
			$writer->writeCData('K&G Laboratorios');
			$writer->endElement();
			$writer->endElement();
			//end for
			
			//Serie y número del documento que modifica
			//Tipo de documento del documento que modifica
			$writer->startElementNS('cac','BillingReference',null);
			$writer->startElementNS('cac','CreditNoteDocumentReference',null);
			$writer->writeElementNS('cbc','ID', null,'F002-6');
			$writer->writeElementNS('cbc','DocumentTypeCode', null,'01');
			$writer->endElement();
			$writer->endElement();
			//end for
			
			//Documento de referencia
			//Tipo y número de la guía de remisión relacionada con la operación
			$writer->startElementNS('cac','DespatchDocumentReference',null);
			$writer->writeElementNS('cbc','ID', null,'031-002020');
			$writer->writeElementNS('cbc','DocumentTypeCode', null,'09');
			$writer->endElement();
			//end for
			
			//Tipo y número de otro documento y
			//código relacionado con la operación
			$writer->startElementNS('cac','AdditionalDocumentReference',null);
			$writer->writeElementNS('cbc','ID', null,'>10000120094');
			$writer->writeElementNS('cbc','DocumentTypeCode', null,'05');
			$writer->endElement();
			//end for
		
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
		
		
		
		//Apellidos y nombres, denominación o razón social del Emisor
		//Número y Tipo de Documento del Emisor
		//Código del domicilio fiscal o de local anexo del emisor
		$writer->startElementNS('cac','AccountingSupplierParty',null);
		//$writer->writeElementNS('cbc','CustomerAssignedAccountID', null,'04');
		// $writer->writeElementNS('cbc','AdditionalAccountID', null,'04');
		
		$writer->startElementNS('cac','Party',null);
		
		$writer->startElementNS('cac','PartyTaxScheme',null);
		$writer->startElementNS('cbc','RegistrationName',null);
		$writer->writeCData('');
		$writer->endElement();
		$writer->startElement('CompanyID');
		$writer->writeAttribute('schemeID', '6');
		$writer->writeAttribute('schemeName', 'SUNAT:Identificador de Documento de Identidad');
		$writer->writeAttribute('schemeAgencyName', 'PE:SUNAT');
		$writer->writeAttribute('schemeURI', 'urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo06');		
		$writer->text('12345678909');
		$writer->endElement();
		$writer->startElementNS('cac','RegistrationAddress',null);
		$writer->writeElementNS('cbc','AddressTypeCode', null,'0001');
		$writer->endElement();
		$writer->startElementNS('cac','TaxScheme',null);
		$writer->writeElementNS('cbc','ID', null,'-');
		$writer->endElement();	
		// $writer->startElementNS('cac','PostalAddress',null);
		// $writer->writeElementNS('cbc','ID', null,'04');
		// $writer->writeElementNS('cbc','StreetName', null,'04');
		// $writer->writeElementNS('cbc','CitySubdivisionName', null,'04');
		// $writer->writeElementNS('cbc','CityName', null,'04');
		// $writer->writeElementNS('cbc','CountrySubentity', null,'04');
		// $writer->writeElementNS('cbc','District', null,'04');
		// $writer->startElementNS('cac','Country',null);
		// $writer->writeElementNS('cbc','IdentificationCode', null,'04');
		// $writer->endElement();
		
		
		$writer->endElement();
		
		$writer->endElement();
		$writer->endElement();
		
		//Tipo y número de documento de identidad del adquirente o usuario
		//Número de RUC
		//Apellidos y nombres, denominación o razón social del adquirente o usuario
		$writer->startElementNS('cac','AccountingCustomerParty',null);
		
		$writer->startElementNS('cac','Party',null);
		$writer->startElementNS('cac','PartyTaxScheme',null);
		$writer->startElementNS('cbc','RegistrationName',null);
		$writer->writeCData('');
		$writer->endElement();
		$writer->startElement('CompanyID');
		$writer->writeAttribute('schemeID', '6');
		$writer->writeAttribute('schemeName', 'SUNAT:Identificador de Documento de Identidad');
		$writer->writeAttribute('schemeAgencyName', 'PE:SUNAT');
		$writer->writeAttribute('schemeURI', 'urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo06');		
		$writer->text('12345678909');
		$writer->endElement();
		$writer->startElementNS('cac','TaxScheme',null);
		$writer->writeElementNS('cbc','ID', null,'-');
		$writer->endElement();	
		$writer->endElement();		
		$writer->endElement();
		
		$writer->endElement();
		
		
			//Monto total del impuestos
			//Monto las operaciones gravadas/exoneradas/inafectas del impuesto
			//Sumatoria de IGV
			//Sumatoria de ISC
			//Sumatoria de Otros Tributos
			$writer->startElementNS('cac','TaxTotal',null);
			$writer->startElementNS('cbc','TaxAmount', null);
			$writer->writeAttribute('currencyID','PEN');
			$writer->text('15.25');
			$writer->endElement();
			//FOR
			$writer->startElementNS('cac','TaxSubtotal',null);
			$writer->startElementNS('cbc','TaxableAmount', null);
			$writer->writeAttribute('currencyID','PEN');
			$writer->text('15.25');
			$writer->endElement();
			$writer->startElementNS('cbc','TaxAmount', null);
			$writer->writeAttribute('currencyID','PEN');
			$writer->text('15.25');
			$writer->endElement();
			$writer->startElementNS('cac','TaxCategory',null);
			$writer->writeElementNS('cbc','ID', null,'S');
			$writer->startElementNS('cac','TaxScheme',null);
			$writer->writeElementNS('cbc','ID', null,'1000');
			$writer->writeElementNS('cbc','Name', null,'IGV');
			$writer->writeElementNS('cbc','TaxTypeCode', null,'VAT');
			$writer->endElement();
			$writer->endElement();
			$writer->endElement();
			//
			$writer->endElement();
		
		//Monto total de descuentos del comprobante
		//Importe total de la venta, cesión en uso o del servicio prestado		
		$writer->startElementNS('cac','LegalMonetaryTotal',null);
		//if(AllowanceTotalAmount!=null)
		$writer->startElementNS('cbc','AllowanceTotalAmount', null);
		$writer->writeAttribute('currencyID','PEN');
		$writer->text('2.00');
		$writer->endElement();	
		//if(PrepaidAmount!=null)
		$writer->startElementNS('cbc','PrepaidAmount', null);
		$writer->writeAttribute('currencyID','PEN');
		$writer->text('2.00');
		$writer->endElement();			
		$writer->startElementNS('cbc','PayableAmount', null);
		$writer->writeAttribute('currencyID','PEN');
		$writer->text('2.00');
		$writer->endElement();		
		$writer->endElement();
		
		
			//for
			$writer->startElementNS('cac','CreditNoteLine',null);
			//Número de orden del Ítem
			//Unidad de medida por ítem Cantidad de unidades por ítem
			//Valor de venta del ítem
			$writer->writeElementNS('cbc','ID', null,'04');
			$writer->startElementNS('cbc','CreditedQuantity', null);
			$writer->writeAttribute('unitCode','CS');
			$writer->writeAttribute('unitCodeListID','UN/ECE rec 20');
			$writer->writeAttribute('unitCodeListAgencyName','United Nations Economic Commission for Europe');
			$writer->text('20');
			$writer->endElement();		
			$writer->startElementNS('cbc','LineExtensionAmount', null);
			$writer->writeAttribute('currencyID','PEN');
			$writer->text('2.00');
			$writer->endElement();
			
			//Precio de venta unitario por item que modifica y código 01
			//Valor referencial unitario por ítem en operaciones no onerosas 02
			$writer->startElementNS('cac','PricingReference',null);
				//for
				$writer->startElementNS('cac','AlternativeConditionPrice',null);
				$writer->startElementNS('cbc','PriceAmount', null);
				$writer->writeAttribute('currencyID','PEN');
				$writer->text('2.00');
				$writer->endElement();
				$writer->writeElementNS('cbc','PriceTypeCode', null,'01');
				$writer->endElement();
			
			$writer->endElement();
			// $writer->startElementNS('cac','AllowanceCharge',null);
			// $writer->writeElementNS('cbc','ChargeIndicator', null,'04');
			// $writer->startElementNS('cbc','Amount', null);
			// $writer->writeAttribute('currencyID','PEN');
			// $writer->text('2.00');
			// $writer->endElement();
			// $writer->endElement();
			
				//Monto de tributo del ítem (IGV)
				//Monto de tributo del ítem (ISC)

				
				$writer->startElementNS('cac','TaxTotal',null);
				$writer->startElementNS('cbc','TaxAmount', null);
				$writer->writeAttribute('currencyID','PEN');
				$writer->text('2.00');
				$writer->endElement();
				//for
				$writer->startElementNS('cac','TaxSubtotal',null);
				$writer->startElementNS('cbc','TaxableAmount', null);
				$writer->writeAttribute('currencyID','PEN');
				$writer->text('2.00');
				$writer->endElement();
				$writer->startElementNS('cbc','TaxAmount', null);
				$writer->writeAttribute('currencyID','PEN');
				$writer->text('2.00');
				$writer->endElement();
				//$writer->writeElementNS('cbc','Percent', null,'04');
				
				$writer->startElementNS('cac','TaxCategory',null);
				$writer->writeElementNS('cbc','ID', null,'S');
				$writer->writeElementNS('cbc','TaxExemptionReasonCode', null,'04');
				$writer->writeElementNS('cbc','TierRange', null,'04');
				
				$writer->startElementNS('cac','TaxScheme',null);
				$writer->writeElementNS('cbc','ID', null,'1000');
				$writer->writeElementNS('cbc','Name', null,'IGV');
				$writer->writeElementNS('cbc','TaxTypeCode', null,'VAT');
				$writer->endElement();
				
				$writer->endElement();
				
				$writer->endElement();
				//
				$writer->endElement();
			
				//Descripción detallada del servicio prestado, bien vendido o cedido en uso, indicando las características		
				$writer->startElementNS('cac','Item',null);	
				$writer->startElementNS('cbc','Description',null);
				$writer->writeCData('');
				$writer->endElement();
				
				//Código de producto
				//Código de producto SUNAT
				$writer->startElementNS('cbc','SellersItemIdentification',null);	
				$writer->writeElementNS('cbc','ID', null,'04');
				$writer->endElement();
				$writer->startElementNS('cac','CommodityClassification',null);	
				$writer->startElementNS('cbc','ItemClassificationCode',null);
				$writer->writeAttribute('listID', 'UNSPSC');
				$writer->writeAttribute('listAgencyName', 'GS1 US');
				$writer->writeAttribute('listName', 'Item Classification');				
				$writer->text('10');
				$writer->endElement();
				$writer->endElement();
				$writer->endElement();
				
				//Valor unitario del ítem
				$writer->startElementNS('cac','Price',null);	
				$writer->startElementNS('cbc','PriceAmount', null);
				$writer->writeAttribute('currencyID','PEN');
				$writer->text('2.00');
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