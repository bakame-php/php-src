--TEST--
Test base32_decode() function : invalid parameters in strict mode
--FILE--
<?php
echo "*** Testing base32_decode() : invalid parameters in strict mode ***\n\n";
$testData = [
    'characters outside of base32 extended hex alphabet' => [
        'encoded' => 'CPNMUOJ1E8Z======',
        'alphabet' => PHP_BASE32_HEX,
        'padding' => '=',
        'expected' => false,
    ],
    'characters outside of base32 us ascii alphabet' => [
        'encoded' => '90890808',
        'alphabet' => PHP_BASE32_ASCII,
        'padding' => '=',
        'expected' => false,
    ],
    'characters not upper-cased' => [
        'encoded' => 'MzxQ====',
        'alphabet' => PHP_BASE32_ASCII,
        'padding' => '=',
        'expected' => false,
    ],
    'padding character in the middle of the sequence' => [
        'encoded' => 'Mzx==Q====',
        'alphabet' => PHP_BASE32_ASCII,
        'padding' => '=',
        'expected' => false,
    ],
    'invalid padding length' => [
        'encoded' => 'MzxQ=======',
        'alphabet' => PHP_BASE32_ASCII,
        'padding' => '=',
        'expected' => false,
    ],
    'invalid encoded string length' => [
        'encoded' => 'MzxQ',
        'alphabet' => PHP_BASE32_ASCII,
        'padding' => '=',
        'expected' => false,
    ],
    'invalid alphabet length' => [
        'encoded' => 'MZXQ=====',
        'alphabet' => '1234560asdfghjklzxcvbnm',
        'padding' => '=',
        'error' => 'The alphabet must be a 32 bytes long string.',
    ],
    'the padding character is contained within the alphabet' => [
        'encoded' => 'MZXQ=======',
        'alphabet' => str_replace('A', '*', PHP_BASE32_ASCII),
        'padding' => '*',
        'error' => 'The alphabet can not contain a reserved character.',
    ],
    'the padding character is contained within the alphabet is case insensitive' => [
        'encoded' => 'MZXQ=======',
        'alphabet' => PHP_BASE32_ASCII,
        'padding' => 'a',
        'error' => 'The alphabet can not contain a reserved character.',
    ],
    'the padding character is different than one byte' => [
        'encoded' => 'A',
        'alphabet' => PHP_BASE32_ASCII,
        'padding' => 'yo',
        'error' => 'The padding character must be a non-reserved single byte character.',
    ],
    'the padding character can not contain "\r"' => [
        'encoded' => 'A',
        'alphabet' => PHP_BASE32_ASCII,
        'padding' => "\r",
        'error' => 'The padding character must be a non-reserved single byte character.',
    ],
    'the padding character can not contain "\n"' => [
        'encoded' => 'A',
        'alphabet' => PHP_BASE32_ASCII,
        'padding' => "\n",
        'error' => 'The padding character must be a non-reserved single byte character.',
    ],
    'the padding character can not contain "\t"' => [
        'encoded' => 'A',
        'alphabet' => PHP_BASE32_ASCII,
        'padding' => "\t",
        'error' => 'The padding character must be a non-reserved single byte character.',
    ],
    'the alphabet can not contain "\r"' => [
        'encoded' => 'A',
        'alphabet' => substr(PHP_BASE32_ASCII, 0, -1)."\r",
        'padding' => '=',
        'error' => 'The alphabet can not contain a reserved character.',
    ],
    'the alphabet can not contain "\n"' => [
        'encoded' => 'A',
        'alphabet' => substr(PHP_BASE32_HEX, 0, -1)."\n",
        'padding' => '=',
        'error' => 'The alphabet can not contain a reserved character.',
    ],
    'the alphabet can not contain "\t"' => [
        'encoded' => 'A',
        'alphabet' => substr(PHP_BASE32_HEX, 0, -1)."\t",
        'padding' => '=',
        'error' => 'The alphabet can not contain a reserved character.',
    ],
];

foreach ($testData as $testTitle => $data) {
    try {
        echo "$testTitle: ";
        $res = base32_decode($data['encoded'], $data['alphabet'], $data['padding'], true);
        if (isset($data['expected'])) {
            if ($res === $data['expected']) {
                echo "TEST PASSED\n";
            } else {
                echo "TEST FAILED\n";
            }
        } else {
            echo "TEST FAILED\n";
        }
    } catch (ValueError $exception) {
        if (isset($data['error'])) {
            if ($exception->getMessage() === $data['error']) {
                echo "TEST PASSED\n";
            } else {
                echo "TEST FAILED\n";
            }
        } else {
            echo "TEST FAILED\n";
        }
    }
}
echo "\nDone\n";
?>
--EXPECT--
*** Testing base32_decode() : invalid parameters in strict mode***

characters outside of base32 extended hex alphabet: TEST PASSED
characters outside of base32 us ascii alphabet: TEST PASSED
characters not upper-cased: TEST PASSED
padding character in the middle of the sequence: TEST PASSED
invalid padding length: TEST PASSED
invalid encoded string length: TEST PASSED
invalid alphabet length: TEST PASSED
the padding character is contained within the alphabet: TEST PASSED
the padding character is contained within the alphabet is case insensitive: TEST PASSED
the padding character is different than one byte: TEST PASSED
the padding character can not contain "\r": TEST PASSED
the padding character can not contain "\n": TEST PASSED
the padding character can not contain "\t": TEST PASSED
the alphabet can not contain "\r": TEST PASSED
the alphabet can not contain "\n": TEST PASSED
the alphabet can not contain "\t": TEST PASSED

Done
