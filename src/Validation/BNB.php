<?php

namespace Vectorface\PhpCryptocurrencyAddressValidation\Validation;

use Vectorface\PhpCryptocurrencyAddressValidation\Utils\Bech32Decoder;
use Vectorface\PhpCryptocurrencyAddressValidation\Utils\Bech32Exception;
use Vectorface\PhpCryptocurrencyAddressValidation\Validation;

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
