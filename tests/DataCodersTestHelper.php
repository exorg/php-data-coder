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
 * DataCodersTestHelper.
 * Helper for test classes for
 * Encoder/Decoder classes.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class DataCodersTestHelper
{
    /**
     * Directory with the files containing data
     * in various formats.
     * They are inputs and the expected results
     * of the encoding/decoding operations.
     */
    const FILES_DIRECTORY = 'data';

    /**
     * Format of the encoded/decoded data.
     *
     * @var string
     */
    protected $dataFormat = null;

    /**
     * Sets data format.
     * Should be lowercase.
     *
     * @param string $dataFormat
     */
    public function setDataFormat($dataFormat)
    {
        $this->dataFormat = $dataFormat;
    }

    /**
     * Returns data format.
     *
     * @return string
     */
    public function getDataFormat()
    {
        return $this->dataFormat;
    }

    /**
     * Loads content of the data file.
     *
     * @param string $filePath
     * @return string
     */
    public function loadFileContent($dataFilePath)
    {
        $fullFilePath = __DIR__
            . DIRECTORY_SEPARATOR
            . self::FILES_DIRECTORY
            . DIRECTORY_SEPARATOR
            . trim($dataFilePath);

        $dataFileContent = file_get_contents($fullFilePath);

        return $dataFileContent;
    }
}
