<?php
namespace Aligent\S3MediaBundle\Cache;

use Aws\CacheInterface as AwsCacheInterface;
use Doctrine\Common\Cache\Cache;
use Symfony\Component\Cache\CacheItem;
use Symfony\Contracts\Cache\CacheInterface as SymfonyCacheInterface;

class OroCacheAdapter implements AwsCacheInterface
{
    public function __construct(
        private SymfonyCacheInterface $cache
    ) {
    }

    public function get($key)
    {
        /** @var CacheItem $cacheItem */
        $cacheItem = $this->cache->getItem($key);
        if ($cacheItem->isHit()) {
            return $cacheItem->get();
        }
        return null;
    }

    public function fetch($key)
    {
        return $this->get($key);
    }

    public function set($key, $value, $ttl = 0)
    {
        $item = $this->cache->getItem($key);
        $item->set($value)
            ->expiresAfter($ttl === 0 ? null : $ttl);

        return $this->cache->save($item);
    }

    public function save($key, $value, $ttl = 0)
    {
        return $this->set($key, $value, $ttl);
    }

    public function remove($key)
    {
        return $this->cache->delete($key);
    }

    public function delete($key)
    {
        return $this->remove($key);
    }

    public function contains($key)
    {
        return $this->cache->hasItem($key);
    }
}
