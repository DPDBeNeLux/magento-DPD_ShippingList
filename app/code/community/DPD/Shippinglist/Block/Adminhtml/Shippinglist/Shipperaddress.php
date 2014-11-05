<?php
 
class DPD_Shippinglist_Block_Adminhtml_Shippinglist_Shipperaddress extends Mage_Core_Block_Text
{
    public function __construct()
    {
        $this->_blockGroup = 'dpd_shippinglist';
        $this->_controller = 'adminhtml_shippinglist_shipperaddress';
        $this->_headerText = Mage::helper('adminhtml')->__('Shipper Address');
		
        parent::__construct();
		
		$shipperInfo = $this->_getSenderInformation();
		
		$this->addText('<div id="dpd_shippinglist_shipper_address">');
		$this->addText('<h3>Client Address</h3>');
		$this->addText($shipperInfo['name1'].'<br \>');
		$this->addText($shipperInfo['street'].' '.$shipperInfo['houseNo'].'<br \>');
		$this->addText($shipperInfo['country'].'-'.$shipperInfo['zipCode'].' '.$shipperInfo['city'].'<br \>');
		$this->addText('</div>');
    }
	
	private function _getSenderInformation()
    {
		$dpdShippingModel = new DPD_Shipping_Model_Webservice();
		
        return array(
            'name1' => Mage::getStoreConfig($dpdShippingModel::XML_PATH_DPD_SENDER_NAME),
            'street' => Mage::getStoreConfig($dpdShippingModel::XML_PATH_DPD_SENDER_STREET),
            'houseNo' => Mage::getStoreConfig($dpdShippingModel::XML_PATH_DPD_SENDER_STREETNUMBER),
            'country' => Mage::getStoreConfig($dpdShippingModel::XML_PATH_DPD_SENDER_COUNTRY),
            'zipCode' => Mage::getStoreConfig($dpdShippingModel::XML_PATH_DPD_SENDER_ZIPCODE),
            'city' => Mage::getStoreConfig($dpdShippingModel::XML_PATH_DPD_SENDER_CITY)
        );
    }
}
