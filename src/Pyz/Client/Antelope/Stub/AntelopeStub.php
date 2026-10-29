<?php

namespace Pyz\Client\Antelope\Stub;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationResponseTransfer;
use Generated\Shared\Transfer\AntelopeResponseTransfer;
use Spryker\Client\ZedRequest\ZedRequestClientInterface;

class AntelopeStub
{
    public function __construct(
        protected ZedRequestClientInterface $zedRequestClient
    ) {
    }

    public function getAntelope(
        AntelopeCriteriaTransfer $antelopeCriteriaTransfer
    ): AntelopeResponseTransfer {
        /**
         * @var AntelopeResponseTransfer $antelopeTransfer
         */
        $antelopeTransfer = $this->zedRequestClient->call('/antelope/gateway/get-antelope',
            $antelopeCriteriaTransfer);
        return $antelopeTransfer;
    }

    public function getAntelopeLocation(
        AntelopeLocationCriteriaTransfer $antelopeLocationCriteriaTransfer
    ): AntelopeLocationResponseTransfer {
        /**
         * @var AntelopeLocationResponseTransfer $antelopeLocationResponseTransfer
         */
        $antelopeLocationResponseTransfer = $this->zedRequestClient->call('/antelope/gateway/get-antelope-location',
            $antelopeLocationCriteriaTransfer);
        return $antelopeLocationResponseTransfer;
    }
}
