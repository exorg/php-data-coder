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
 * JsonDatafileDecoderTest.
 * PHPUnit test class for JsonDatafileDecoder class.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015-2023 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class JsonDatafileDecoderTest extends TestCase
{
    /**
     * Decoded data format.
     */
    const DATA_FORMAT_JSON = 'json';

    /**
     * Helper for handling data file fixtures.
     *
     * @var DataFileFixturesHelper
     */
    private static $dataFileFixturesHelper = null;

    /**
     * Instance of tested class.
     *
     * @var JsonDatafileDecoder
     */
    private $jsonDatafileDecoder;

    /**
     * Test Exorg\DataCoder\JsonDatafileDecoder class
     * has been created.
     */
    public function testJsonDatafileDecoderClassExists()
    {
        $this->assertTrue(
            class_exists('Exorg\DataCoder\JsonDatafileDecoder')
        );
    }

    /**
     * Test if decodeFile function
     * has been defined.
     */
    public function testDecodeFileFunctionExists()
    {
        $this->assertTrue(
            method_exists(
                'Exorg\DataCoder\JsonDatafileDecoder',
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
        $this->expectException('\Exorg\DataCoder\FileException');

        $dataFilePath = self::$dataFileFixturesHelper->buildEncodedFilePath('noexistent.format');

        $this->jsonDatafileDecoder->decodeFile($dataFilePath);
    }

    /**
     * Test decodeFile function throws exception
     * when data in the file have incorrect format.
     */
    public function testDecodeFileWithIncorrectData()
    {
        $this->expectException('\Exorg\DataCoder\DataFormatInvalidException');

        $dataFilePath = self::$dataFileFixturesHelper->buildEncodedFilePath('data.nonexistentformat');

        $this->jsonDatafileDecoder->decodeFile($dataFilePath);
    }

    /**
     * Test decodeFile function properly decodes file data
     * with JSON format.
     */
    public function testDecodeFile()
    {
        $dataFilePath = self::$dataFileFixturesHelper->buildEncodedFilePath('data.json');
        $expectedResult = self::$dataFileFixturesHelper->loadDecodedData();

        $actualResult = $this->jsonDatafileDecoder->decodeFile($dataFilePath);

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * This method is called before the first test of this test class is run.
     */
    public static function setUpBeforeClass(): void
    {
        self::$dataFileFixturesHelper = new DataFileFixturesHelper();
        self::$dataFileFixturesHelper->setDataFormat(self::DATA_FORMAT_JSON);
    }

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $this->jsonDatafileDecoder = new JsonDatafileDecoder();
    }
}
