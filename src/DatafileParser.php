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
 * DatafileParser.
 * Parse data file content
 *
 * according to given format.
 *
 * @package DatafilesParser
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-datafiles-parser
 */
class DatafileParser
{
    /**
     * Parsed file info.
     *
     * @var \SplFileInfo
     */
    protected $fileInfo;

    /**
     * Parse file content according to file type.
     *
     * @param string $filePath
     * @return array
     */
    public function parseFile($filePath)
    {
        $this->setUpFileInfo($filePath);
        $fileFormat = $this->getDataFileFormat();
        $fileData = $this->getDataFileContent();

        $datafileContentParser = new DatafileContentParser($fileFormat);
        $result = $datafileContentParser->parseData($fileData);

        return $result;
    }

    /**
     * Set-up file info.
     *
     * @param string $filePath
     */
    private function setUpFileInfo($filePath)
    {
        $this->fileInfo = new \SplFileInfo($filePath);
    }

    /**
     * Read file and get content.
     *
     * @throws FileReadingErrorException
     */
    private function getDataFileContent()
    {
        $fileObject = $this->fileInfo->openFile();
        $dataFileContent = '';

        while (!$fileObject->eof()) {
            $dataFileContent .= $fileObject->fgetc();
        }

        return $dataFileContent;
    }

    /**
     * Extract file format.
     *
     * @return string
     */
    private function getDataFileFormat()
    {
        $fileFormat = $fileObject = $this->fileInfo->getExtension();

        return $fileFormat;
    }
}
