<?php

declare(strict_types=1);

/*
 * This file is part of the DataCoder package.
 *
 * (c) Katarzyna Krasińska <katheroine@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ExOrg\DataCoder\Coder\Yaml\Data;

use ExOrg\DataCoder\Coder\Data\DecodingStrategyInterface;
use ExOrg\DataCoder\DataFormat\DataFormatInvalidException;
use Symfony\Component\Yaml\Yaml;

/**
 * Yaml Data Decoder.
 * Data decoder for YAML format.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015-2023 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class Decoder implements DecodingStrategyInterface
{
    /**
     * Decode given YAML data to PHP array.
     *
     * @param string $data
     *
     * @return array
     *
     * @throws DataFormatInvalidException
     */
    public function decodeData(string $data): array
    {
        $this->turnOffErrors();

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
     *
     * @return void
     */
    private function turnOffErrors(): void
    {
        $emptyFunction = function () {
        };

        set_error_handler($emptyFunction);

        error_reporting();
    }
}
