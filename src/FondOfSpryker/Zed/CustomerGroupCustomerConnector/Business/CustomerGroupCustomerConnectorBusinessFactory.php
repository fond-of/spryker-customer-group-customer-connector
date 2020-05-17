<?php

namespace FondOfSpryker\Zed\CustomerGroupCustomerConnector\Business;

use FondOfSpryker\Zed\CustomerGroupCustomerConnector\Business\Expander\CustomerHydrator;
use FondOfSpryker\Zed\CustomerGroupCustomerConnector\Business\Expander\CustomerHydratorInterface;
use FondOfSpryker\Zed\CustomerGroupCustomerConnector\CustomerGroupCustomerConnectorDependencyProvider;
use FondOfSpryker\Zed\CustomerGroupCustomerConnector\Dependency\Facade\CustomerGroupCustomerConnectorToCustomerGroupFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class CustomerGroupCustomerConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\CustomerGroupCustomerConnector\Business\Expander\CustomerHydratorInterface
     */
    public function createCustomerHydrator(): CustomerHydratorInterface
    {
        return new CustomerHydrator(
            $this->getCustomerGroupFacade()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\CustomerGroupCustomerConnector\Dependency\Facade\CustomerGroupCustomerConnectorToCustomerGroupFacadeInterface
     */
    protected function getCustomerGroupFacade(): CustomerGroupCustomerConnectorToCustomerGroupFacadeInterface
    {
        return $this->getProvidedDependency(CustomerGroupCustomerConnectorDependencyProvider::FACADE_CUSTOMER_GROUP);
    }
}
