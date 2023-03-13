<?php
declare(strict_types=1);

namespace Chimera\Tests\MessageCreator\InputExtractor;

use Chimera\Input;
use Chimera\MessageCreator\InputExtractor\AppendGeneratedIdentifier;
use Chimera\MessageCreator\InputExtractor\UseInputData;
use PHPUnit\Framework\Attributes as PHPUnit;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

#[PHPUnit\CoversClass(AppendGeneratedIdentifier::class)]
#[PHPUnit\UsesClass(UseInputData::class)]
final class AppendGeneratedIdentifierTest extends TestCase
{
    #[PHPUnit\Test]
    public function extractDataShouldAddTheIdentifierAttributeWhenItExists(): void
    {
        $id = Uuid::uuid4();

        $input = $this->createMock(Input::class);
        $input->method('getData')->willReturn(['testing' => 1]);
        $input->method('getAttribute')->willReturn($id);

        $extractor = new AppendGeneratedIdentifier(new UseInputData());

        self::assertSame(['id' => $id, 'testing' => 1], $extractor->extractData($input));
    }

    #[PHPUnit\Test]
    public function extractDataShouldOverrideInputData(): void
    {
        $id = Uuid::uuid4();

        $input = $this->createMock(Input::class);
        $input->method('getData')->willReturn(['testing' => 1, 'id' => '123']);
        $input->method('getAttribute')->willReturn($id);

        $extractor = new AppendGeneratedIdentifier(new UseInputData());

        self::assertSame(['id' => $id, 'testing' => 1], $extractor->extractData($input));
    }

    #[PHPUnit\Test]
    public function extractDataShouldReturnTheInputDataWhenIdentifierAttributeDoesNotExist(): void
    {
        $input = $this->createMock(Input::class);
        $input->method('getData')->willReturn(['testing' => 1, 'id' => '123']);
        $input->method('getAttribute')->willReturn(null);

        $extractor = new AppendGeneratedIdentifier(new UseInputData());

        self::assertSame(['testing' => 1, 'id' => '123'], $extractor->extractData($input));
    }
}
