<?php

namespace Pyz\Client\Antelope;

use Pyz\Client\Antelope\Stub\AntelopeStub;
use Spryker\Client\Kernel\AbstractFactory;
use Spryker\Client\ZedRequest\ZedRequestClientInterface;

class AntelopeFactory extends AbstractFactory
{
    public function createAntelopeStub(): AntelopeStub
    {
        return new AntelopeStub($this->getZedRequestClient());
    }

    public function getZedRequestClient(): ZedRequestClientInterface
    {
        return $this->getProvidedDependency(AntelopeDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
