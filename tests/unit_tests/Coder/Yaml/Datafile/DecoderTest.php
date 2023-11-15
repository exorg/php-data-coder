<?php

/*
 * This file is part of the DataCoder package.
 *
 * (c) Katarzyna Krasińska <katheroine@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ExOrg\DataCoder\Coder\Yaml\Datafile;

use PHPUnit\Framework\TestCase;
use ExOrg\Decapsulator\ObjectDecapsulator;
use ExOrg\DataCoder\Fixture\DataFileFixturesHelper;

/**
 * Yaml Datafile Decoder Test.
 * PHPUnit test class for YamlDatafileDecoder class.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015-2023 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class DecoderTest extends TestCase
{
    const DECODER_FULLY_QUALIFIED_CLASS_NAME = 'ExOrg\DataCoder\Coder\Yaml\Datafile\Decoder';
    const FILE_EXCEPTION_FULLY_QUALIFIED_CLASS_NAME = 'ExOrg\DataCoder\File\FileException';
    const DATA_FORMAT_INVALID_EXCEPTION_FULLY_QUALIFIED_CLASS_NAME = 'ExOrg\DataCoder\DataFormat\DataFormatInvalidException';

    /**
     * Decoded data format.
     */
    const DATA_FORMAT_YAML = 'yaml';

    /**
     * Helper for handling data file fixtures.
     *
     * @var DataFileFixturesHelper
     */
    private static $dataFileFixturesHelper = null;

    /**
     * Instance of tested class.
     *
     * @var YamlDatafileDecoder
     */
    private $yamlDatafileDecoder;

    /**
     * Test ExOrg\DataCoder\YamlDatafileDecoder class
     * has been created.
     */
    public function testYamlDatafileDecoderClassExists()
    {
        $this->assertTrue(
            class_exists(self::DECODER_FULLY_QUALIFIED_CLASS_NAME)
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

        $this->yamlDatafileDecoder->decodeFile($dataFilePath);
    }

    /**
     * Test decodeFile function throws exception
     * when data in the file have incorrect format.
     */
    public function testDecodeFileWithIncorrectData()
    {
        $this->expectException(self::DATA_FORMAT_INVALID_EXCEPTION_FULLY_QUALIFIED_CLASS_NAME);

        $dataFilePath = self::$dataFileFixturesHelper->buildEncodedFilePath('data.nonexistentformat');

        $this->yamlDatafileDecoder->decodeFile($dataFilePath);
    }

    /**
     * Test decodeFile function properly decodes file data
     * with YAML format.
     */
    public function testDecodeFile()
    {
        $dataFilePath = self::$dataFileFixturesHelper->buildEncodedFilePath('data.yaml');
        $expectedResult = self::$dataFileFixturesHelper->loadDecodedData();

        $actualResult = $this->yamlDatafileDecoder->decodeFile($dataFilePath);

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * This method is called before the first test of this test class is run.
     */
    public static function setUpBeforeClass(): void
    {
        self::$dataFileFixturesHelper = new DataFileFixturesHelper();
        self::$dataFileFixturesHelper->setDataFormat(self::DATA_FORMAT_YAML);
    }

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $this->yamlDatafileDecoder = new Decoder();
    }
}
