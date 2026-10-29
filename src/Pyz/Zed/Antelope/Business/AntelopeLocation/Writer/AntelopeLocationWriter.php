<?php

namespace Pyz\Zed\Antelope\Business\AntelopeLocation\Writer;

use Generated\Shared\Transfer\AntelopeLocationResponseTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Pyz\Zed\Antelope\Persistence\AntelopeEntityManagerInterface;

class AntelopeLocationWriter
{
    public function __construct(
        protected AntelopeEntityManagerInterface $entityManager
    ) {
    }

    public function createLocation(AntelopeLocationTransfer $antelopeLocationTransfer
    ): AntelopeLocationTransfer {
        return $this->entityManager->createAntelopeLocation($antelopeLocationTransfer);
    }

    public function updateLocation(AntelopeLocationTransfer $antelopeLocationTransfer
    ): AntelopeLocationResponseTransfer {
        $updatedAntelopeLocationTransfer = $this->entityManager->updateAntelopeLocation($antelopeLocationTransfer);
        $antelopeLocationResponseTransfer = new AntelopeLocationResponseTransfer();
        $antelopeLocationResponseTransfer->setIsSuccessful(false);
        if ($updatedAntelopeLocationTransfer) {
            $antelopeLocationResponseTransfer->setAntelopeLocation($updatedAntelopeLocationTransfer);
            $antelopeLocationResponseTransfer->setIsSuccessful(true);
        }

        return $antelopeLocationResponseTransfer;
    }

    public function deleteLocation(int $idAntelopeLocation): bool
    {
        return $this->entityManager->deleteAntelopeLocation($idAntelopeLocation);
    }
}
