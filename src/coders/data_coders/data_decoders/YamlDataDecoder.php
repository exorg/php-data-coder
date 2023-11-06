<?php

/*
 * This file is part of the DataCoder package.
 *
 * (c) Katarzyna Krasińska <katheroine@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ExOrg\DataCoder;

use Symfony\Component\Yaml\Yaml;

/**
 * YamlDataDecoder.
 * Data decoder for YAML format.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015-2023 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class YamlDataDecoder extends AbstractDataDecoder implements DataDecodingStrategyInterface
{
    /**
     * Decode given YAML data to PHP array.
     *
     * @param string $data
     * @return array
     * @throws DataFormatInvalidException
     */
    public function decodeData($data)
    {
        $this->turnOffErrors();

        $this->validateData($data);

        $parsedData = Yaml::parse($data);

        $parsingSuccessful = ($parsedData !== null);

        if ($parsingSuccessful) {
            return $parsedData;
        } else {
            throw new DataFormatInvalidException(
                'Invalid YAML data format.'
            );
        }
    }

    /**
     * Turn off errors reporting.
     */
    private function turnOffErrors()
    {
        $emptyFunction = function () {
        };

        set_error_handler($emptyFunction);

        error_reporting();
    }
}
