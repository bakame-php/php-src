--TEST--
Test base32_decode() function : invalid parameters in strict mode
--FILE--
<?php
echo "*** Testing base32_decode() : invalid parameters in strict mode ***\n\n";
$testData = [
        'characters outside of base32 extended hex alphabet' => [
            'sequence' => 'CPNMUOJ1E8Z======',
            'message' => 'The encoded string contains characters outside of the base32 alphabet.',
            'alphabet' => PHP_BASE32_HEX,
            'padding' => '=',
        ],
        'characters outside of base32 us ascii alphabet' => [
            'sequence' => '90890808',
            'message' => 'The encoded string contains characters outside of the base32 alphabet.',
            'alphabet' => PHP_BASE32_ASCII,
            'padding' => '=',
        ],
        'characters not upper-cased' => [
            'sequence' => 'MzxQ====',
            'message' => 'The encoded string contains lower-cased characters which is forbidden on strict mode.',
            'alphabet' => PHP_BASE32_ASCII,
            'padding' => '=',
        ],
        'padding character in the middle of the sequence' => [
            'sequence' => 'Mzx==Q====',
            'message' => 'A padding character is contained in the middle of the encoded string.',
            'alphabet' => PHP_BASE32_ASCII,
            'padding' => '=',
        ],
        'invalid padding length' => [
            'sequence' => 'MzxQ=======',
            'message' => 'The encoded string contains an invalid padding length.',
            'alphabet' => PHP_BASE32_ASCII,
            'padding' => '=',
        ],
        'invalid encoded string length' => [
            'sequence' => 'A',
            'message' => 'The encoded string length is not a multiple of 8.',
            'alphabet' => PHP_BASE32_ASCII,
            'padding' => '=',
        ],
        'invalid alphabet length' => [
            'sequence' => 'A',
            'message' => 'The alphabet must be a 32 bytes long string.',
            'alphabet' => '1234567890asdfghjklzxcvbnm',
            'padding' => '=',
        ],
        'the padding character is contained within the alphabet' => [
            'sequence' => 'A',
            'message' => 'The alphabet can not contain a reserved character.',
            'alphabet' => str_replace('A', '*', PHP_BASE32_ASCII),
            'padding' => '*',
        ],
        'the padding character is contained within the alphabet is case insensitive' => [
            'sequence' => 'A',
            'message' => 'The alphabet can not contain a reserved character.',
            'alphabet' => str_replace('A', '*', PHP_BASE32_ASCII),
            'padding' => 'a',
        ];
        'the padding character is different than one byte' => [
            'sequence' => 'A',
            'message' => 'The padding character must be a non reserved single byte character.',
            'alphabet' => PHP_BASE32_ASCII,
            'padding' => 'yo',
        ];
        'the padding character can not contain "\r"' => [
            'sequence' => 'A',
            'message' => 'The padding character must be a non reserved single byte character.',
            'alphabet' => PHP_BASE32_ASCII,
            'padding' => "\r",
        ];
        'the padding character can not contain "\n"' => [
            'sequence' => 'A',
            'message' => 'The padding character must be a non reserved single byte character.',
            'alphabet' => PHP_BASE32_ASCII,
            'padding' => "\n",
        ];
        'the padding character can not contain "\t"' => [
            'sequence' => 'A',
            'message' => 'The padding character must be a non reserved single byte character.',
            'alphabet' => PHP_BASE32_ASCII,
            'padding' => "\t",
        ];
        'the alphabet can not contain "\r"' => [
            'sequence' => 'A',
            'message' => 'The alphabet can not contain a reserved character.',
            'alphabet' => substr(PHP_BASE32_ASCII, 0, -1)."\r",
            'padding' => '=',
        ];
        'the alphabet can not contain "\n"' => [
            'sequence' => 'A',
            'message' => 'The alphabet can not contain a reserved character.',
            'alphabet' => substr(PHP_BASE32_HEX, 0, -1)."\n",
            'padding' => '=',
        ];
        'the alphabet can not contain "\t"' => [
            'sequence' => 'A',
            'message' => 'The alphabet can not contain a reserved character.',
            'alphabet' => substr(PHP_BASE32_HEX, 0, -1)."\t",
            'padding' => '=',
        ];
];

foreach ($testData as $testTitle => $data) {
    try {
        echo "$testTitle\n";
        var_dump(base32_decode($data['sequence'], $data['alphabet'], $data['padding'], true));
        echo "===\n";
    } catch (ValueError $exception) {
        echo "error message: ", $exception->getMessage(), "\n===\n";
    }
}
echo "\nDone\n";
?>
--EXPECT--
*** Testing base32_decode() : invalid parameters in strict mode ***

characters outside of base32 extended hex alphabet
bool(false)
===
characters outside of base32 us ascii alphabet
bool(false)
===
characters not upper-cased
bool(false)
===
padding character in the middle of the sequence
bool(false)
===
invalid padding length
bool(false)
===
invalid encoded string length
bool(false)
===
invalid alphabet length
error message: The alphabet must be a 32 bytes long string.
===
the padding character is contained within the alphabet
error message: The alphabet can not contain a reserved character.
===
the padding character is contained within the alphabet is case insensitive
bool(false)
===
the padding character is different than one byte
error message: The padding character must be a non-reserved single byte character.
===
the padding character can not contain "\r"
error message: The padding character must be a non-reserved single byte character.
===
the padding character can not contain "\n"
error message: The padding character must be a non-reserved single byte character.
===
the padding character can not contain "\t"
error message: The padding character must be a non-reserved single byte character.
===
the alphabet can not contain "\r"
error message: The alphabet can not contain a reserved character.
===
the alphabet can not contain "\n"
error message: The alphabet can not contain a reserved character.
===
the alphabet can not contain "\t"
error message: The alphabet can not contain a reserved character.
===

Done
