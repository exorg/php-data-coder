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
 * about the file
 * and performs basic operations.
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
        if (empty($filePath)) {
            throw new \InvalidArgumentException(
               'File path not defined.'
            );
        }

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
     * @throws NonexistentFileException
     * @return string
     */
    public function getContent()
    {
        if (!file_exists($this->path)) {
            throw new NonexistentFileException(
                'File '
                . $this->path
                . ' does not exist.'
            );
        } elseif (!is_readable($this->path)) {
            throw new NonexistentFileException(
                'File '
                . $this->path
                . ' cannot be read.'
            );
        }

        $fileContent = file_get_contents($this->path);

        return $fileContent;
    }
}
