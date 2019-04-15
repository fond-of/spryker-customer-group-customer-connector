<?php

namespace FondOfSpryker\Zed\CustomerGroupCustomerConnector\Dependency\Facade;

use Generated\Shared\Transfer\CustomerGroupCollectionTransfer;

interface CustomerGroupCustomerConnectorToCustomerGroupFacadeInterface
{
    /**
     * @param int $idCustomer
     *
     * @return \Generated\Shared\Transfer\CustomerGroupCollectionTransfer
     */
    public function getCustomerGroupCollectionByIdCustomer(int $idCustomer): CustomerGroupCollectionTransfer;
}
