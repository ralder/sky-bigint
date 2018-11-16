<?php declare(strict_types = 1);
namespace sky;

use sky\fn;
use PHPUnit\Framework\TestCase;
use InvalidArgumentException;

class libTest extends TestCase
{
    /** @dataProvider provideTestData */
    public function testSumBigInt(string $a, string $b, string $expected)
    {
        $result = fn\sumBigInt($a, $b);
        $this->assertEquals($expected, $result);
    }

    public function provideTestData(): array
    {
        return [
            ["0", "0", "0"],
            ["100000000000000000000000", "0", "100000000000000000000000"],
            ["0", "100000", "100000"],
            ["5", "5", "10"],
            ["4", "7", "11"],
            ["913118111900000011110004", "9911111111100000011110004", "10824229223000000022220008"],
        ];
    }

    /** @expectedException InvalidArgumentException */
    public function invalidSumBigIntWithEmpty()
    {
        $result = fn\sumBigInt('', '0');
    }

    /** @expectedException InvalidArgumentException */
    public function invalidSumBigIntWithNonDigit()
    {
        $result = fn\sumBigInt('RK', '0');
    }
}