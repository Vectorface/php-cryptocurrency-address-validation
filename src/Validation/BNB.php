<?php

namespace jlcooke\PhpCryptocurrencyAddressValidation\Validation;

use jlcooke\PhpCryptocurrencyAddressValidation\Utils\Bech32Decoder;
use jlcooke\PhpCryptocurrencyAddressValidation\Utils\Bech32Exception;
use jlcooke\PhpCryptocurrencyAddressValidation\Validation;

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
