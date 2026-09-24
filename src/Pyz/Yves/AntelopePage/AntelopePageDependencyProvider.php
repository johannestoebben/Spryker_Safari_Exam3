<?php

namespace Pyz\Yves\AntelopePage;

use Spryker\Yves\Kernel\AbstractBundleDependencyProvider;
use Spryker\Yves\Kernel\Container;

class AntelopePageDependencyProvider extends AbstractBundleDependencyProvider
{
    public const string CLIENT_ANTELOPE = 'CLIENT_ANTELOPE';

    public function provideDependencies(Container $container): Container
    {
        $container = parent::provideDependencies($container);
        $container = $this->addAntelopeClient($container);

        return $container;
    }

    protected function addAntelopeClient(Container $container): Container
    {
        $container->set(static::CLIENT_ANTELOPE,
            function (Container $container) {
                return $container->getLocator()->antelope()->client();
            });
        return $container;
    }
}
