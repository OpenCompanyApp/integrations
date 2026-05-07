<?php

namespace OpenCompany\Integrations\OpenAlex;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the OpenAlex REST API.
 *
 * Handles API-key injection, endpoint routing, query normalization, and JSON
 * error conversion for OpenAlex entity and utility endpoints.
 */
class OpenAlexService
{
    /** @var array<int, string> */
    public const ENTITIES = [
        'works',
        'authors',
        'sources',
        'institutions',
        'topics',
        'domains',
        'fields',
        'subfields',
        'sdgs',
        'countries',
        'continents',
        'languages',
        'keywords',
        'publishers',
        'funders',
        'awards',
        'work-types',
        'source-types',
        'institution-types',
        'licenses',
    ];

    /** @var array<int, string> */
    public const AUTOCOMPLETE_ENTITIES = [
        'works',
        'authors',
        'sources',
        'institutions',
        'topics',
        'keywords',
        'publishers',
        'funders',
    ];

    /**
     * @param  string  $apiKey  OpenAlex API key.
     * @param  string  $baseUrl  OpenAlex API base URL.
     */
    public function __construct(private string $apiKey = '', private string $baseUrl = 'https://api.openalex.org')
    {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    /**
     * List, search, filter, sort, page, sample, or group an OpenAlex entity endpoint.
     *
     * @param  array<string, mixed>  $params  OpenAlex list query parameters.
     * @return array<string, mixed>
     */
    public function list(string $entity, array $params = []): array
    {
        $this->assertEntity($entity);

        return $this->request($entity, $params);
    }

    /**
     * Get a single OpenAlex entity by OpenAlex ID or supported external ID.
     *
     * @param  array<string, mixed>  $params  Optional select or other query parameters.
     * @return array<string, mixed>
     */
    public function get(string $entity, string $id, array $params = []): array
    {
        $this->assertEntity($entity);
        if ($id === '') {
            throw new RuntimeException('id is required.');
        }

        return $this->request($entity.'/'.ltrim($id, '/'), $params);
    }

    /**
     * Search the OpenAlex autocomplete endpoint for supported entity types.
     *
     * @param  array<string, mixed>  $params  Autocomplete parameters including q and optional filter.
     * @return array<string, mixed>
     */
    public function autocomplete(string $entity, array $params): array
    {
        if (!in_array($entity, self::AUTOCOMPLETE_ENTITIES, true)) {
            throw new RuntimeException("Unsupported OpenAlex autocomplete entity: {$entity}");
        }

        return $this->request('autocomplete/'.$entity, $params);
    }

    /**
     * Check current OpenAlex API key rate-limit status.
     *
     * @return array<string, mixed>
     */
    public function rateLimit(): array
    {
        return $this->request('rate-limit');
    }

    /**
     * List available OpenAlex changefile dates.
     *
     * @return array<string, mixed>
     */
    public function listChangefiles(): array
    {
        return $this->request('changefiles');
    }

    /**
     * Get OpenAlex changefile details for a specific date.
     *
     * @return array<string, mixed>
     */
    public function getChangefile(string $date): array
    {
        if ($date === '') {
            throw new RuntimeException('date is required.');
        }

        return $this->request('changefiles/'.$date);
    }

    /**
     * Make a JSON GET request to OpenAlex.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    private function request(string $path, array $params = []): array
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('OpenAlex API key is not configured.');
        }

        $query = $this->normalizeParams($params);
        $query['api_key'] ??= $this->apiKey;

        try {
            $response = Http::acceptJson()
                ->withUserAgent('OpenCompany Integrations openalex/1.0')
                ->timeout(60)
                ->get($this->baseUrl.'/'.ltrim($path, '/'), $query);

            return $this->parseResponse($response, $path);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("OpenAlex API connection error: {$path}", ['error' => $e->getMessage()]);

            throw new RuntimeException("Failed to connect to OpenAlex API: {$e->getMessage()}");
        }
    }

    /**
     * Normalize OpenAlex query parameters, including list and associative filter values.
     *
     * @param  array<string, mixed>  $params  Raw query parameters.
     * @return array<string, scalar>
     */
    private function normalizeParams(array $params): array
    {
        $query = [];
        foreach ($params as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }

            if (is_array($value)) {
                $value = $this->stringifyArrayParam($value);
            }

            if ($value !== '') {
                $query[$key] = is_bool($value) ? ($value ? 'true' : 'false') : $value;
            }
        }

        return $query;
    }

    /**
     * Convert array query parameters to OpenAlex comma-separated syntax.
     *
     * @param  array<mixed>  $value  Query array value.
     */
    private function stringifyArrayParam(array $value): string
    {
        $isAssoc = array_keys($value) !== range(0, count($value) - 1);
        if ($isAssoc) {
            return implode(',', array_map(
                static fn (string|int $key, mixed $item): string => (string) $key.':'.(is_bool($item) ? ($item ? 'true' : 'false') : (string) $item),
                array_keys($value),
                $value
            ));
        }

        return implode(',', array_map(static fn (mixed $item): string => (string) $item, array_filter($value, static fn (mixed $item): bool => $item !== null && $item !== '')));
    }

    /**
     * Parse JSON responses and convert OpenAlex errors to exceptions.
     *
     * @return array<string, mixed>
     */
    private function parseResponse(Response $response, string $path): array
    {
        $json = $response->json();
        if (!$response->successful()) {
            $message = is_array($json) ? ($json['message'] ?? $json['error'] ?? null) : null;
            $error = is_string($message) ? $message : $response->body();
            Log::error("OpenAlex API error: {$path}", ['status' => $response->status(), 'error' => $error]);

            throw new RuntimeException('OpenAlex API error ('.$response->status().'): '.$error);
        }

        return is_array($json) ? $json : ['body' => $response->body(), 'status' => $response->status()];
    }

    /**
     * Ensure an entity slug is a current non-deprecated OpenAlex endpoint.
     */
    private function assertEntity(string $entity): void
    {
        if (!in_array($entity, self::ENTITIES, true)) {
            throw new RuntimeException("Unsupported OpenAlex entity: {$entity}");
        }
    }
}
