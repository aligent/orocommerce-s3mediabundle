<?php
/**
 *
 *
 * @category  Aligent
 * @package
 * @author    Adam Hall <adam.hall@aligent.com.au>
 * @copyright 2019 Aligent Consulting.
 * @license   MIT
 * @link      http://www.aligent.com.au/
 */

namespace Aligent\S3MediaBundle\Provider;

use Aws\CacheInterface;
use Aws\Credentials\CredentialProvider;
use Aws\Credentials\Credentials;
use Aws\DoctrineCacheAdapter;
use Aws\Exception\CredentialsException;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;

class ChainCredentialsProvider
{
    /**
     * @var array Credential Providers
     */
    protected $providers = [];

    /**
     * ChainCredentialsProvider constructor.
     * @param CacheInterface $cache
     */
    public function __construct(
        protected CacheInterface $cache
    ) {
    }

    /**
     * @param array $providers
     */
    public function setProviders($providers)
    {
        $this->providers = $providers;
    }

    /**
     * @param callable $provider
     * @return $this
     */
    public function addProvider($provider)
    {
        $this->providers[] = CredentialProvider::cache($provider, $this->cache);
        return $this;
    }

    /**
     * Load ECS credentials
     *
     * @return PromiseInterface
     */
    public function getCredentialChain()
    {
        return CredentialProvider::memoize(
            call_user_func_array(
                [
                    CredentialProvider::class,
                    'chain'
                ],
                $this->providers
            )
        );
    }
}
