<?php

namespace FondOfSpryker\Zed\CustomerGroupCustomerConnector;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CustomerGroupCustomerConnector\Dependency\Facade\CustomerGroupCustomerConnectorToCustomerGroupFacadeBridge;
use Spryker\Shared\Kernel\BundleProxy;
use Spryker\Zed\CustomerGroup\Business\CustomerGroupFacadeInterface;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Locator;

class CustomerGroupCustomerConnectorDependencyProviderTest extends Unit
{
    /**
     * @var \Spryker\Zed\Kernel\Locator|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $locatorMock;

    /**
     * @var \Spryker\Zed\Kernel\Container|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $containerMock;

    /**
     * @var \Spryker\Shared\Kernel\BundleProxy|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $bundleProxyMock;

    /**
     * @var \Spryker\Zed\CustomerGroup\Business\CustomerGroupFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerGroupFacadeMock;

    /**
     * @var \FondOfSpryker\Zed\CustomerGroupCustomerConnector\CustomerGroupCustomerConnectorDependencyProvider
     */
    protected $customerGroupCustomerConnectorDependencyProvider;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->setMethodsExcept(['factory', 'set', 'offsetSet', 'get', 'offsetGet'])
            ->getMock();

        $this->locatorMock = $this->getMockBuilder(Locator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bundleProxyMock = $this->getMockBuilder(BundleProxy::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerGroupFacadeMock = $this->getMockBuilder(CustomerGroupFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerGroupCustomerConnectorDependencyProvider = new CustomerGroupCustomerConnectorDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideBusinessLayerDependencies(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('getLocator')
            ->willReturn($this->locatorMock);

        $this->locatorMock->expects($this->atLeastOnce())
            ->method('__call')
            ->with('customerGroup')
            ->willReturn($this->bundleProxyMock);

        $this->bundleProxyMock->expects($this->atLeastOnce())
            ->method('__call')
            ->with('facade')
            ->willReturn($this->customerGroupFacadeMock);

        $this->assertEquals(
            $this->containerMock,
            $this->customerGroupCustomerConnectorDependencyProvider->provideBusinessLayerDependencies($this->containerMock)
        );

        $this->assertInstanceOf(
            CustomerGroupCustomerConnectorToCustomerGroupFacadeBridge::class,
            $this->containerMock[CustomerGroupCustomerConnectorDependencyProvider::FACADE_CUSTOMER_GROUP]
        );
    }
}
