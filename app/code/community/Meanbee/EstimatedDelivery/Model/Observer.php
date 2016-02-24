<?php
class Meanbee_EstimatedDelivery_Model_Observer
{
    /**
     * Save chosen slot to quote object.
     *
     * @param  Varien_Event_Observer $observer
     */
    public function saveQuoteBefore($observer)
    {
        $quote = $observer->getQuote();
        $fields = Mage::app()->getFrontController()->getRequest()->getPost();
        $year = isset($fields['slot-year']) ? $fields['slot-year'] : null;
        $month = isset($fields['slot-month']) ? str_pad($fields['slot-month'] + 1, 2, '0', STR_PAD_LEFT) : null;
        $week = isset($fields['slot-week']) ? $fields['slot-week'] + 1  : null;
        $day = isset($fields['slot-day']) ? str_pad($fields['slot-day'] + 1, 2, '0', STR_PAD_LEFT) : null;
        $deliverySlot = null;
        if ($year && $month && $day) {
            $deliverySlot = "{$year}-{$month}-{$day}";
        } else if ($year && $month && $week) {
            // NOT IMPLEMENTED
        } else if ($year && $month) {
            $deliverySlot = "{$year}-{$month}";
        } else return;
        $quote->setDeliverySlot($deliverySlot);
    }


}