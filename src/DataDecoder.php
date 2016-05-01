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
 * DataDecoder.
 * Expansible Universal Data Decoder.
 * Provide decoding strategies for basic format of data files
 * with possibility to extending for another formats.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class DataDecoder
{
    use DataFormatConfigurableTrait;
    use CoderBuildingTrait;

    /**
     * Data decoding strategy.
     *
     * @var DataDecodingStrategyInterface
     */
    private $dataDecodingStrategy;

    /**
     * Decode data.
     *
     * @param array $data
     * @return array
     */
    public function decodeData($data)
    {
        $this->setUpDataDecodingStrategy();

        $decodedData = $this->dataDecodingStrategy->decodeData($data);

        return $decodedData;
    }

    /**
     * Set-up data decoding strategy.
     *
     * @param DataDecodingStrategyInterface $dataDecodingStrategy
     */
    private function setUpDataDecodingStrategy()
    {
        $this->dataDecodingStrategy = $this->buildCoder();
    }
}
