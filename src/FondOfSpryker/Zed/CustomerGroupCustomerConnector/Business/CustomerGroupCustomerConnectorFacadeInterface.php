<?php

namespace FondOfSpryker\Zed\CustomerGroupCustomerConnector\Business;

use Generated\Shared\Transfer\CustomerTransfer;

interface CustomerGroupCustomerConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    public function expandCustomer(CustomerTransfer $customerTransfer): CustomerTransfer;
}
