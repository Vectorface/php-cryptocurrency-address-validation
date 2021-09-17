<?php

namespace Merkeleon\PhpCryptocurrencyAddressValidation\Validation;

use Merkeleon\PhpCryptocurrencyAddressValidation\Base58Validation;
use Merkeleon\PhpCryptocurrencyAddressValidation\Utils\Bech32Decoder;
use Merkeleon\PhpCryptocurrencyAddressValidation\Utils\Bech32Exception;

class BTC extends Base58Validation
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
        $valid = parent::validate($address, $options);

        if (!$valid) {
            // maybe it's a bech32 address
            try {
                $valid = is_array($decoded = Bech32Decoder::decodeRaw($address)) && $decoded[0] === 'bc';
            } catch (Bech32Exception $exception) {
            }
        }

        return $valid;
    }
}
