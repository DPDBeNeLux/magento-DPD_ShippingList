<?php
 
class DPD_Shippinglist_Block_Adminhtml_Shippinglist_Items_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
 
    public function __construct()
    {
        parent::__construct();
        $this->setId('shippinglist_items');
        $this->setDefaultSort('item_id');
		$this->setFilterVisibility(false);
    }
 
	private function getCarrierCode($carrierCode)
	{
		switch($carrierCode)
		{
			case 'dpdparcelshops':
				return 'Parcelshop';
				break;
			case 'dpdclassic':
				return 'Home';
				break;
			default:
				return '';
		}
	}
 
    protected function _prepareCollection()
    {
		$orderIds = $this->getRequest()->getParam('entity_id');
		
		$collection = Mage::getModel('sales/order_shipment_track')->getCollection()
			->addAttributeToFilter('main_table.entity_id', array('in' => $orderIds))
			->addAttributeToFilter('order_billing_address.address_type', 'billing');
			
		$collection->getSelect()->join( 
			array('order_details'=>'sales_flat_order'), 
			'main_table.order_id = order_details.entity_id', 
			array('main_table.track_number', 'main_table.carrier_code', 'order_details.increment_id', 'order_details.weight')
		);
		
		$collection->getSelect()->join( 
			array('order_billing_address'=>'sales_flat_order_address'), 
			'main_table.order_id = order_billing_address.parent_id', 
			array('main_table.track_number', 'main_table.carrier_code', 'order_billing_address.firstname', 'order_billing_address.lastname', 'order_billing_address.street', 'order_billing_address.country_id', 'order_billing_address.postcode', 'order_billing_address.city')
		);
			
        $this->setCollection($collection);
		
		$i = 1;
		foreach ($this->getCollection() as $item) {
			$item['row_count'] = $i;
			$item['track_number'] = explode('-', $item['track_number'])[1];
			$item['carrier_code'] = $this->getCarrierCode($item['carrier_code']);
			
			$i++;
        }
		
        parent::_prepareCollection();
        return $this;
    }
 
 
    protected function _prepareColumns()
    {
        $this->addColumn('row_count', array(
            'header' => Mage::helper('dpd_shippinglist')->__('Count'),
            'sortable' => true,
            'width' => '4',
            'index' => 'row_count'
        ));
 
		$this->addColumn('track_number', array(
            'header' => Mage::helper('dpd_shippinglist')->__('Track Number'),
            'sortable' => true,
            'width' => '15',
            'index' => 'track_number',
            'type'  => 'text'
        ));        
		
		$this->addColumn('carrier_code', array(
            'header' => Mage::helper('dpd_shippinglist')->__('Delivery Type'),
            'sortable' => true,
            'width' => '15',
            'index' => 'carrier_code',
            'type'  => 'text'
        ));     
		
		$this->addColumn('firstname', array(
            'header' => Mage::helper('dpd_shippinglist')->__('First Name'),
            'sortable' => true,
            'width' => '25',
            'index' => 'firstname',
            'type'  => 'text'
        ));
 		
		$this->addColumn('lastname', array(
            'header' => Mage::helper('dpd_shippinglist')->__('Last Name'),
            'sortable' => true,
            'width' => '25',
            'index' => 'lastname',
            'type'  => 'text'
        ));
		 		
		$this->addColumn('street', array(
            'header' => Mage::helper('dpd_shippinglist')->__('Address'),
            'sortable' => true,
            'width' => '50',
            'index' => 'street',
            'type'  => 'text'
        ));

		$this->addColumn('country_id', array(
            'header' => Mage::helper('dpd_shippinglist')->__('Country'),
            'sortable' => true,
            'width' => '2',
            'index' => 'country_id',
            'type'  => 'text'
        ));

		$this->addColumn('postcode', array(
            'header' => Mage::helper('dpd_shippinglist')->__('Zip Code'),
            'sortable' => true,
            'width' => '10',
            'index' => 'postcode',
            'type'  => 'text'
        ));

		$this->addColumn('city', array(
            'header' => Mage::helper('dpd_shippinglist')->__('City'),
            'sortable' => true,
            'width' => '30',
            'index' => 'city',
            'type'  => 'text'
        ));		
		
		$this->addColumn('increment_id', array(
            'header' => Mage::helper('dpd_shippinglist')->__('Ref 1'),
            'sortable' => true,
            'width' => '35',
            'index' => 'increment_id',
            'type'  => 'text'
        ));
		
		$this->addColumn('weight', array(
            'header' => Mage::helper('dpd_shippinglist')->__('Weight'),
            'sortable' => true,
            'width' => '35',
            'index' => 'weight',
            'type'  => 'text'
        ));

        return parent::_prepareColumns();
    }
 
 
}