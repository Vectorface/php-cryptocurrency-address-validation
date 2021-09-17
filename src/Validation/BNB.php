<?php

namespace Merkeleon\PhpCryptocurrencyAddressValidation\Validation;

use Merkeleon\PhpCryptocurrencyAddressValidation\Utils\Bech32Decoder;
use Merkeleon\PhpCryptocurrencyAddressValidation\Utils\Bech32Exception;
use Merkeleon\PhpCryptocurrencyAddressValidation\Validation;

class BNB extends Validation
{
    public function validate(string $address, array $options = []): bool
    {
        $valid = false;
        try {
            $valid = is_array($decoded = Bech32Decoder::decodeRaw($address)) && $decoded[0] === 'bnb';
        } catch (Bech32Exception $exception) {
        }

        return $valid;
    }
}
