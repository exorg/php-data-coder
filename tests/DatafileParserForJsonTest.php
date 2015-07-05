<?php

/*
 * This file is part of the DatafilesParser package.
 *
 * (c) Katarzyna Krasińska <katheroine@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Exorg\DatafilesParser;

/**
 * DatafileParserForJsonTest.
 * PHPUnit test class for DatafileParser class
 * for JSON format.
 *
 * @package DatafilesParser
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-datafiles-parser
 */
class DatafileParserForJsonTest extends \PHPUnit_Framework_TestCase
{
    use CheckingDataParsingResultTrait;

    /**
     * Relative path to the fixture of parsing data file.
     */
    const FIXTURE_FILE = 'fixtures/data.json';

    /**
     * File parser object.
     *
     * @var DatafileParser
     */
    private $datafileParser;

    /**
     * Test parseData method properly parses data.
     */
    public function testParseFile()
    {
        $filePath = $this->provideFilePath();

        $expectedResult = $this->provideExpectedResultOfParseData();
        $actualResult = $this->datafileParser->parseFile($filePath);

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->datafileParser = new DatafileParser();
    }

    /**
     * Provide JSON file path.
     */
    protected function provideFilePath()
    {
        $filePath = (__DIR__)
            . DIRECTORY_SEPARATOR
            . self::FIXTURE_FILE;

        return $filePath;
    }
}
