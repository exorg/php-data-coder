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
class YamlDataDecoderTest extends AbstractDataDecoderTest
{
    /**
     * Relative path to the fixture with decoding data.
     */
    const FIXTURE_FILE = 'fixtures/data.yaml';

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
        $yamlDataDecoder = new YamlDataDecoder();

        $this->assertInstanceOf('Exorg\DataCoder\YamlDataDecoder', $yamlDataDecoder);
    }

    /**
     * Test parseData method doesn't accept data of incorrect format.
     *
     * @expectedException \Exorg\DataCoder\DataFormatInvalidException
     */
    public function testParseDataWithIncorrectData()
    {
        $data = '';

        $this->yamlDataDecoder->parseData($data);
    }

    /**
     * Test parseData method accepts data of correct format
     * and properly parses data.
     */
    public function testParseDataWithCorrectData()
    {
        $data = $this->provideDecodedData();

        $expectedResult = self::provideExpectedResultOfDecodedData();
        $actualResult = $this->yamlDataDecoder->parseData($data);

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->initialiseDataDecoder();
    }

    /**
     * Provide relative path
     * of the data file used for data decoder test.
     *
     * @return string
     */
    protected function provideFixtureFilePath()
    {
        return self::FIXTURE_FILE;
    }

    /**
     * Initialise data decoder fixture.
     */
    private function initialiseDataDecoder()
    {
        $this->yamlDataDecoder = new YamlDataDecoder();
    }
}
