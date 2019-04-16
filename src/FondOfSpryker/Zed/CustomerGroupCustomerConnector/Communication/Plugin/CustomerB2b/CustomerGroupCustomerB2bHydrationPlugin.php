<?php

namespace FondOfSpryker\Zed\CustomerGroupCustomerConnector\Communication\Plugin\CustomerB2b;

use FondOfSpryker\Zed\CustomerB2b\Dependency\Plugin\CustomerB2bHydrationPluginInterface;
use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\CustomerGroupCustomerConnector\Business\CustomerGroupCustomerConnectorFacadeInterface getFacade()
 */
class CustomerGroupCustomerB2bHydrationPlugin extends AbstractPlugin implements CustomerB2bHydrationPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    public function hydrate(CustomerTransfer $customerTransfer): CustomerTransfer
    {
        $customerTransfer = $this->getFacade()->hydrateCustomer($customerTransfer);

        return $customerTransfer;
    }
}
