<?php

/*
 * This file is part of the DataCoder package.
 *
 * (c) Katarzyna Krasińska <katheroine@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ExOrg\DataCoder\Coder\Data;

use ExOrg\Decapsulator\ObjectDecapsulator;
use PHPUnit\Framework\TestCase;

/**
 * DataEncoderTest.
 * PHPUnit test class for DataEncoder class.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015-2023 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class EncoderTest extends TestCase
{
    const ENCODER_FULLY_QUALIFIED_CLASS_NAME = 'ExOrg\DataCoder\Coder\Data\Encoder';

    /**
     * Instance of tested class.
     *
     * @var DataEncoder
     */
    private $dataEncoder;

    /**
     * Test ExOrg\DataCoder\DataEncoder class
     * has been created.
     */
    public function testDataEncoderClassExists()
    {
        $this->assertTrue(
            class_exists(self::ENCODER_FULLY_QUALIFIED_CLASS_NAME)
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
                self::ENCODER_FULLY_QUALIFIED_CLASS_NAME,
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

        $this->dataEncoder->setDataFormat($dataFormat);
    }

    /**
     * Test setDataFormat function
     * thows exception when dataFormat is null.
     */
    public function testSetDataFormatWithNullDataFormat()
    {
        $this->expectException('\InvalidArgumentException');

        $dataFormat = null;

        $this->dataEncoder->setDataFormat($dataFormat);
    }

    /**
     * Test setDataFormat function
     * thows exception when dataFormat is empty string.
     */
    public function testSetDataFormatWithEmptyDataFormat()
    {
        $this->expectException('\InvalidArgumentException');

        $dataFormat = '';

        $this->dataEncoder->setDataFormat($dataFormat);
    }

    /**
     * Test setDataFormat function sets proper format
     * that allows to build proper Data Encoder.
     *
     * @dataProvider dataFormatsAndResultsProvider
     */
    public function testSetDataFormat($dataFormat, $expectedResult)
    {
        $this->dataEncoder->setDataFormat($dataFormat);

        $actualResult = $this->dataEncoder->encodeData('');

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * Test if encodeData function
     * has been defined.
     */
    public function testEncodeDataFunctionExists()
    {
        $this->assertTrue(
            method_exists(
                self::ENCODER_FULLY_QUALIFIED_CLASS_NAME,
                'encodeData'
            )
        );
    }

    /**
     * Test encodeData function
     * encodes data properly.
     *
     * @param array $data
     * @dataProvider dataProvider
     */
    public function testEncodeData($data)
    {
        $this->dataEncoder->setDataFormat('format');

        $dataValues = array_values($data);
        $dataCore = array_shift($dataValues);

        $expectedResult = "<FORMAT ENCODED DATA>"
            . $dataCore
            . "</FORMAT ENCODED DATA>";

        $actualResult = $this->dataEncoder->encodeData($data, 'file');

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * Provide data formats
     * and expected results returned by proper encoders.
     *
     * @return array
     */
    public static function dataFormatsAndResultsProvider()
    {
        return array(
            array('format1', '<FORMAT 1 ENCODED DATA/>'),
            array('Format2', '<FORMAT 2 ENCODED DATA/>'),
            array('FORMAT3', '<FORMAT 3 ENCODED DATA/>'),
        );
    }

    /**
     * Provide data to encode.
     *
     * @return array
     */
    public static function dataProvider()
    {
        return array(
            array(array('apple')),
            array(array('pear')),
            array(array('plum')),
        );
    }

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $this->dataEncoder = new Encoder();
    }
}
