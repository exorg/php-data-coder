<?php

/*
 * This file is part of the DataCoder package.
 *
 * (c) Katarzyna Krasińska <katheroine@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ExOrg\DataCoder\Coder\Data;

use ExOrg\DataCoder\Coder\Data\DecodingStrategyInterface;
use ExOrg\DataCoder\CoderBuilder\CoderBuildingTrait;
use ExOrg\DataCoder\DataFormat\DataFormatConfigurableTrait;

/**
 * DataDecoder.
 * Allows to decode data
 * accordingly the chosen data format.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015-2023 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class Decoder implements DecodingStrategyInterface
{
    use DataFormatConfigurableTrait;
    use CoderBuildingTrait;

    /**
     * Decode data.
     *
     * @param array $data
     * @return array
     */
    public function decodeData($data)
    {
        $dataDecodingStrategy = $this->buildCoder();

        $decodedData = $dataDecodingStrategy->decodeData($data);

        return $decodedData;
    }
}
