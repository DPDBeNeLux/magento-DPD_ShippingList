<?php
/**
 * @package            DPD
 * @subpackage       Shippinglist
 * @category            Report
 * @author               Michiel Van Gucht
 */
class DPD_Shippinglist_Adminhtml_ShippinglistController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout()->_setActiveMenu('sales/sales');
		
		$signatureBlock = $this->getLayout()
			->createBlock('core/text');
			
		$signatureBlock->addText('<div id="dpd_shippinglist_signature">');
		$signatureBlock->addText('Signature __________________________________');
		$signatureBlock->addText('</div>');
		
		$logoUrl = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).'adminhtml/default/default/images/dpd/DPDLogoSmall.png';
		
		$logoBlock = $this->getLayout()
			->createBlock('core/text');
			
		$logoBlock->addText('<div id="dpd_shippinglist_logo">');
		$logoBlock->addText('<img src="'.$logoUrl .'">');
		$logoBlock->addText('</div>');
       
		
		$this->_addContent($this->getLayout()->createBlock('dpd_shippinglist/adminhtml_shippinglist_shipperaddress'));
		$this->_addContent($logoBlock);
		$this->_addContent($this->getLayout()->createBlock('dpd_shippinglist/adminhtml_shippinglist_items'));
		$this->_addContent($signatureBlock);
		
        $this->renderLayout();
    }
}
