<?php

declare(strict_types=1);

/**
 * @copyright Kevin Hemker <kevin@hemkers.de>
 * @license   MIT
 * @see       https://github.com/KevinHemker/random-string
 */

namespace Hemker\RandomString;

use Hemker\RandomString\Exception\InvalidArgumentException;

/**
 * @api
 */
class RandomStringGenerator
{
    private const HASH_CHARACTERS = '123456789ABCDEFGHJKLMNPQRSTUVWXYZ';

    private int $length = 1;
    private string $chars = self::HASH_CHARACTERS;

    public function __construct(string $chars = self::HASH_CHARACTERS, int $length = 1)
    {
        $this->chars($chars);
        $this->length($length);
    }

    public function length(int $length): self
    {
        if ($length <= 0) {
            throw new InvalidArgumentException('Only positive integers are allowed ('.$length.' given).');
        }

        $this->length = $length;

        return $this;
    }

    public function chars(string $preset): self
    {
        $this->chars = $preset;

        return $this;
    }

    public function create(int $count = 1): string|array
    {
        if ($count <= 0) {
            throw new InvalidArgumentException('Only positive integers are allowed ('.$count.' given).');
        }

        $result = [];
        do {
            $string = '';
            do {
                $randomString = $this->createRandomString();
                $string .= $this->encodeToValidCharacters($randomString);
            } while (strlen($string) < $this->length);
            $result[] = substr($string, -$this->length);
        } while (count($result) < $count);

        return $count == 1 ? $result[0] : $result;
    }

    private function createRandomString(): string
    {
        return substr(str_shuffle(str_repeat(implode('', range('!', 'z')), 20)), 0, 20);
    }

    private function encodeToValidCharacters(string $input): string
    {
        /** @psalm-var numeric-string $input */
        $input = str_replace(['a', 'b', 'c', 'd', 'e', 'f'], ['10', '11', '12', '13', '14', '15'], md5($input));
        /** @psalm-var numeric-string $base_count */
        $base_count = strval(strlen($this->chars));
        $encoded = '';
        while (floatval($input) >= floatval($base_count)) {
            $div = bcdiv($input, $base_count);
            $mod = bcmod($input, $base_count);
            $encoded = substr($this->chars, intval($mod), 1).$encoded;
            $input = $div;
        }
        if (floatval($input) > 0) {
            $encoded = substr($this->chars, intval($input), 1).$encoded;
        }

        return $encoded;
    }
}
