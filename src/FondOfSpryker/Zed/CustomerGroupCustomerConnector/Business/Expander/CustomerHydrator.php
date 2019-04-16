<?php

namespace FondOfSpryker\Zed\CustomerGroupCustomerConnector\Business\Expander;

use FondOfSpryker\Zed\CustomerGroupCustomerConnector\Dependency\Facade\CustomerGroupCustomerConnectorToCustomerGroupFacadeInterface;
use Generated\Shared\Transfer\CustomerTransfer;

class CustomerHydrator implements CustomerHydratorInterface
{
    /**
     * @var \FondOfSpryker\Zed\CustomerGroupCustomerConnector\Dependency\Facade\CustomerGroupCustomerConnectorToCustomerGroupFacadeInterface
     */
    protected $customerGroupFacade;

    /**
     * @param \FondOfSpryker\Zed\CustomerGroupCustomerConnector\Dependency\Facade\CustomerGroupCustomerConnectorToCustomerGroupFacadeInterface $customerGroupFacade
     */
    public function __construct(CustomerGroupCustomerConnectorToCustomerGroupFacadeInterface $customerGroupFacade)
    {
        $this->customerGroupFacade = $customerGroupFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    public function hydrate(CustomerTransfer $customerTransfer): CustomerTransfer
    {
        $idCustomer = $customerTransfer->getIdCustomer();

        if ($idCustomer === null) {
            return $customerTransfer;
        }

        $customerGroupCollectionTransfer = $this->customerGroupFacade->getCustomerGroupCollectionByIdCustomer($idCustomer);

        $customerTransfer->setCustomerGroupCollection($customerGroupCollectionTransfer);

        return $customerTransfer;
    }
}
