<?php

namespace jlcooke\PhpCryptocurrencyAddressValidation\Validation;

use jlcooke\PhpCryptocurrencyAddressValidation\Base58Validation;

class DOGE extends Base58Validation
{
    protected $base58PrefixToHexVersion = [
        'D' => '1E',
        '9' => '16',
        'A' => '16',
    ];

    protected $network_version_map = [
        '1E' => self::MAINNET,
        '16' => self::MAINNET,
    ];
}
