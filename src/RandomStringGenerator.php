<?php

namespace Hemker\RandomString;

use Hemker\RandomString\Exception\InvalidArgumentException;

class RandomStringGenerator
{
    private const HASH_CHARACTERS = '123456789ABCDEFGHJKLMNPQRSTUVWXYZ';

    private int $length = 1;

    public function length(int $length): self
    {
        if ($length <= 0) {
            throw new InvalidArgumentException('Only positive integers are allowed ('.$length.' given).');
        }

        $this->length = $length;

        return $this;
    }

    public function create(): string
    {
        $result = '';
        do {
            $randomString = $this->createRandomString();
            $result .= $this->encodeToValidCharacters($randomString);
        } while (strlen($result) < $this->length);

        return substr($result, -$this->length);
    }

    private function createRandomString(): string
    {
        return substr(str_shuffle(str_repeat(implode('', range('!', 'z')), 20)), 0, 20);
    }

    private function encodeToValidCharacters($input): string
    {
        $input = str_replace(['a', 'b', 'c', 'd', 'e', 'f'], ['10', '11', '12', '13', '14', '15'], md5($input));
        $base_count = strval(strlen(self::HASH_CHARACTERS));
        $encoded = '';
        while (floatval($input) >= floatval($base_count)) {
            $div = bcdiv($input, $base_count);
            $mod = bcmod($input, $base_count);
            $encoded = substr(self::HASH_CHARACTERS, intval($mod), 1).$encoded;
            $input = $div;
        }
        if (floatval($input) > 0) {
            $encoded = substr(self::HASH_CHARACTERS, intval($input), 1).$encoded;
        }

        return $encoded;
    }
}
