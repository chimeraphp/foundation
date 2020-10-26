<?php
declare(strict_types=1);

namespace Chimera\MessageCreator\Tests\Unit\InputExtractor;

use Chimera\Input;
use Chimera\MessageCreator\InputExtractor\AppendGeneratedIdentifier;
use Chimera\MessageCreator\InputExtractor\UseInputData;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

/**
 * @coversDefaultClass \Chimera\MessageCreator\InputExtractor\AppendGeneratedIdentifier
 *
 * @uses \Chimera\MessageCreator\InputExtractor\UseInputData
 */
final class AppendGeneratedIdentifierTest extends TestCase
{
    /**
     * @test
     *
     * @covers ::__construct
     * @covers ::extractData
     */
    public function extractDataShouldAddTheIdentifierAttributeWhenItExists(): void
    {
        $id = Uuid::uuid4();

        $input = $this->createMock(Input::class);
        $input->method('getData')->willReturn(['testing' => 1]);
        $input->method('getAttribute')->willReturn($id);

        $extractor = new AppendGeneratedIdentifier(new UseInputData());

        self::assertSame(['id' => $id, 'testing' => 1], $extractor->extractData($input));
    }

    /**
     * @test
     *
     * @covers ::__construct
     * @covers ::extractData
     */
    public function extractDataShouldOverrideInputData(): void
    {
        $id = Uuid::uuid4();

        $input = $this->createMock(Input::class);
        $input->method('getData')->willReturn(['testing' => 1, 'id' => '123']);
        $input->method('getAttribute')->willReturn($id);

        $extractor = new AppendGeneratedIdentifier(new UseInputData());

        self::assertSame(['id' => $id, 'testing' => 1], $extractor->extractData($input));
    }

    /**
     * @test
     *
     * @covers ::__construct
     * @covers ::extractData
     */
    public function extractDataShouldReturnTheInputDataWhenIdentifierAttributeDoesNotExist(): void
    {
        $input = $this->createMock(Input::class);
        $input->method('getData')->willReturn(['testing' => 1, 'id' => '123']);
        $input->method('getAttribute')->willReturn(null);

        $extractor = new AppendGeneratedIdentifier(new UseInputData());

        self::assertSame(['testing' => 1, 'id' => '123'], $extractor->extractData($input));
    }
}
