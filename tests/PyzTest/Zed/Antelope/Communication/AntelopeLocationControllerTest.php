<?php

namespace PyzTest\Zed\Antelope\Communication;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationResponseTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;
use Pyz\Zed\Antelope\Communication\Controller\AntelopeLocationController;
use ReflectionProperty;
use Symfony\Component\HttpFoundation\Request;

/**
 * @group PyzTest
 * @group Zed
 * @group Antelope
 * @group Communication
 * @group AntelopeLocationControllerTest
 */
class AntelopeLocationControllerTest extends Unit
{
    protected AntelopeLocationController $antelopeLocationController;

    protected AntelopeFacadeInterface $antelopeFacadeMock;

    public function testAddActionCreatesLocationFromRequest(): void
    {
        // Arrange
        $request = new Request(['locationName' => 'Serengeti']);

        $this->antelopeFacadeMock->expects($this->once())
            ->method('createLocation')
            ->with($this->callback(fn (AntelopeLocationTransfer $transfer) => $transfer->getLocationName() === 'Serengeti'))
            ->willReturnCallback(fn (AntelopeLocationTransfer $transfer) => $transfer->setIdAntelopeLocation(7));

        // Act
        $result = $this->antelopeLocationController->addAction($request);

        // Assert
        $this->assertInstanceOf(AntelopeLocationTransfer::class, $result['antelopeLocation']);
        $this->assertSame(7, $result['antelopeLocation']->getIdAntelopeLocation());
        $this->assertSame('Serengeti', $result['antelopeLocation']->getLocationName());
    }

    public function testAddActionFallsBackToGeneratedNameWhenNoneGiven(): void
    {
        // Arrange
        $this->antelopeFacadeMock->expects($this->once())
            ->method('createLocation')
            ->willReturnArgument(0);

        // Act
        $result = $this->antelopeLocationController->addAction(new Request());

        // Assert
        $this->assertNotEmpty($result['antelopeLocation']->getLocationName());
    }

    public function testGetActionReturnsLocation(): void
    {
        // Arrange
        $antelopeLocationTransfer = (new AntelopeLocationTransfer())->setIdAntelopeLocation(3)->setLocationName('Okavango');

        $this->antelopeFacadeMock->expects($this->once())
            ->method('getAntelopeLocation')
            ->with($this->callback(fn (AntelopeLocationCriteriaTransfer $criteria) => $criteria->getIdAntelopeLocation() === 3))
            ->willReturn((new AntelopeLocationResponseTransfer())->setIsSuccessful(true)->setAntelopeLocation($antelopeLocationTransfer));

        // Act
        $result = $this->antelopeLocationController->getAction(new Request(['id' => '3']));

        // Assert
        $this->assertSame($antelopeLocationTransfer, $result['antelopeLocation']);
    }

    public function testIndexActionListsLocations(): void
    {
        // Arrange
        $antelopeLocationCollectionTransfer = (new AntelopeLocationCollectionTransfer())
            ->addAntelopeLocation((new AntelopeLocationTransfer())->setLocationName('Serengeti'))
            ->addAntelopeLocation((new AntelopeLocationTransfer())->setLocationName('Okavango'));

        $this->antelopeFacadeMock->method('getAntelopeLocationCollection')
            ->willReturn($antelopeLocationCollectionTransfer);

        // Act
        $result = $this->antelopeLocationController->indexAction();

        // Assert
        $this->assertCount(2, $result['antelopeLocations']);
    }

    protected function _before(): void
    {
        parent::_before();

        $this->antelopeFacadeMock = $this->createMock(AntelopeFacadeInterface::class);
        $this->antelopeLocationController = new AntelopeLocationController();
        (new ReflectionProperty(AntelopeLocationController::class, 'facade'))->setValue($this->antelopeLocationController, $this->antelopeFacadeMock);
    }
}
