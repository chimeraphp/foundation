<?php
declare(strict_types=1);

namespace Chimera\MessageCreator\InputExtractor;

use Chimera\IdentifierGenerator;
use Chimera\Input;
use Chimera\MessageCreator\InputExtractor;

final class AppendGeneratedIdentifier implements InputExtractor
{
    private const DEFAULT_NAME = 'id';

    public function __construct(
        private readonly InputExtractor $decorated,
        private readonly string $attributeName = self::DEFAULT_NAME,
    ) {
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
