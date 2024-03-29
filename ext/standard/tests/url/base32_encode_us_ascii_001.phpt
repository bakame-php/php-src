--TEST--
Test base32_encode() function : basic functionality with us-ascii alphabet
--FILE--
<?php
echo "*** Testing base32_encode() : basic functionality ***\n";

$values = [
    'RFC Vector 1' => ['f', 'MY======'],
    'RFC Vector 2' => ['fo', 'MZXQ===='],
    'RFC Vector 3' => ['foo', 'MZXW6==='],
    'RFC Vector 4' => ['foob', 'MZXW6YQ='],
    'RFC Vector 5' => ['fooba', 'MZXW6YTB'],
    'RFC Vector 6' => ['foobar', 'MZXW6YTBOI======'],
    'Old Vector 1' => [' ', 'EA======'],
    'Old Vector 2' => ['  ', 'EAQA===='],
    'Old Vector 3' => ['   ', 'EAQCA==='],
    'Old Vector 4' => ['    ', 'EAQCAIA='],
    'Old Vector 5' => ['     ', 'EAQCAIBA'],
    'Old Vector 6' => ['      ', 'EAQCAIBAEA======'],
    'Empty String' => ['', ''],
    'Random Integers' => [base64_decode('HgxBl1kJ4souh+ELRIHm/x8yTc/cgjDmiCNyJR/NJfs=', true), 'DYGEDF2ZBHRMULUH4EFUJAPG74PTETOP3SBDBZUIENZCKH6NEX5Q===='],
    'Partial zero edge case' => ['8', 'HA======'],
];

foreach ($values as $name => [$decoded, $encoded]) {
    echo $name, PHP_EOL;
    var_dump(base32_encode($decoded));
    var_dump(base32_encode(decoded: $decoded, alphaber:PHP_BASE32_ASCII, padding: '='));
}
echo "Done";
?>
--EXPECT--
*** Testing base32_encode() : basic functionality ***
RFC Vector 1
string(8) "MY======"
string(8) "MY======"
RFC Vector 2
string(8) "MZXQ===="
string(8) "MZXQ===="
RFC Vector 3
string(8) "MZXW6==="
string(8) "MZXW6==="
RFC Vector 4
string(8) "MZXW6YQ="
string(8) "MZXW6YQ="
RFC Vector 5
string(8) "MZXW6YTB"
string(8) "MZXW6YTB"
RFC Vector 6
string(16) "MZXW6YTBOI======"
string(16) "MZXW6YTBOI======"
Old Vector 1
string(8) "EA======"
string(8) "EA======"
Old Vector 2
string(8) "EAQA===="
string(8) "EAQA===="
Old Vector 3
string(8) "EAQCA==="
string(8) "EAQCA==="
Old Vector 4
string(8) "EAQCAIA="
string(8) "EAQCAIA="
Old Vector 5
string(8) "EAQCAIBA"
string(8) "EAQCAIBA"
Old Vector 6
string(16) "EAQCAIBAEA======"
string(16) "EAQCAIBAEA======"
Empty String
string(0) ""
string(0) ""
Random Integers
string(56) "DYGEDF2ZBHRMULUH4EFUJAPG74PTETOP3SBDBZUIENZCKH6NEX5Q===="
string(56) "DYGEDF2ZBHRMULUH4EFUJAPG74PTETOP3SBDBZUIENZCKH6NEX5Q===="
Partial zero edge case
string(8) "HA======"
string(8) "HA======"
Done
