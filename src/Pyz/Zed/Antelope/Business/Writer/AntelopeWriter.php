<?php

namespace Pyz\Zed\Antelope\Business\Writer;

use Generated\Shared\Transfer\AntelopeTransfer;
use Pyz\Zed\Antelope\Persistence\AntelopeEntityManagerInterface;

class AntelopeWriter
{
    public function __construct(
        protected AntelopeEntityManagerInterface $entityManager
    ) {
    }

    public function createAntelope(AntelopeTransfer $antelopeTransfer
    ): AntelopeTransfer {
        return $this->entityManager->createAntelope($antelopeTransfer);
    }
}
