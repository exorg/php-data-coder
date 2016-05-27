<?php

/*
 * This file is part of the DataCoder package.
 *
 * (c) Katarzyna Krasińska <katheroine@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Exorg\DataCoder;

/**
 * YamlDataEncoder.
 * Data encoder for YAML format.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class YamlDataEncoder extends AbstractDataEncoder implements DataEncodingStrategyInterface
{
    /**
     * Encode given PHP array to YAML data.
     *
     * @param array $data
     * @return string
     * @throws \InvalidArgumentException
     */
    public function encodeData($data)
    {
        $this->validateData($data);

        $encodedData = \yaml_emit($data);

        return $encodedData;
    }
}
