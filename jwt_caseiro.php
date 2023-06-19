<?php
$issuedAt = new DateTimeImmutable();
$exp = $issuedAt->modify('+6 minutes')->getTimestamp();

$secret_key = "veniVidiVici";

function base64UrlEncode($info)
{
    return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($info));
}

$headerArray = [
    'typ' => 'JWT',
    'alg' => 'HS256',
];
$header = base64UrlEncode(json_encode($headerArray));

$payloadArray = [
    'Iss' => 'Avetools',
    'sub' => md5(time()),
    'iat' => $issuedAt->getTimestamp(),
    'exp' => $exp,
    'nbf' => $issuedAt->getTimestamp(),
    'name' => utf8_encode("Thiagão"),
    'id' => utf8_encode(12),
    'type' => utf8_encode("Programador"),
];
$payload = base64UrlEncode(json_encode($payloadArray));

$signature = base64UrlEncode(hash_hmac('sha256', "$header.$payload", $secret_key, true));

$token = "$header.$payload.$signature";

echo ($token);