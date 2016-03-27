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
 * Provide parsing strategies for basic format of data files
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
    /**
     * Data parsing strategy.
     *
     * @var DataParsingStrategyInterface
     */
    private $dataParsingStrategy;

    /**
     * Set data parsing strategy.
     *
     * @param DataParsingStrategyInterface $dataParsingStrategy
     */
    public function setDataParsingStrategy(DataParsingStrategyInterface $dataParsingStrategy)
    {
        $this->dataParsingStrategy = $dataParsingStrategy;
    }

    /**
     * Parse data.
     *
     * @param array $data
     * @return array
     */
    public function parseData($data)
    {
        $parsedData = $this->dataParsingStrategy->decodeData($data);

        return $parsedData;
    }
}
