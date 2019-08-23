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

namespace Aligent\S3MediaBundle\Provider;


use Aws\Credentials\CredentialProvider;
use Aws\Credentials\Credentials;
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
     * @param array $providers
     */
    public function setProviders($providers)
    {
        $this->providers = $providers;
    }

    /**
     * @param $provider
     * @return $this
     */
    public function addProvider($provider)
    {
        $this->providers[] = $provider;
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