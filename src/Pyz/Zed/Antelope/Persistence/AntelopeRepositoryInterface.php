<?php

namespace Pyz\Zed\Antelope\Persistence;


use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;

/**
 * @method \Pyz\Zed\Antelope\Persistence\AntelopePersistenceFactory getFactory()
 */
interface AntelopeRepositoryInterface
{
    public function getAntelope(
        AntelopeCriteriaTransfer $antelopeCriteriaTransfer
    ): ?AntelopeTransfer;

    public function findLocationById(int $idLocation): ?AntelopeLocationTransfer;

    public function findAntelopeLocation(
        AntelopeLocationCriteriaTransfer $antelopeLocationCriteriaTransfer
    ): ?AntelopeLocationTransfer;

    public function getAntelopeLocationCollection(): AntelopeLocationCollectionTransfer;
}
