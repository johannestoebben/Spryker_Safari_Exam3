<?php

namespace Pyz\Zed\Antelope\Business;


use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationResponseTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\AntelopeResponseTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;

/**
 * @method  \Pyz\Zed\Antelope\Business\AntelopeBusinessFactory getFactory()
 */
interface AntelopeFacadeInterface
{
    public function createAntelope(AntelopeTransfer $antelopeTransfer
    ): AntelopeTransfer;

    public function getAntelope(
        AntelopeCriteriaTransfer $antelopeCriteriaTransfer
    ): AntelopeResponseTransfer;

    public function createLocation(AntelopeLocationTransfer $antelopeLocationTransfer
    ): AntelopeLocationTransfer;

    public function findLocationById(int $idLocation): ?AntelopeLocationTransfer;

    public function getAntelopeLocation(
        AntelopeLocationCriteriaTransfer $antelopeLocationCriteriaTransfer
    ): AntelopeLocationResponseTransfer;

    public function getAntelopeLocationCollection(): AntelopeLocationCollectionTransfer;

    public function updateLocation(AntelopeLocationTransfer $antelopeLocationTransfer
    ): AntelopeLocationResponseTransfer;

    public function deleteLocation(int $idAntelopeLocation): bool;
}
