<?php

namespace FondOfSpryker\Zed\CustomerGroupCustomerConnector\Business\Expander;

use Generated\Shared\Transfer\CustomerTransfer;

interface CustomerExpanderInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    public function expand(CustomerTransfer $customerTransfer): CustomerTransfer;
}
