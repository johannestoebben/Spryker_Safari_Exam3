<?php

namespace Pyz\Zed\Antelope\Business\AntelopeLocation\Reader;

use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationResponseTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Pyz\Zed\Antelope\Persistence\AntelopeRepositoryInterface;

class AntelopeLocationReader
{
    public function __construct(
        protected AntelopeRepositoryInterface $antelopeRepository
    ) {
    }

    public function findLocationById(int $idLocation): ?AntelopeLocationTransfer
    {
        return $this->antelopeRepository->findLocationById($idLocation);
    }

    public function getAntelopeLocation(
        AntelopeLocationCriteriaTransfer $antelopeLocationCriteriaTransfer
    ): AntelopeLocationResponseTransfer {
        $antelopeLocationTransfer = $this->antelopeRepository->findAntelopeLocation($antelopeLocationCriteriaTransfer);
        $antelopeLocationResponseTransfer = new AntelopeLocationResponseTransfer();
        $antelopeLocationResponseTransfer->setIsSuccessful(false);
        if ($antelopeLocationTransfer) {
            $antelopeLocationResponseTransfer->setAntelopeLocation($antelopeLocationTransfer);
            $antelopeLocationResponseTransfer->setIsSuccessful(true);
        }

        return $antelopeLocationResponseTransfer;
    }

    public function getAntelopeLocationCollection(): AntelopeLocationCollectionTransfer
    {
        return $this->antelopeRepository->getAntelopeLocationCollection();
    }
}
