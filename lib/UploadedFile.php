<?php

namespace Hejiang\Storage;


class UploadedFile extends \yii\web\UploadedFile
{
    /**
     * Driver interface
     *
     * @var \Hejiang\Drivers\DriverInterface
     */
    protected $driver;

    /**
     * Storage base path
     *
     * @var string
     */
    protected $basePath;

    /**
     * Override `saveAs` method to call specified driver
     *
     * @param string $file
     * @param boolean $deleteTempFile
     * @return string|false The URL to access this file
     */
    public function saveAs($file, $deleteTempFile = true)
    {
        $result = false;
        if ($this->error == UPLOAD_ERR_OK && is_uploaded_file($this->tempName)) {
            $result = $this->driver->put($this->tempName, $this->getFullPath($file));
        }
        if ($result && $deleteTempFile) {
            $this->deleteTempFile();
        }
        return $result;
    }

    /**
     * Delete uploaded temp file
     *
     * @return bool
     */
    public function deleteTempFile()
    {
        return unlink($this->tempName);
    }

    /**
     * Save the uploaded file with original file extension
     *
     * @param string $baseName
     * @param boolean $deleteTempFile
     * @return string|false The URL to access this file
     */
    public function saveWithOriginalExtension($baseName, $deleteTempFile = true)
    {
        return $this->saveAs($baseName . '.' . $this->getExtension(), $deleteTempFile);
    }

    protected function getFullPath($file)
    {
        return rtrim($this->basePath, '/')
                . '/'
                . ltrim($file, '/');
    }

    public static function getInstanceByStorage($name, $driver, $basePath)
    {
        $instance = parent::getInstanceByName($name);
        if ($instance === null) {
            return null;
        }
        $instance->driver = $driver;
        $instance->basePath = $basePath;
        return $instance;
    }
}