<?php

namespace Pyz\Zed\Antelope\Business;

use Pyz\Zed\Antelope\Business\AntelopeLocation\Reader\AntelopeLocationReader;
use Pyz\Zed\Antelope\Business\AntelopeLocation\Writer\AntelopeLocationWriter;
use Pyz\Zed\Antelope\Business\Reader\AntelopeReader;
use Pyz\Zed\Antelope\Business\Writer\AntelopeWriter;
use Pyz\Zed\Antelope\Persistence\AntelopeEntityManagerInterface;
use Pyz\Zed\Antelope\Persistence\AntelopeRepositoryInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method AntelopeEntityManagerInterface getEntityManager()
 * @method AntelopeRepositoryInterface getRepository()
 */
class AntelopeBusinessFactory extends AbstractBusinessFactory
{
    public function createAntelopeWriter(): AntelopeWriter
    {
        return new AntelopeWriter($this->getEntityManager());
    }

    public function createAntelopeReader(): AntelopeReader
    {
        return new AntelopeReader($this->getRepository());
    }

    public function createAntelopeLocationWriter(): AntelopeLocationWriter
    {
        return new AntelopeLocationWriter($this->getEntityManager());
    }

    public function createAntelopeLocationReader(): AntelopeLocationReader
    {
        return new AntelopeLocationReader($this->getRepository());
    }
}
