--TEST--
Test base32_encode() function : basic functionality with hex alphabet
--FILE--
<?php
echo "*** Testing base32_encode() : basic functionality with hex alphabet***\n";

$values = [
    'RFC Vector 1' => ['f', 'CO======'],
    'RFC Vector 2' => ['fo', 'CPNG===='],
    'RFC Vector 3' => ['foo', 'CPNMU==='],
    'RFC Vector 4' => ['foob', 'CPNMUOG='],
    'RFC Vector 5' => ['fooba', 'CPNMUOJ1'],
    'RFC Vector 6' => ['foobar', 'CPNMUOJ1E8======'],
    'Old Vector 1' => [' ', '40======'],
    'Old Vector 2' => ['  ', '40G0===='],
    'Old Vector 3' => ['   ', '40G20==='],
    'Old Vector 4' => ['    ', '40G2080='],
    'Old Vector 5' => ['     ', '40G20810'],
    'Old Vector 6' => ['      ', '40G2081040======'],
    'Empty String' => ['', ''],
    'Random Integers' => [base64_decode('HgxBl1kJ4souh+ELRIHm/x8yTc/cgjDmiCNyJR/NJfs=', true), '3O6435QP17HCKBK7S45K90F6VSFJ4JEFRI131PK84DP2A7UD4NTG===='],
];

foreach ($values as $name => [$decoded, $encoded]) {
    echo $name, PHP_EOL;
    var_dump(base32_encode(decoded: $decoded, alphaber:PHP_BASE32_HEX, padding: '='));
}
echo "Done";
?>
--EXPECT--
*** Testing base32_encode() : basic functionality with hex alphabet ***
RFC Vector 1
string(8) "CO======"
RFC Vector 2
string(8) "CPNG===="
RFC Vector 3
string(8) "CPNMU==="
RFC Vector 4
string(8) "CPNMUOG="
RFC Vector 5
string(8) "CPNMUOJ1"
RFC Vector 6
string(16) "CPNMUOJ1E8======"
Old Vector 1
string(8) "40======"
Old Vector 2
string(8) "40G0===="
Old Vector 3
string(8) "40G20==="
Old Vector 4
string(8) "40G2080="
Old Vector 5
string(8) "40G20810"
Old Vector 6
string(16) "40G2081040======"
Empty String
string(0) ""
Random Integers
string(56) "3O6435QP17HCKBK7S45K90F6VSFJ4JEFRI131PK84DP2A7UD4NTG===="
Done
