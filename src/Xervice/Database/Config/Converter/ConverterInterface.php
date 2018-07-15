<?php
declare(strict_types=1);

namespace Xervice\Database\Config\Converter;

interface ConverterInterface
{
    /**
     * @param array $config
     *
     * @return string
     */
    public function convert(array $config): string;
}
