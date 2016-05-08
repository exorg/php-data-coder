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
 * YamlDataEncoderTest.
 * PHPUnit test class for YamlDataEncoder class.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class YamlDataEncoderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Encoded data format.
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
     * @var YamlDataEncoder
     */
    private $yamlDataEncoder;

    /**
     * Test YamlDataEncoder class
     * has been created.
     */
    public function testYamlDataEncoderClassExists()
    {
        $this->assertTrue(
            class_exists('Exorg\DataCoder\YamlDataEncoder')
        );
    }

    /**
     * Test if encodeData function
     * has been defined.
     */
    public function testEncodeDataFunctionExists()
    {
        $this->assertTrue(
            method_exists(
                'Exorg\DataCoder\YamlDataEncoder',
                'encodeData'
            )
        );
    }

    /**
     * Test encodeData function
     * throws exception when data is not an array.
     *
     * @expectedException InvalidArgumentException
     */
    public function testEncodeDataWithNotArrayData()
    {
        $data = '';

        $this->yamlDataEncoder->encodeData($data);
    }

    /**
     * Test encodeData function properly encodes data
     * in the YAML format.
     */
    public function testEncodeData()
    {
        $data = self::$dataFileFixturesHelper->loadDecodedData();
        $expectedResult = self::$dataFileFixturesHelper->loadEncodedData();

        $actualResult = $this->yamlDataEncoder->encodeData($data);

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * This method is called before the first test of this test class is run.
     */
    public static function setUpBeforeClass()
    {
        self::$dataFileFixturesHelper = new DataFileFixturesHelper();
        self::$dataFileFixturesHelper->setDataFormat(self::DATA_FORMAT_YAML);
    }

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->yamlDataEncoder = new YamlDataEncoder();
    }
}
