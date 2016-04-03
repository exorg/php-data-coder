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
 * DataCodersTest.
 * PHPUnit base test class for
 * Encoder/Decoder classes.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class DataCodersTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Directory with the files containing data
     * in various formats.
     * They are inputs and the expected results
     * of the encoding/decoding operations.
     *
     * @var string
     */
    const FILES_DIRECTORY = 'data';

    /**
     * Format of the encoded/decoded data.
     *
     * @var string
     */
    private $dataFormat = null;

    /**
     * Sets data format.
     * Should be lowercase.
     *
     * @param string $dataFormat
     */
    protected function setDataFormat($dataFormat)
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
     */
    protected function loadFileContent($dataFilePath)
    {
        $fullFilePath = __DIR__
            . DIRECTORY_SEPARATOR
            . self::FILES_DIRECTORY
            . DIRECTORY_SEPARATOR
            . trim($dataFilePath);

        $dataFileContent = file_get_contents($fullFilePath);

        return $dataFileContent;
    }

    /**
     * Test for self function setDataFormat.
     *
     * @dataProvider dataFormatsProvider
     * @param string $expectedDataFormat
     */
    public function testSelfSetDataFormat($expectedDataFormat)
    {
        $this->setDataFormat($expectedDataFormat);

        $actualDataFormat = $this->dataFormat;
        $this->assertEquals($expectedDataFormat, $actualDataFormat);
    }

    /**
     * Test for self function getDataFormat.
     *
     * @dataProvider dataFormatsProvider
     * @param string $expectedDataFormat
     */
    public function testSelfGetDataFormat($expectedDataFormat)
    {
        $this->dataFormat = $expectedDataFormat;

        $actualDataFormat = $this->getDataFormat();
        $this->assertEquals($expectedDataFormat, $actualDataFormat);
    }

    /**
     * Test for self function loadFileContent.
     */
    public function testSelfLoadFileContent()
    {
        $expectedFileContent = (string) microtime();
        $this->writeContentToSelfTestFile($expectedFileContent);

        $actualFileContent = $this->loadFileContent('self-test');

        $this->assertEquals($expectedFileContent, $actualFileContent);
    }

    /**
     * Data formats examples provider.
     *
     * @return array
     */
    public function dataFormatsProvider()
    {
        return array(
            array('format'),
            array('another-format'),
        );
    }

    /**
     * Writes content to the special self test file.
     *
     * @param string $content
     */
    private function writeContentToSelfTestFile($content)
    {
        $filePath = __DIR__ . "/data/self-test";
        $file = fopen($filePath, "w") or $this->fail("Unable to open file data/self-test");
        fwrite($file, $content);
        fclose($file);
    }
}
