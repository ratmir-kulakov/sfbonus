<?php

$connectorOptionsEncoded = 'YToxOntzOjU6InJvb3';

$connectorOptionsSerialized = base64_decode($connectorOptionsEncoded);
$connectorOptionsUnserialized = unserialize($connectorOptionsSerialized);

echo '<pre>';
print_r($connectorOptionsUnserialized);
echo '</pre>';
?>