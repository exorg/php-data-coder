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
     * Instance of tested class.
     *
     * @var DatafileDecoder
     */
    private $datafileDecoder;

    /**
     * Test Exorg\DataCoder\DatafileDecoder class
     * has been implemented.
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
                $this->datafileDecoder,
                'setDataFormat'
            )
        );
    }

    /**
     * Test setDataFormat($dataFormat) method
     * sets proper decoding strategy.
     *
     * @expectedException Exorg\DataCoder\DataFormatInvalidException
     */
    public function testSetDataFormatFunctionWithEmptyDataFormat()
    {
        $dataFormat = '';

        $this->datafileDecoder->setDataFormat($dataFormat);
    }

    /**
     * Test setDataFormat($dataFormat) method
     * sets proper decoding strategy.
     *
     * @expectedException Exorg\DataCoder\DataFormatInvalidException
     */
    public function testSetDataFormatFunctionWithNullDataFormat()
    {
        $dataFormat = null;

        $this->datafileDecoder->setDataFormat($dataFormat);
    }

    /**
     * Test setDataFormat($dataFormat) method
     * sets proper property.
     *
     * @dataProvider dataFormatsResultsProvider
     */
    public function testSetDataFormatFunction($dataFormat, $expectedResult)
    {
        $this->datafileDecoder->setDataFormat($dataFormat);

        $actualResult = $this->datafileDecoder->decodeFile(__DIR__ . '/data/encoded/data.dummy');

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * Test if decodeFile($filePath) method
     * has been defined.
     */
    public function testDecodeFileFunctionExists()
    {
        $this->assertTrue(
            method_exists(
                $this->datafileDecoder,
                'decodeFile'
            )
        );
    }

    /**
     * Test decodeFile method throws exception
     * when improper format has been set directly.
     *
     * @expectedException Exorg\DataCoder\DecoderClassNotFoundException
     */
    public function testDecodeFileWhenImproperFormatIsSet()
    {
        $this->datafileDecoder->setDataFormat('nonexistent');
        $this->datafileDecoder->decodeFile(__DIR__ . '/data/encoded/data.anotherdummy');
    }

    /**
     * Test decodeFile method properly decodes data file
     * when format has been set directly.
     */
    public function testDecodeFileWhenFormatIsSet()
    {
        $expectedResult = "<DUMMY DATA>Another dummy data</DUMMY DATA>";

        $this->datafileDecoder->setDataFormat('dummy');
        $actualResult = $this->datafileDecoder->decodeFile(__DIR__ . '/data/encoded/data.anotherdummy');

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * Test decodeFile function throws exception
     * when data format hasn't been set
     * and decoder must recognize format by file extension
     * but file has improper extension.
     *
     * @expectedException Exorg\DataCoder\DecoderClassNotFoundException
     */
    public function testDecodeFileWhenFormatIsNotSetAndFileHasImproperExtension()
    {
        $this->datafileDecoder->decodeFile(__DIR__ . '/data/encoded/data.nonexistent');
    }

    /**
     * Test decodeFile function returns proper result
     * when data format hasn't been set
     * and decoder must recognize format by file extension.
     */
    public function testDecodeFileWhenFormatIsNotSet()
    {
        $expectedResult = "<DUMMY DATA>Dummy data</DUMMY DATA>";

        $actualResult = $this->datafileDecoder->decodeFile(__DIR__ . '/data/encoded/data.dummy');

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * Provides data formats
     * and expected results returned by proper decoders.
     *
     * @return array
     */
    public function dataFormatsResultsProvider()
    {
        return array(
            array('dummy1', '<DUMMY 1 DATA/>'),
            array('dummy2', '<DUMMY 2 DATA/>'),
            array('dummy3', '<DUMMY 3 DATA/>'),
        );
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
