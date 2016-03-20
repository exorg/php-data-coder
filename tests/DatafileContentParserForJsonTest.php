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
 * DatafileContentParserForJsonTest.
 * PHPUnit test class for DatafileContentParser class
 * for JSON format.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class DatafileContentParserForJsonTest extends AbstractDataDecoderTest
{
    /**
     * Relative path to the fixture of parsing data file.
     */
    const FIXTURE_FILE = 'fixtures/data.json';

    /**
     * Instance of tested class.
     *
     * @var DatafileContentParser
     */
    private $datafileContentParser;

    /**
     * Test parseData method properly parse data
     * of the JSON file content.
     */
    public function testParseDataForJson()
    {
        $data = $this->provideParsedData();

        $expectedResult = $this->provideExpectedResultOfParseData();
        $actualResult = $this->datafileContentParser->parseData($data);

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->datafileContentParser = new DatafileContentParser('JSON');
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
}
