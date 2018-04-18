<?php


namespace Xervice\Database\Config\Converter;


class Json implements ConverterInterface
{
    /**
     * @param array $config
     *
     * @return string
     */
    public function convert(array $config) : string
    {
        return json_encode($config, 448);
    }
}