<?php

namespace PyzTest\Zed\Antelope\Communication;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationResponseTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;
use Pyz\Zed\Antelope\Communication\Controller\GatewayController;
use ReflectionProperty;

/**
 * @group PyzTest
 * @group Zed
 * @group Antelope
 * @group Communication
 * @group GatewayControllerTest
 */
class GatewayControllerTest extends Unit
{
    protected GatewayController $gatewayController;

    protected AntelopeFacadeInterface $antelopeFacadeMock;

    public function testGetAntelopeLocationActionReturnsFacadeResponse(): void
    {
        // Arrange
        $criteriaTransfer = (new AntelopeLocationCriteriaTransfer())->setIdAntelopeLocation(1);
        $expectedResponse = (new AntelopeLocationResponseTransfer())
            ->setIsSuccessful(true)
            ->setAntelopeLocation((new AntelopeLocationTransfer())->setIdAntelopeLocation(1)->setLocationName('Serengeti'));

        $this->antelopeFacadeMock->expects($this->once())
            ->method('getAntelopeLocation')
            ->with($criteriaTransfer)
            ->willReturn($expectedResponse);

        // Act
        $result = $this->gatewayController->getAntelopeLocationAction($criteriaTransfer);

        // Assert
        $this->assertSame($expectedResponse, $result);
        $this->assertTrue($result->getIsSuccessful());
        $this->assertSame('Serengeti', $result->getAntelopeLocation()->getLocationName());
    }

    public function testGetAntelopeLocationActionReturnsUnsuccessfulResponseWhenNotFound(): void
    {
        // Arrange
        $criteriaTransfer = (new AntelopeLocationCriteriaTransfer())->setIdAntelopeLocation(99999);
        $this->antelopeFacadeMock->method('getAntelopeLocation')
            ->willReturn((new AntelopeLocationResponseTransfer())->setIsSuccessful(false));

        // Act
        $result = $this->gatewayController->getAntelopeLocationAction($criteriaTransfer);

        // Assert
        $this->assertFalse($result->getIsSuccessful());
        $this->assertNull($result->getAntelopeLocation());
    }

    protected function _before(): void
    {
        parent::_before();

        $this->antelopeFacadeMock = $this->createMock(AntelopeFacadeInterface::class);
        $this->gatewayController = new GatewayController();
        (new ReflectionProperty(GatewayController::class, 'facade'))->setValue($this->gatewayController, $this->antelopeFacadeMock);
    }
}
