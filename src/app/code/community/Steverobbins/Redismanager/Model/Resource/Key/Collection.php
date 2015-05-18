<?php
/**
 * Redis Management Module
 *
 * PHP Version 5
 *
 * @category   Steverobbins
 * @package    Steverobbins_Redismanager
 * @author     Steve Robbins <steven.j.robbins@gmail.com>
 * @copyright  Copyright (c) 2014 Steve Robbins (https://github.com/steverobbins)
 * @license    http://creativecommons.org/licenses/by/3.0/deed.en_US Creative Commons Attribution 3.0 Unported License
 */

class Steverobbins_Redismanager_Model_Resource_Key_Collection
    extends Varien_Data_Collection
{
    /**
     * Instance of Redis
     *
     * @return Steverobbins_Redismanager_Model_Backend_Redis_Cm|Steverobbins_Redismanager_Model_Backend_Redis_Mage
     */
    public $service;

    protected $_isLoaded = false;

    /**
     * Load collection of keys
     *
     * @return Steverobbins_Redismanager_Model_Resource_Key_Collection
     */
    public function load($printQuery = false, $logQuery = false)
    {
        if (!$this->service || $this->_isLoaded) {
            return $this;
        }
        foreach ($this->service->getIds() as $id => $key) {
            $item = new Varien_Object(array(
                'id'   => $id + 1,
                'key'  => $key
            ));
            $this->addItem($item);
        }
        $this->_isLoaded = true;
        return $this;
    }
}
