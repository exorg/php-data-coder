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
 * DataDecodersTest.
 * PHPUnit base test class for
 * Decoder classes.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class DataDecodersTest extends DataCodersTest
{
    /**
     * Directory with the files containing encoded data
     * in various formats.
     *
     * @var string
     */
    const ENCODED_DATA_SUBDIRECTORY = 'encoded';

    /**
     * Directory with the files containing decoded data
     * from various formats.
     *
     * @var string
     */
    const DECODED_DATA_SUBDIRECTORY = 'decoded';

    /**
     * Base of the name (with no extension)
     * of the file with encoded data.
     *
     * @var string
     */
    const ENCODED_DATA_BASE_FILENAME = 'data';

    /**
     * Loads input data to pass
     * to the Decoder class.
     *
     * @return string
     */
    public function loadDataToDecode()
    {
        $fullFilePath = __DIR__
            . DIRECTORY_SEPARATOR
            . self::FILES_DIRECTORY
            . DIRECTORY_SEPARATOR
            . self::ENCODED_DATA_SUBDIRECTORY
            . DIRECTORY_SEPARATOR
            . self::ENCODED_DATA_BASE_FILENAME
            . '.'
            . $this->getDataFormat();

        $data = file_get_contents($fullFilePath);

        return $data;
    }

    /**
     * Returns expected result
     * of the decoding operation.
     *
     * @return array
     */
    public function getExpectedDecodingResult()
    {
        $fullFilePath = __DIR__
            . DIRECTORY_SEPARATOR
            . self::FILES_DIRECTORY
            . DIRECTORY_SEPARATOR
            . self::DECODED_DATA_SUBDIRECTORY
            . DIRECTORY_SEPARATOR
            . $this->getDataFormat()
            . '.php';

        $code = file_get_contents($fullFilePath);

        // Define variable $result
        // and assing to it expected result
        // of decoding operation.
        eval($code);

        return $result;
    }

    /**
     * Test for self function loadDataToDecode.
     */
    public function testSelfLoadDataToDecode()
    {
        $expectedData = (string) microtime();
        $this->writeContentToSelfTestEncodedFile($expectedData);

        $this->setDataFormat('self-test');
        $actualData = $this->loadDataToDecode();

        $this->assertEquals($expectedData, $actualData);
    }

    /**
     * Test for self function loadDataToDecode
     * when improper format data has been set.
     *
     * @expectedException PHPUnit_Framework_Error_Warning
     */
    public function testSelfLoadDataToDecodeWithImproperDataFormat()
    {
        $expectedData = (string) microtime();
        $this->writeContentToSelfTestEncodedFile($expectedData);

        $this->setDataFormat('another');
        $actualData = $this->loadDataToDecode();

        $this->assertNotEquals($expectedData, $actualData);
    }

    /**
     * Test for self function getExpectedDecodingResult.
     */
    public function testSelfGetExpectedDecodingResult()
    {
        $expectedResult = array(
            'value' => (string) microtime(),
        );
        $this->writeResultToSelfTestDecodedFile($expectedResult);

        $this->setDataFormat('self-test');
        $actualResult = $this->getExpectedDecodingResult();

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * Test for self function getExpectedDecodingResult
     * when improper format data has been set.
     *
     * @expectedException PHPUnit_Framework_Error_Warning
     */
    public function testSelfGetExpectedDecodingResultWithImproperDataFormat()
    {
        $expectedResult = array(
            'value' => (string) microtime(),
        );
        $this->writeResultToSelfTestDecodedFile($expectedResult);

        $this->setDataFormat('another');
        $actualResult = $this->getExpectedDecodingResult();

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * Writes content to the special self test file
     * from directory with encoded data.
     *
     * @param string $content
     */
    private function writeContentToSelfTestEncodedFile($content)
    {
        $filePath = __DIR__ . "/data/encoded/data.self-test";
        file_put_contents($filePath, $content);
    }

    /**
     * Writes result to the special self test file
     * from directory with decoded data.
     *
     * @param string $content
     */
    private function writeResultToSelfTestDecodedFile($result)
    {
        $content = "\$result = array(\n";
        foreach ($result as $key => $value) {
            $content .= "    '$key' => '$value',\n";
        }
        $content .= ');';

        $filePath = __DIR__ . "/data/decoded/self-test.php";
        file_put_contents($filePath, $content);
    }
}
