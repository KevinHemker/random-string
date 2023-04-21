<?php

declare(strict_types=1);

use Hemker\RandomString\RandomStringGenerator;
use PHPUnit\Framework\TestCase;

class RandomStringGeneratorTest extends TestCase
{
    /**
     * @covers \RandomStringGenerator::length
     *
     * @dataProvider lengthProvider
     */
    public function testCanProduceStringsOfDifferentLengths(int $expectedLength, int $length)
    {
        $generator = new RandomStringGenerator();
        $string = $generator->length($length)->create();

        $this->assertSame($expectedLength, strlen($string));
    }

    public function lengthProvider(): array
    {
        return [
            [5, 5],
            [10, 10],
            [50, 50],
            [1000, 1000],
        ];
    }
}
