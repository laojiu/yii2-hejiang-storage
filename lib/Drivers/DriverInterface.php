<?php

namespace Hejiang\Storage\Drivers;

interface DriverInterface
{
    /**
     * Put a object
     *
     * @param string $localFile
     * @param string $saveTo
     * @return string|false
     */
    function put($localFile, $saveTo);
}