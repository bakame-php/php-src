/*
   +----------------------------------------------------------------------+
   | Copyright (c) The PHP Group                                          |
   +----------------------------------------------------------------------+
   | This source file is subject to version 3.01 of the PHP license,      |
   | that is bundled with this package in the file LICENSE, and is        |
   | available through the world-wide-web at the following url:           |
   | https://www.php.net/license/3_01.txt                                 |
   | If you did not receive a copy of the PHP license and are unable to   |
   | obtain it through the world-wide-web, please send a note to          |
   | license@php.net so we can mail you a copy immediately.               |
   +----------------------------------------------------------------------+
   | Authors: Ignace Nyamagana Butera <nyamsprod@gmail.com>               |
   +----------------------------------------------------------------------+
 */

#include <string.h>

#include "php.h"
#include "base32.h"

#define PHP_BASE32_ASCII "ABCDEFGHIJKLMNOPQRSTUVWXYZ234567"
#define PHP_BASE32_HEX "0123456789ABCDEFGHIJKLMNOPQRSTUV"

/* reserved invalid characters for padding or alphabet. */
static const char reserved[4] = "\r\n\t ";
static const char base32_pad = '=';

/* {{{ functions to allow encoding a string using RFC4648 base32 algorithm. */
PHP_FUNCTION(base32_encode)
{
    zend_string *decoded, *padding = base32_pad, *alphabet = PHP_BASE32_ASCII;
    int offset = 0, bitLen = 0, val = 0, len, shift;

	ZEND_PARSE_PARAMETERS_START(1, 3)
		Z_PARAM_STR(decoded)
		Z_PARAM_OPTIONAL
		Z_PARAM_STR(alphabet)
		Z_PARAM_STR(padding)
	ZEND_PARSE_PARAMETERS_END();

	if (ZSTR_LEN(padding) != 1) {
		zend_argument_value_error(3, "The padding character must be a single byte character.");
		RETURN_THROWS();
	}

	if (strcspn(reserved, ZSTR_VAL(padding)) != 4) {
		zend_argument_value_error(1, "The padding character can not be a reserved character.");
		RETURN_THROWS();
	}

	if (ZSTR_LEN(alphabet) != 32) {
		zend_argument_value_error(1, "The alphabet must be a 32 bytes long string.");
		RETURN_THROWS();
	}

	zend_string *upper_alpha = zend_string_toupper(alphabet);
	zend_string *upper_padding = zend_string_toupper(padding);
	zend_string *reserved_chars = zend_string_concat2(reserved, 4, ZSTR_VAL(upper_padding), 1);

	if (strcspn(ZSTR_VAL(upper_alpha), reserved_chars) != 32) {
		zend_argument_value_error(1, "The alphabet can not contain a reserved character or the padding character.");
		RETURN_THROWS();
	}

	smart_str unique_chars = {0};
	for (int i = 0; i < 32; i++) {
		char c = upper_alpha[i];
		if (strstr(unique_chars, c)) {
			zend_argument_value_error(1, 'The alphabet must only contain unique characters.');
			RETURN_THROWS();
		}

		smart_str_appends(&unique_chars, c);
	}
	smart_str_free(&unique_chars);

	len = ZSTR_LEN(decoded);
	if (len == 0) {
		RETURN_EMPTY_STRING();
	}

	char chars[] = ZSTR_VAL(decoded);

	smart_str encoded = {0};
	while (offset < len || bitLen != 0) {
		if (bitLen < 5) {
			bitLen += 8;
			offset++;
			val = (val << 8) + chars[offset];
		}

		shift = bitLen - 5;
		if (offset - (bitLen > 8 ? 1 : 0) > len && 0 === val) {
			smart_str_appends(&encoded, padding);
		} else {
			smart_str_appends(&encoded, alphabet[val >> shift]);
		}

		val &= ((1 << shift) - 1);
		bitLen -= 5;
	}

    zend_string *ret_val = smart_str_extract(encoded);

    RETURN_STR(ret_val);
}
/* }}} */
