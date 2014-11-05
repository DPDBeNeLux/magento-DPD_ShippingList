<?php
/**
 * @package            DPD
 * @subpackage       Shippinlist
 * @category            Report
 * @author               Michiel Van Gucht
 */
class DPD_Shippinglist_Model_Observer
{
    public function addMassAction($observer)
    {
        $block = $observer->getEvent()->getBlock();
        if(get_class($block) =='Mage_Adminhtml_Block_Widget_Grid_Massaction'
            && $block->getRequest()->getControllerName() == 'dpdorder')
        {
            $block->addItem('shippingList', array(
                'label' => 'Print Shipping List',
                'url' => Mage::helper('adminhtml')->getUrl('adminhtml/shippinglist')
            ));
        }
    }
}
