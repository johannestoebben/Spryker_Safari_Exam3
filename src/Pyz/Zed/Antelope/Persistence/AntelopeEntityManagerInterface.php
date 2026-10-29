<?php

namespace Pyz\Zed\Antelope\Persistence;

use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;

interface AntelopeEntityManagerInterface
{
    public function createAntelope(AntelopeTransfer $antelopeTransfer
    ): AntelopeTransfer;

    public function updateAntelope(AntelopeTransfer $antelopeTransfer
    ): AntelopeTransfer;

    public function createAntelopeLocation(AntelopeLocationTransfer $antelopeLocationTransfer
    ): AntelopeLocationTransfer;

    public function updateAntelopeLocation(AntelopeLocationTransfer $antelopeLocationTransfer
    ): ?AntelopeLocationTransfer;

    public function deleteAntelopeLocation(int $idAntelopeLocation): bool;
}
