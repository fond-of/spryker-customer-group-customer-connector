<?php

namespace FondOfSpryker\Zed\CustomerGroupCustomerConnector\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CustomerGroupCustomerConnector\Business\Expander\CustomerExpanderInterface;

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
     * @var \FondOfSpryker\Zed\CustomerGroupCustomerConnector\Business\Expander\CustomerExpanderInterface|\PHPUnit\Framework\MockObject\MockObject
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

        $this->customerTransferMock = $this->getMockBuilder('\\Generated\\Shared\\Transfer\\CustomerTransfer')
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerExpanderMock = $this->getMockBuilder(CustomerExpanderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerGroupCustomerConnectorFacade = new CustomerGroupCustomerConnectorFacade();

        $this->customerGroupCustomerConnectorFacade->setFactory($this->customerGroupCustomerConnectorBusinessFactoryMock);
    }

    /**
     * @return void
     */
    public function testExpandCustomer(): void
    {
        $this->customerGroupCustomerConnectorBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createCustomerExpander')
            ->willReturn($this->customerExpanderMock);

        $this->customerExpanderMock->expects($this->atLeastOnce())
            ->method('expand')
            ->with($this->customerTransferMock)
            ->willReturn($this->customerTransferMock);

        $customerTransfer = $this->customerGroupCustomerConnectorFacade->expandCustomer($this->customerTransferMock);

        $this->assertEquals($this->customerTransferMock, $customerTransfer);
    }
}
