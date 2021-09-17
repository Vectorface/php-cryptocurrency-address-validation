<?php

namespace Merkeleon\PhpCryptocurrencyAddressValidation\Validation;

use Merkeleon\PhpCryptocurrencyAddressValidation\Base58Validation;
use Merkeleon\PhpCryptocurrencyAddressValidation\Utils\Bech32Decoder;
use Merkeleon\PhpCryptocurrencyAddressValidation\Utils\Bech32Exception;

class TBTC extends Base58Validation
{
    // more info at https://en.bitcoin.it/wiki/List_of_address_prefixes
    protected $base58PrefixToHexVersion = [
        'm' => '6F',
        'n' => '6F',
        '2' => 'C4',
    ];

    protected $network_version_map = [
        '6F' => self::MAINNET,
        'C4' => self::MAINNET,
    ];

    public function validate(string $address, array $options = []): bool
    {
        $valid = parent::validate($address);

        if (!$valid) {
            // maybe it's a bech32 address
            try {
                $valid = is_array($decoded = Bech32Decoder::decodeRaw($address)) && $decoded[0] === 'tb';
            } catch (Bech32Exception $exception) {
            }
        }

        return $valid;
    }
}
