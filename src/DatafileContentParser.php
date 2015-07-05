<?php

/*
 * This file is part of the DatafilesParser package.
 *
 * (c) Katarzyna Krasińska <katheroine@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Exorg\DatafilesParser;

/**
 * DatafileContentParser.
 * Parse file content
 * according to given format.
 *
 * @package DatafilesParser
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-datafiles-parser
 */
class DatafileContentParser
{
    /**
     * Namespace separator.
     */
    const NAMESPACE_SEPARATOR = "\\";

    /**
     * Parsing strategy full name postfix.
     */
    const STRATEGY_CLASS_NAME_POSTFIX = "DataParsingStrategy";

    /**
     * Parsed file format.
     *
     * @var string
     */
    private $fileFormat = null;

    /**
     * Construct parser instance and set-up parsed file format.
     *
     * @param string $fileFormat
     */
    public function __construct($fileFormat)
    {
        $this->fileFormat = $fileFormat;
    }

    /**
     * Parse file content.
     *
     * @param string $data
     * @return array
     */
    public function parseData($data)
    {
        $parsingStrategy = $this->buildParsingStrategy();
        $result = $this->parseDataWithParsingStrategy($data, $parsingStrategy);

        return $result;
    }

    /**
     * Build parsing strategy.
     *
     * @return DataParsingStrategy
     */
    private function buildParsingStrategy()
    {
        $parsingStrategyClass = __NAMESPACE__
            . self::NAMESPACE_SEPARATOR
            . ucfirst(strtolower($this->fileFormat))
            . self::STRATEGY_CLASS_NAME_POSTFIX;

        $parsingStrategy = new $parsingStrategyClass();

        return $parsingStrategy;
    }

    /**
     * Parse file content with chosen parsing strategy.
     *
     * @param string $data
     * @param DataParsingStrategy $parsingStrategy
     * @return array
     */
    private function parseDataWithParsingStrategy($data, $parsingStrategy)
    {
        $dataParser = new DataParser();
        $dataParser->setDataParsingStrategy($parsingStrategy);
        $result = $dataParser->parseData($data);

        return $result;
    }
}
