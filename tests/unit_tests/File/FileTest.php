<?php

/*
 * This file is part of the DataCoder package.
 *
 * (c) Katarzyna Krasińska <katheroine@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ExOrg\DataCoder\File;

use PHPUnit\Framework\TestCase;

/**
 * FileTest.
 * PHPUnit test class for File class.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015-2023 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class FileTest extends TestCase
{
    /**
     * Relative path of directory with file fixtures
     * used in tests.
     */
    const FILE_FIXTURES_RELATIVE_PATH = '../../fixtures/files';

    const FILE_FULLY_QUALIFIED_CLASS_NAME = 'ExOrg\DataCoder\File\File';
    const FILE_EXCEPTION_FULLY_QUALIFIED_CLASS_NAME = 'ExOrg\DataCoder\File\FileException';

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
     * Test if File class
     * has been created.
     */
    public function testFileClassExists()
    {
        $this->assertTrue(
            class_exists(self::FILE_FULLY_QUALIFIED_CLASS_NAME)
        );
    }

    /**
     * Test if constructor throws exception
     * when file path argument type is improper.
     */
    public function testConstructorWhenFilePathIsNotString()
    {
        $this->expectException('\InvalidArgumentException');

        $filePath = 1024;

        new File($filePath);
    }

    /**
     * Test if constructor throws exception
     * when file path argument is null.
     */
    public function testConstructorWhenFilePathIsNull()
    {
        $this->expectException('\InvalidArgumentException');

        $filePath = null;

        new File($filePath);
    }

    /**
     * Test if constructor throws exception
     * when file path argument is empty string.
     */
    public function testConstructorWhenFilePathIsEmptyString()
    {
        $this->expectException('\InvalidArgumentException');

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

        $this->assertInstanceOf(self::FILE_FULLY_QUALIFIED_CLASS_NAME, $file);
    }

    /**
     * Test if constructor creates object
     * when file defined by passed path exists.
     */
    public function testConstructorWhenFileExists()
    {
        $filePath = self::buildFileFixturePath('file.ext');

        $file = new File($filePath);

        $this->assertInstanceOf(self::FILE_FULLY_QUALIFIED_CLASS_NAME, $file);
    }

    /**
     * Test if getExtension function
     * has been defined.
     */
    public function testGetExtensionFunctionExists()
    {
        $this->assertTrue(
            method_exists(
                self::FILE_FULLY_QUALIFIED_CLASS_NAME,
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
    public function testGetExtension($filePath, $fileExtension)
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
                self::FILE_FULLY_QUALIFIED_CLASS_NAME,
                'getContent'
            )
        );
    }

    /**
     * Test getContent function throws exception
     * when file doesn't exist.
     */
    public function testGetContentWhenFileDoesNotExist()
    {
        $this->expectException(self::FILE_EXCEPTION_FULLY_QUALIFIED_CLASS_NAME);

        $filePath = self::buildFileFixturePath('nonexistent');

        $file = new File($filePath);

        $file->getContent();
    }

    /**
     * Test getContent function throws exception
     * when file is not readable.
     */
    public function testGetContentWhenFileIsNotReadable()
    {
        $this->expectException(self::FILE_EXCEPTION_FULLY_QUALIFIED_CLASS_NAME);

        $filePath = self::buildFileFixturePath('unreadable-file');

        $file = new File($filePath);

        $file->getContent();
    }

    /**
     * Test getContent function throws exception
     * when file is placed in unreadable directory.
     */
    public function testGetContentWhenDirectoryIsNotReadable()
    {
        $this->expectException(self::FILE_EXCEPTION_FULLY_QUALIFIED_CLASS_NAME);

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
    public function testGetContent($filePath, $fileContent)
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
                self::FILE_FULLY_QUALIFIED_CLASS_NAME,
                'setContent'
            )
        );
    }

    /**
     * Test setContent function throws exception
     * when content is improper.
     *
     * @dataProvider improperFileContentProvider
     */
    public function testSetContentWhenContentIsImproper($content)
    {
        $this->expectException('\InvalidArgumentException');

        $file = new File('file');

        $file->setContent($content);
    }

    /**
     * Test setContent function throws exception
     * when file is not writable.
     */
    public function testSetContentWhenFileIsNotWritable()
    {
        $this->expectException(self::FILE_EXCEPTION_FULLY_QUALIFIED_CLASS_NAME);

        $filePath = self::buildFileFixturePath('unwritable-file');

        $file = new File($filePath);

        $file->setContent('Some content');
    }

    /**
     * Test setContent function throws exception
     * when file is writting in unwritable directory.
     */
    public function testSetContentWhenDirectoryIsNotWritable()
    {
        $this->expectException(self::FILE_EXCEPTION_FULLY_QUALIFIED_CLASS_NAME);

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
    public function testSetContent($filePath, $fileContent)
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
    public static function filePathExtensionProvider()
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
    public static function fileForReadPathAndContentProvider()
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
    public static function fileForWritePathAndContentProvider()
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
    public static function improperFileContentProvider()
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
    public static function setUpBeforeClass(): void
    {
        self::setSpecialPermissionsForFiles();
    }

    /**
     * This method is called after the last test of this test class is run.
     */
    public static function tearDownAfterClass(): void
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
