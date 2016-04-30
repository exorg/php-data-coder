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
 * YamlDataDecoderTest.
 * PHPUnit test class for YamlDataDecoder class.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class YamlDataDecoderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Decoded data format.
     */
    const DATA_FORMAT_YAML = 'yaml';

    /**
     * Test helper for Data Decoders.
     *
     * @var DataCodersTestHelper
     */
    private static $dataCodersTestHelper = null;

    /**
     * Instance of tested class.
     *
     * @var YamlDataDecoder
     */
    private $yamlDataDecoder;

    /**
     * Test YamlDataDecoder class
     * has been implemented.
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
                $this->yamlDataDecoder,
                'decodeData'
            )
        );
    }

    /**
     * Test decodeData method doesn't accept data of incorrect format.
     *
     * @expectedException \Exorg\DataCoder\DataFormatInvalidException
     */
    public function testDecodeDataWithIncorrectData()
    {
        $data = '';

        $this->yamlDataDecoder->decodeData($data);
    }

    /**
     * Test decodeData method accepts data of correct format
     * and properly parses data.
     */
    public function testDecodeDataWithCorrectData()
    {
        $data = self::$dataCodersTestHelper->loadEncodedData();
        $expectedResult = self::$dataCodersTestHelper->loadDecodedData();

        $actualResult = $this->yamlDataDecoder->decodeData($data);

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * This method is called before the first test of this test class is run.
     */
    public static function setUpBeforeClass()
    {
        self::$dataCodersTestHelper = new DataCodersTestHelper();
        self::$dataCodersTestHelper->setDataFormat(self::DATA_FORMAT_YAML);
    }

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->yamlDataDecoder = new YamlDataDecoder();
    }
}
