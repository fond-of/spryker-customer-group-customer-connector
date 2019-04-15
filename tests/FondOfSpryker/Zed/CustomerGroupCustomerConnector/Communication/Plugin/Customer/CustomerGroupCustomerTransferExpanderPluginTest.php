<?php

namespace FondOfSpryker\Zed\CustomerGroupCustomerConnector\Communication\Plugin\Customer;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CustomerGroupCustomerConnector\Business\CustomerGroupCustomerConnectorFacade;

class CustomerGroupCustomerTransferExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CustomerGroupCustomerConnector\Communication\Plugin\Customer\CustomerGroupCustomerTransferExpanderPlugin
     */
    protected $customerGroupCustomerTransferExpanderPlugin;

    /**
     * @var \FondOfSpryker\Zed\CustomerGroupCustomerConnector\Business\CustomerGroupCustomerConnectorFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerGroupCustomerConnectorFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->customerTransferMock = $this->getMockBuilder('\\Generated\\Shared\\Transfer\\CustomerTransfer')
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerGroupCustomerConnectorFacadeMock = $this->getMockBuilder(CustomerGroupCustomerConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerGroupCustomerTransferExpanderPlugin = new CustomerGroupCustomerTransferExpanderPlugin();

        $this->customerGroupCustomerTransferExpanderPlugin->setFacade($this->customerGroupCustomerConnectorFacadeMock);
    }

    /**
     * @return void
     */
    public function testExpandTransfer(): void
    {
        $this->customerGroupCustomerConnectorFacadeMock->expects($this->atLeastOnce())
            ->method('expandCustomer')
            ->with($this->customerTransferMock)
            ->willReturn($this->customerTransferMock);

        $customerTransfer = $this->customerGroupCustomerTransferExpanderPlugin->expandTransfer($this->customerTransferMock);

        $this->assertEquals(
            $this->customerTransferMock,
            $customerTransfer
        );
    }
}
