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
 * JsonDataParsingStrategy.
 * Data parsing strategy for JSON format.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class JsonDataParsingStrategy implements DataParsingStrategyInterface
{
    /**
     * Parse given JSON data content to the array.
     *
     * @param string $data
     * @return array
     * @throws DataFormatInvalidException
     */
    public function parseData($data)
    {
        $parsedData = json_decode($data, true);

        $parsingSuccessful = !(is_null($parsedData));

        if ($parsingSuccessful) {
            return $parsedData;
        } else {
            $message = 'Invalid JSON data format.';
            $exception = new DataFormatInvalidException($message);

            throw $exception;
        }
    }
}
