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

/**
 * File.
 * Provides needed informations
 * about the file defined by absolute path
 * and performs basic operations on file.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015-2023 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class File
{
    /**
     * File absolute path.
     *
     * @var string
     */
    private string $path;

    /**
     * Configure file path.
     *
     * @param string $filePath
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(string $filePath)
    {
        self::validatePath($filePath);
        $this->path = $filePath;
    }

    /**
     * Extract file extension.
     *
     * @return string
     */
    public function getExtension(): string
    {
        $extension = pathinfo($this->path, PATHINFO_EXTENSION);

        return $extension;
    }

    /**
     * Read file content.
     *
     * @return string
     *
     * @throws FileException
     */
    public function getContent(): string
    {
        $this->validatePathToRead($this->path);

        $fileContent = file_get_contents($this->path);

        return $fileContent;
    }

    /**
     * Write file content.
     *
     * @param string $content
     *
     * @return void
     *
     * @throws \InvalidArgumentException
     * @throws FileException
     */
    public function setContent(string $content): void
    {
        $this->validateContent($content);
        $this->validatePathToWrite($this->path);

        file_put_contents($this->path, $content);
    }

    /**
     * Validate file path
     * and check if it can be used
     * to define file.
     *
     * @param string $path
     *
     * @return void
     *
     * @throws \InvalidArgumentException
     */
    private static function validatePath(string $path): void
    {
        /*if (!is_string($path)) {
            throw new \InvalidArgumentException(
                'File path must be string.'
            );
        } else*/
        if (empty($path)) {
            throw new \InvalidArgumentException(
                'File path cannot be empty.'
            );
        }
    }

    /**
     * Validate file path
     * and check if file can be read.
     *
     * @param string $path
     *
     * @return void
     *
     * @throws FileException
     */
    private static function validatePathToRead(string $path): void
    {
        if (!file_exists($path)) {
            throw new FileException(
                'File '
                . $path
                . ' does not exist.'
            );
        } elseif (!is_readable($path)) {
            throw new FileException(
                'File '
                . $path
                . ' cannot be read.'
            );
        }
    }

    /**
     * Validate file path
     * and check if file can be written.
     *
     * @param string $path
     *
     * @return void
     *
     * @throws FileException
     */
    private static function validatePathToWrite(string $path): void
    {
        $directoryPath = dirname($path);

        if (
            (file_exists($path) && !is_writable($path))
            || (!file_exists($path) && !is_writable($directoryPath))
        ) {
            throw new FileException(
                'File '
                . $path
                . ' cannot be written.'
            );
        }
    }

    /**
     * Validate file content.
     *
     * @param string $content
     *
     * @return void
     *
     * @throws \InvalidArgumentException
     */
    private function validateContent(string $content): void
    {
        $contentIsValid = is_string($content);

        if (!$contentIsValid) {
            throw new \InvalidArgumentException(
                'Improper file content.
                Must be string.'
            );
        }
    }
}
