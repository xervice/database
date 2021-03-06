<?php
declare(strict_types=1);


namespace Xervice\Database\Business\Model\Config\Converter;


class Json implements ConverterInterface
{
    /**
     * @param array $config
     *
     * @return string|null
     */
    public function convert(array $config) : ?string
    {
        return  json_encode($config, 448) ?: null;
    }
}
