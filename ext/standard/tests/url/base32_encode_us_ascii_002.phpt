--TEST--
Test base32_encode() function : basic functionality - check algorithm round trips with us-ascii alphabet
--FILE--
<?php
/*
 * Test base62_encode with single byte values.
 */

echo "*** Testing base32_encode() : basic functionality ***\n";

$values = [
    "Hello World",
    "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!%^&*(){}[]",
    "\n\t Line with control characters\r\n",
    "\xC1\xC2\xC3\xC4\xC5\xC6",
    "\75\76\77\78\79\80",
    "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789%!",
    "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789%!\75\76\77\78\79\80",
    "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789%!ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789%!",
    "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789%!ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789%!\75\76\77\78\79\80",
    '',
    '10',
    'test130',
    'test',
    '8',
    '0',
    '=',
    'foobar',
    PHP_BASE32_ASCII,
    PHP_BASE32_HEX,
];

echo "\n--- Testing base32_encode() with binary string input ---\n";

$counter = 1;
foreach($values as $str) {
    echo "-- Iteration $counter --\n";

    $enc = base32_encode($str);
    $dec = base32_decode($enc);

    if ($dec !== $str) {
        echo "TEST FAILED\n";
    } else {
        echo "TEST PASSED\n";
    }

    $counter ++;
}

?>
--EXPECT--
*** Testing base32_encode() : basic functionality ***

--- Testing base32_encode() with binary string input ---
-- Iteration 1 --
TEST PASSED
-- Iteration 2 --
TEST PASSED
-- Iteration 3 --
TEST PASSED
-- Iteration 4 --
TEST PASSED
-- Iteration 5 --
TEST PASSED
-- Iteration 6 --
TEST PASSED
-- Iteration 7 --
TEST PASSED
-- Iteration 8 --
TEST PASSED
-- Iteration 9 --
TEST PASSED
