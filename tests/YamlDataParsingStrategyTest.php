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
 * YamlDataParsingStrategyTest.
 * PHPUnit test class for YamlDataParsingStrategy class.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class YamlDataParsingStrategyTest extends AbstractDataParsingTest
{
    /**
     * Relative path to the fixture of parsing data file.
     */
    const FIXTURE_FILE = 'fixtures/data.yaml';

    /**
     * Instance of tested class.
     *
     * @var YamlDataParsingStrategy
     */
    private $dataParsingStrategy;

    /**
     * Test YamlDataParsingStrategy class
     * has been implemented.
     */
    public function testYamlDataParsingStrategyClassExists()
    {
        $yamlDataParsingStrategy = new YamlDataParsingStrategy();

        $this->assertInstanceOf('Exorg\DataCoder\YamlDataParsingStrategy', $yamlDataParsingStrategy);
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
        $this->dataParsingStrategy = new YamlDataParsingStrategy();
    }
}
