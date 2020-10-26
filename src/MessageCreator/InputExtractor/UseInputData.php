<?php
declare(strict_types=1);

namespace Chimera\MessageCreator\InputExtractor;

use Chimera\Input;
use Chimera\MessageCreator\InputExtractor;

final class UseInputData implements InputExtractor
{
    /** @inheritdoc */
    public function extractData(Input $input): array
    {
        return $input->getData();
    }
}
