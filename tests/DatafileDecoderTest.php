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
     * Test decodeFile function returns proper result.
     */
    public function testDecodeFile()
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
