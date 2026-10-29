<?php

namespace PyzTest\Zed\Antelope\Business;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Pyz\Zed\Antelope\Business\AntelopeLocation\Reader\AntelopeLocationReader;
use Pyz\Zed\Antelope\Persistence\AntelopeRepositoryInterface;

/**
 * @group PyzTest
 * @group Zed
 * @group Antelope
 * @group Business
 * @group AntelopeLocationReaderTest
 */
class AntelopeLocationReaderTest extends Unit
{
    public function testGetAntelopeLocationReturnsSuccessfulResponseWhenFound(): void
    {
        // Arrange
        $criteriaTransfer = (new AntelopeLocationCriteriaTransfer())->setIdAntelopeLocation(1);
        $antelopeLocationTransfer = (new AntelopeLocationTransfer())->setIdAntelopeLocation(1);
        $repositoryMock = $this->createMock(AntelopeRepositoryInterface::class);
        $repositoryMock->method('findAntelopeLocation')->with($criteriaTransfer)->willReturn($antelopeLocationTransfer);

        // Act
        $result = (new AntelopeLocationReader($repositoryMock))->getAntelopeLocation($criteriaTransfer);

        // Assert
        $this->assertTrue($result->getIsSuccessful());
        $this->assertSame($antelopeLocationTransfer, $result->getAntelopeLocation());
    }

    public function testGetAntelopeLocationReturnsUnsuccessfulResponseWhenNotFound(): void
    {
        // Arrange
        $repositoryMock = $this->createMock(AntelopeRepositoryInterface::class);
        $repositoryMock->method('findAntelopeLocation')->willReturn(null);

        // Act
        $result = (new AntelopeLocationReader($repositoryMock))->getAntelopeLocation(new AntelopeLocationCriteriaTransfer());

        // Assert
        $this->assertFalse($result->getIsSuccessful());
        $this->assertNull($result->getAntelopeLocation());
    }
}
