<?php
namespace App\Http\Controllers\Core;

use App\Http\Controllers\Sunat\Zipeoxml;
use Greenter\XMLSecLibs\Sunat\SignedXml;

class InvoiceCore
{
	 
	public function Invoice()
    {
		$objzip = new Zipeoxml;
		$UblVersionId ='2.1';
		$CustomizationId ='2.0';
		$writer = new \XMLWriter();
		$writer->openMemory();
		$writer->setIndent(true);
		$writer->setIndentString(" ");
		$writer->startDocument('1.0','ISO-8859-1');		
		$writer->startElement('Invoice');
		$writer->writeAttribute('xmlns','urn:oasis:names:specification:ubl:schema:xsd:Invoice-2');
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
		
		$writer->writeElementNS('cbc','UBLVersionID', null,$UblVersionId);
		$writer->writeElementNS('cbc','CustomizationID', null,$CustomizationId);
		
		//codigo de tipo de operacion
		$writer->startElementNS('cbc','ProfileID', null);
		$writer->writeAttribute('schemeName', 'SUNAT:Identificador de Tipo de Operación');
		$writer->writeAttribute('schemeAgencyName', 'PE:SUNAT');
		$writer->writeAttribute('schemeURI', 'urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo17');
		$writer->text('F100-10');
		$writer->endElement();
		
		//Numeración, conformada por serie y número correlativo
		$writer->writeElementNS('cbc','ID', null,$UblVersionId);
		//Fecha de emisión
		$writer->writeElementNS('cbc','IssueDate', null,$UblVersionId);
		//hora de emisión
		$writer->writeElementNS('cbc','IssueTime', null,$UblVersionId);
		
		//Tipo de documento (Factura)
		$writer->startElementNS('cbc','InvoiceTypeCode', null);
		$writer->writeAttribute('listAgencyName', 'PE:SUNAT');
		$writer->writeAttribute('listName', 'SUNAT:Identificador de Tipo de Documento');
		$writer->writeAttribute('listURI', 'urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo01');
		$writer->text('03');
		$writer->endElement();
		//$writer->writeElementNS('cbc','DocumentCurrencyCode', null,$UblVersionId);
		
		// Leyendas
			// Ejemplo:
		// Importes Totales y Código interno generado por el software de facturación
		//Notas adicionales
		//for
		$writer->startElementNS('cbc','Note', null);
		$writer->writeAttribute('languageLocaleID', '1000');
		$writer->text('F100-10');
		$writer->endElement();
		//
		
		//tipo moneda
		$writer->startElementNS('cbc','DocumentCurrencyCode', null);
		$writer->writeAttribute('listID', 'ISO 4217 Alpha');
		$writer->writeAttribute('listName', 'Currency');
		$writer->writeAttribute('listAgencyName', 'United Nations Economic Commission for Europe');
		$writer->text('F100-10');
		$writer->endElement();
		
		//Tipo y número de la guía de remisión relacionada con la operación que se factura
		//Documentos relacionados - Guía remisión u otros 
		//for
		$writer->startElementNS('cac','DespatchDocumentReference',null);
		$writer->writeElementNS('cbc','ID', null,'04');
		$writer->startElementNS('cbc','DocumentTypeCode', null);
		$writer->writeAttribute('listAgencyName', 'PE:SUNAT');
		$writer->writeAttribute('listName', 'SUNAT:Identificador de guía relacionada');
		$writer->writeAttribute('listURI', 'rn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo01');
		$writer->text('09');
		$writer->endElement();
		$writer->endElement();
		//
		//for
		$writer->startElementNS('cac','AdditionalDocumentReference',null);
		$writer->writeElementNS('cbc','ID', null,'04');
		$writer->startElementNS('cbc','DocumentTypeCode', null);
		$writer->writeAttribute('listAgencyName', 'PE:SUNAT');
		$writer->writeAttribute('listName', 'SUNAT: Identificador de documento relacionado');
		$writer->writeAttribute('listURI', 'urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo12');
		$writer->text('99');
		$writer->endElement();
		$writer->endElement();
		//
		
		//firma electrónica en el contenedor cac:Signature 
		$writer->startElementNS('cac','Signature',null);
		$writer->writeElementNS('cbc','ID', null,'SignatureSP');
		
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
		$writer->writeElementNS('cbc','URI', null,'SignatureSP');
		$writer->endElement();
		
		$writer->endElement();
		
		$writer->endElement();
		//
		
		//Nombre Comercial del emisor
		//Apellidos y nombres, denominación o razón social del emisor
		//Tipo y Número de RUC del emisor
		//Código del domicilio fiscal o de local anexo del emisor 
		$writer->startElementNS('cac','AccountingSupplierParty',null);
		//$writer->writeElementNS('cbc','CustomerAssignedAccountID', null,'04');
		//$writer->writeElementNS('cbc','AdditionalAccountID', null,'04');

		
		$writer->startElementNS('cac','Party',null);
		
		$writer->startElementNS('cac','PartyName',null);
		
		$writer->startElementNS('cbc','Name',null);
		$writer->writeCData('K&G Laboratorios');
		$writer->endElement();
		
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
		// $writer->endElement();
		
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
		$writer->startElementNS('cac','RegistrationAddress',null);
		$writer->writeElementNS('cbc','AddressTypeCode', null,'0001');
		$writer->endElement();
		$writer->endElement();
		
		$writer->endElement();
		$writer->endElement();
		//
		
		//datos receptor
		//Tipo y número de documento de identidad del adquirente o usuario
		//Apellidos y nombres, denominación o razón social del adquirente o usuario
		$writer->startElementNS('cac','AccountingCustomerParty',null);
		//$writer->writeElementNS('cbc','CustomerAssignedAccountID', null,'04');
		//$writer->writeElementNS('cbc','AdditionalAccountID', null,'04');
		
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
		//
		
		// Serie y número de comprobante del anticipo (para el caso de reorganización de empresas, incluye el RUC)
		// Código de tipo de documento
		// Monto prepagado o anticipado
		// Código de tipo de moneda del monto prepagado o anticipado
		// Número de RUC del emisor del comprobante de anticipo
		//Anticipados
		//if (PrepaidPayment!=null)
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
		//
		
		//Dirección del lugar en el que se entrega el bien
		//if(DeliveryTerms!=null)
		$writer->startElementNS('cac','DeliveryTerms',null);
		$writer->startElementNS('cac','DeliveryLocation',null);
		$writer->startElementNS('cac','Address',null);
		$writer->writeElementNS('cbc','StreetName', null,'04');
		//if(CitySubdivisionName!=null)
			$writer->writeElementNS('cbc','CitySubdivisionName', null,'');
		$writer->writeElementNS('cbc','CityName', null,'04');
		$writer->writeElementNS('cbc','CountrySubentity', null,'04');
		$writer->writeElementNS('cbc','CountrySubentityCode', null,'04');
		$writer->writeElementNS('cbc','District', null,'04');
		$writer->startElementNS('cac','Country',null);
		$writer->startElementNS('cbc','IdentificationCode',null);
		$writer->writeAttribute('listID', 'ISO 3166-1');
		$writer->writeAttribute('listAgencyName', 'United Nations Economic Commission for Europe');
		$writer->writeAttribute('listName', 'Country');				
		$writer->text('PE');
		$writer->endElement();
		$writer->endElement();
		$writer->endElement();
		$writer->endElement();
		$writer->endElement();
		//
		
		//Información de descuentos Globales
		$writer->startElementNS('cac','AllowanceCharge',null);
		$writer->writeElementNS('cbc','ChargeIndicato', null,'04');
		$writer->writeElementNS('cbc','AllowanceChargeReasonCode', null,'04');
		$writer->startElementNS('cbc','Amount',null);
		$writer->writeAttribute('currencyID', 'PEN');			
		$writer->text('60.00');
		$writer->endElement();
		$writer->startElementNS('cbc','BaseAmount',null);
		$writer->writeAttribute('currencyID', 'PEN');			
		$writer->text('60.00');
		$writer->endElement();
		$writer->endElement();
		//
		
		//Monto total de impuestos
		//Monto las operaciones gravadas
		//Monto las operaciones Exoneradas
		//Monto las operaciones inafectas del impuesto (Ver Ejemplo en la página 47)
		//Monto las operaciones gratuitas (Ver Ejemplo en la página 48)
		//Sumatoria de IGV
		//Sumatoria de ISC (Ver Ejemplo en la página 51)
		//Sumatoria de Otros Tributos (Ver Ejemplo en la página 52)
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
		$writer->startElementNS('cbc','ID',null);
		$writer->writeAttribute('schemeID', 'UN/ECE 5305');
		$writer->writeAttribute('schemeName', 'Tax Category Identifier');
		$writer->writeAttribute('schemeAgencyName', '"United Nations Economic Commission for Europe"');				
		$writer->text('S');
		$writer->endElement();
		$writer->startElementNS('cac','TaxScheme',null);
		$writer->startElementNS('cbc','ID',null);
		$writer->writeAttribute('schemeID', '"UN/ECE 5305');
		$writer->writeAttribute('schemeAgencyID', '6');			
		$writer->text('1000');
		$writer->endElement();
		$writer->writeElementNS('cbc','Name', null,'IGV');
		$writer->writeElementNS('cbc','TaxTypeCode', null,'VAT');
		$writer->endElement();
		$writer->endElement();
		$writer->endElement();
		//
		$writer->endElement();
		//
		
		
		//Total valor de venta
		//Total precio de venta (incluye impuestos)
		//Monto total de descuentos del comprobante
		//Monto total de otros cargos del comprobante
		//Importe total de la venta, cesión en uso o del servicio prestado
		$writer->startElementNS('cac','LegalMonetaryTotal',null);
		$writer->startElementNS('cbc','LineExtensionAmount', null);
		$writer->writeAttribute('currencyID','PEN');
		$writer->text('15.25');
		$writer->endElement();
		$writer->startElementNS('cbc','TaxInclusiveAmount', null);
		$writer->writeAttribute('currencyID','PEN');
		$writer->text('15.25');
		$writer->endElement();
		$writer->startElementNS('cbc','AllowanceTotalAmount', null);
		$writer->writeAttribute('currencyID','PEN');
		$writer->text('15.25');
		$writer->endElement();
		$writer->startElementNS('cbc','ChargeTotalAmount', null);
		$writer->writeAttribute('currencyID','PEN');
		$writer->text('15.25');
		$writer->endElement();
		//
		$writer->startElementNS('cbc','PrepaidAmount', null);
		$writer->writeAttribute('currencyID','PEN');
		$writer->text('15.25');
		$writer->endElement();
		//
		
		$writer->startElementNS('cbc','PayableAmount', null);
		$writer->writeAttribute('currencyID','PEN');
		$writer->text('15.25');
		$writer->endElement();
		$writer->endElement();
		//
		
		
		//Número de orden del Ítem
		//Cantidad y Unidad de medida por ítem
		//Valor de venta del ítem
		//for
		$writer->startElementNS('cac','InvoiceLine',null);
		
		$writer->writeElementNS('cbc','ID', null,'04');
		$writer->startElementNS('cbc','InvoicedQuantity', null);
		$writer->writeAttribute('unitCode','CS');
		$writer->writeAttribute('unitCodeListID','UN/ECE rec 20');
		$writer->writeAttribute('unitCodeListAgencyName','United Nations Economic Commission for Europe');
		$writer->text('60');
		$writer->endElement();
		$writer->startElementNS('cbc','LineExtensionAmount', null);
		$writer->writeAttribute('currencyID','PEN');
		$writer->text('2.00');
		$writer->endElement();
		
		//Precio de venta unitario por item y código 01
		//Valor referencial unitario por ítem en operaciones no onerosas 02
		$writer->startElementNS('cac','PricingReference',null);
			$writer->startElementNS('cac','AlternativeConditionPrice',null);
			$writer->startElementNS('cbc','PriceAmount', null);
			$writer->writeAttribute('currencyID','PEN');
			$writer->text('2.00');
			$writer->endElement();
			$writer->startElementNS('cbc','PriceTypeCode', null);
			$writer->writeAttribute('listName','SUNAT:Indicador de Tipo de Precio');
			$writer->writeAttribute('listAgencyName','"PE:SUNAT');
			$writer->writeAttribute('listURI','urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo16');
			$writer->text('01');
			$writer->endElement();
			$writer->endElement();	
		$writer->endElement();
		
		//Descuentos por Ítem
		$writer->startElementNS('cac','AllowanceCharge',null);
		$writer->writeElementNS('cbc','ChargeIndicator', null,'false');
		$writer->writeElementNS('cbc','AllowanceChargeReasonCode', null,'00');
		$writer->writeElementNS('cbc','MultiplierFactorNumeric', null,'0.05');
		$writer->startElementNS('cbc','Amount', null);
		$writer->writeAttribute('currencyID','PEN');
		$writer->text('2.00');
		$writer->endElement();
		$writer->startElementNS('cbc','BaseAmount', null);
		$writer->writeAttribute('currencyID','PEN');
		$writer->text('2.00');
		$writer->endElement();
		$writer->endElement();
		//
		
			
			//Afectación al IGV por ítem
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
		
			
			$writer->startElementNS('cac','TaxCategory',null);
			$writer->startElementNS('cbc','ID',null);
			$writer->writeAttribute('schemeID', 'UN/ECE 5305');
			$writer->writeAttribute('schemeName', 'SUNAT:Codigo de Tipo de Afectación del IGV');
			$writer->writeAttribute('schemeAgencyName', 'United Nations Economic Commission for Europe');				
			$writer->text('S');
			$writer->endElement();
			$writer->writeElementNS('cbc','Percent', null,'04');
			$writer->startElementNS('cbc','TaxExemptionReasonCode',null);
			$writer->writeAttribute('listAgencyName', 'UN/ECE 5305');
			$writer->writeAttribute('listName', 'Tax Category Identifier');
			$writer->writeAttribute('listURI', 'urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo07');				
			$writer->text('10');
			$writer->endElement();
			//if(TierRange!=null)
			$writer->writeElementNS('cbc','TierRange', null,'04');
			
			$writer->startElementNS('cac','TaxScheme',null);
			$writer->startElementNS('cbc','ID',null);
			$writer->writeAttribute('schemeID', 'UN/ECE 5153');
			$writer->writeAttribute('schemeName', 'Tax Scheme Identifier');
			$writer->writeAttribute('schemeAgencyName', 'United Nations Economic Commission for Europe');				
			$writer->text('1000');
			$writer->endElement();
			$writer->writeElementNS('cbc','Name', null,'IGV');
			$writer->writeElementNS('cbc','TaxTypeCode', null,'VAT');
			$writer->endElement();
			
			$writer->endElement();
			
			$writer->endElement();
			
			//Afectación al ISC por ítem
			$writer->startElementNS('cac','TaxSubtotal',null);
			$writer->startElementNS('cbc','TaxableAmount', null);
			$writer->writeAttribute('currencyID','PEN');
			$writer->text('2.00');
			$writer->endElement();
			$writer->startElementNS('cbc','TaxAmount', null);
			$writer->writeAttribute('currencyID','PEN');
			$writer->text('2.00');
			$writer->endElement();
		
			
			$writer->startElementNS('cac','TaxCategory',null);
			$writer->startElementNS('cbc','ID',null);
			$writer->writeAttribute('schemeID', 'UN/ECE 5305');
			$writer->writeAttribute('schemeName', 'SUNAT:Codigo de Tipo de Afectación del IGV');
			$writer->writeAttribute('schemeAgencyName', 'United Nations Economic Commission for Europe');				
			$writer->text('S');
			$writer->endElement();
			$writer->writeElementNS('cbc','Percent', null,'04');
			$writer->startElementNS('cbc','TaxExemptionReasonCode',null);
			$writer->writeAttribute('listAgencyName', 'UN/ECE 5305');
			$writer->writeAttribute('listName', 'Tax Category Identifier');
			$writer->writeAttribute('listURI', 'urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo07');				
			$writer->text('10');
			$writer->endElement();
			
			$writer->startElementNS('cac','TaxScheme',null);
			$writer->startElementNS('cbc','ID',null);
			$writer->writeAttribute('schemeID', 'UN/ECE 5153');
			$writer->writeAttribute('schemeName', 'Tax Scheme Identifier');
			$writer->writeAttribute('schemeAgencyName', 'United Nations Economic Commission for Europe');				
			$writer->text('1000');
			$writer->endElement();
			$writer->writeElementNS('cbc','Name', null,'IGV');
			$writer->writeElementNS('cbc','TaxTypeCode', null,'VAT');
			$writer->endElement();
			
			$writer->endElement();
			
			$writer->endElement();
			//
			$writer->endElement();
			//
			
		
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
			
		
		$writer->endElement();
		$writer->endDocument();
		//header('Content-type: text/xml');
		//echo $writer->outputMemory();
		 $carpeta="XML/";
		 $filename = "example1";
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
		
		$filename='10292703151-03-B001-0004078';
		
		
		return $filename;
		//$writer->flush();

	}
}
?>