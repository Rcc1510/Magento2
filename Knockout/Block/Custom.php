<?php

namespace Kitchen\Knockout\Block;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Kitchen\Knockout\Model\CustomerFactory;

class Custom extends \Magento\Framework\View\Element\Template implements ArgumentInterface
{
	public function __construct(\Magento\Framework\View\Element\Template\Context $context,
	CustomerFactory $customerFactory)
	{
		parent::__construct($context);
		$this->customerFactory = $customerFactory;
	}

	public function custom()
	{
		
		$model = $this->customerFactory->create();
        $collection = $model->getCollection();
		foreach ($collection as $item) {
            echo "<tr>";
            echo '<td>'. $item->getCustomerId(). '</td>';
            echo '<td>'. $item->getFirstName(). '</td>';
            echo '<td>'. $item->getLastName(). '</td>';
            echo '<td>'. $item->getEmail(). '</td>';
            echo '<td>'. $item->getGender(). '</td>';
            echo '<td>'. $item->getBirthDate(). '</td>';
            echo '<td>'. $item->getImage(). '</td>';
            echo '<td>'. $item->getAddress(). '</td>';
            echo '<td>'. $item->getIsActive(). '</td>';
            echo '<td>'. $item->getHobbies(). '</td>';
            echo '<td>'. $item->getNewsletterSubscription(). '</td>';
            echo "</tr>";
        }

	}

}
