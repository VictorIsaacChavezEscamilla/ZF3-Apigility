<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Agenda;

class Module
{
    const VERSION = '1.0.2';
    const BASE_URL_API_REST = 'http://localhost:8080';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}
