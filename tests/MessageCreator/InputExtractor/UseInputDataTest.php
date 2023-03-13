<?php
declare(strict_types=1);

namespace Chimera\Tests\MessageCreator\InputExtractor;

use Chimera\Input;
use Chimera\MessageCreator\InputExtractor\UseInputData;
use PHPUnit\Framework\Attributes as PHPUnit;
use PHPUnit\Framework\TestCase;

#[PHPUnit\CoversClass(UseInputData::class)]
final class UseInputDataTest extends TestCase
{
    #[PHPUnit\Test]
    public function extractDataShouldReturnTheInputData(): void
    {
        $input = $this->createMock(Input::class);
        $input->method('getData')->willReturn(['testing' => 1]);

        $extractor = new UseInputData();

        self::assertSame(['testing' => 1], $extractor->extractData($input));
    }
}
