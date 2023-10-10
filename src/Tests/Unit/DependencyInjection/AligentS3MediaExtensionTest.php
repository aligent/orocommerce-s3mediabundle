<?php
/**
 * @category  Aligent
 * @package
 * @author    Chris Rossi <chris.rossi@aligent.com.au>
 * @copyright 2022 Aligent Consulting.
 * @license
 * @link      http://www.aligent.com.au/
 */
namespace Aligent\S3MediaBundle\Tests\Unit\DependencyInjection;

use Aligent\S3MediaBundle\Cache\OroCacheAdapter;
use Aligent\S3MediaBundle\DependencyInjection\AligentS3MediaExtension;
use Aligent\S3MediaBundle\Provider\ChainCredentialsProvider;
use Oro\Bundle\TestFrameworkBundle\Test\DependencyInjection\ExtensionTestCase;

class AligentS3MediaExtensionTest extends ExtensionTestCase
{
    public function testLoad(): void
    {
        $this->loadExtension(new AligentS3MediaExtension());

        // Services
        $expectedDefinitions = [
            'aligent_s3.cache',
            OroCacheAdapter::class,
            ChainCredentialsProvider::class,
            'aligent_s3.credentials',
            'aligent_s3.credentials_provider.ecs',
            'aligent_s3.credentials_provider.key',
            'aligent_s3.client'
        ];
        $this->assertDefinitionsLoaded($expectedDefinitions);
    }
}
