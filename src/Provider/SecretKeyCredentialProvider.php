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
     * @var string
     */
    protected $key;

    /**
     * @var string
     */
    protected $secret;

    /**
     * SecretKeyCredentialProvider constructor.
     * @param string $key
     * @param string $secret
     */
    public function __construct(string $key, string $secret)
    {
        $this->key = $key;
        $this->secret = $secret;
    }

    /**
     * @return PromiseInterface
     */
    public function __invoke()
    {
        if ($this->key && $this->secret) {
            return Promise\promise_for(
                new Credentials($this->key, $this->secret)
            );
        }

        $msg = 'Missing amazon_s3.key or amazon_s3.secret';
        return new RejectedPromise(new CredentialsException($msg));
    }
}
