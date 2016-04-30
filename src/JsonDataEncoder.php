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
 * JsonDataEncoder.
 * Data encoder for JSON format.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class JsonDataEncoder implements DataEncodingStrategyInterface
{
    /**
     * Decode given JSON data to PHP array.
     *
     * @param string $data
     * @return array
     * @throws \InvalidArgumentException
     */
    public function encodeData($data)
    {
        $dataTypeIsCorrect = is_array($data)
            || ($data instanceof \stdClass);

        if (!$dataTypeIsCorrect) {
            throw new \InvalidArgumentException(
                'Invalid type of data.
                 It must be either an array or object od stdClass'
            );
        }

        $encodedData = json_encode($data, JSON_PRETTY_PRINT);

        return $encodedData;
    }
}
