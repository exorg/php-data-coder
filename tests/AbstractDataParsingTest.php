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
 * AbstractDataParsingTest.
 * PHPUnit abstract test class for
 * Datafile Parser classes.
 *
 * @package DatafilesParser
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-datafiles-parser
 */
abstract class AbstractDataParsingTest extends \PHPUnit_Framework_TestCase
{
    use CheckingDataParsingResultTrait;

    /**
     * Provide relative path
     * of the data file used for parsing strategy test.
     *
     * @return string
     */
    abstract protected function provideFixtureFilePath();

    /**
     * Provide data for the parsing process.
     *
     * @return array()
     */
    protected function provideParsedData()
    {
        $this->turnOffErrors();

        $dataFileContent = $this->readDataContent();
        $dataReadCorrectly = ($dataFileContent !== false);

        if (! $dataReadCorrectly) {
            $this->fail("Data file cannot be read.");
        }

        return $dataFileContent;
    }

    /**
     * Read content of the fixture data file
     * destined for parsing.
     *
     * @return string
     */
    private function readDataContent()
    {
        $dataFilePath = (__DIR__)
            . DIRECTORY_SEPARATOR
            . $this->provideFixtureFilePath();

        $dataFileContent = file_get_contents($dataFilePath);

        return $dataFileContent;
    }

    /**
     * Turn off errors reporting.
     */
    private function turnOffErrors()
    {
        $emptyFunction = function () {};

        set_error_handler($emptyFunction);

        error_reporting();
    }
}
