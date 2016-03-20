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
 * PHPUnit test class for JsonDataParsingStrategy class.
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
     * Relative path to the fixture of parsing data file.
     */
    const FIXTURE_FILE = 'fixtures/data.json';

    /**
     * Instance of tested class.
     *
     * @var JsonDataParsingStrategy
     */
    private $dataParsingStrategy;

    /**
     * Test JsonDataParsingStrategy class
     * has been implemented.
     */
    public function testJsonDataParsingStrategyClassExists()
    {
        $jsonDataParsingStrategy = new JsonDataParsingStrategy();

        $this->assertInstanceOf('Exorg\DataCoder\JsonDataParsingStrategy', $jsonDataParsingStrategy);
    }

    /**
     * Test parseData method doesn't accept data of incorrect format.
     *
     * @expectedException \Exorg\DataCoder\DataFormatInvalidException
     */
    public function testParseDataWithIncorrectData()
    {
        $data = '';

        $this->dataParsingStrategy->parseData($data);
    }

    /**
     * Test parseData method accepts data of correct format
     * and properly parses data.
     */
    public function testParseDataWithCorrectData()
    {
        $data = $this->provideParsedData();

        $expectedResult = self::provideExpectedResultOfParseData();
        $actualResult = $this->dataParsingStrategy->parseData($data);

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->initialiseDataParsingStrategy();
    }

    /**
     * Provide relative path
     * of the data file used for parsing strategy test.
     *
     * @return string
     */
    protected function provideFixtureFilePath()
    {
        return self::FIXTURE_FILE;
    }

    /**
     * Initialise data parsing strategy fixture.
     */
    private function initialiseDataParsingStrategy()
    {
        $this->dataParsingStrategy = new JsonDataParsingStrategy();
    }
}
