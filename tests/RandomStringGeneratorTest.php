<?php

declare(strict_types=1);

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

        $validChars = str_split($preset);
        $onlyValidCharsGiven = true;
        foreach (str_split($string) as $char) {
            if (!in_array($char, $validChars)) {
                $onlyValidCharsGiven = false;
            }
        }

        $this->assertTrue($onlyValidCharsGiven, sprintf('Generated string contains other chars than defined! (generated: %s, allowed chars: %s)', $string, $preset));
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
