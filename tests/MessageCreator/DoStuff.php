<?php
declare(strict_types=1);

namespace Lcobucci\Chimera\Tests\MessageCreator;

use Lcobucci\Chimera\Input;
use function assert;
use function is_string;

final class DoStuff
{
    /**
     * @var Input
     */
    public $request;

    /**
     * @var string[]
     */
    public $extra;

    /**
     * @param string[] $extra
     */
    private function __construct(Input $request, array $extra)
    {
        $this->request = $request;
        $this->extra   = $extra;
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
