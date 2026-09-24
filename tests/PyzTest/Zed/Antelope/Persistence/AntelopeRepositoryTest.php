<?php

namespace PyzTest\Zed\Antelope\Persistence;

use Codeception\Test\Unit;
use Pyz\Zed\Antelope\Persistence\AntelopeRepository;
use Pyz\Zed\Antelope\Persistence\Exception\EntityNotFoundException;

/**
 * @group Antelope
 */
class AntelopeRepositoryTest extends Unit
{

    protected AntelopeRepository $repository;

    public function testGetAntelopeLocationByIdThrowsExceptionWhenNotFound(): void
    {
        $nonExistentId = 99999;

        $this->expectException(EntityNotFoundException::class);
        $this->expectExceptionMessage(sprintf('Antelope Location %d not found', $nonExistentId));

        $this->repository->getAntelopeLocationById($nonExistentId);
    }

    protected function _before(): void
    {
        $this->repository = new AntelopeRepository();
    }
}
