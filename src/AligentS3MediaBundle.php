<?php
/**
 *
 *
 * @category  Aligent
 * @package
 * @author    Adam Hall <adam.hall@aligent.com.au>
 * @copyright 2018 Aligent Consulting.
 * @license   MIT
 * @link      http://www.aligent.com.au/
 */

namespace Aligent\S3MediaBundle;

use Aligent\S3MediaBundle\DependencyInjection\Compiler\ChainCredentialsProviderPass;
use Symfony\Component\Console\Application;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AligentS3MediaBundle extends Bundle
{

    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new ChainCredentialsProviderPass());
    }
}
