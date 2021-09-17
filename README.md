# php-cryptocurrency-address-validation

Easy to use PHP Bitcoin and Litecoin address validator.
One day I will add other crypto currencies. Or how about you? :)

2021-09-17 - needed more features like TestNet vs MainNet filters on validation.

## Usage

```php
use Vectorface\PhpCryptocurrencyAddressValidation\Validation;

$validator = Validation::make('BTC');
var_dump([
  'classic' => $validator->validate('1QLbGuc3WGKKKpLs4pBp9H6jiQ2MgPkXRp'),
  'options empty (assumes Mainnet)' => $validator->validate('1QLbGuc3WGKKKpLs4pBp9H6jiQ2MgPkXRp', []),
  'options NET MAIN' => $validator->validate('1QLbGuc3WGKKKpLs4pBp9H6jiQ2MgPkXRp', [ Validation::OPT_NET => Validation::MAINNET ]),
  'options NET TEST' => $validator->validate('1QLbGuc3WGKKKpLs4pBp9H6jiQ2MgPkXRp', [ Validation::OPT_NET => Validation::TESTNET ]),
  'options NET garbage (assumes Mainnet)' => $validator->validate('1QLbGuc3WGKKKpLs4pBp9H6jiQ2MgPkXRp', [ Validation::OPT_NET => 'blah' ]),
  'options garbage (assumes Mainnet)' => $validator->validate('1QLbGuc3WGKKKpLs4pBp9H6jiQ2MgPkXRp', [ 'hammer' => 'nail' ]),
]);

```
