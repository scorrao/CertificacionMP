<?php
var_dump($_POST);

// SDK de Mercado Pago
require __DIR__ .  '/vendor/autoload.php';

// Agrega credenciales
MercadoPago\SDK::setAccessToken('APP_USR-6317427424180639-042414-47e969706991d3a442922b0702a0da44-469485398');
MercadoPago\SDK::setIntegratorId('dev_24c65fb163bf11ea96500242ac130004');
// Crea un objeto de preferencia
$preference = new MercadoPago\Preference();

$preference->payment_methods = array(
    "excluded_payment_methods" => array(
      array("id" => "amex")
    ),
    "excluded_payment_types" => array(
      array("id" => "atm")
    ),
    "installments" => 6
  );
/*nformación del pagador
Datos del pagador:
a)Nombre y Apellido: Lalo Landa
b)Email: ​El email del test-user pagador entregado en este documento.
c)Código de área: 11
d)Teléfono: 22223333
Datos de la dirección del pagador:
a)Nombre de la calle: False
b)Número de la casa: 123
c)Código postal: 1111*/ 

$payer = new MercadoPago\Payer();
$payer->name = "Lalo";
$payer->surname = "Landa";
$payer->email = "test_user_63274575@testuser.com";
$payer->phone = array(
  "area_code" => "11",
  "number" => "22223333"
);

$payer->address = array(
  "street_name" => "False",
  "street_number" => 123,
  "zip_code" => "1111"
);
$preference->payer = $payer;
// Crea un ítem en la preferencia
$item = new MercadoPago\Item();
$item->id = "1234";
$item->title = $_POST['title'];
$item->description = "Dispositivo móvil de Tienda e-commerce";
$item->quantity = 1;
$item->unit_price = $_POST['price'];
$item->picture_url  = "https://mp.santiagocorrao.com.ar/assets/003.jpg";
$preference->items = array($item);

$preference->external_reference = "santiagocorrao96@gmail.com";

$preference->notification_url = "https://mp.santiagocorrao.com.ar/webhooks.php";

$preference->back_urls = array(
    "success" => "https://mp.santiagocorrao.com.ar/success.php",
    "failure" => "https://mp.santiagocorrao.com.ar/failure.php",
    "pending" => "https://mp.santiagocorrao.com.ar/pending.php"
);
$preference->auto_return = "approved";

$preference->save();

header('Location: ' . $preference->init_point);
?>