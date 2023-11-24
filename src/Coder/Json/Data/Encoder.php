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

namespace ExOrg\DataCoder\Coder\Json\Data;

use ExOrg\DataCoder\Coder\Data\AbstractEncoder;
use ExOrg\DataCoder\Coder\Data\EncodingStrategyInterface;

/**
 * Json Data Encoder.
 * Data encoder for JSON format.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015-2023 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class Encoder extends AbstractEncoder implements EncodingStrategyInterface
{
    /**
     * Encode given PHP array to JSON data.
     *
     * @param array $data
     *
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    public function encodeData(array $data): string
    {
        $dataTypeIsCorrect = is_array($data);

        $this->validateData($data);

        $encodedData = json_encode($data, JSON_PRETTY_PRINT);

        return $encodedData;
    }
}
