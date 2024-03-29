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
