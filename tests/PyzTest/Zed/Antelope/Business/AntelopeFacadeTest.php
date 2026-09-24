<?php

namespace PyzTest\Zed\Antelope\Business;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\AntelopeResponseTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Pyz\Zed\Antelope\Business\Antelope\Reader\AntelopeReader;
use Pyz\Zed\Antelope\Business\Antelope\Writer\AntelopeWriter;
use Pyz\Zed\Antelope\Business\AntelopeBusinessFactory;
use Pyz\Zed\Antelope\Business\AntelopeFacade;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;
use Pyz\Zed\Antelope\Business\AntelopeLocation\Reader\AntelopeLocationReader;
use Pyz\Zed\Antelope\Business\AntelopeLocation\Writer\AntelopeLocationWriter;

/**
 * @group PyzTest
 * @group Zed
 * @group Antelope
 * @group Business
 * @group AntelopeFacadeTest
 */
class AntelopeFacadeTest extends Unit
{

    protected AntelopeFacadeInterface $antelopeFacade;


    protected AntelopeBusinessFactory $businessFactoryMock;

    public function testCreateAntelope(): void
    {
        // Arrange
        $antelopeTransfer = new AntelopeTransfer();
        $expectedAntelopeTransfer = (new AntelopeTransfer())->setName('Antelope Name');
        $antelopeWriterMock = $this->createMock(AntelopeWriter::class);

        $this->businessFactoryMock->expects($this->once())
            ->method('createAntelopeWriter')
            ->willReturn($antelopeWriterMock);

        $antelopeWriterMock->expects($this->once())
            ->method('createAntelope')
            ->with($antelopeTransfer)
            ->willReturn($expectedAntelopeTransfer);

        // Act
        $result = $this->antelopeFacade->createAntelope($antelopeTransfer);

        // Assert
        $this->assertSame($expectedAntelopeTransfer, $result);
    }

    public function testGetAntelopeLocationById(): void
    {
        // Arrange
        $idLocation = 1;
        $expectedAntelopeLocationTransfer = (new AntelopeLocationTransfer())->setIdAntelopeLocation($idLocation);
        $antelopeLocationReaderMock = $this->createMock(AntelopeLocationReader::class);

        $this->businessFactoryMock->expects($this->once())
            ->method('createAntelopeLocationReader')
            ->willReturn($antelopeLocationReaderMock);

        $antelopeLocationReaderMock->expects($this->once())
            ->method('getAntelopeLocationById')
            ->with($idLocation)
            ->willReturn($expectedAntelopeLocationTransfer);

        // Act
        $result = $this->antelopeFacade->getAntelopeLocationById($idLocation);

        // Assert
        $this->assertSame($expectedAntelopeLocationTransfer, $result);
    }

    public function testGetAntelope(): void
    {
        // Arrange
        $criteriaTransfer = new AntelopeCriteriaTransfer();
        $expectedResponse = new AntelopeResponseTransfer();
        $antelopeReaderMock = $this->createMock(AntelopeReader::class);

        $this->businessFactoryMock->expects($this->once())
            ->method('createAntelopeReader')
            ->willReturn($antelopeReaderMock);

        $antelopeReaderMock->expects($this->once())
            ->method('getAntelope')
            ->with($criteriaTransfer)
            ->willReturn($expectedResponse);

        // Act
        $result = $this->antelopeFacade->getAntelope($criteriaTransfer);

        // Assert
        $this->assertSame($expectedResponse, $result);
    }

    public function testCreateAntelopeLocation(): void
    {
        // Arrange
        $antelopeLocationTransfer = new AntelopeLocationTransfer();
        $expectedAntelopeLocationTransfer = (new AntelopeLocationTransfer())->setLocationName('Location Name');
        $antelopeLocationWriterMock = $this->createMock(AntelopeLocationWriter::class);

        $this->businessFactoryMock->expects($this->once())
            ->method('createAntelopeLocationWriter')
            ->willReturn($antelopeLocationWriterMock);


        $antelopeLocationWriterMock->expects($this->once())
            ->method('createAntelopeLocation')
            ->with($antelopeLocationTransfer)
            ->willReturn($expectedAntelopeLocationTransfer);

        // Act
        $result = $this->antelopeFacade->createAntelopeLocation($antelopeLocationTransfer);

        // Assert
        $this->assertSame($expectedAntelopeLocationTransfer, $result);
    }

    protected function _before(): void
    {
        parent::_before();

        $this->businessFactoryMock = $this->createMock(AntelopeBusinessFactory::class);
        $this->antelopeFacade = new AntelopeFacade();
        $this->antelopeFacade->setFactory($this->businessFactoryMock);
    }
}
