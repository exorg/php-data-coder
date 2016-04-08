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
 * DataDecodersTestHelperTest.
 * PHPUnit base test class for
 * DataDecodersTestHelper.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class DataDecodersTestHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Instance of tested class.
     *
     * @var DataDecodersTestHelper
     */
    private $dataDecodersTestHelper = null;

    /**
     * Test if Exorg\DataCoder\DataDecodersTestHelper class
     * has been created.
     */
    public function testDataDecodersTestHelperClassExists()
    {
        $this->assertTrue(
            class_exists('Exorg\DataCoder\DataDecodersTestHelper')
        );
    }

    /**
     * Test if loadDataToDecode function
     * has been defined.
     */
    public function testLoadDataToDecodeFunctionExists()
    {
        $this->assertTrue(
            method_exists(
                $this->dataDecodersTestHelper,
                'loadDataToDecode'
            )
        );
    }

    /**
     * Test for function loadDataToDecode.
     */
    public function testLoadDataToDecode()
    {
        $expectedData = (string) microtime();
        $this->writeContentToSelfTestEncodedFile($expectedData);

        $this->dataDecodersTestHelper->setDataFormat('self-test');
        $actualData = $this->dataDecodersTestHelper->loadDataToDecode();

        $this->assertEquals($expectedData, $actualData);
    }

    /**
     * Test for function loadDataToDecode
     * when improper format data has been set.
     *
     * @expectedException PHPUnit_Framework_Error_Warning
     */
    public function testLoadDataToDecodeWithImproperDataFormat()
    {
        $expectedData = (string) microtime();
        $this->writeContentToSelfTestEncodedFile($expectedData);

        $this->dataDecodersTestHelper->setDataFormat('another');
        $actualData = $this->dataDecodersTestHelper->loadDataToDecode();

        $this->assertNotEquals($expectedData, $actualData);
    }

    /**
     * Test if getExpectedDecodingResult function
     * has been defined.
     */
    public function testGetExpectedDecodingResultFunctionExists()
    {
        $this->assertTrue(
            method_exists(
                $this->dataDecodersTestHelper,
                'loadDataToDecode'
            )
        );
    }

    /**
     * Test for function getExpectedDecodingResult.
     */
    public function testGetExpectedDecodingResult()
    {
        $expectedResult = array(
            'value' => (string) microtime(),
        );
        $this->writeResultToSelfTestDecodedFile($expectedResult);

        $this->dataDecodersTestHelper->setDataFormat('self-test');
        $actualResult = $this->dataDecodersTestHelper->getExpectedDecodingResult();

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * Test for function getExpectedDecodingResult
     * when improper format data has been set.
     *
     * @expectedException PHPUnit_Framework_Error_Warning
     */
    public function testGetExpectedDecodingResultWithImproperDataFormat()
    {
        $expectedResult = array(
            'value' => (string) microtime(),
        );
        $this->writeResultToSelfTestDecodedFile($expectedResult);

        $this->dataDecodersTestHelper->setDataFormat('another');
        $actualResult = $this->dataDecodersTestHelper->getExpectedDecodingResult();

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->dataDecodersTestHelper = new DataDecodersTestHelper();
    }

    /**
     * Writes content to the special self test file
     * from directory with encoded data.
     *
     * @param string $content
     */
    private function writeContentToSelfTestEncodedFile($content)
    {
        $filePath = __DIR__ . "/data/encoded/data.self-test";
        file_put_contents($filePath, $content);
    }

    /**
     * Writes result to the special self test file
     * from directory with decoded data.
     *
     * @param string $content
     */
    private function writeResultToSelfTestDecodedFile($result)
    {
        $content = "\$result = array(\n";
        foreach ($result as $key => $value) {
            $content .= "    '$key' => '$value',\n";
        }
        $content .= ');';

        $filePath = __DIR__ . "/data/decoded/self-test.php";
        file_put_contents($filePath, $content);
    }
}
