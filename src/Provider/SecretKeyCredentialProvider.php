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

use Aws\Credentials\Credentials;
use Aws\Exception\CredentialsException;
use GuzzleHttp\Promise;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Promise\RejectedPromise;

class SecretKeyCredentialProvider
{
    /**
     * SecretKeyCredentialProvider constructor.
     * @param string $key
     * @param string $secret
     */
    public function __construct(
        protected string $key,
        protected string $secret
    ) {
    }

    /**
     * @return PromiseInterface
     */
    public function __invoke(): PromiseInterface
    {
        if ($this->key && $this->secret) {
            return Promise\Create::promiseFor(
                new Credentials($this->key, $this->secret)
            );
        }

        return new RejectedPromise(
            new CredentialsException(
                'Missing amazon_s3.key or amazon_s3.secret'
            )
        );
    }
}
