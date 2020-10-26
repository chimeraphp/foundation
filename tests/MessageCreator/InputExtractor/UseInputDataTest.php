<?php
declare(strict_types=1);

namespace Chimera\MessageCreator\Tests\Unit\InputExtractor;

use Chimera\Input;
use Chimera\MessageCreator\InputExtractor\UseInputData;
use PHPUnit\Framework\TestCase;

/** @coversDefaultClass \Chimera\MessageCreator\InputExtractor\UseInputData */
final class UseInputDataTest extends TestCase
{
    /**
     * @test
     *
     * @covers ::extractData
     */
    public function extractDataShouldReturnTheInputData(): void
    {
        $input = $this->createMock(Input::class);
        $input->method('getData')->willReturn(['testing' => 1]);

        $extractor = new UseInputData();

        self::assertSame(['testing' => 1], $extractor->extractData($input));
    }
}
