<?php

namespace Hejiang\Storage\Components;

use Hejiang\Storage\UploadedFile;

/**
 * Storage component
 * 
 * @property \Hejiang\Drivers\DriverInterface $driver
 * @property string $basePath
 */
class StorageComponent extends \yii\base\Component
{
    protected $_driver;

    public $_basePath;

    public function getDriver()
    {
        if ($this->_driver === null) {
            $this->setDriver([
                'class' => 'Hejiang\Storage\Drivers\Local'
            ]);
        }
        return $this->_driver;
    }

    public function setDriver($value)
    {
        if (is_array($value)) {
            $this->_driver = \Yii::createObject($value);
        } else {
            $this->_driver = $value;
        }
    }

    public function getBasePath()
    {
        return $this->_basePath;
    }

    public function setBasePath($value)
    {
        $this->_basePath = $value;
    }

    /**
     * Uploaded file getter
     *
     * @param string $name
     * @return UploadedFile
     */
    public function getUploadedFile($name)
    {
        return UploadedFile::getInstanceByStorage($name, $this->driver, $this->basePath);
    }

}