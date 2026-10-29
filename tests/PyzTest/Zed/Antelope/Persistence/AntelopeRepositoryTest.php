<?php

namespace PyzTest\Zed\Antelope\Persistence;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Pyz\Zed\Antelope\Persistence\AntelopeRepository;

/**
 * @group Antelope
 */
class AntelopeRepositoryTest extends Unit
{

    protected AntelopeRepository $repository;

    public function testFindLocationByIdReturnsNullWhenNotFound(): void
    {
        $this->assertNull($this->repository->findLocationById(99999));
    }

    public function testFindAntelopeLocationReturnsNullWhenNotFound(): void
    {
        $criteriaTransfer = (new AntelopeLocationCriteriaTransfer())->setIdAntelopeLocation(99999);

        $this->assertNull($this->repository->findAntelopeLocation($criteriaTransfer));
    }

    protected function _before(): void
    {
        $this->repository = new AntelopeRepository();
    }
}
