<?php

namespace Anh\SapeBundle\Sape;

class SapeClient extends \SAPE_client
{
    /**
     * @var string
     */
    private $cacheDir;

    /**
     * @param $sapeUser
     * @param $cacheDir
     * @param null $options
     * @throws \Exception
     */
    public function __construct($sapeUser, $cacheDir, $options = null)
    {
        $this->cacheDir = $cacheDir;

        if (!is_dir($cacheDir)) {
            if (!mkdir($cacheDir, 0777, true)) {
                throw new \Exception(sprintf("Unable to create directory '%s'", $cacheDir));
            }
        }

        if (!defined('_SAPE_USER')) {
            define('_SAPE_USER', $sapeUser);
        }

        // ugly hack to prevent 'Undefined index' notice outside of request scope
        if (!isset($_SERVER['SERVER_SOFTWARE'])) {
            $_SERVER['SERVER_SOFTWARE'] = 'Unknown';
        }

        if (!isset($_SERVER['REQUEST_URI'])) {
            $_SERVER['REQUEST_URI'] = '/';
        }

        if (!isset($_SERVER['HTTP_HOST'])) {
            $_SERVER['HTTP_HOST'] = 'localhost';
        }

        parent::SAPE_client($options);
    }

    /**
     * @return string
     */
    public function _get_db_file()
    {
        if ($this->_multi_site) {
            return $this->cacheDir . '/' . $this->_host . '.links.db';
        }

        return $this->cacheDir . '/links.db';
    }
}
