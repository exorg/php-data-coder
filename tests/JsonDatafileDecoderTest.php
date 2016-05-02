// <?php

// /*
//  * This file is part of the DataCoder package.
//  *
//  * (c) Katarzyna Krasińska <katheroine@gmail.com>
//  *
//  * For the full copyright and license information, please view the LICENSE
//  * file that was distributed with this source code.
//  */

// namespace Exorg\DataCoder;

// use Exorg\Decapsulator\ObjectDecapsulator;

// /**
//  * JsonDatafileDecoderTest.
//  * PHPUnit test class for JsonDatafileDecoder class.
//  *
//  * @package DataCoder
//  * @author Katarzyna Krasińska <katheroine@gmail.com>
//  * @copyright Copyright (c) 2015 Katarzyna Krasińska
//  * @license http://opensource.org/licenses/MIT MIT License
//  * @link https://github.com/ExOrg/php-data-coder
//  */
// class JsonDatafileDecoderTest extends \PHPUnit_Framework_TestCase
// {
//     /**
//      * Relative path of directory with data fixtures
//      * used in tests.
//      */
//     const DATA_FIXTURES_RELATIVE_PATH = 'data/encoded';

//     /**
//      * Instance of tested class.
//      *
//      * @var JsonDatafileDecoder
//      */
//     private $jsonDatafileDecoder;

//     /**
//      * Test Exorg\DataCoder\JsonDatafileDecoder class
//      * has been implemented.
//      */
//     public function testJsonDatafileDecoderClassExists()
//     {
//         $this->assertTrue(
//             class_exists('Exorg\DataCoder\JsonDatafileDecoder')
//         );
//     }

//     /**
//      * Test if decodeFile($filePath) method
//      * has been defined.
//      */
//     public function testDecodeFileFunctionExists()
//     {
//         $this->assertTrue(
//             method_exists(
//                 $this->jsonDatafileDecoder,
//                 'decodeFile'
//             )
//         );
//     }

//     /**
//      * Test decodeFile method throws exception
//      * when file doesn't exist.
//      *
//      * @expectedException Exorg\DataCoder\FileException
//      */
//     public function testDecodeFileWhenFileDoesNotExist()
//     {
//         $dataFilePath = self::buildDataFixturePath('noexistent.format');

//         $this->jsonDatafileDecoder->decodeFile($dataFilePath);
//     }

//     /**
//      * Sets up the fixture, for example, open a network connection.
//      * This method is called before a test is executed.
//      */
//     protected function setUp()
//     {
//         $this->jsonDatafileDecoder = new JsonDatafileDecoder();
//     }

//     /**
//      * Returns absolute path to the data fixture.
//      *
//      * @param string $dataFileName
//      * @return string
//      */
//     private static function buildDataFixturePath($dataFileName)
//     {
//         $absoluteFilePath = __DIR__
//             . DIRECTORY_SEPARATOR
//             . self::DATA_FIXTURES_RELATIVE_PATH
//             . DIRECTORY_SEPARATOR
//             . $dataFileName;

//         return $absoluteFilePath;
//     }
// }
