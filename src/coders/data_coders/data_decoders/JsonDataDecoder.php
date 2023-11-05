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
 * JsonDataDecoder.
 * Data decoder for JSON format.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015-2023 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class JsonDataDecoder extends AbstractDataDecoder implements DataDecodingStrategyInterface
{
    /**
     * Decode given JSON data to PHP array.
     *
     * @param string $data
     * @return array
     * @throws DataFormatInvalidException
     */
    public function decodeData($data)
    {
        $this->validateData($data);

        $decodedData = json_decode($data, true);

        $parsingSuccessful = !(is_null($decodedData));

        if ($parsingSuccessful) {
            return $decodedData;
        } else {
            throw new DataFormatInvalidException(
                'Invalid JSON data format.'
            );
        }
    }
}
