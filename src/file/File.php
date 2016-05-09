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
 * File.
 * Provides needed informations
 * about the file defined by absolute path
 * and performs basic operations on file.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
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
    private $path;

    /**
     * Configure file path.
     *
     * @param string $filePath
     * @throws \InvalidArgumentException
     */
    public function __construct($filePath)
    {
        self::validatePath($filePath);
        $this->path = $filePath;
    }

    /**
     * Extract file extension.
     *
     * @return string
     */
    public function getExtension()
    {
        $extension = pathinfo($this->path, PATHINFO_EXTENSION);

        return $extension;
    }

    /**
     * Read file content.
     *
     * @throws FileException
     * @return string
     */
    public function getContent()
    {
        $this->validatePathToRead($this->path);

        $fileContent = file_get_contents($this->path);

        return $fileContent;
    }

    /**
     * Write file content.
     *
     * @param string $content
     * @throws \InvalidArgumentException
     * @throws FileException
     */
    public function setContent($content)
    {
        $this->validateContent($content);
        $this->validatePathToWrite($this->path);

        $fileContent = file_put_contents($this->path, $content);
    }

    /**
     * Validate file path
     * and check if it can be used
     * to define file.
     *
     * @param string $path
     * @throws \InvalidArgumentException
     */
    private static function validatePath($path)
    {
        if(!is_string($path)) {
            throw new \InvalidArgumentException(
               'File path must be string.'
            );
        } elseif (empty($path)) {
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
     * @throws FileException
     */
    private static function validatePathToRead($path)
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
     * @throws FileException
     */
    private static function validatePathToWrite($path)
    {
        $directoryPath = dirname($path);

        if ((file_exists($path) && !is_writable($path))
        || (!file_exists($path) && !is_writable($directoryPath))) {
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
     * @throws \InvalidArgumentException
     */
    private function validateContent($content)
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
