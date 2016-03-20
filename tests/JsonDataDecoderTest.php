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
class JsonDataDecoderTest extends AbstractDataDecoderTest
{
    /**
     * Relative path to the fixture with decoding data.
     */
    const FIXTURE_FILE = 'fixtures/data.json';

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
        $jsonDataDecoder = new JsonDataDecoder();

        $this->assertInstanceOf('Exorg\DataCoder\JsonDataDecoder', $jsonDataDecoder);
    }

    /**
     * Test parseData method doesn't accept data of incorrect format.
     *
     * @expectedException \Exorg\DataCoder\DataFormatInvalidException
     */
    public function testParseDataWithIncorrectData()
    {
        $data = '';

        $this->jsonDataDecoder->parseData($data);
    }

    /**
     * Test parseData method accepts data of correct format
     * and properly parses data.
     */
    public function testParseDataWithCorrectData()
    {
        $data = $this->provideDecodedData();

        $expectedResult = self::provideExpectedResultOfDecodedData();
        $actualResult = $this->jsonDataDecoder->parseData($data);

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
        $this->jsonDataDecoder = new JsonDataDecoder();
    }
}
