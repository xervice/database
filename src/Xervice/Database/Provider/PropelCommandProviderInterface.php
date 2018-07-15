<?php
declare(strict_types=1);

namespace Xervice\Database\Provider;

interface PropelCommandProviderInterface
{
    /**
     * @param string $command
     *
     * @return array
     * @throws \Symfony\Component\Process\Exception\RuntimeException
     */
    public function execute(string $command): array;
}
