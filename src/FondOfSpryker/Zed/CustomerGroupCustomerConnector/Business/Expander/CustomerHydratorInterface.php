<?php

namespace FondOfSpryker\Zed\CustomerGroupCustomerConnector\Business\Expander;

use Generated\Shared\Transfer\CustomerTransfer;

interface CustomerHydratorInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    public function hydrate(CustomerTransfer $customerTransfer): CustomerTransfer;
}
