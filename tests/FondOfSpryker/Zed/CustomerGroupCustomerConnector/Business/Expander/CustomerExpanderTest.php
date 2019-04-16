<?php

namespace FondOfSpryker\Zed\CustomerGroupCustomerConnector\Business\Expander;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CustomerGroupCustomerConnector\Dependency\Facade\CustomerGroupCustomerConnectorToCustomerGroupFacadeInterface;

class CustomerExpanderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CustomerGroupCustomerConnector\Business\Expander\CustomerHydrator
     */
    protected $customerExpander;

    /**
     * @var \FondOfSpryker\Zed\CustomerGroupCustomerConnector\Dependency\Facade\CustomerGroupCustomerConnectorToCustomerGroupFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerGroupFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

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

        $this->customerTransferMock = $this->getMockBuilder('\\Generated\\Shared\\Transfer\\CustomerTransfer')
            ->disableOriginalConstructor()
            ->setMethods(['getIdCustomer', 'setCustomerGroupCollection'])
            ->getMock();

        $this->customerGroupCollectionTransferMock = $this->getMockBuilder('\\Generated\\Shared\\Transfer\\CustomerGroupCollectionTransfer')
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerGroupFacadeMock = $this->getMockBuilder(CustomerGroupCustomerConnectorToCustomerGroupFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerExpander = new CustomerHydrator($this->customerGroupFacadeMock);
    }

    /**
     * @return void
     */
    public function testExpandWithoutCustomerId(): void
    {
        $this->customerTransferMock->expects($this->atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn(null);

        $this->customerGroupFacadeMock->expects($this->never())
            ->method('getCustomerGroupCollectionByIdCustomer');

        $this->customerTransferMock->expects($this->never())
            ->method('setCustomerGroupCollection');

        $customerTransfer = $this->customerExpander->hydrate($this->customerTransferMock);

        $this->assertEquals(
            $this->customerTransferMock,
            $customerTransfer
        );
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $idCustomer = 1;

        $this->customerTransferMock->expects($this->atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($idCustomer);

        $this->customerGroupFacadeMock->expects($this->atLeastOnce())
            ->method('getCustomerGroupCollectionByIdCustomer')
            ->with($idCustomer)
            ->willReturn($this->customerGroupCollectionTransferMock);

        $this->customerTransferMock->expects($this->atLeastOnce())
            ->method('setCustomerGroupCollection')
            ->with($this->customerGroupCollectionTransferMock);

        $customerTransfer = $this->customerExpander->hydrate($this->customerTransferMock);

        $this->assertEquals(
            $this->customerTransferMock,
            $customerTransfer
        );
    }
}
