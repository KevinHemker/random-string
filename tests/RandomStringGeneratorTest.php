<?php

declare(strict_types=1);

use Hemker\RandomString\RandomStringGenerator;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Hemker\RandomString\RandomStringGenerator
 */
class RandomStringGeneratorTest extends TestCase
{
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
