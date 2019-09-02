<?php

namespace Djgxp\Bundle\GuzzleBundle;

use Djgxp\Bundle\GuzzleBundle\DependencyInjection\Compiler\GuzzleCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class DjgxpGuzzleBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new GuzzleCompilerPass());
    }
}
