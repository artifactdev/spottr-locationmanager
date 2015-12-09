<?php

use FlorianWolters\Component\Core\StringUtils;

/**
 * The ClassLoader class provides some static methods, to include required class files much more easy.
 *
 * @package MJ-REST api core
 * @subpackage system
 * @version 0.9.0
 * @author Markus Jahn
 * @copyright (c) 2014, Markus Jahn, markus-jahn@gmx.net
 */
class ClassLoader
{

    /**
     * Load the classes from the given path, which starts with the given prefix, ends with the given suffix and have the
     * given extention type.
     *
     * @param string $location
     *            Filesystem location, from where the classes should be imported.
     * @param string $prefix
     *            File name prefix of the files to import.
     * @param string $suffix
     *            File name suffix of the files to import.
     * @param string $fileType
     *            Type of the file to import. Mostely php.
     * @return multitype:string List of imported file class names.
     */
    public static function loadClasses($location, $prefix = "", $suffix = "", $fileType = "php")
    {
        $prefix = StringUtils::isBlank($prefix) ? "" : $prefix . ".";
        $fileType = StringUtils::isBlank($fileType) ? "" : "." . $fileType;
        $importedFiles = array();

        $filesArray = array();
        if (!file_exists($location)) {
            return array();
        }

        // iterate over the include dir
        $dir = new RecursiveDirectoryIterator($location);
        foreach (new RecursiveIteratorIterator($dir) as $file) {
            $filesArray[$file->getFileName()] = $file;
        }
        ksort($filesArray);

        foreach ($filesArray as $file) {
            $fileName = $file->getFileName();

            if ((! StringUtils::isBlank($prefix) && ! StringUtils::startsWith($fileName, $prefix)) ||
                 (! StringUtils::isBlank($fileType) && ! StringUtils::endsWith($fileName, $fileType))) {
                continue;
            }

            $fileNameWithoutExtention = substr($fileName, 0, strrpos($fileName, $fileType));
            if (! StringUtils::isBlank($suffix) && ! StringUtils::endsWith($fileNameWithoutExtention, $suffix)) {
                continue;
            }

            require_once $file->getPathname();
            $className = substr($fileName, strlen($prefix), - strlen($fileType));
            $importedFiles[] = $className;
        }

        return $importedFiles;
    }
}
