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

use Symfony\Component\Yaml\Yaml;

/**
 * YamlDataEncoder.
 * Data encoder for YAML format.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright 2015-2023 Katarzyna Krasińska
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

        $encodedData = Yaml::dump($data);

        return $encodedData;
    }
}
