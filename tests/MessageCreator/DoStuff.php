<?php
declare(strict_types=1);

namespace Lcobucci\Chimera\Tests\MessageCreator;

use Psr\Http\Message\ServerRequestInterface;

final class DoStuff
{
    /**
     * @var ServerRequestInterface
     */
    public $request;

    /**
     * @var array
     */
    public $extra;

    private function __construct(ServerRequestInterface $request, array $extra)
    {
        $this->request = $request;
        $this->extra   = $extra;
    }

    public static function fromRequest(ServerRequestInterface $request, ...$extra): self
    {
        return new self($request, $extra);
    }

    public static function aCustomName(ServerRequestInterface $request, ...$extra): self
    {
        array_unshift($extra, 'testing');

        return new self($request, $extra);
    }
}
