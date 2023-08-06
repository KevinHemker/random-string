<?php

declare(strict_types=1);

/**
 * @copyright Kevin Hemker <kevin@hemkers.de>
 * @license   MIT
 * @see       https://github.com/KevinHemker/random-string
 */

use Hemker\RandomString\RandomStringGenerator;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Hemker\RandomString\RandomStringGenerator
 */
class RandomStringGeneratorTest extends TestCase
{
    public function testNoLengthGivenWillResultInLengthOne()
    {
        $generator = new RandomStringGenerator();
        $string = $generator->create();
        $this->assertSame(1, strlen($string));
    }

    /**
     * @dataProvider validLengthProvider
     */
    public function testCanProduceStringsOfDifferentLengths(int $expectedLength, int $length)
    {
        $generator = new RandomStringGenerator();
        $string = $generator->length($length)->create();

        $this->assertSame($expectedLength, strlen($string));
    }

    /**
     * @dataProvider invalidLengthProvider
     */
    public function testLengthsLessThanOrEqualZeroLeadsToAnException(int $length)
    {
        $this->expectException(\Hemker\RandomString\Exception\InvalidArgumentException::class);
        $this->expectExceptionMessage('Only positive integers are allowed');

        $generator = new RandomStringGenerator();
        $generator->length($length)->create();
    }

    public function testResultWillOnlyContainGivenChars()
    {
        $preset = 'asdf';
        $generator = new RandomStringGenerator();
        $string = $generator->length(50)->chars($preset)->create();

        $this->assertTrue($this->onlyValidCharsUsed($preset, $string), sprintf('Generated string contains other chars than defined! (generated: %s, allowed chars: %s)', $string, $preset));
    }

    /**
     * @dataProvider validLengthProvider
     */
    public function testMultipleStringsCanBeCreatedAtOnce(int $expectedLength, int $length)
    {
        $preset = '1234567890';
        $generator = new RandomStringGenerator($preset, 5);
        $strings = $generator->create($length);

        $this->assertIsArray($strings);
        $this->assertSame($expectedLength, count($strings));

        foreach ($strings as $string) {
            $this->assertSame(5, strlen($string));
            $this->assertTrue($this->onlyValidCharsUsed($preset, $string));
        }
    }

    private function onlyValidCharsUsed(string $validChars, string $stringToTest): bool
    {
        $validChars = str_split($validChars);
        foreach (str_split($stringToTest) as $char) {
            if (!in_array($char, $validChars)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @return int[][] First: Expected Length, then: Param to length()
     */
    public function validLengthProvider(): array
    {
        return [
            [5, 5],
            [10, 10],
            [50, 50],
            [1000, 1000],
        ];
    }

    public function invalidLengthProvider(): array
    {
        return [
            [0],
            [-5],
        ];
    }
}
