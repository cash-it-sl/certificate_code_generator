<?php

require "vendor/autoload.php";

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Label\Alignment\LabelAlignmentLeft;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
if(isset($_POST['data'])){
    $text = $_POST['data'];
   
   // echo "Data received by qr_component.php: " . $text;
    // Do something with the result data
    // For example, you can insert it into a database or process it further
  


$qr_code = QrCode::create($text)
                 ->setSize(600)
                 ->setMargin(40)
                 ->setForegroundColor(new Color(0, 0, 0))
                 ->setBackgroundColor(new Color(255, 255, 255))
                 ->setErrorCorrectionLevel(new ErrorCorrectionLevelHigh);



$writer = new PngWriter;

$result = $writer->write($qr_code);

// Output the QR code image to the browser
header("Content-Type: " . $result->getMimeType());

echo $result->getString();
$result->saveToFile(__DIR__.'/qrcode.png');



}
?>