<?php

namespace FondOfSpryker\Zed\CustomerGroupCustomerConnector\Business;

use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfSpryker\Zed\CustomerGroupCustomerConnector\Business\CustomerGroupCustomerConnectorBusinessFactory getFactory()
 */
class CustomerGroupCustomerConnectorFacade extends AbstractFacade implements CustomerGroupCustomerConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    public function expandCustomer(CustomerTransfer $customerTransfer): CustomerTransfer
    {
        return $this->getFactory()->createCustomerExpander()->expand($customerTransfer);
    }
}
