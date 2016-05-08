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
 * FileTest.
 * PHPUnit test class for File class.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class FileTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Relative path of directory with file fixtures
     * used in tests.
     */
    const FILE_FIXTURES_RELATIVE_PATH = '../testing_environment/files';

    /**
     * Self-test for function buildFileFixturePath.
     */
    public function testSelfBuildFileFixturePath()
    {
        $expectedFileContent = 'Self test';

        $filePath = self::buildFileFixturePath('self-test');

        $actualFileContent = file_get_contents($filePath);

        $this->assertEquals($expectedFileContent, $actualFileContent);
    }

    /**
     * Test if Exorg\DataCoder\File class
     * has been created.
     */
    public function testFileClassExists()
    {
        $this->assertTrue(
            class_exists('Exorg\DataCoder\File')
        );
    }

    /**
     * Test if constructor throws exception
     * when file path argument is null.
     *
     * @expectedException \InvalidArgumentException
     */
    public function testConstructorWhenFilePathIsNull()
    {
        $filePath = null;

        new File($filePath);
    }

    /**
     * Test if constructor throws exception
     * when file path argument is empty string.
     *
     * @expectedException \InvalidArgumentException
     */
    public function testConstructorWhenFilePathIsEmptyString()
    {
        $filePath = '';

        new File($filePath);
    }

    /**
     * Test if constructor creates object
     * when file defined by passed path
     * doesn't exist.
     */
    public function testConstructorWhenFileDoesNotExist()
    {
        $filePath = self::buildFileFixturePath('nonexistent');

        $file = new File($filePath);

        $this->assertInstanceOf('Exorg\DataCoder\File', $file);
    }

    /**
     * Test if constructor creates object
     * when file defined by passed path exists.
     */
    public function testConstructorWhenFileExists()
    {
        $filePath = self::buildFileFixturePath('file.ext');

        $file = new File($filePath);

        $this->assertInstanceOf('Exorg\DataCoder\File', $file);
    }

    /**
     * Test if getExtension function
     * has been defined.
     */
    public function testGetExtensionFunctionExists()
    {
        $this->assertTrue(
            method_exists(
                'Exorg\DataCoder\File',
                'getExtension'
            )
        );
    }

    /**
     * Test getExtension function
     * returns proper extension.
     *
     * @dataProvider filePathExtensionProvider
     */
    public function testGetExtensionFunction($filePath, $fileExtension)
    {
        $file = new File($filePath);

        $this->assertEquals($fileExtension, $file->getExtension());
    }

    /**
     * Test if getContent function
     * has been defined.
     */
    public function testGetContentFunctionExists()
    {
        $this->assertTrue(
            method_exists(
                'Exorg\DataCoder\File',
                'getContent'
            )
        );
    }

    /**
     * Test getContent function throws exception
     * when file doesn't exist.
     *
     * @expectedException \Exorg\DataCoder\FileException
     */
    public function testGetContentFunctionWhenFileDoesNotExist()
    {
        $filePath = self::buildFileFixturePath('nonexistent');

        $file = new File($filePath);

        $file->getContent();
    }

    /**
     * Test getContent function throws exception
     * when file is not readable.
     *
     * @expectedException \Exorg\DataCoder\FileException
     */
    public function testGetContentFunctionWhenFileIsNotReadable()
    {
        $filePath = self::buildFileFixturePath('unreadable-file');

        $file = new File($filePath);

        $file->getContent();
    }

    /**
     * Test getContent function throws exception
     * when file is placed in unreadable directory.
     *
     * @expectedException \Exorg\DataCoder\FileException
     */
    public function testGetContentFunctionWhenDirectoryIsNotReadable()
    {
        $filePath = self::buildFileFixturePath('unreadable-directory/file-for-read');

        $file = new File($filePath);

        $file->getContent();
    }

    /**
     * Test getContent function
     * returns proper content.
     *
     * @dataProvider fileForReadPathAndContentProvider
     */
    public function testGetContentFunction($filePath, $fileContent)
    {
        $file = new File($filePath);

        $this->assertEquals($fileContent, $file->getContent());
    }

    /**
     * Test if setContent function
     * has been defined.
     */
    public function testSetContentFunctionExists()
    {
        $this->assertTrue(
            method_exists(
                'Exorg\DataCoder\File',
                'setContent'
            )
        );
    }

    /**
     * Test setContent function throws exception
     * when content is improper.
     *
     * @dataProvider improperFileContentProvider
     * @expectedException InvalidArgumentException
     */
    public function testSetContentFunctionWhenContentIsImproper($content)
    {
        $file = new File('file');

        $file->setContent($content);
    }

    /**
     * Test setContent function throws exception
     * when file is not writable.
     *
     * @expectedException \Exorg\DataCoder\FileException
     */
    public function testSetContentFunctionWhenFileIsNotWritable()
    {
        $filePath = self::buildFileFixturePath('unwritable-file');

        $file = new File($filePath);

        $file->setContent('Some content');
    }

    /**
     * Test setContent function throws exception
     * when file is writting in unwritable directory.
     *
     * @expectedException \Exorg\DataCoder\FileException
     */
    public function testSetContentFunctionWhenDirectoryIsNotWritable()
    {
        $filePath = self::buildFileFixturePath('unwritable-directory/file-for-write');

        $file = new File($filePath);

        $file->setContent('Some content');
    }

    /**
     * Test setContent function
     * returns proper content.
     *
     * @dataProvider fileForWritePathAndContentProvider
     * @param string $filePath
     * @param string $fileContent
     */
    public function testSetContentFunction($filePath, $fileContent)
    {
        $file = new File($filePath);

        $file->setContent($fileContent);

        $this->assertEquals($fileContent, file_get_contents($filePath));
    }

    /**
     * Provide file paths
     * and appropriate extension.
     *
     * @return array
     */
    public function filePathExtensionProvider()
    {
        return array(
            array('file', ''),
            array('file.ext', 'ext'),
            array('file.dat', 'dat'),
            array('files/file.ext', 'ext'),
        );
    }

    /**
     * Provide paths and appropriate contents
     * of the files destined to write.
     *
     * @return array
     */
    public function fileForReadPathAndContentProvider()
    {
        return array(
            array(self::buildFileFixturePath('file-for-read'), 'File for read'),
            array(self::buildFileFixturePath('file-for-read.ext'), 'File for read with extension'),
            array(self::buildFileFixturePath('file-for-read.dat'), 'File for read with another extension'),
            array(self::buildFileFixturePath('directory/file-for-read'), 'File for read in directory'),
        );
    }

    /**
     * Provide paths and appropriate contents
     * of the files destined to write.
     *
     * @return array
     */
    public function fileForWritePathAndContentProvider()
    {
        return array(
            array(self::buildFileFixturePath('file-for-write'), 'File for write'),
            array(self::buildFileFixturePath('file-for-write.ext'), 'File for write with extension'),
            array(self::buildFileFixturePath('file-for-write.dat'), 'File for write with another extension'),
            array(self::buildFileFixturePath('directory/file-for-write'), 'File for write in directory'),
            array(self::buildFileFixturePath('nonexistant-file-for-write'), 'Nonoexistent file for write'),
            array(self::buildFileFixturePath('nonexistent-file-for-write.ext'), 'Nonexistent file for write with extension'),
            array(self::buildFileFixturePath('nonexistent-file-for-write.dat'), 'Nonexistent file for write with another extension'),
            array(self::buildFileFixturePath('directory/nonexistent-file-for-write'), 'Nonexistent file for write in directory'),
        );
    }

    /**
     * Provide file content
     * of improper type.
     *
     * @return array
     */
    public function improperFileContentProvider()
    {
        return array(
            array(null),
            array(1024),
            array(true),
            array(array()),
            array(new \stdClass()),
        );
    }

    /**
     * This method is called before the first test of this test class is run.
     */
    public static function setUpBeforeClass()
    {
        self::setSpecialPermissionsForFiles();
    }

    /**
     * This method is called after the last test of this test class is run.
     */
    public static function tearDownAfterClass()
    {
        self::resetPermissionsForFiles();
        self::removeFilesShouldNotExist();
        self::clearFilesShouldBeEmpty();
    }

    /**
     * Returns absolute path to the file fixture.
     *
     * @param string $fileName
     * @return string
     */
    private static function buildFileFixturePath($fileName)
    {
        $absoluteFilePath = __DIR__
            . DIRECTORY_SEPARATOR
            . self::FILE_FIXTURES_RELATIVE_PATH
            . DIRECTORY_SEPARATOR
            . $fileName;

        return $absoluteFilePath;
    }

    /**
     * Set special permissions for files and directories
     * to test unwrittable and unreadable ones.
     */
    private static function setSpecialPermissionsForFiles()
    {
        exec("chmod a-r " . self::buildFileFixturePath('unreadable-file'));
        exec("chmod a-w " . self::buildFileFixturePath('unwritable-file'));
        exec("chmod a-rx " . self::buildFileFixturePath('unreadable-directory'));
        exec("chmod a-wx " . self::buildFileFixturePath('unwritable-directory'));
    }

    /**
     * Reset permissions for files to default.
     */
    private static function resetPermissionsForFiles()
    {
        exec("chmod a+r " . self::buildFileFixturePath('unreadable-file'));
        exec("chmod a+w " . self::buildFileFixturePath('unwritable-file'));
        exec("chmod a+rx " . self::buildFileFixturePath('unreadable-directory'));
        exec("chmod a+wx " . self::buildFileFixturePath('unwritable-directory'));
    }

    /**
     * Remove files created in the testing process,
     * that shouldn't exist at the begining of tests.
     */
    private static function removeFilesShouldNotExist()
    {
        exec("rm " . self::buildFileFixturePath('nonexistant-file-for-write'));
        exec("rm " . self::buildFileFixturePath('nonexistent-file-for-write.ext'));
        exec("rm " . self::buildFileFixturePath('nonexistent-file-for-write.dat'));
        exec("rm " . self::buildFileFixturePath('directory/nonexistent-file-for-write'));
    }

    /**
     * Clear content of files,
     * that should be empty at the begining of tests.
     */
    private static function clearFilesShouldBeEmpty()
    {
        file_put_contents(self::buildFileFixturePath('file-for-write'), '');
        file_put_contents(self::buildFileFixturePath('file-for-write.ext'), '');
        file_put_contents(self::buildFileFixturePath('file-for-write.dat'), '');
        file_put_contents(self::buildFileFixturePath('directory/file-for-write'), '');
    }
}
