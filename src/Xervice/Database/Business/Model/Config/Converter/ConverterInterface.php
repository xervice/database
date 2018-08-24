<?php
declare(strict_types=1);

namespace Xervice\Database\Business\Model\Config\Converter;

interface ConverterInterface
{
    /**
     * @param array $config
     *
     * @return string|null
     */
    public function convert(array $config) : ?string;
}
