<?php

    $user = wp_get_current_user();
    $uid = $user->ID;

    $selecteaza_categoria = get_user_meta($uid,'sel_cat2',true);
    global $cele_3_cat; $kk = 2;
    if($selecteaza_categoria == $cele_3_cat[0]) $kk = 1;
    if($selecteaza_categoria == $cele_3_cat[1]) $kk = 1;
    if($selecteaza_categoria == $cele_3_cat[2]) $kk = 1;

    $abtype = $_GET['imi_doresc'];
    $cost = get_option('Buzzler_'.$abtype.'_' . $kk);

    //---------------------------------------------------------
echo getcwd(); exit;
    require_once 'Mobilpay/Payment/Request/Abstract.php';
require_once 'Mobilpay/Payment/Request/Card.php';
require_once 'Mobilpay/Payment/Invoice.php';
require_once 'Mobilpay/Payment/Address.php';

#for testing purposes, all payment requests will be sent to the sandbox server. Once your account will be active you must switch back to the live server https://secure.mobilpay.ro
#in order to display the payment form in a different language, simply add the language identifier to the end of the paymentUrl, i.e https://secure.mobilpay.ro/en for English
$paymentUrl = 'http://sandboxsecure.mobilpay.ro';
//$paymentUrl = 'https://secure.mobilpay.ro';
// this is the path on your server to the public certificate. You may download this from Admin -> Conturi de comerciant -> Detalii -> Setari securitate
$x509FilePath 	= 'i.e: /home/certificates/public.cer';
try
{
	srand((double) microtime() * 1000000);
	$objPmReqCard 						= new Mobilpay_Payment_Request_Card();
	#merchant account signature - generated by mobilpay.ro for every merchant account
	#semnatura contului de comerciant - mergi pe www.mobilpay.ro Admin -> Conturi de comerciant -> Detalii -> Setari securitate
	$objPmReqCard->signature 			= '2JGX-4XHU-NJKL-WG7B-L3XJ';
	#you should assign here the transaction ID registered by your application for this commercial operation
	#order_id should be unique for a merchant account
	$objPmReqCard->orderId 				= md5(uniqid(rand()));
	#below is where mobilPay will send the payment result. This URL will always be called first; mandatory
	$objPmReqCard->confirmUrl 			= home_url().'/?confirm_url=1';
	#below is where mobilPay redirects the client once the payment process is finished. Not to be mistaken for a "successURL" nor "cancelURL"; mandatory
	$objPmReqCard->returnUrl 			= home_url().'/?return_url=1'; ;

	#detalii cu privire la plata: moneda, suma, descrierea
	#payment details: currency, amount, description
	$objPmReqCard->invoice = new Mobilpay_Payment_Invoice();
	#payment currency in ISO Code format; permitted values are RON, EUR, USD, MDL; please note that unless you have mobilPay permission to
	#process a currency different from RON, a currency exchange will occur from your currency to RON, using the official BNR exchange rate from that moment
	#and the customer will be presented with the payment amount in a dual currency in the payment page, i.e N.NN RON (e.ee EUR)
	$objPmReqCard->invoice->currency	= 'RON';
	$objPmReqCard->invoice->amount		=  $cost;
	#available installments number; if this parameter is present, only its value(s) will be available
	//$objPmReqCard->invoice->installments= '2,3';
	#selected installments number; its value should be within the available installments defined above
	//$objPmReqCard->invoice->selectedInstallments= '3';
	$objPmReqCard->invoice->details		= 'Plata PLANIF.RO';

$forma = get_user_meta($uid,'forma',true);
if($forma == "pers_fizica") $forma = "person"; else $forma = "company";

	#detalii cu privire la adresa posesorului cardului
	#details on the cardholder address (optional)
	$billingAddress 				= new Mobilpay_Payment_Address();
	$billingAddress->type			= $forma; //should be "person"
	$billingAddress->firstName		= get_user_meta($uid,'nume_factura',true);
	$billingAddress->lastName		= get_user_meta($uid,'nume_factura',true);
	$billingAddress->address		= get_user_meta($uid,'adresa_factura',true);
	$billingAddress->email			= get_user_meta($uid,'email2',true);
	$billingAddress->mobilePhone		= get_user_meta($uid,'phone',true);
	$objPmReqCard->invoice->setBillingAddress($billingAddress);

	#detalii cu privire la adresa de livrare
	#details on the shipping address
	/*$shippingAddress 				= new Mobilpay_Payment_Address();
	$shippingAddress->type			= $_POST['shipping_type'];
	$shippingAddress->firstName		= $_POST['shipping_first_name'];
	$shippingAddress->lastName		= $_POST['shipping_last_name'];
	$shippingAddress->address		= $_POST['shipping_address'];
	$shippingAddress->email		= $_POST['shipping_email'];
	$shippingAddress->mobilePhone		= $_POST['shipping_mobile_phone'];
	$objPmReqCard->invoice->setShippingAddress($shippingAddress); */

	#uncomment the line below in order to see the content of the request
	//echo "<pre>";print_r($objPmReqCard);echo "</pre>";
	$objPmReqCard->encrypt($x509FilePath);
}
catch(Exception $e)
{
}



  if(!($e instanceof Exception)):?>
<p>
	<form name="frmPaymentRedirect" method="post" action="<?php echo $paymentUrl;?>">
	<input type="hidden" name="env_key" value="<?php echo $objPmReqCard->getEnvKey();?>"/>
	<input type="hidden" name="data" value="<?php echo $objPmReqCard->getEncData();?>"/>
	<p>
		Vei redirectat catre pagina de plati securizata a mobilpay.ro
	</p>
	<p>
		Pentru a continua apasa <input type="image" src="images/mobilpay.gif" />
	</p>
	</form>
</p>
<!--
<script type="text/javascript" language="javascript">
	window.setTimeout(document.frmPaymentRedirect.submit(), 5000);
</script> -->
<?php else:?>
<p><strong><?php echo $e->getMessage();?></strong></p>
<?php endif;?>
