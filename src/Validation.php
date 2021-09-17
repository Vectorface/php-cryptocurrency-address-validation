<?php

namespace Vectorface\PhpCryptocurrencyAddressValidation;

use Vectorface\PhpCryptocurrencyAddressValidation\Exception\CryptocurrencyValidatorNotFound;

abstract class Validation
{
    const OPT_NET = 'network';
    const MAINNET = 'mainnet';
    const TESTNET = 'testnet';

    protected $address;
    protected $addressVersion;
    protected $base58PrefixToHexVersion;
    protected $network_version_map;
    protected $length = 50;
    protected $lengths = [];

    protected function __construct()
    {
    }

    /**
     * @param string $iso
     * @return mixed
     * @throws CryptocurrencyValidatorNotFound
     */
    public static function make(string $iso)
    {
        $class = self::class . '\\' . strtoupper($iso);
        if (class_exists($class)) {
            return new $class();
        }
        throw new CryptocurrencyValidatorNotFound($iso);
    }

    abstract public function validate(string $address, array $options = []): bool;
}
