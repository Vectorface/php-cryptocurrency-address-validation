<?php

namespace Vectorface\PhpCryptocurrencyAddressValidation\Validation;

use CBOR\ByteStringObject;
use CBOR\CBORObject;
use CBOR\Decoder;
use CBOR\ListObject;
use CBOR\OtherObject;
use CBOR\StringStream;
use CBOR\Tag;
use Vectorface\PhpCryptocurrencyAddressValidation\Base58Validation;
use Vectorface\PhpCryptocurrencyAddressValidation\Utils\Bech32Decoder;
use Vectorface\PhpCryptocurrencyAddressValidation\Utils\Bech32Exception;

class ADA extends Base58Validation
{
    protected $validLengths = [
        33, // A
        66, // D
    ];
    protected $validBechPrefix = 'addr';

    public function isValidV1(string $address, array $options = []): bool
    {
        try {
            $addressHex = self::base58ToHex($address);

            $otherObjectManager = new OtherObject\OtherObjectManager();
            $otherObjectManager->add(OtherObject\SimpleObject::class);

            $tagManager = new Tag\TagManager();
            $tagManager->add(Tag\UnsignedBigIntegerTag::class);

            $decoder = new Decoder($tagManager, $otherObjectManager);
            $data = hex2bin($addressHex);
            $stream = new StringStream($data);

            /** @var ListObject $object */
            $object = $decoder->decode($stream);

            /** @var array $normalizedData */
            $normalizedData = $object->normalize();
            if ($object->getMajorType() != CBORObject::MAJOR_TYPE_LIST) {
                return false;
            }
            if (count($normalizedData) != 2) {
                return false;
            }
            if (!is_numeric($normalizedData[1])) {
                return false;
            }
            if (!$normalizedData[0] instanceof Tag\GenericTag) {
                return false;
            }

            /** @var ByteStringObject $bs */
            $bs = $normalizedData[0]->getValue();
            
            if (!in_array($bs->getLength(), $this->validLengths)) {
                return false;
            }
            
            $crcCalculated = crc32($bs->getValue());
            $validCrc = $normalizedData[1];

            return $crcCalculated == (int)$validCrc;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function validate(string $address, array $options = []): bool
    {
        $valid = $this->isValidV1($address, $options);
        if (!$valid) {
            // maybe it's a bech32 address
            try {
                $valid = is_array($decoded = Bech32Decoder::decodeRaw($address)) && $this->validBechPrefix === $decoded[0];
            } catch (Bech32Exception $exception) {
            }
        }

        return $valid;
    }
}
