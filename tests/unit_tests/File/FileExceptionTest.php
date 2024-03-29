<?php

declare(strict_types=1);

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
 * FileException Test.
 * PHPUnit test class for FileException class.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015-2023 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class FileExceptionTest extends TestCase
{
    const FILE_EXCEPTION_FULLY_QUALIFIED_CLASS_NAME = 'ExOrg\DataCoder\File\FileException';

    /**
     * Test if ExOrg\DataCoder\NonexistentFileException class
     * has been created.
     */
    public function testFileExceptionTestClassExists()
    {
        $this->assertTrue(
            class_exists(self::FILE_EXCEPTION_FULLY_QUALIFIED_CLASS_NAME)
        );
    }
}
