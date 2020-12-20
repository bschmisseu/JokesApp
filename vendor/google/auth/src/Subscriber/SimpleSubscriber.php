<?php
/*
 * Copyright 2015 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Google\Auth\Subscriber;

use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\StreamInterface;

/**
 * SimpleSubscriber is a Guzzle Subscriber that implements Google's Simple API
 * access.
 *
 * Requests are accessed using the Simple API access developer key.
 */
class SimpleSubscriber implements StreamInterface
{
    /**
     * @var array
     */
    private $config;

    /**
     * Create a new Simple plugin.
     *
     * The configuration array expects one option
     * - key: required, otherwise InvalidArgumentException is thrown
     *
     * @param array $config Configuration array
     */
    public function __construct(array $config)
    {
        if (!isset($config['key'])) {
            throw new \InvalidArgumentException('requires a key to have been set');
        }

        $this->config = array_merge([], $config);
    }

    /**
     * @return array
     */
    public function getEvents()
    {
        return ['before' => ['onBefore', RequestException::SIGN_REQUEST]];
    }

    /**
     * Updates the request query with the developer key if auth is set to simple.
     *
     *   use Google\Auth\Subscriber\SimpleSubscriber;
     *   use GuzzleHttp\Client;
     *
     *   $my_key = 'is not the same as yours';
     *   $subscriber = new SimpleSubscriber(['key' => $my_key]);
     *
     *   $client = new Client([
     *      'base_url' => 'https://www.googleapis.com/discovery/v1/',
     *      'defaults' => ['auth' => 'simple']
     *   ]);
     *   $client->getEmitter()->attach($subscriber);
     *
     *   $res = $client->get('drive/v2/rest');
     *
     * @param BeforeEvent $event
     */
    public function onBefore(BeforeEvent $event)
    {
        // Requests using "auth"="simple" with the developer key.
        $request = $event->getRequest();
        if ($request->getConfig()['auth'] != 'simple') {
            return;
        }
        $request->getQuery()->overwriteWith($this->config);
    }
    public function getMetadata($key = null)
    {}

    public function isSeekable()
    {}

    public function read($length)
    {}

    public function tell()
    {}

    public function isWritable()
    {}

    public function seek($offset, $whence = SEEK_SET)
    {}

    public function __toString()
    {}

    public function getSize()
    {}

    public function rewind()
    {}

    public function detach()
    {}

    public function getContents()
    {}

    public function close()
    {}

    public function eof()
    {}

    public function write($string)
    {}

    public function isReadable()
    {}

}
