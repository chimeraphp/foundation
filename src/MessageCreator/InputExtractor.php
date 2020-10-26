<?php
declare(strict_types=1);

namespace Chimera\MessageCreator;

use Chimera\Input;

interface InputExtractor
{
    /** @return array<string, mixed> */
    public function extractData(Input $input): array;
}
