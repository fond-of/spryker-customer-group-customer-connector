<?php

namespace FondOfSpryker\Zed\CustomerGroupCustomerConnector\Communication\Plugin\CustomerB2b;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CustomerGroupCustomerConnector\Business\CustomerGroupCustomerConnectorFacade;

class CustomerGroupCustomerB2bHydrationPluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CustomerGroupCustomerConnector\Communication\Plugin\CustomerB2b\CustomerGroupCustomerB2bHydrationPlugin
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

        $this->customerGroupCustomerTransferExpanderPlugin = new CustomerGroupCustomerB2bHydrationPlugin();

        $this->customerGroupCustomerTransferExpanderPlugin->setFacade($this->customerGroupCustomerConnectorFacadeMock);
    }

    /**
     * @return void
     */
    public function testExpandTransfer(): void
    {
        $this->customerGroupCustomerConnectorFacadeMock->expects($this->atLeastOnce())
            ->method('hydrateCustomer')
            ->with($this->customerTransferMock)
            ->willReturn($this->customerTransferMock);

        $customerTransfer = $this->customerGroupCustomerTransferExpanderPlugin->hydrate($this->customerTransferMock);

        $this->assertEquals(
            $this->customerTransferMock,
            $customerTransfer
        );
    }
}
