<?php
$access_token = 'cY2AWZ1+7iEYQ5JhJuaGznVFoQWAZyNzRUiruUxxi2imxTvv2sLW9j+2v+LtTLbrLp0oacW1Qf89UnJZCKvAFgAC16x4FifUfx++cxR1tm9AiYL+ekybcxT6e/JNx5WwUyZKZ84Whd1lwJl9K8Rf6QdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
