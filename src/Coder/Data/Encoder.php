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

namespace ExOrg\DataCoder\Coder\Data;

use ExOrg\DataCoder\Coder\Data\EncodingStrategyInterface;
use ExOrg\DataCoder\CoderBuilder\CoderBuildingTrait;
use ExOrg\DataCoder\DataFormat\DataFormatConfigurableTrait;

/**
 * Data Encoder.
 * Allows to encode data
 * accordingly the chosen data format.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015-2023 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class Encoder implements EncodingStrategyInterface
{
    use DataFormatConfigurableTrait;
    use CoderBuildingTrait;

    /**
     * Encode data.
     *
     * @param array $data
     *
     * @return string
     */
    public function encodeData(array $data): string
    {
        $dataEncodingStrategy = $this->buildCoder();

        $encodedData = $dataEncodingStrategy->encodeData($data);

        return $encodedData;
    }
}
