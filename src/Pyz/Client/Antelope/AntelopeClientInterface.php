<?php

namespace Pyz\Client\Antelope;


use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationResponseTransfer;
use Generated\Shared\Transfer\AntelopeResponseTransfer;

/**
 * @method \Pyz\Client\Antelope\AntelopeFactory getFactory()
 */
interface AntelopeClientInterface
{
    public function getAntelope(AntelopeCriteriaTransfer $antelopeCriteriaTransfer): AntelopeResponseTransfer;

    public function getAntelopeLocation(
        AntelopeLocationCriteriaTransfer $antelopeLocationCriteriaTransfer
    ): AntelopeLocationResponseTransfer;
}
