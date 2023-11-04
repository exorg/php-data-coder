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
 * YamlDatafileEncoderTest.
 * PHPUnit test class for YamlDatafileEncoder class.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015-2023 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class YamlDatafileEncoderTest extends TestCase
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
     * @var YamlDatafileEncoder
     */
    private $yamlDatafileEncoder;

    /**
     * Test Exorg\DataCoder\YamlDatafileEncoder class
     * has been created.
     */
    public function testYamlDatafileEncoderClassExists()
    {
        $this->assertTrue(
            class_exists('Exorg\DataCoder\YamlDatafileEncoder')
        );
    }

    /**
     * Test if encodeFile function
     * has been defined.
     */
    public function testEncodeFileFunctionExists()
    {
        $this->assertTrue(
            method_exists(
                'Exorg\DataCoder\YamlDatafileEncoder',
                'encodeFile'
            )
        );
    }

    /**
     * Test encodeFile function throws exception
     * when type of data is incorrect.
     */
    public function testEncodeFileWithIncorrectData()
    {
        $this->expectException('\InvalidArgumentException');

        $dataFilePath = self::$dataFileFixturesHelper->buildCreatedFilePath('data');
        $data = 1024;

        $this->yamlDatafileEncoder->encodeFile($data, $dataFilePath);
    }

    /**
     * Test encodeFile encodes data properly
     * and saves it to the proper file.
     */
    public function testEncodeFile()
    {
        $dataFilePath = self::$dataFileFixturesHelper->buildCreatedFilePath('data.yaml');
        $data = self::$dataFileFixturesHelper->loadDecodedData();

        $this->yamlDatafileEncoder->encodeFile($data, $dataFilePath);

        $expectedResult = self::$dataFileFixturesHelper->loadEncodedData();
        $actualResult = file_get_contents($dataFilePath);

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
        $this->yamlDatafileEncoder = new YamlDatafileEncoder();
    }
}
