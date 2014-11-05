<?php
 
class DPD_Shippinglist_Block_Adminhtml_Shippinglist_Items extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'dpd_shippinglist';
        $this->_controller = 'adminhtml_shippinglist_items';
        $this->_headerText = Mage::helper('adminhtml')->__('DPD Shipping List');
		
        parent::__construct();
        $this->_removeButton('add');
    }
}