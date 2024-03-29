<?php

declare(strict_types=1);

/*
 * This file is part of the DataCoder package.
 *
 * (c) Katarzyna Krasińska <katheroine@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ExOrg\DataCoder\Coder\Data;

use PHPUnit\Framework\TestCase;

/**
 * Data Decoder Test.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015-2023 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class DecoderTest extends TestCase
{
    const DECODER_FULLY_QUALIFIED_CLASS_NAME = 'ExOrg\DataCoder\Coder\Data\Decoder';

    /**
     * Instance of tested class.
     *
     * @var DataDecoder
     */
    private Decoder $dataDecoder;

    /**
     * Test Data Decoder class
     * has been created.
     */
    public function testDataDecoderClassExists()
    {
        $this->assertTrue(
            class_exists(self::DECODER_FULLY_QUALIFIED_CLASS_NAME)
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
                self::DECODER_FULLY_QUALIFIED_CLASS_NAME,
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
        $this->expectException('\TypeError');

        $dataFormat = 1024;

        $this->dataDecoder->setDataFormat($dataFormat);
    }

    /**
     * Test setDataFormat function
     * thows exception when dataFormat is null.
     */
    public function testSetDataFormatWithNullDataFormat()
    {
        $this->expectException('\TypeError');

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
                self::DECODER_FULLY_QUALIFIED_CLASS_NAME,
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

        $expectedResult = ["<FORMAT DECODED DATA>{$data}</FORMAT DECODED DATA>"];

        $actualResult = $this->dataDecoder->decodeData($data);

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * Provide data formats
     * and expected results returned by proper decoders.
     *
     * @return array
     */
    public static function dataFormatsAndResultsProvider(): array
    {
        return [
            ['format1', ['<FORMAT 1 DECODED DATA/>']],
            ['Format2', ['<FORMAT 2 DECODED DATA/>']],
            ['FORMAT3', ['<FORMAT 3 DECODED DATA/>']],
        ];
    }

    /**
     * Provide data to decode.
     *
     * @return array
     */
    public static function dataProvider(): array
    {
        return [
            ['apple'],
            ['pear'],
            ['plum'],
        ];
    }

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp(): void
    {
        $this->dataDecoder = new Decoder();
    }
}
