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
class JsonDataDecoderTest extends \PHPUnit_Framework_TestCase
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
     * has been implemented.
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
                $this->jsonDataDecoder,
                'decodeData'
            )
        );
    }

    /**
     * Test decodeData function doesn't accept data of incorrect format.
     *
     * @expectedException \Exorg\DataCoder\DataFormatInvalidException
     */
    public function testDecodeDataWithIncorrectData()
    {
        $data = '';

        $this->jsonDataDecoder->decodeData($data);
    }

    /**
     * Test decodeData function accepts data of correct format
     * and properly parses data.
     */
    public function testDecodeDataWithCorrectData()
    {
        $data = self::$dataFileFixturesHelper->loadEncodedData();
        $expectedResult = self::$dataFileFixturesHelper->loadDecodedData();

        $actualResult = $this->jsonDataDecoder->decodeData($data);

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * This method is called before the first test of this test class is run.
     */
    public static function setUpBeforeClass()
    {
        self::$dataFileFixturesHelper = new DataFileFixturesHelper();
        self::$dataFileFixturesHelper->setDataFormat(self::DATA_FORMAT_JSON);
    }

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->jsonDataDecoder = new JsonDataDecoder();
    }
}
