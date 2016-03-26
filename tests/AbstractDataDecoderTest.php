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
 * AbstractDataDecoderTest.
 * PHPUnit abstract test class for
 * Data Decoder classes.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
abstract class AbstractDataDecoderTest extends \PHPUnit_Framework_TestCase
{
    use CheckingDataDecodingResultTrait;

    /**
     * Provide relative path
     * of the data file used for data decoder test.
     *
     * @return string
     */
    abstract protected function provideFixtureFilePath();

    /**
     * Provide data for the parsing process.
     *
     * @return array()
     */
    protected function provideDecodedData()
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
