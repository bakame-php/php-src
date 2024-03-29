--TEST--
Test base32_decode() function strict mode vs relax mode
--FILE--
<?php
echo "*** Testing base32_decode() : strict mode vs relax mode***\n\n";
<?php

$encode1 = base32_encode('foobar', PHP_BASE32_ASCII);
$encode2 = base32_encode('foobar', strtolower(PHP_BASE32_ASCII));

var_dump(
    base32_decode(encoded: $encode1, alphabet: PHP_BASE32_ASCII, strict: false),
    base32_decode(encoded: $encode1, alphabet: PHP_BASE32_ASCII, strict: true),
    base32_decode(encoded: $encode2, alphabet: PHP_BASE32_ASCII, strict: false),
    base32_decode(encoded: $encode2, alphabet: PHP_BASE32_ASCII, strict: true),
);

echo "\nDone\n";
--EXPECT--
string(6) "foobar"
string(6) "foobar"
string(6) "foobar"
bool(false)

Done
