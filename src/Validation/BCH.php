<?php

namespace jlcooke\PhpCryptocurrencyAddressValidation\Validation;

use jlcooke\PhpCryptocurrencyAddressValidation\Base58Validation;
use jlcooke\PhpCryptocurrencyAddressValidation\Utils\CashAddress;

class BCH extends Base58Validation
{
    // more info at https://en.bitcoin.it/wiki/List_of_address_prefixes
    protected $base58PrefixToHexVersion = [
        '1' => '00',
        '3' => '05',
        '2' => 'C4',
        'm' => 'BB',
    ];

    protected $network_version_map = [
        '00' => self::MAINNET,
        '05' => self::MAINNET,
        'C4' => self::TESTNET,
        'BB' => self::TESTNET,
    ];

    public function validate(string $address, array $options = []): bool
    {
        $address = (string)$address;
        try {
            $legacy = CashAddress::new2old($address);
        } catch (\Exception $ex) {
            $legacy = $address;
        }
        return parent::validate($legacy, $options);
    }
}
