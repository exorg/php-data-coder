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

namespace ExOrg\DataCoder\Coder\Yaml\Data;

use PHPUnit\Framework\TestCase;
use ExOrg\DataCoder\Fixture\DataFileFixturesHelper;

/**
 * Yaml Data Decoder Test.
 * PHPUnit test class for YamlDataDecoder class.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015-2023 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class DecoderTest extends TestCase
{
    const DECODER_FULLY_QUALIFIED_CLASS_NAME = 'ExOrg\DataCoder\Coder\Yaml\Data\Decoder';
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
    private static DataFileFixturesHelper $dataFileFixturesHelper;

    /**
     * Instance of tested class.
     *
     * @var Decoder
     */
    private Decoder $yamlDataDecoder;

    /**
     * Test Yaml Data Decoder class
     * has been created.
     */
    public function testYamlDataDecoderClassExists()
    {
        $this->assertTrue(
            class_exists(self::DECODER_FULLY_QUALIFIED_CLASS_NAME)
        );
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
     * throws exception when data is not string.
     */
    public function testDecodeDataWithNotStringData()
    {
        $this->expectException('\TypeError');

        $data = 1024;

        $this->yamlDataDecoder->decodeData($data);
    }

    /**
     * Test decodeData function
     * throws exception when data is incorrect
     * and doesn't fit to the YAML format.
     */
    public function testDecodeDataWithDataInIncorrectFormat()
    {
        $this->expectException(self::DATA_FORMAT_INVALID_EXCEPTION_FULLY_QUALIFIED_CLASS_NAME);

        $data = '';

        $this->yamlDataDecoder->decodeData($data);
    }

    /**
     * Test encodeData function properly decodes data
     * in the proper YAML format.
     */
    public function testDecodeData()
    {
        $data = self::$dataFileFixturesHelper->loadEncodedData();
        $expectedResult = self::$dataFileFixturesHelper->loadDecodedData();

        $actualResult = $this->yamlDataDecoder->decodeData($data);

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * This method is called before the first test of this test class is run.
     *
     * @return void
     */
    public static function setUpBeforeClass(): void
    {
        self::$dataFileFixturesHelper = new DataFileFixturesHelper();
        self::$dataFileFixturesHelper->setDataFormat(self::DATA_FORMAT_YAML);
    }

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp(): void
    {
        $this->yamlDataDecoder = new Decoder();
    }
}
