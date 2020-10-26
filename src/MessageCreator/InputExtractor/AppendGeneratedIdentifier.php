<?php
declare(strict_types=1);

namespace Chimera\MessageCreator\InputExtractor;

use Chimera\IdentifierGenerator;
use Chimera\Input;
use Chimera\MessageCreator\InputExtractor;

final class AppendGeneratedIdentifier implements InputExtractor
{
    private const DEFAULT_NAME = 'id';

    private InputExtractor $decorated;
    private string $attributeName;

    public function __construct(InputExtractor $decorated, string $attributeName = self::DEFAULT_NAME)
    {
        $this->decorated     = $decorated;
        $this->attributeName = $attributeName;
    }

    /** @inheritdoc */
    public function extractData(Input $input): array
    {
        $id   = $input->getAttribute(IdentifierGenerator::class);
        $data = $this->decorated->extractData($input);

        if ($id === null) {
            return $data;
        }

        return [$this->attributeName => $id] + $data;
    }
}
