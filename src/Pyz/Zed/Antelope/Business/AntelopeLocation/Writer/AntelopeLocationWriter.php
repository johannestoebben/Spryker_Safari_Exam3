<?php

namespace Pyz\Zed\Antelope\Business\AntelopeLocation\Writer;

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
}
