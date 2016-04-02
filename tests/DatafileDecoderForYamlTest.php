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
 * DatafileDecoderForYamlTest.
 * PHPUnit test class for DatafileDecoder class
 * for YAML format.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class DatafileDecoderForYamlTest extends \PHPUnit_Framework_TestCase
{
    use CheckingDataDecodingResultTrait;

    /**
     * Relative path to the fixture of parsing data file.
     */
    const FIXTURE_FILE = 'fixtures/data.yaml';

    /**
     * File decoder object.
     *
     * @var DatafileDecoder
     */
    private $datafileDecoder;

    /**
     * Test parseData method properly parses data.
     */
    public function testParseFile()
    {
        $filePath = $this->provideFilePath();

        $expectedResult = $this->provideExpectedResultOfDecodedData();
        $actualResult = $this->datafileDecoder->parseFile($filePath);

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->datafileDecoder = new DatafileDecoder();
    }

    /**
     * Provide YAML file path.
     */
    protected function provideFilePath()
    {
        $filePath = (__DIR__)
            . DIRECTORY_SEPARATOR
            . self::FIXTURE_FILE;

        return $filePath;
    }
}
