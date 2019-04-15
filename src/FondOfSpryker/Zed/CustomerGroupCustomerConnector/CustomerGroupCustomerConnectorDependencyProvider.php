<?php

namespace FondOfSpryker\Zed\CustomerGroupCustomerConnector;

use FondOfSpryker\Zed\CustomerGroupCustomerConnector\Dependency\Facade\CustomerGroupCustomerConnectorToCustomerGroupFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class CustomerGroupCustomerConnectorDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_CUSTOMER_GROUP = 'FACADE_CUSTOMER_GROUP';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addCustomerGroupFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCustomerGroupFacade(Container $container): Container
    {
        $container[static::FACADE_CUSTOMER_GROUP] = function (Container $container) {
            return new CustomerGroupCustomerConnectorToCustomerGroupFacadeBridge(
                $container->getLocator()->customerGroup()->facade()
            );
        };

        return $container;
    }
}
