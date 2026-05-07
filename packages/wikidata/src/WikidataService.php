<?php

namespace OpenCompany\Integrations\Wikidata;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for Wikidata public APIs.
 *
 * Handles Wikibase action API calls, Wikidata Query Service SPARQL requests,
 * user-agent headers, parameter normalization, and API error parsing.
 */
class WikidataService
{
    private const USER_AGENT = 'OpenCompany Integrations/1.0 (https://opencompany.ai; integrations@opencompany.ai)';

    /**
     * @param  string  $apiUrl  Wikidata action API URL.
     * @param  string  $sparqlUrl  Wikidata Query Service SPARQL URL.
     * @param  string  $entityDataBaseUrl  Wikidata Special:EntityData base URL.
     * @param  string  $entityBaseUrl  Wikidata entity page base URL.
     */
    public function __construct(
        private string $apiUrl = 'https://www.wikidata.org/w/api.php',
        private string $sparqlUrl = 'https://query.wikidata.org/sparql',
        private string $entityDataBaseUrl = 'https://www.wikidata.org/wiki/Special:EntityData',
        private string $entityBaseUrl = 'https://www.wikidata.org/wiki',
    ) {
        $this->entityDataBaseUrl = rtrim($this->entityDataBaseUrl, '/');
        $this->entityBaseUrl = rtrim($this->entityBaseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return true;
    }

    /**
     * Search Wikidata entities with wbsearchentities.
     *
     * @param  array<string, mixed>  $params  Search, language, type, limit, and continue parameters.
     * @return array<string, mixed>
     */
    public function searchEntities(array $params): array
    {
        if (($params['search'] ?? '') === '') {
            throw new RuntimeException('search is required.');
        }

        $type = (string) ($params['type'] ?? 'item');
        if (!in_array($type, ['item', 'property'], true)) {
            throw new RuntimeException('type must be item or property.');
        }

        return $this->action([
            'action' => 'wbsearchentities',
            'search' => $params['search'],
            'language' => (string) ($params['language'] ?? 'en'),
            'uselang' => (string) ($params['uselang'] ?? $params['language'] ?? 'en'),
            'type' => $type,
            'limit' => (int) ($params['limit'] ?? 10),
            'continue' => $params['continue'] ?? null,
        ]);
    }

    /**
     * Retrieve entities with wbgetentities.
     *
     * @param  array<string, mixed>  $params  IDs, props, languages, sites, titles, and sitefilter parameters.
     * @return array<string, mixed>
     */
    public function getEntities(array $params): array
    {
        if (($params['ids'] ?? '') === '' && (($params['sites'] ?? '') === '' || ($params['titles'] ?? '') === '')) {
            throw new RuntimeException('ids or both sites and titles are required.');
        }

        return $this->action([
            'action' => 'wbgetentities',
            'ids' => $params['ids'] ?? null,
            'sites' => $params['sites'] ?? null,
            'titles' => $params['titles'] ?? null,
            'props' => (string) ($params['props'] ?? 'labels|descriptions|aliases|claims|sitelinks'),
            'languages' => $params['languages'] ?? null,
            'sitefilter' => $params['sitefilter'] ?? null,
        ]);
    }

    /**
     * Retrieve claims for an entity or property with wbgetclaims.
     *
     * @param  array<string, mixed>  $params  Entity, property, rank, and claim parameters.
     * @return array<string, mixed>
     */
    public function getClaims(array $params): array
    {
        if (($params['entity'] ?? '') === '' && ($params['claim'] ?? '') === '') {
            throw new RuntimeException('entity or claim is required.');
        }

        return $this->action([
            'action' => 'wbgetclaims',
            'entity' => $params['entity'] ?? null,
            'property' => $params['property'] ?? null,
            'rank' => $params['rank'] ?? null,
            'claim' => $params['claim'] ?? null,
        ]);
    }

    /**
     * Execute a SPARQL SELECT/ASK/CONSTRUCT/DESCRIBE query.
     *
     * @param  array<string, mixed>  $params  SPARQL query and optional timeout.
     * @return array<string, mixed>
     */
    public function sparql(array $params): array
    {
        if (($params['query'] ?? '') === '') {
            throw new RuntimeException('query is required.');
        }

        return $this->get($this->sparqlUrl, ['query' => $params['query'], 'format' => 'json', 'timeout' => $params['timeout'] ?? null]);
    }

    /**
     * Build Special:EntityData URLs for an entity in a chosen format.
     *
     * @return array<string, mixed>
     */
    public function entityDataUrl(string $id, string $format = 'json'): array
    {
        $format = strtolower(trim($format));
        if (!in_array($format, ['json', 'ttl', 'nt', 'rdf', 'n3'], true)) {
            throw new RuntimeException('format must be one of: json, ttl, nt, rdf, n3.');
        }

        return ['url' => $this->entityDataBaseUrl.'/'.$this->entityId($id).'.'.$format];
    }

    /**
     * Build canonical Wikidata entity page URLs.
     *
     * @return array<string, mixed>
     */
    public function entityPageUrl(string $id): array
    {
        return ['url' => $this->entityBaseUrl.'/'.$this->entityId($id)];
    }

    /**
     * Execute a Wikibase action API request.
     *
     * @param  array<string, mixed>  $query  Action API query parameters.
     * @return array<string, mixed>
     */
    private function action(array $query): array
    {
        return $this->get($this->apiUrl, ['format' => 'json', 'errorformat' => 'plaintext'] + $query);
    }

    /**
     * Execute a JSON GET request.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    private function get(string $url, array $query): array
    {
        try {
            $response = Http::acceptJson()
                ->withUserAgent(self::USER_AGENT)
                ->timeout(60)
                ->get($url, array_filter($query, static fn (mixed $value): bool => $value !== null && $value !== ''));

            return $this->parseResponse($response, $url);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('Wikidata API connection error', ['url' => $url, 'error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to Wikidata API: '.$e->getMessage());
        }
    }

    /**
     * Parse JSON responses and normalize API errors.
     *
     * @return array<string, mixed>
     */
    private function parseResponse(Response $response, string $url): array
    {
        $json = $response->json();

        if (!$response->successful() || (is_array($json) && isset($json['error']))) {
            $message = is_array($json) ? (string) ($json['error']['info'] ?? $json['error']['message'] ?? $json['message'] ?? '') : trim(strip_tags($response->body()));
            Log::error('Wikidata API error', ['url' => $url, 'status' => $response->status(), 'error' => $message]);

            throw new RuntimeException('Wikidata API error ('.$response->status().'): '.($message !== '' ? $message : 'Unexpected API error.'));
        }

        return is_array($json) ? $json : ['body' => $response->body(), 'status' => $response->status()];
    }

    private function entityId(string $id): string
    {
        $id = trim($id);
        $id = preg_replace('#^https?://www\.wikidata\.org/(entity|wiki)/#', '', $id) ?? $id;
        if (!preg_match('/^[QP][1-9][0-9]*$/', $id)) {
            throw new RuntimeException('id must be a Wikidata Q or P identifier.');
        }

        return $id;
    }
}
