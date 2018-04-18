<?php

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