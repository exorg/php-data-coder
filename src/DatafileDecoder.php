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
 * DatafileDecoder.
 * Decode data file content
 *
 * according to given format.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class DatafileDecoder
{
    use DecodingDataFormatBasedTrait;

    /**
     * Decoded data format.
     *
     * @var string
     */
    private $dataFormat;

    /**
     * Parsed file info.
     *
     * @var \SplFileInfo
     */
    protected $fileInfo;

    /**
     * Set format of decoded data.
     *
     * @param string $dataFormat
     */
    public function setDataFormat($dataFormat)
    {
        $this->validateDataFormat($dataFormat);
        $this->dataFormat = $dataFormat;
    }

    /**
     * Decode file content according to file type.
     *
     * @param string $filePath
     * @return array
     */
    public function decodeFile($filePath)
    {
        if (!file_exists($filePath)) {
            throw new NonexistentFileException(
                'File '
                . $filePath
                . ' does not exist.'
            );
        }

        $this->setUpFileInfo($filePath);
        $fileFormat = $this->establishDataFormat();
        $fileData = $this->getDataFileContent();

        $dataDecoder = $this->buildDecoderForDataFormat($fileFormat);
        $result = $dataDecoder->decodeData($fileData);

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
     * Establish the dataFormat
     * retrieving it from the proper source.
     *
     * @retun string
     */
    private function establishDataFormat()
    {
        $dataFormatIsSetDirectly = isset($this->dataFormat);

        if ($dataFormatIsSetDirectly) {
            $dataFormat = $this->dataFormat;
        } else {
            $dataFormat = $this->fileInfo->getExtension();
        }

        return $dataFormat;
    }

    /**
     * Validate data format.
     *
     * @param unknown $dataFormat
     * @throws DataFormatInvalidException
     */
    public function validateDataFormat($dataFormat)
    {
        $dataFormatIsValid = (!is_null($dataFormat))
            && (!empty($dataFormat));

        if (!$dataFormatIsValid) {
            throw new DataFormatInvalidException(
                'Data format '
                . $dataFormat
                . ' is invalid'
            );
        }
    }
}
