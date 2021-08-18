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
 * @copyright 2015-2021 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class JsonDataEncoder extends AbstractDataEncoder implements DataEncodingStrategyInterface
{
    /**
     * Encode given PHP array to JSON data.
     *
     * @param array $data
     * @return string
     * @throws \InvalidArgumentException
     */
    public function encodeData($data)
    {
        $dataTypeIsCorrect = is_array($data);

        $this->validateData($data);

        $encodedData = json_encode($data, JSON_PRETTY_PRINT);

        return $encodedData;
    }
}
