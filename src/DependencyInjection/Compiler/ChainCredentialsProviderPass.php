<?php
/**
 *
 *
 * @category  Aligent
 * @package
 * @author    Adam Hall <adam.hall@aligent.com.au>
 * @copyright 2019 Aligent Consulting.
 * @license
 * @link      http://www.aligent.com.au/
 */

namespace Aligent\S3MediaBundle\DependencyInjection\Compiler;

use Aligent\S3MediaBundle\Provider\ChainCredentialsProvider;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\VarDumper\VarDumper;

class ChainCredentialsProviderPass implements CompilerPassInterface
{
    const TAG = 'aligent_s3.credential_provider';

    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition(ChainCredentialsProvider::class)) {
            return;
        }

        $chainDefinition = $container->getDefinition(ChainCredentialsProvider::class);
        $taggedServices = $container->findTaggedServiceIds(self::TAG);


        foreach ($taggedServices as $serviceId => $service) {
            $chainDefinition->addMethodCall('addProvider', [new Reference($serviceId)]);
        }
    }
}
