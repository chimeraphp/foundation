<?php
declare(strict_types=1);

namespace Chimera\Tests\MessageCreator;

use Chimera\Input;

use function assert;
use function is_string;

final class DoStuff
{
    /** @param string[] $extra */
    private function __construct(public Input $request, public array $extra)
    {
    }

    public static function fromInput(Input $input): self
    {
        $id = $input->getAttribute('createdId');
        assert(is_string($id) || $id === null);

        $extra = [];

        if ($id !== null) {
            $extra[] = $id;
        }

        return new self($input, $extra);
    }

    public static function aCustomName(Input $input): self
    {
        return new self($input, ['testing']);
    }
}
