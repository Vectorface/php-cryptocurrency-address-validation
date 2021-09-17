<?php

namespace Vectorface\PhpCryptocurrencyAddressValidation\Validation;

use Vectorface\PhpCryptocurrencyAddressValidation\Base58Validation;

class TRX extends Base58Validation
{
    protected $base58PrefixToHexVersion = [
        'T' => '41',
    ];

    protected $network_version_map = [
        '41' => self::MAINNET,
    ];
}
