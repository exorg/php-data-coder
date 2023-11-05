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

use PHPUnit\Framework\TestCase;
use Exorg\Decapsulator\ObjectDecapsulator;

/**
 * DataDecoderTest.
 * PHPUnit test class for DataDecoder class.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015-2023 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class DataDecoderTest extends TestCase
{
    /**
     * Instance of tested class.
     *
     * @var DataDecoder
     */
    private $dataDecoder;

    /**
     * Test Exorg\DataCoder\DataDecoder class
     * has been created.
     */
    public function testDataDecoderClassExists()
    {
        $this->assertTrue(
            class_exists('Exorg\DataCoder\DataDecoder')
        );
    }

    /**
     * Test if setDataFormat function
     * has been defined.
     */
    public function testSetDataFormatFunctionExists()
    {
        $this->assertTrue(
            method_exists(
                'Exorg\DataCoder\DataDecoder',
                'setDataFormat'
            )
        );
    }

    /**
     * Test setDataFormat function
     * thows exception when dataFormat type is improper.
     */
    public function testSetDataFormatWithNotStringDataFormat()
    {
        $this->expectException('\InvalidArgumentException');

        $dataFormat = 1024;

        $this->dataDecoder->setDataFormat($dataFormat);
    }

    /**
     * Test setDataFormat function
     * thows exception when dataFormat is null.
     */
    public function testSetDataFormatWithNullDataFormat()
    {
        $this->expectException('\InvalidArgumentException');

        $dataFormat = null;

        $this->dataDecoder->setDataFormat($dataFormat);
    }

    /**
     * Test setDataFormat function
     * thows exception when dataFormat is empty string.
     */
    public function testSetDataFormatWithEmptyDataFormat()
    {
        $this->expectException('\InvalidArgumentException');

        $dataFormat = '';

        $this->dataDecoder->setDataFormat($dataFormat);
    }

    /**
     * Test setDataFormat function sets proper format
     * that allows to build proper Data Decoder.
     *
     * @dataProvider dataFormatsAndResultsProvider
     */
    public function testSetDataFormat($dataFormat, $expectedResult)
    {
        $this->dataDecoder->setDataFormat($dataFormat);

        $actualResult = $this->dataDecoder->decodeData('');

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * Test if decodeData function
     * has been defined.
     */
    public function testDecodeDataFunctionExists()
    {
        $this->assertTrue(
            method_exists(
                'Exorg\DataCoder\DataDecoder',
                'decodeData'
            )
        );
    }

    /**
     * Test decodeData function
     * decodes data properly.
     *
     * @dataProvider dataProvider
     */
    public function testDecodeData($data)
    {
        $this->dataDecoder->setDataFormat('format');

        $expectedResult = array("<FORMAT DECODED DATA>"
            . $data
            . "</FORMAT DECODED DATA>");

        $actualResult = $this->dataDecoder->decodeData($data);

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * Provide data formats
     * and expected results returned by proper decoders.
     *
     * @return array
     */
    public static function dataFormatsAndResultsProvider()
    {
        return array(
            array('format1', array('<FORMAT 1 DECODED DATA/>')),
            array('Format2', array('<FORMAT 2 DECODED DATA/>')),
            array('FORMAT3', array('<FORMAT 3 DECODED DATA/>')),
        );
    }

    /**
     * Provide data to decode.
     *
     * @return array
     */
    public static function dataProvider()
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
    protected function setUp(): void
    {
        $this->dataDecoder = new DataDecoder();
    }
}
