<?php

/*
 * This file is part of the DatafilesParser package.
 *
 * (c) Katarzyna Krasińska <katheroine@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Exorg\DatafilesParser;

use Exorg\DatafilesParser\DataFormatInvalidException;

/**
 * JsonDataParsingStrategy.
 * Data parsing strategy for JSON format.
 *
 * @package DatafilesParser
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-datafiles-parser
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
