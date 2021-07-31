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
 * JsonDataDecoderTest.
 * PHPUnit test class for JsonDataDecoder class.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class JsonDataDecoderTest extends TestCase
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
     * @var JsonDataDecoder
     */
    private $jsonDataDecoder;

    /**
     * Test JsonDataDecoder class
     * has been created.
     */
    public function testJsonDataDecoderClassExists()
    {
        $this->assertTrue(
            class_exists('Exorg\DataCoder\JsonDataDecoder')
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
                'Exorg\DataCoder\JsonDataDecoder',
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

        $this->jsonDataDecoder->decodeData($data);
    }

    /**
     * Test decodeData function
     * throws exception when data is incorrect
     * and doesn't fit to the JSON format.
     */
    public function testDecodeDataWithDataInIncorrectFormat()
    {
        $this->expectException('\Exorg\DataCoder\DataFormatInvalidException');

        $data = '';

        $this->jsonDataDecoder->decodeData($data);
    }

    /**
     * Test encodeData function properly decodes data
     * in the proper JSON format.
     */
    public function testDecodeData()
    {
        $data = self::$dataFileFixturesHelper->loadEncodedData();
        $expectedResult = self::$dataFileFixturesHelper->loadDecodedData();

        $actualResult = $this->jsonDataDecoder->decodeData($data);

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
        $this->jsonDataDecoder = new JsonDataDecoder();
    }
}
