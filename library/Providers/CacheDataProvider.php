<?php

/**
 * This file is part of the Phalcon API.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Phalcon\Api\Providers;

use Phalcon\Cache\AdapterFactory;
use Phalcon\Cache\Cache;
use Phalcon\Config\Config;
use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Storage\SerializerFactory;

class CacheDataProvider implements ServiceProviderInterface
{
    /**
     * @param DiInterface $container
     */
    public function register(DiInterface $container): void
    {
        /** @var Config $config */
        $config = $container->getShared('config');

        $container->setShared(
            'cache',
            function () use ($config) {
                $cache   = $config->get('cache')
                                  ->toArray()
                ;
                $adapter = $cache['adapter'];
                $options = $cache['options'] ?? [];

                $serializerFactory = new SerializerFactory();
                $adapterFactory    = new AdapterFactory($serializerFactory);
                $adapter           = $adapterFactory->newInstance($adapter, $options);

                return new Cache($adapter);
            }
        );
    }
}
