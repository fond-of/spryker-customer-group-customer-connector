<?php

namespace FondOfSpryker\Zed\CustomerGroupCustomerConnector\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CustomerGroupCollectionTransfer;
use Spryker\Zed\CustomerGroup\Business\CustomerGroupFacadeInterface;

class CustomerGroupCustomerConnectorToCustomerGroupFacadeBridgeTest extends Unit
{
    /**
     * @var \Spryker\Zed\CustomerGroup\Business\CustomerGroupFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerGroupFacadeMock;

    /**
     * @var \FondOfSpryker\Zed\CustomerGroupCustomerConnector\Dependency\Facade\CustomerGroupCustomerConnectorToCustomerGroupFacadeBridge
     */
    protected $customerGroupCustomerConnectorToCustomerGroupFacadeBridge;

    /**
     * @var \Generated\Shared\Transfer\CustomerGroupCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerGroupCollectionTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->customerGroupFacadeMock = $this->getMockBuilder(CustomerGroupFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerGroupCollectionTransferMock = $this->getMockBuilder(CustomerGroupCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerGroupCustomerConnectorToCustomerGroupFacadeBridge = new CustomerGroupCustomerConnectorToCustomerGroupFacadeBridge(
            $this->customerGroupFacadeMock
        );
    }

    /**
     * @return void
     */
    public function testGetCustomerGroupCollectionByIdCustomer(): void
    {
        $idCustomer = 1;

        $this->customerGroupFacadeMock->expects($this->atLeastOnce())
            ->method('getCustomerGroupCollectionByIdCustomer')
            ->with($idCustomer)
            ->willReturn($this->customerGroupCollectionTransferMock);

        $customerGroupCollectionTransferMock = $this->customerGroupCustomerConnectorToCustomerGroupFacadeBridge
            ->getCustomerGroupCollectionByIdCustomer($idCustomer);

        $this->assertEquals(
            $this->customerGroupCollectionTransferMock,
            $customerGroupCollectionTransferMock
        );
    }
}
