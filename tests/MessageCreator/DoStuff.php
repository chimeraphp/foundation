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
     * @var string[]
     */
    public $extra;

    /**
     * @param string[] $extra
     */
    private function __construct(ServerRequestInterface $request, array $extra)
    {
        $this->request = $request;
        $this->extra   = $extra;
    }

    public static function fromRequest(ServerRequestInterface $request): self
    {
        /** @var string|null $id */
        $id    = $request->getAttribute('createdId');
        $extra = [];

        if ($id !== null) {
            $extra[] = $id;
        }

        return new self($request, $extra);
    }

    public static function aCustomName(ServerRequestInterface $request): self
    {
        return new self($request, ['testing']);
    }
}
