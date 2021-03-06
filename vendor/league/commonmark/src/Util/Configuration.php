<?php

/*
 * This file is part of the league/commonmark package.
 *
 * (c) Colin O'Dell <colinodell@gmail.com>
 *
 * Original code based on the CommonMark JS reference parser (https://bitly.com/commonmark-js)
 *  - (c) John MacFarlane
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace League\CommonMark\Util;

final class Configuration implements ConfigurationInterface
{
    private $config;

    /**
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    /**
     * {@inheritdoc}
     */
    public function merge(array $config = [])
    {
        $this->config = \array_replace_recursive($this->config, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function replace(array $config = [])
    {
        $this->config = $config;
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function getConfig(?string $key = null, $default = null)
=======
    public function get(?string $key = null, $default = null)
>>>>>>> 56a34df1984fbc88561415294f7408501262a1ab
    {
        if ($key === null) {
            return $this->config;
        }

        // accept a/b/c as ['a']['b']['c']
        if (\strpos($key, '/')) {
            return $this->getConfigByPath($key, $default);
        }

        if (!isset($this->config[$key])) {
            return $default;
        }

        return $this->config[$key];
    }

    /**
     * {@inheritdoc}
     */
    public function set(string $key, $value = null)
    {
        // accept a/b/c as ['a']['b']['c']
        if (\strpos($key, '/')) {
            $this->setByPath($key, $value);
        }

        $this->config[$key] = $value;
    }

    /**
     * @param string      $keyPath
     * @param string|null $default
     *
     * @return mixed|null
     */
<<<<<<< HEAD
    protected function getConfigByPath(string $keyPath, $default = null)
=======
    private function getConfigByPath(string $keyPath, $default = null)
>>>>>>> 56a34df1984fbc88561415294f7408501262a1ab
    {
        $keyArr = \explode('/', $keyPath);
        $data = $this->config;
        foreach ($keyArr as $k) {
            if (!\is_array($data) || !isset($data[$k])) {
                return $default;
            }

            $data = $data[$k];
        }

        return $data;
    }

    /**
     * @param string      $keyPath
     * @param string|null $value
     */
    private function setByPath(string $keyPath, $value = null)
    {
        $keyArr = \explode('/', $keyPath);
        $pointer = &$this->config;
        while (($k = array_shift($keyArr)) !== null) {
            if (!\is_array($pointer)) {
                $pointer = [];
            }

            if (!isset($pointer[$k])) {
                $pointer[$k] = null;
            }

            $pointer = &$pointer[$k];
        }

        $pointer = $value;
    }
}
