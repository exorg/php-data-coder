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

use Exorg\Decapsulator\ObjectDecapsulator;

/**
 * DatafileDecoderTest.
 * PHPUnit test class for DatafileDecoder class.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class DatafileDecoderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Helper for handling data file fixtures.
     *
     * @var DataFileFixturesHelper
     */
    private static $dataFileFixturesHelper = null;

    /**
     * Instance of tested class.
     *
     * @var DatafileDecoder
     */
    private $datafileDecoder;

    /**
     * Test Exorg\DataCoder\DatafileDecoder class
     * has been created.
     */
    public function testDatafileDecoderClassExists()
    {
        $this->assertTrue(
            class_exists('Exorg\DataCoder\DatafileDecoder')
        );
    }

    /**
     * Test if setDataFormat($dataFormat) method
     * has been defined.
     */
    public function testSetDataFormatFunctionExists()
    {
        $this->assertTrue(
            method_exists(
                'Exorg\DataCoder\DatafileDecoder',
                'setDataFormat'
            )
        );
    }

    /**
     * Test setDataFormat function
     * thows exception when dataFormat type is improper.
     *
     * @expectedException \InvalidArgumentException
     */
    public function testSetDataFormatFunctionWithNotStringDataFormat()
    {
        $dataFormat = 1024;

        $this->datafileDecoder->setDataFormat($dataFormat);
    }

    /**
     * Test setDataFormat function
     * thows exception when dataFormat is null.
     *
     * @expectedException \InvalidArgumentException
     */
    public function testSetDataFormatFunctionWithNullDataFormat()
    {
        $dataFormat = null;

        $this->datafileDecoder->setDataFormat($dataFormat);
    }

    /**
     * Test setDataFormat function
     * thows exception when dataFormat is empty string.
     *
     * @expectedException \InvalidArgumentException
     */
    public function testSetDataFormatFunctionWithEmptyDataFormat()
    {
        $dataFormat = '';

        $this->datafileDecoder->setDataFormat($dataFormat);
    }

    /**
     * Test setDataFormat function sets proper format
     * that allows to build proper Data Decoder.
     *
     * @dataProvider dataFormatsAndResultsProvider
     */
    public function testSetDataFormatFunction($dataFormat, $expectedResult)
    {
        $dataFilePath = self::$dataFileFixturesHelper->buildEncodedFilePath('data.format');

        $this->datafileDecoder->setDataFormat($dataFormat);
        $actualResult = $this->datafileDecoder->decodeFile($dataFilePath);

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * Test if decodeFile function
     * has been defined.
     */
    public function testDecodeFileFunctionExists()
    {
        $this->assertTrue(
            method_exists(
                'Exorg\DataCoder\DatafileDecoder',
                'decodeFile'
            )
        );
    }

    /**
     * Test decodeFile function throws exception
     * when file doesn't exist.
     *
     * @expectedException Exorg\DataCoder\FileException
     */
    public function testDecodeFileWhenFileDoesNotExist()
    {
        $dataFilePath = self::$dataFileFixturesHelper->buildEncodedFilePath('noexistent.format');

        $this->datafileDecoder->decodeFile($dataFilePath);
    }

    /**
     * Test decodeFile function throws exception
     * when improper format has been set directly.
     *
     * @expectedException Exorg\DataCoder\CoderClassNotFoundException
     */
    public function testDecodeFileWhenImproperFormatIsSet()
    {
        $dataFilePath = self::$dataFileFixturesHelper->buildEncodedFilePath('data.format');

        $this->datafileDecoder->setDataFormat('nonexistent');
        $this->datafileDecoder->decodeFile($dataFilePath);
    }

    /**
     * Test decodeFile function properly decodes data file
     * when format has been set directly.
     */
    public function testDecodeFileWhenFormatIsSet()
    {
        $expectedResult = array("<FORMAT DECODED DATA>Another dummy data</FORMAT DECODED DATA>");

        $dataFilePath = self::$dataFileFixturesHelper->buildEncodedFilePath('data.anotherformat');

        $this->datafileDecoder->setDataFormat('format');
        $actualResult = $this->datafileDecoder->decodeFile($dataFilePath);

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * Test decodeFile function throws exception
     * when data format hasn't been set
     * and decoder must recognize format by file extension
     * but file has improper extension.
     *
     * @expectedException Exorg\DataCoder\CoderClassNotFoundException
     */
    public function testDecodeFileWhenFormatIsNotSetAndFileHasImproperExtension()
    {
        $dataFilePath = self::$dataFileFixturesHelper->buildEncodedFilePath('data.nonexistentformat');

        $this->datafileDecoder->decodeFile($dataFilePath);
    }

    /**
     * Test decodeFile function throws exception
     * when data format hasn't been set
     * and decoder must recognize format by file extension
     * but file has no extension.
     *
     * @expectedException \LogicException
     */
    public function testDecodeFileWhenFormatIsNotSetAnFileHasNotExtension()
    {
        $dataFilePath = self::$dataFileFixturesHelper->buildEncodedFilePath('data');

        $this->datafileDecoder->decodeFile($dataFilePath);
    }

    /**
     * Test decodeFile function returns proper result
     * when data format hasn't been set
     * and decoder must recognize format by file extension.
     */
    public function testDecodeFileWhenFormatIsNotSet()
    {
        $expectedResult = array("<FORMAT DECODED DATA>Dummy data</FORMAT DECODED DATA>");

        $dataFilePath = self::$dataFileFixturesHelper->buildEncodedFilePath('data.format');

        $actualResult = $this->datafileDecoder->decodeFile($dataFilePath);

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * Provide data formats
     * and expected results returned by proper decoders.
     *
     * @return array
     */
    public function dataFormatsAndResultsProvider()
    {
        return array(
            array('format1', array('<FORMAT 1 DECODED DATA/>')),
            array('Format2', array('<FORMAT 2 DECODED DATA/>')),
            array('format3', array('<FORMAT 3 DECODED DATA/>')),
        );
    }

    /**
     * This method is called before the first test of this test class is run.
     */
    public static function setUpBeforeClass()
    {
        self::$dataFileFixturesHelper = new DataFileFixturesHelper();
    }

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->datafileDecoder = new DatafileDecoder();
    }
}
