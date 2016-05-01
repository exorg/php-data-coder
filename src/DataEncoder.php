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
 * DataEncoder.
 * Expansible Universal Data Encoder.
 * Provide decoding strategies for basic format of data files
 * with possibility to extending for another formats.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class DataEncoder
{
    use DataFormatConfigurableTrait;
    use CoderBuildingTrait;

    /**
     * Data encoding strategy.
     *
     * @var DataEncodingStrategyInterface
     */
    private $dataEncodingStrategy;

    /**
     * Encode data.
     *
     * @param array $data
     * @return array
     */
    public function encodeData($data)
    {
        $this->setUpDataEncodingStrategy();

        $encodedData = $this->dataEncodingStrategy->encodeData($data);

        return $encodedData;
    }

    /**
     * Set-up data decoding strategy.
     *
     * @param DataEncodingStrategyInterface $dataEncodingStrategy
     */
    private function setUpDataEncodingStrategy()
    {
        $this->dataEncodingStrategy = $this->buildCoder();
    }
}
