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
    const FILES_DIRECTORY = '../data';

    /**
     * Directory with the files containing encoded data
     * in various formats.
     */
    const ENCODED_DATA_SUBDIRECTORY = 'encoded';

    /**
     * Directory with the files containing decoded data
     * from various formats.
     */
    const DECODED_DATA_SUBDIRECTORY = 'decoded';

    /**
     * Base of the name (with no extension)
     * of the file with encoded data.
     */
    const ENCODED_DATA_BASE_FILENAME = 'data';

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
    protected function getDataFormat()
    {
        return $this->dataFormat;
    }

    /**
     * Loads content of the data file.
     *
     * @param string $filePath
     * @return string
     * @throws UnexpectedValueException
     */
    protected function loadFileContent($partialFilePath)
    {
        $fullFilePath = $this->buildFullPathFromPartialFilePath($partialFilePath);

        $this->validateFilePath($fullFilePath);

        $dataFileContent = file_get_contents($fullFilePath);

        return $dataFileContent;
    }

    /**
     * Validate existance and avability
     * of the file defined by absolute path.
     *
     * @param string $filePath
     * @throws UnexpectedValueException
     */
    private function validateFilePath($filePath)
    {
        $fileIsAvailable = file_exists($filePath)
            && is_readable($filePath);

        if (!$fileIsAvailable) {
            throw new \UnexpectedValueException(
                "File "
                . $filePath
                . " doesn't exist or is not readable."
            );
        }
    }

    /**
     * Builds full absolute file path
     * from partial relative file path.
     *
     * @param string $partialFilePath
     * @return string
     */
    private function buildFullPathFromPartialFilePath($partialFilePath)
    {
        $fullFilePath = __DIR__
            . DIRECTORY_SEPARATOR
            . self::FILES_DIRECTORY
            . DIRECTORY_SEPARATOR
            . trim($partialFilePath);

        return $fullFilePath;
    }
}
