--TEST--
Test base32_decode() function strict mode vs relax mode
--FILE--
<?php
echo "*** Testing base32_decode() : strict mode vs relax mode ***\n";
$empty_string = "\r\n\t ";
$encode1 = base32_encode('foobar', PHP_BASE32_ASCII);
$encode2 = base32_encode('foobar', strtolower(PHP_BASE32_ASCII));

var_dump(
    base32_decode(encoded: $encode1, alphabet: PHP_BASE32_ASCII, strict: false) === 'foobar',
    base32_decode(encoded: $encode1, alphabet: PHP_BASE32_ASCII, strict: true) === 'foobar',
    base32_decode(encoded: $encode2, alphabet: PHP_BASE32_ASCII, strict: false) === 'foobar',
    base32_decode(encoded: $encode2, alphabet: PHP_BASE32_ASCII, strict: true) === false,
    base32_decode($empty_string) === '',
    base32_decode(encoded: $empty_string, alphabet:PHP_BASE32_HEX, strict: true) === '',
);

echo "\nDone\n";
--EXPECT--
*** Testing base32_decode() : strict mode vs relax mode **

bool(true)
bool(true)
bool(true)
bool(false)
bool(true)
bool(true)

Done
