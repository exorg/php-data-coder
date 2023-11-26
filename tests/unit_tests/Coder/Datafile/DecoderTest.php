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

namespace ExOrg\DataCoder\Coder\Datafile;

use PHPUnit\Framework\TestCase;
use ExOrg\DataCoder\Fixture\DataFileFixturesHelper;

/**
 * Datafile Decoder Test.
 * PHPUnit test class for Datafile Decoder class.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015-2023 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class DecoderTest extends TestCase
{
    const DECODER_FULLY_QUALIFIED_CLASS_NAME = 'ExOrg\DataCoder\Coder\Datafile\Decoder';
    const FILE_EXCEPTION_FULLY_QUALIFIED_CLASS_NAME = 'ExOrg\DataCoder\File\FileException';
    const CODER_CLASS_NOT_FOUND_EXCEPTION_FULLY_QUALIFIED_CLASS_NAME = 'ExOrg\DataCoder\CoderBuilder\CoderClassNotFoundException';

    /**
     * Helper for handling data file fixtures.
     *
     * @var DataFileFixturesHelper
     */
    private static DataFileFixturesHelper $dataFileFixturesHelper;

    /**
     * Instance of tested class.
     *
     * @var Decoder
     */
    private Decoder $datafileDecoder;

    /**
     * Test Datafile Decoder class
     * has been created.
     */
    public function testDatafileDecoderClassExists()
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

        $this->datafileDecoder->setDataFormat($dataFormat);
    }

    /**
     * Test setDataFormat function
     * thows exception when dataFormat is null.
     */
    public function testSetDataFormatWithNullDataFormat()
    {
        $this->expectException('\TypeError');

        $dataFormat = null;

        $this->datafileDecoder->setDataFormat($dataFormat);
    }

    /**
     * Test setDataFormat function
     * thows exception when dataFormat is empty string.
     */
    public function testSetDataFormatWithEmptyDataFormat()
    {
        $this->expectException('\InvalidArgumentException');

        $dataFormat = '';

        $this->datafileDecoder->setDataFormat($dataFormat);
    }

    /**
     * Test setDataFormat function sets proper format
     * that allows to build proper Data Decoder.
     *
     * @dataProvider dataFormatsAndResultsProvider
     */
    public function testSetDataFormat($dataFormat, $expectedResult)
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
                self::DECODER_FULLY_QUALIFIED_CLASS_NAME,
                'decodeFile'
            )
        );
    }

    /**
     * Test decodeFile function throws exception
     * when file doesn't exist.
     */
    public function testDecodeFileWhenFileDoesNotExist()
    {
        $this->expectException(self::FILE_EXCEPTION_FULLY_QUALIFIED_CLASS_NAME);

        $dataFilePath = self::$dataFileFixturesHelper->buildEncodedFilePath('noexistent.format');

        $this->datafileDecoder->decodeFile($dataFilePath);
    }

    /**
     * Test decodeFile function throws exception
     * when improper format has been set directly.
     */
    public function testDecodeFileWhenImproperDataFormatIsSet()
    {
        $this->expectException(self::CODER_CLASS_NOT_FOUND_EXCEPTION_FULLY_QUALIFIED_CLASS_NAME);

        $dataFilePath = self::$dataFileFixturesHelper->buildEncodedFilePath('data.format');

        $this->datafileDecoder->setDataFormat('nonexistent');
        $this->datafileDecoder->decodeFile($dataFilePath);
    }

    /**
     * Test decodeFile function properly decodes data file
     * when format has been set directly.
     */
    public function testDecodeFileWhenDataFormatIsSet()
    {
        $expectedResult = ["<FORMAT DECODED DATA>Another dummy data</FORMAT DECODED DATA>"];

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
     */
    public function testDecodeFileWhenDataFormatIsNotSetAndFileHasImproperExtension()
    {
        $this->expectException(self::CODER_CLASS_NOT_FOUND_EXCEPTION_FULLY_QUALIFIED_CLASS_NAME);

        $dataFilePath = self::$dataFileFixturesHelper->buildEncodedFilePath('data.nonexistentformat');

        $this->datafileDecoder->decodeFile($dataFilePath);
    }

    /**
     * Test decodeFile function throws exception
     * when data format hasn't been set
     * and decoder must recognize format by file extension
     * but file has no extension.
     */
    public function testDecodeFileWhenDataFormatIsNotSetAnFileHasNotExtension()
    {
        $this->expectException('\LogicException');

        $dataFilePath = self::$dataFileFixturesHelper->buildEncodedFilePath('data');

        $this->datafileDecoder->decodeFile($dataFilePath);
    }

    /**
     * Test decodeFile function returns proper result
     * when data format hasn't been set
     * and decoder must recognize format by file extension.
     */
    public function testDecodeFileWhenDataFormatIsNotSet()
    {
        $expectedResult = ["<FORMAT DECODED DATA>Dummy data</FORMAT DECODED DATA>"];

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
    public static function dataFormatsAndResultsProvider(): array
    {
        return [
            ['format1', ['<FORMAT 1 DECODED DATA/>']],
            ['Format2', ['<FORMAT 2 DECODED DATA/>']],
            ['format3', ['<FORMAT 3 DECODED DATA/>']],
        ];
    }

    /**
     * This method is called before the first test of this test class is run.
     *
     * @return void
     */
    public static function setUpBeforeClass(): void
    {
        self::$dataFileFixturesHelper = new DataFileFixturesHelper();
    }

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp(): void
    {
        $this->datafileDecoder = new Decoder();
    }
}
