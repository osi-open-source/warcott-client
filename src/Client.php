<?php

namespace Warcott;

use Warcott\Constants\Endpoints;
use GuzzleHttp\Client as GuzzleClient;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Client
 * @package Warcott
 */
class Client
{

    /** @var GuzzleClient */
    private $client;

    /**
     * Client constructor.
     * @param GuzzleClient $guzzleClient
     */
    public function __construct(GuzzleClient $guzzleClient)
    {
        $this->client = $guzzleClient;
    }

    /**
     * @param string $domainKey
     * @param array $data
     * @param bool $isOutStream
     * @return mixed
     */
    public function getMapping(string $domainKey, array $data, bool $isOutStream = true)
    {
        $data = [
            'json' => [
                'domain_key' => $domainKey,
                'data'       => $data,
                'stream'     => $isOutStream ? "OUT" : "IN",
            ]
        ];
        return $this->getJsonResponse($this->client->post(Endpoints::MAPPING, $data));
    }

    /**
     * Combination of all Fieldsets and Fields by some domain
     * Dataset - Domain fieldsets
     * @param \string[] $domainKeys
     * @param bool $isJsonAssoc
     * @return mixed
     */
    public function getDataset(array $domainKeys = [], bool $isJsonAssoc = true)
    {
        $params = [];
        if (count($domainKeys) > 0) {
            $params = [
                'query' => ['domain_key' => $domainKeys]
            ];
        }
        return $this->getJsonResponse($this->client->get(Endpoints::FIELDSETS, $params), $isJsonAssoc);
    }

    /**
     * @param array $domainKeys
     * @param bool $isJsonAssoc
     * @return mixed
     */
    public function getFields(array $domainKeys = [], bool $isJsonAssoc = true)
    {
        $params = [];
        if (count($domainKeys) > 0) {
            $params = [
                'query' => ['domain_key' => $domainKeys]
            ];
        }
        return $this->getJsonResponse($this->client->get(Endpoints::FIELDS, $params), $isJsonAssoc);
    }

    /**
     * @param string $domainKey
     * @param bool $isJsonAssoc
     * @return mixed
     */
    public function getDomain(string $domainKey, bool $isJsonAssoc = true)
    {
        return $this->get(Endpoints::DOMAINS . '/' . $domainKey, true, $isJsonAssoc);
    }

    /**
     * @param string $parentKey
     * @param bool $isJsonAssoc
     * @return mixed
     */
    public function getSubDomains(string $parentKey, bool $isJsonAssoc = true)
    {
        $parentDomain = $this->getDomain($parentKey, $isJsonAssoc);

        $data = [
            'data' => [
                'parent_id' => [
                    'value' => $parentDomain['id']
                ]
            ]
        ];

        return $this->get(Endpoints::DOMAINS . '?data=' . json_encode($data), true, $isJsonAssoc);
    }

    /**
     * @return string
     */
    public function getValidationRules(): string
    {
        return $this->getStringResponse($this->client->get(Endpoints::VALIDATION_RULES));
    }

    /**
     * @return string
     */
    public function getValidationRulesJs(): string
    {
        return $this->getStringResponse($this->client->get(Endpoints::VALIDATION_RULES_JS));
    }

    /**
     * @param ResponseInterface $response
     * @param bool $assoc
     * @return mixed
     */
    private function getJsonResponse(ResponseInterface $response, $assoc = true)
    {
        return json_decode($this->getStringResponse($response), $assoc);
    }

    /**
     * @param ResponseInterface $response
     * @return string
     */
    private function getStringResponse(ResponseInterface $response): string
    {
        return $response->getBody()->__toString();
    }

    /**
     * @param string $endpoint
     * @param bool $jsonDecoded
     * @param bool $isJsonAssoc
     * @return string
     */
    public function get(string $endpoint, bool $jsonDecoded = true, bool $isJsonAssoc = true): string
    {
        if ($jsonDecoded) {
            return $this->getJsonResponse($this->client->get($endpoint), $isJsonAssoc);
        } else {
            return $this->getStringResponse($this->client->get($endpoint));
        }
    }
}
