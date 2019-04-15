<?php

namespace FondOfSpryker\Zed\CustomerGroupCustomerConnector\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CustomerGroupCustomerConnector\Business\Expander\CustomerExpander;
use FondOfSpryker\Zed\CustomerGroupCustomerConnector\CustomerGroupCustomerConnectorDependencyProvider;
use FondOfSpryker\Zed\CustomerGroupCustomerConnector\Dependency\Facade\CustomerGroupCustomerConnectorToCustomerGroupFacadeInterface;
use Spryker\Zed\Kernel\Container;

class CustomerGroupCustomerConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \Spryker\Zed\Kernel\Container|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $containerMock;

    /**
     * @var \FondOfSpryker\Zed\CustomerGroupCustomerConnector\Dependency\Facade\CustomerGroupCustomerConnectorToCustomerGroupFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerGroupFacadeMock;

    /**
     * @var \FondOfSpryker\Zed\CustomerGroupCustomerConnector\Business\CustomerGroupCustomerConnectorBusinessFactory
     */
    protected $customerGroupCustomerConnectorBusinessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerGroupFacadeMock = $this->getMockBuilder(CustomerGroupCustomerConnectorToCustomerGroupFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerGroupCustomerConnectorBusinessFactory = new CustomerGroupCustomerConnectorBusinessFactory();

        $this->customerGroupCustomerConnectorBusinessFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateCustomerExpander(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->with(CustomerGroupCustomerConnectorDependencyProvider::FACADE_CUSTOMER_GROUP)
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(CustomerGroupCustomerConnectorDependencyProvider::FACADE_CUSTOMER_GROUP)
            ->willReturn($this->customerGroupFacadeMock);

        $customerExpander = $this->customerGroupCustomerConnectorBusinessFactory->createCustomerExpander();

        $this->assertInstanceOf(CustomerExpander::class, $customerExpander);
    }
}
