<?php

namespace Djgxp\Bundle\GuzzleBundle\DependencyInjection\Compiler;

use Djgxp\Bundle\GuzzleBundle\DependencyInjection\Exception\VersionNotSupportedException;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

class GuzzleCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        $taggedServices = $container->findTaggedServiceIds('guzzle.client');

        foreach ($taggedServices as $id => $attributes) {
            $definition = $container->getDefinition($id);
            $class      = $definition->getClass();
            $version    = constant($class . '::VERSION');

            if (1 === preg_match('#6.[0-9]+.[0-9]+#', $version)) {
                $this->guzzle6($definition);
            } else {
                throw new VersionNotSupportedException(sprintf('Guzzle %s is not supported', $version));
            }
        }
    }

    /**
     * @param Definition $definition
     */
    public function guzzle6(Definition $definition)
    {
        $arguments = count($definition->getArguments());

        if ($arguments === 0) {
            $definition->addArgument(['handler' => new Reference('djgxp.guzzle_bundle.handler_stack')]);
        } elseif ($arguments === 1) {
            $argument = $definition->getArgument(0);

            if (is_array($argument)) {
                $definition->replaceArgument(1, array_merge($argument, ['handler' => new Reference('djgxp.guzzle_bundle.handler_stack')]));
            } else {
                $definition->addArgument(['handler' => new Reference('djgxp.guzzle_bundle.handler_stack')]);
            }
        } elseif ($arguments === 2) {
            $definition->replaceArgument(1, array_merge($definition->getArgument(1), ['handler' => new Reference('djgxp.guzzle_bundle.handler_stack')]));
        }
    }
}
