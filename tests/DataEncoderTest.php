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
 * DataEncoderTest.
 * PHPUnit test class for DataEncoder class.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class DataEncoderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Instance of tested class.
     *
     * @var DataEncoder
     */
    private $dataEncoder;

    /**
     * Test Exorg\DataCoder\DataEncoder class
     * has been implemented.
     */
    public function testDataEncoderClassExists()
    {
        $this->assertTrue(
            class_exists('Exorg\DataCoder\DataEncoder')
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
                $this->dataEncoder,
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

        $this->dataEncoder->setDataFormat($dataFormat);
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

        $this->dataEncoder->setDataFormat($dataFormat);
    }

    /**
     * Test setDataFormat function sets proper format
     * that allows to build proper Data Encoder.
     *
     * @dataProvider dataFormatsResultsProvider
     */
    public function testSetDataFormat($dataFormat, $expectedResult)
    {
        $this->dataEncoder->setDataFormat($dataFormat);

        $actualResult = $this->dataEncoder->encodeData('');

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * Test if encodeData($data) method
     * has been defined.
     */
    public function testEncodeDataFunctionExists()
    {
        $this->assertTrue(
            method_exists(
                $this->dataEncoder,
                'encodeData'
            )
        );
    }

    /**
     * Test encodeData function returns proper result.
     *
     * @dataProvider dataProvider
     */
    public function testEncodeData($data)
    {
        $this->dataEncoder->setDataFormat('format');

        $expectedResult = "<FORMAT ENCODED DATA>"
            . $data
            . "</FORMAT ENCODED DATA>";

        $actualResult = $this->dataEncoder->encodeData($data);

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * Provides data formats
     * and expected results returned by proper encoders.
     *
     * @return array
     */
    public function dataFormatsResultsProvider()
    {
        return array(
            array('format1', '<FORMAT 1 ENCODED DATA/>'),
            array('format2', '<FORMAT 2 ENCODED DATA/>'),
            array('format3', '<FORMAT 3 ENCODED DATA/>'),
        );
    }

    /**
     * Provides data to encode.
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
        $this->dataEncoder = new DataEncoder();
    }
}
