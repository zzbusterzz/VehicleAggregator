<?php
$svg = new DOMDocument();
$svg->load(public_path('images/Logo-White-Title.svg'));
$svg->documentElement->setAttribute("class", "logo");
echo $svg->saveXML($svg->documentElement);
?>
