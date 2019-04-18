<?php

namespace FondOfSpryker\Zed\CustomerGroupCustomerConnector\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CustomerGroupCustomerConnector\Business\Expander\CustomerHydratorInterface;
use Generated\Shared\Transfer\CustomerTransfer;

class CustomerGroupCustomerConnectorFacadeTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CustomerGroupCustomerConnector\Business\CustomerGroupCustomerConnectorFacadeInterface
     */
    protected $customerGroupCustomerConnectorFacade;

    /**
     * @var \FondOfSpryker\Zed\CustomerGroupCustomerConnector\Business\CustomerGroupCustomerConnectorBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerGroupCustomerConnectorBusinessFactoryMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @var \FondOfSpryker\Zed\CustomerGroupCustomerConnector\Business\Expander\CustomerHydratorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerExpanderMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->customerGroupCustomerConnectorBusinessFactoryMock = $this->getMockBuilder(CustomerGroupCustomerConnectorBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerExpanderMock = $this->getMockBuilder(CustomerHydratorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerGroupCustomerConnectorFacade = new CustomerGroupCustomerConnectorFacade();

        $this->customerGroupCustomerConnectorFacade->setFactory($this->customerGroupCustomerConnectorBusinessFactoryMock);
    }

    /**
     * @return void
     */
    public function testHydrateCustomer(): void
    {
        $this->customerGroupCustomerConnectorBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createCustomerHydrator')
            ->willReturn($this->customerExpanderMock);

        $this->customerExpanderMock->expects($this->atLeastOnce())
            ->method('hydrate')
            ->with($this->customerTransferMock)
            ->willReturn($this->customerTransferMock);

        $customerTransfer = $this->customerGroupCustomerConnectorFacade->hydrateCustomer($this->customerTransferMock);

        $this->assertEquals($this->customerTransferMock, $customerTransfer);
    }
}
