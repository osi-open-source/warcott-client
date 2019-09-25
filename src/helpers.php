<?php


if (! function_exists('warcottDataset')) {

    /**
     * Fetch Warcott fieldset for a given domain key
     *
     * @param string $domainKey (you can pass comma separated list)
     * @return string
     */
    function warcottDataset(string $domainKey)
    {
        return app('warcottApi')->getDataset(explode(',', $domainKey));
    }
}

if (! function_exists('warcottMap')) {
    /**
     * Parse data with Warcott mapping for a given key
     *
     * @param string $domainKey (you can pass comma separated list)
     * @param array $data
     * @param bool $directionOut
     * @return string
     */
    function warcottMap(string $domainKey, array $data, bool $directionOut = true)
    {
        return app('warcottApi')->getMapping($domainKey, $data, $directionOut);
    }
}
