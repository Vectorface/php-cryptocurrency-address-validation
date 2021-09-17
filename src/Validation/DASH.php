<?php

namespace Vectorface\PhpCryptocurrencyAddressValidation\Validation;

use Vectorface\PhpCryptocurrencyAddressValidation\Base58Validation;

class DASH extends Base58Validation
{
    const VERSION_P2PKH = '4C';
    const VERSION_P2SH = '10';

    protected $base58PrefixToHexVersion = [
        'X' => self::VERSION_P2PKH,
        '7' => self::VERSION_P2SH,
    ];

    protected $network_version_map = [
        self::VERSION_P2PKH => self::MAINNET,
        self::VERSION_P2SH  => self::MAINNET,
    ];
}
