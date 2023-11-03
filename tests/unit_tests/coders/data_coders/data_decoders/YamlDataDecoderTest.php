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

/**
 * YamlDataDecoderTest.
 * PHPUnit test class for YamlDataDecoder class.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright 2015-2023 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class YamlDataDecoderTest extends TestCase
{
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
     * @var YamlDataDecoder
     */
    private $yamlDataDecoder;

    /**
     * Test YamlDataDecoder class
     * has been created.
     */
    public function testYamlDataDecoderClassExists()
    {
        $this->assertTrue(
            class_exists('Exorg\DataCoder\YamlDataDecoder')
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
                'Exorg\DataCoder\YamlDataDecoder',
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
        $this->expectException('\InvalidArgumentException');

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
        $this->expectException('\Exorg\DataCoder\DataFormatInvalidException');

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
        $this->yamlDataDecoder = new YamlDataDecoder();
    }
}
