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
 * YamlDataDecoder.
 * Data decoder for YAML format.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class YamlDataDecoder implements DataParsingStrategyInterface
{
    /**
     * Parse given Yaml data content to the array.
     *
     * @param string $data
     * @return array
     * @throws DataFormatInvalidException
     */
    public function parseData($data)
    {
        $this->turnOffErrors();

        $parsedData = yaml_parse($data);

        $parsingSuccessful = ($parsedData !== false);

        if ($parsingSuccessful) {
            return $parsedData;
        } else {
            $message = 'Invalid YAML data format.';
            $exception = new DataFormatInvalidException($message);

            throw $exception;
        }
    }

    /**
     * Turn off errors reporting.
     */
    private function turnOffErrors()
    {
        $emptyFunction = function () {};

        set_error_handler($emptyFunction);

        error_reporting();
    }
}
