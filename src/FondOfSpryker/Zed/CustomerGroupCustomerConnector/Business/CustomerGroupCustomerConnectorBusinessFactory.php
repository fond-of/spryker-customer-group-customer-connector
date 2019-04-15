<?php

namespace FondOfSpryker\Zed\CustomerGroupCustomerConnector\Business;

use FondOfSpryker\Zed\CustomerGroupCustomerConnector\Business\Expander\CustomerExpander;
use FondOfSpryker\Zed\CustomerGroupCustomerConnector\Business\Expander\CustomerExpanderInterface;
use FondOfSpryker\Zed\CustomerGroupCustomerConnector\CustomerGroupCustomerConnectorDependencyProvider;
use FondOfSpryker\Zed\CustomerGroupCustomerConnector\Dependency\Facade\CustomerGroupCustomerConnectorToCustomerGroupFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class CustomerGroupCustomerConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\CustomerGroupCustomerConnector\Business\Expander\CustomerExpanderInterface
     */
    public function createCustomerExpander(): CustomerExpanderInterface
    {
        return new CustomerExpander(
            $this->getCustomerGroupFacade()
        );
    }

    /**
     * @throws
     *
     * @return \FondOfSpryker\Zed\CustomerGroupCustomerConnector\Dependency\Facade\CustomerGroupCustomerConnectorToCustomerGroupFacadeInterface
     */
    protected function getCustomerGroupFacade(): CustomerGroupCustomerConnectorToCustomerGroupFacadeInterface
    {
        return $this->getProvidedDependency(CustomerGroupCustomerConnectorDependencyProvider::FACADE_CUSTOMER_GROUP);
    }
}
