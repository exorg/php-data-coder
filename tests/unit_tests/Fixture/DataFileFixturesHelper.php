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

namespace ExOrg\DataCoder\Fixture;

/**
 * Data File Fixtures Helper.
 * Helps to handle data file fixtures.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015-2023 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class DataFileFixturesHelper
{
    /**
     * Directory with the files containing data
     * in various formats.
     * They are inputs and the expected results
     * of the encoding/decoding operations.
     */
    const FILES_DIRECTORY = '../../fixtures/data';

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
     * Directory where data files are saved.
     */
    const CREATED_DATA_SUBDIRECTORY = 'created';

    /**
     * Base of the name (with no extension)
     * of the file with encoded data.
     */
    const ENCODED_DATA_FILENAME_BASE = 'data';

    /**
     * Format of the encoded/decoded data.
     * Must be lowercase.
     *
     * @var string
     */
    protected string $dataFormat;

    /**
     * Set data format.
     *
     * @param string $dataFormat
     *
     * @return void
     */
    public function setDataFormat(string $dataFormat): void
    {
        $this->dataFormat = strtolower($dataFormat);
    }

    /**
     * Load encoded data
     * from the data file.
     *
     * @return string
     */
    public function loadEncodedData(): string
    {
        $fileName = self::ENCODED_DATA_FILENAME_BASE
            . '.'
            . $this->dataFormat;

        $dataFilePath = $this->buildEncodedFilePath($fileName);

        $data = $this->loadFileContent($dataFilePath);

        return $data;
    }

    /**
     * Load decoded data
     * form the code snippet file.
     *
     * @return array
     */
    public function loadDecodedData(): array
    {
        $fileName = $this->dataFormat . '.php';

        $codeFilePath = $this->buildDecodedFilePath($fileName);

        $resultCode = $this->loadFileContent($codeFilePath);

        // Define variable $result
        // and assing to it expected result
        // of decoding operation.
        eval($resultCode);

        return $result;
    }

    /**
     * Build path to the encoded data file.
     *
     * @param string $fileName
     *
     * @return string
     */
    public function buildEncodedFilePath(string $fileName): string
    {
        $partialDataFilePath = self::ENCODED_DATA_SUBDIRECTORY
            . DIRECTORY_SEPARATOR
            . $fileName;

        $fullDataFilePath = $this->buildFullPathFromPartialFilePath($partialDataFilePath);

        return $fullDataFilePath;
    }

    /**
     * Build path to the decoded data file.
     *
     * @param string $fileName
     *
     * @return string
     */
    public function buildDecodedFilePath(string $fileName): string
    {
        $partialDataFilePath = self::DECODED_DATA_SUBDIRECTORY
            . DIRECTORY_SEPARATOR
            . $fileName;

        $fullDataFilePath = $this->buildFullPathFromPartialFilePath($partialDataFilePath);

        return $fullDataFilePath;
    }

    /**
     * Build path to the created data file.
     *
     * @param string $fileName
     *
     * @return string
     */
    public function buildCreatedFilePath(string $fileName): string
    {
        $partialDataFilePath = self::CREATED_DATA_SUBDIRECTORY
            . DIRECTORY_SEPARATOR
            . $fileName;

        $fullDataFilePath = $this->buildFullPathFromPartialFilePath($partialDataFilePath);

        return $fullDataFilePath;
    }

    /**
     * Load content of the data file.
     *
     * @param string $filePath
     *
     * @return string
     *
     * @throws \UnexpectedValueException
     */
    private function loadFileContent(string $filePath): string
    {
        $this->validateFilePath($filePath);

        $dataFileContent = file_get_contents($filePath);

        return $dataFileContent;
    }

    /**
     * Validate existance and avability
     * of the file defined by absolute path.
     *
     * @param string $filePath
     *
     * @return void
     *
     * @throws \UnexpectedValueException
     */
    private function validateFilePath(string $filePath): void
    {
        $fileIsAvailable = file_exists($filePath)
            && is_readable($filePath);

        if (!$fileIsAvailable) {
            throw new \UnexpectedValueException(
                "File {$filePath} doesn't exist or is not readable."
            );
        }
    }

    /**
     * Build full absolute file path
     * from partial relative file path.
     *
     * @param string $partialFilePath
     *
     * @return string
     */
    private function buildFullPathFromPartialFilePath(string $partialFilePath): string
    {
        $fullUncanonizedDirectoryPath = __DIR__
            . DIRECTORY_SEPARATOR
            . self::FILES_DIRECTORY;

        $fullDirectoryPath = realpath($fullUncanonizedDirectoryPath);

        $fullFilePath = $fullDirectoryPath
            . DIRECTORY_SEPARATOR
            . trim($partialFilePath);

        return $fullFilePath;
    }
}
