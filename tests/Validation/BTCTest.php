<?php

namespace Tests\Validation;

use Vectorface\PhpCryptocurrencyAddressValidation\Validation;

class BTCTest extends BaseValidationTestCase
{
    public function getValidationInstance(): Validation
    {
        return Validation::make('BTC');
    }

    public function addressProvider()
    {
        return [
            ['1QLbGuc3WGKKKpLs4pBp9H6jiQ2MgPkXRp', [], true],
            ['1QLbGuc3WGKKKpLs4pBp9H6jiQ2MgPkXRp', [Validation::OPT_NET => Validation::MAINNET], true],
            ['1QLbGuc3WGKKKpLs4pBp9H6jiQ2MgPkXRp', [Validation::OPT_NET => Validation::TESTNET], false],
            ['3QJmV3qfvL9SuYo34YihAf3sRCW3qSinyC', [], true],
            ['LbTjMGN7gELw4KbeyQf6cTCq859hD18guE', [], false],
            ['bc1qar0srrr7xfkvy5l643lydnw9re59gtzzwf5mdq', [], true],
            ['ltc1qy4rwhdkujk35ga26774gqmng67kgggtqnsx9vp0xgzp3wz3yjkhqashszw', [], false],
            ['mipcBbFg9gMiCh81Kj8tqqdgoZub1ZJRfn', [], false],
            ['2MzQwSSnBHWHqSAqtTVQ6v47XtaisrJa1Vc', [], false],
            ['tb1qw508d6qejxtdg4y5r3zarvary0c5xw7kxpjzsx', [], false],
            ['3PpQtDyDza5Sgyo6duza8c4VjnlwA8cVoC', [], false],


            ['1E3d6EWLgwisXY2CWXDcdQQP2ivRN7e9r9', [], true],
            ['1AGNa15ZQXAZUgFiqJ2i7Z2DPU2J6hW62i', [], true],
            ['1Q1pE5vPGEEMqRcVRMbtBK842Y6Pzo6nK9', [], true],
            ['1Q1pE5vPGEEMqRcVRMbtBK842Y6Pzo6nK0', [], false],
            ['1Q1pE5vPGEEMqRcVRMbtBK842Y6Pzo6nKl', [], false],
            ['1Q1pE5vPGEEMqRcVRMbtBK842Y6Pzo6nJ9', [], false],
            ['1AGNa15ZQXAZUgFiqJ2i7Z2DPU2J6hW62I', [], false],
            ['bc1qw508d6qejxtdg4y5r3zarvary0c5xw7kv8f3t4', [], true],
            ['1AGNa15ZQXAZUgFiqJ2i7Z2DPU2J6hW62i', [], true],
            ['3ALJH9Y951VCGcVZYAdpA3KchoP9McEj1G', [], true],
            ['bc1qw508d6qejxtdg4y5r3zarvary0c5xw7kv8f3t4', [], true],
            ['tb1qw508d6qejxtdg4y5r3zarvary0c5xw7kxpjzsx', [Validation::OPT_NET => Validation::TESTNET], false],
            ['abc123', [], false],
            ['1E3d6EWlgwisXY2CWXDcdQQP2ivRN7e9r9', [], false],
            ['1E3d6EWLgwisXY2CWXDcdQQP2IvRN7e9r9', [], false],
            ['39FKvVF2gnKEAugSUFspCdGnYEgc7z8MPX', [Validation::OPT_NET => Validation::MAINNET], true],
        ];
    }
}
