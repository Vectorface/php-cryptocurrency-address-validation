<?php

namespace Vectorface\PhpCryptocurrencyAddressValidation\Validation;

use Vectorface\PhpCryptocurrencyAddressValidation\Base58Validation;
use Vectorface\PhpCryptocurrencyAddressValidation\Utils\Bech32Decoder;
use Vectorface\PhpCryptocurrencyAddressValidation\Utils\Bech32Exception;

class LTC extends Base58Validation
{
    const DEPRECATED_ADDRESS_VERSIONS = ['31'];

    protected $deprecatedAllowed = false;

    protected $base58PrefixToHexVersion = [
        'L' => '30',
        'M' => '32',
        '3' => '05',
        'm' => '6F',
        '2' => 'C4',
        'Q' => '3A',
    ];

    protected $network_version_map = [
        '30' => self::MAINNET,
        '32' => self::MAINNET,
        '05' => self::MAINNET,
        '6F' => self::TESTNET,
        'C4' => self::TESTNET,
        '3A' => self::TESTNET,
    ];

    public function validate(string $address, array $options = []): bool
    {
        $valid = parent::validate($address);

        if (!$valid) {
            // maybe it's a bech32 address
            try {
                $valid = is_array($decoded = Bech32Decoder::decodeRaw($address)) && $decoded[0] === 'ltc';
            } catch (Bech32Exception $exception) {
            }
        }

        return $valid;
    }

    protected function validateVersion(string $version, array $options = []): bool
    {
        if (!$this->deprecatedAllowed && in_array($this->addressVersion, self::DEPRECATED_ADDRESS_VERSIONS)) {
            return false;
        }
        return hexdec($version) == hexdec($this->addressVersion);
    }

    /**
     * @return boolean
     */
    public function isDeprecatedAllowed(): bool
    {
        return $this->deprecatedAllowed;
    }

    /**
     * @param bool $deprecatedAllowed
     */
    public function setDeprecatedAllowed(bool $deprecatedAllowed)
    {
        $this->deprecatedAllowed = $deprecatedAllowed;
    }
}
