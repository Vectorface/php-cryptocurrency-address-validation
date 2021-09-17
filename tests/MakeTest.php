<?php

namespace Tests;

use jlcooke\PhpCryptocurrencyAddressValidation\Validation;

class MakeTest extends TestCase
{
    /** @dataProvider makeProvider */
    public function testMake($iso, $class)
    {
        $instance = Validation::make($iso);

        $this->assertInstanceOf($class, $instance);
    }

    public function makeProvider()
    {
        return [
            ['BCH', Validation\BCH::class],
            ['BNB', Validation\BNB::class],
            ['BSV', Validation\BSV::class],
            ['BTC', Validation\BTC::class],
            ['DASH', Validation\DASH::class],
            ['DOGE', Validation\DOGE::class],
            ['ETC', Validation\ETC::class],
            ['ETH', Validation\ETH::class],
            ['LTC', Validation\LTC::class],
            ['NEO', Validation\NEO::class],
            ['TBTC', Validation\TBTC::class],
            ['XRP', Validation\XRP::class],
            ['ZEC', Validation\ZEC::class],
        ];
    }
}
