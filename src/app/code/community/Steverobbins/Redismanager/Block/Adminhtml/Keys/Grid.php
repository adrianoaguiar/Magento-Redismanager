<?php
/**
 * Redis Management Module
 * 
 * @category   Steverobbins
 * @package    Steverobbins_Redismanager
 * @author     Steve Robbins <steven.j.robbins@gmail.com>
 * @copyright  Copyright (c) 2014 Steve Robbins (https://github.com/steverobbins)
 * @license    http://creativecommons.org/licenses/by/3.0/deed.en_US Creative Commons Attribution 3.0 Unported License
 */

class Steverobbins_Redismanager_Block_Adminhtml_Keys_Grid
     extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Initialize grid
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('keysGrid');
        $this->setDefaultSort('id');
        $this->setDefaultDir(Zend_Db_Select::SQL_DESC);
        $this->setSaveParametersInSession(true);
    }

    /**
     * Load collection
     *
     * @return Steverobbins_Redismanager_Block_Adminhtml_Keys_Grid
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel('redismanager/key_collection');
        $services = Mage::helper('redismanager')->getServices();
        $id = Mage::app()->getRequest()->getParam('id');
        $service = Mage::helper('redismanager')->getRedisInstance(
            $services[$id]['host'],
            $services[$id]['port'],
            $services[$id]['password'],
            $services[$id]['db']
        );
        $collection->service = $service;
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * Create columns
     * 
     * @return Steverobbins_Redismanager_Block_Adminhtml_Keys_Grid
     */
    protected function _prepareColumns()
    {
        $this->addColumn('id', array(
            'header' => Mage::helper('redismanager')->__('ID'),
            'align'  =>'right',
            'width'  => '50px',
            'type'   => 'number',
            'index'  => 'id',
            'filter' => false,
            'sortable'   => false,
        ));
        $this->addColumn('key', array(
            'header' => Mage::helper('redismanager')->__('Key'),
            'index'  => 'key',
            'filter' => false,
            'sortable'   => false,
        ));
        return parent::_prepareColumns();
    }

    /**
     * Get row link
     *
     * @return string
     */
    public function getRowUrl($row)
    {
        return false;
    }

    /**
     * Nothing to see here
     *
     * @return string
     */
    public function getPagerVisibility()
    {
        return false;
    }

    /**
     * Nothing to see here
     *
     * @return string
     */
    public function getMainButtonsHtml()
    {
        return false;
    }
}
