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

use Exorg\DataCoder\DataFormat;

/**
 * DatafileContentDecoder.
 * Decode file content
 * according to given format.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class DatafileContentDecoder
{
    /**
     * Namespace separator.
     */
    const NAMESPACE_SEPARATOR = "\\";

    /**
     * Parsing strategy full name postfix.
     */
    const STRATEGY_CLASS_NAME_POSTFIX = "DataDecoder";

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
     * Decode file content.
     *
     * @param string $data
     * @return array
     */
    public function decodeData($data)
    {
        $decodingStrategy = $this->buildDecodingStrategy();
        $result = $decodingStrategy->decodeData($data);

        return $result;
    }

    /**
     * Build decoding strategy.
     *
     * @return DataDecodingStrategyInterface
     */
    private function buildDecodingStrategy()
    {
        $decodingStrategyClass = __NAMESPACE__
            . self::NAMESPACE_SEPARATOR
            . ucfirst(strtolower($this->fileFormat))
            . self::STRATEGY_CLASS_NAME_POSTFIX;

        $decodingStrategy = new $decodingStrategyClass();

        return $decodingStrategy;
    }
}
