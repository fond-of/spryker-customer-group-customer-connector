<?php

namespace FondOfSpryker\Zed\CustomerGroupCustomerConnector\Dependency\Facade;

use Generated\Shared\Transfer\CustomerGroupCollectionTransfer;
use Spryker\Zed\CustomerGroup\Business\CustomerGroupFacadeInterface;

class CustomerGroupCustomerConnectorToCustomerGroupFacadeBridge implements CustomerGroupCustomerConnectorToCustomerGroupFacadeInterface
{
    /**
     * @var \Spryker\Zed\CustomerGroup\Business\CustomerGroupFacadeInterface
     */
    protected $customerGroupFacade;

    /**
     * @param \Spryker\Zed\CustomerGroup\Business\CustomerGroupFacadeInterface $customerGroupFacade
     */
    public function __construct(CustomerGroupFacadeInterface $customerGroupFacade)
    {
        $this->customerGroupFacade = $customerGroupFacade;
    }

    /**
     * @param int $idCustomer
     *
     * @return \Generated\Shared\Transfer\CustomerGroupCollectionTransfer
     */
    public function getCustomerGroupCollectionByIdCustomer(int $idCustomer): CustomerGroupCollectionTransfer
    {
        return $this->customerGroupFacade->getCustomerGroupCollectionByIdCustomer($idCustomer);
    }
}
