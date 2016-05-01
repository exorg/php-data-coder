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
class YamlDataEncoder implements DataEncodingStrategyInterface
{
    /**
     * Encode given PHP array YAML data.
     *
     * @param array $data
     * @return string
     * @throws \InvalidArgumentException
     */
    public function encodeData($data)
    {
        $dataTypeIsCorrect = is_array($data);

        if (!$dataTypeIsCorrect) {
            throw new \InvalidArgumentException(
                'Invalid type of data.
                 It must be either an array or object od stdClass'
            );
        }

        $encodedData = yaml_emit($data);

        return $encodedData;
    }
}
