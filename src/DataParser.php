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
 * DatafilesParser.
 * Expansible Universal Data and Data Files Parser.
 * Provide parsing strategies for basic format of data files
 * with possibility to extending for another formats.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class DataParser
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
        $parsedData = $this->dataParsingStrategy->parseData($data);

        return $parsedData;
    }
}
