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
 * DataDecoderTest.
 * PHPUnit test class for DataDecoder class.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class DataDecoderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Instance of tested class.
     *
     * @var DataDecoder
     */
    private $dataDecoder;

    /**
     * Test Exorg\DataCoder\DataDecoder class
     * has been implemented.
     */
    public function testDataDecoderClassExists()
    {
        $this->assertTrue(
            class_exists('Exorg\DataCoder\DataDecoder')
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
                $this->dataDecoder,
                'setDataFormat'
            )
        );
    }

    /**
     * Test setDataFormat($dataFormat) method
     * sets proper decoding strategy.
     *
     * @expectedException \InvalidArgumentException
     */
    public function testSetDataFormatFunctionWithEmptyDataFormat()
    {
        $dataFormat = '';

        $this->dataDecoder->setDataFormat($dataFormat);
    }

    /**
     * Test setDataFormat($dataFormat) method
     * sets proper decoding strategy.
     *
     * @expectedException \InvalidArgumentException
     */
    public function testSetDataFormatFunctionWithNullDataFormat()
    {
        $dataFormat = null;

        $this->dataDecoder->setDataFormat($dataFormat);
    }

    /**
     * Test setDataFormat function sets proper format
     * that allows to build proper Data Decoder.
     *
     * @dataProvider dataFormatsResultsProvider
     */
    public function testSetDataFormat($dataFormat, $expectedResult)
    {
        $this->dataDecoder->setDataFormat($dataFormat);

        $actualResult = $this->dataDecoder->decodeData('');

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * Test if decodeData($data) method
     * has been defined.
     */
    public function testDecodeDataFunctionExists()
    {
        $this->assertTrue(
            method_exists(
                $this->dataDecoder,
                'decodeData'
            )
        );
    }

    /**
     * Test decodeData function returns proper result.
     *
     * @dataProvider dataProvider
     */
    public function testDecodeData($data)
    {
        $this->dataDecoder->setDataFormat('format');

        $expectedResult = "<FORMAT DATA>"
            . $data
            . "</FORMAT DATA>";

        $actualResult = $this->dataDecoder->decodeData($data);

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
            array('format1', '<FORMAT 1 DATA/>'),
            array('format2', '<FORMAT 2 DATA/>'),
            array('format3', '<FORMAT 3 DATA/>'),
        );
    }

    /**
     * Provides data to decode.
     *
     * @return array
     */
    public function dataProvider()
    {
        return array(
            array('apple'),
            array('pear'),
            array('plum'),
        );
    }

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->dataDecoder = new DataDecoder();
    }
}
