<?php

namespace OpenCompany\Integrations\UsCensus;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the U.S. Census Data API.
 *
 * Handles public dataset discovery, dataset metadata endpoints, data queries,
 * optional API keys, response parsing, and API error normalization.
 */
class UsCensusService
{
    /**
     * @param  string  $apiKey  Optional Census API key.
     * @param  string  $baseUrl  Census Data API base URL.
     */
    public function __construct(private string $apiKey = '', private string $baseUrl = 'https://api.census.gov')
    {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return true;
    }

    /**
     * List all Census API datasets.
     *
     * @param  array<string, mixed>  $params  Optional search and vintage filters applied client-side.
     * @return array<string, mixed>
     */
    public function listDatasets(array $params = []): array
    {
        $data = $this->get('data.json');
        $datasets = $data['dataset'] ?? [];
        if (!is_array($datasets)) {
            return $data;
        }

        $query = strtolower(trim((string) ($params['q'] ?? '')));
        $vintage = trim((string) ($params['vintage'] ?? ''));
        $limit = (int) ($params['limit'] ?? 50);
        $matches = array_values(array_filter($datasets, static function (mixed $dataset) use ($query, $vintage): bool {
            if (!is_array($dataset)) {
                return false;
            }
            if ($vintage !== '' && (string) ($dataset['c_vintage'] ?? '') !== $vintage) {
                return false;
            }
            if ($query === '') {
                return true;
            }

            return str_contains(strtolower(json_encode($dataset) ?: ''), $query);
        }));

        return ['dataset' => array_slice($matches, 0, max(1, $limit)), 'count' => count($matches)];
    }

    /**
     * Get one dataset's root metadata.
     *
     * @param  array<string, mixed>  $params  Dataset path such as 2023/acs/acs5.
     * @return array<string, mixed>
     */
    public function datasetMetadata(array $params): array
    {
        return $this->get($this->datasetPath($params).'.json');
    }

    /**
     * Get variables for a dataset or variable group.
     *
     * @param  array<string, mixed>  $params  Dataset path, optional group, search, predicate-only flag, and limit.
     * @return array<string, mixed>
     */
    public function variables(array $params): array
    {
        $path = $this->datasetPath($params).'/'.($params['group'] ?? '') . ((($params['group'] ?? '') !== '') ? '/variables.json' : 'variables.json');
        $data = $this->get($path);
        $variables = $data['variables'] ?? [];
        if (!is_array($variables)) {
            return $data;
        }

        $query = strtolower(trim((string) ($params['q'] ?? '')));
        $predicateOnly = (bool) ($params['predicate_only'] ?? false);
        $limit = (int) ($params['limit'] ?? 100);
        $matches = [];
        foreach ($variables as $name => $meta) {
            if (!is_array($meta)) {
                continue;
            }
            if ($predicateOnly && !($meta['predicateOnly'] ?? false)) {
                continue;
            }
            if ($query !== '' && !str_contains(strtolower($name.' '.json_encode($meta)), $query)) {
                continue;
            }
            $matches[$name] = $meta;
            if (count($matches) >= max(1, $limit)) {
                break;
            }
        }

        return ['variables' => $matches, 'count' => count($matches)];
    }

    /**
     * Get variable groups for a dataset.
     *
     * @param  array<string, mixed>  $params  Dataset path and optional search/limit filters.
     * @return array<string, mixed>
     */
    public function groups(array $params): array
    {
        $data = $this->get($this->datasetPath($params).'/groups.json');
        $groups = $data['groups'] ?? [];
        if (!is_array($groups)) {
            return $data;
        }

        $query = strtolower(trim((string) ($params['q'] ?? '')));
        $limit = (int) ($params['limit'] ?? 100);
        $matches = array_values(array_filter($groups, static fn (mixed $group): bool => is_array($group) && ($query === '' || str_contains(strtolower(json_encode($group) ?: ''), $query))));

        return ['groups' => array_slice($matches, 0, max(1, $limit)), 'count' => count($matches)];
    }

    /**
     * Get supported geographies for a dataset.
     *
     * @param  array<string, mixed>  $params  Dataset path and optional search/limit filters.
     * @return array<string, mixed>
     */
    public function geographies(array $params): array
    {
        $data = $this->get($this->datasetPath($params).'/geography.json');
        $fips = $data['fips'] ?? [];
        if (!is_array($fips)) {
            return $data;
        }

        $query = strtolower(trim((string) ($params['q'] ?? '')));
        $limit = (int) ($params['limit'] ?? 100);
        $matches = array_values(array_filter($fips, static fn (mixed $geo): bool => is_array($geo) && ($query === '' || str_contains(strtolower(json_encode($geo) ?: ''), $query))));

        return ['fips' => array_slice($matches, 0, max(1, $limit)), 'count' => count($matches)];
    }

    /**
     * Get examples for a dataset.
     *
     * @param  array<string, mixed>  $params  Dataset path.
     * @return array<string, mixed>
     */
    public function examples(array $params): array
    {
        return $this->get($this->datasetPath($params).'/examples.json');
    }

    /**
     * Query a Census dataset.
     *
     * @param  array<string, mixed>  $params  Dataset path, get variables, for/in predicates, ucgid, predicates object, and optional key.
     * @return array<string, mixed>
     */
    public function dataQuery(array $params): array
    {
        $path = $this->datasetPath($params);
        $query = [];
        foreach (['get', 'for', 'in', 'ucgid'] as $field) {
            if (($params[$field] ?? '') !== '') {
                $query[$field] = $params[$field];
            }
        }
        if (isset($params['predicates']) && is_array($params['predicates'])) {
            $query += $params['predicates'];
        }
        if (($query['get'] ?? '') === '') {
            throw new RuntimeException('get is required for Census data queries.');
        }
        if (($query['for'] ?? '') === '' && ($query['ucgid'] ?? '') === '') {
            throw new RuntimeException('for or ucgid is required for Census data queries.');
        }

        $rows = $this->get($path, $query);
        if (!is_array($rows) || !isset($rows[0]) || !is_array($rows[0])) {
            return is_array($rows) ? $rows : ['body' => $rows];
        }

        $headers = $rows[0];
        $records = [];
        foreach (array_slice($rows, 1) as $row) {
            if (is_array($row)) {
                $records[] = array_combine($headers, $row) ?: [];
            }
        }

        return ['headers' => $headers, 'records' => $records, 'row_count' => count($records), 'raw' => $rows];
    }

    /**
     * Build a Census API URL for inspection or sharing.
     *
     * @param  array<string, mixed>  $params  Dataset path, get variables, geography, ucgid, predicates object, and optional include_key flag.
     * @return array<string, mixed>
     */
    public function dataQueryUrl(array $params): array
    {
        $path = $this->datasetPath($params);
        $query = [];
        foreach (['get', 'for', 'in', 'ucgid'] as $field) {
            if (($params[$field] ?? '') !== '') {
                $query[$field] = $params[$field];
            }
        }
        if (isset($params['predicates']) && is_array($params['predicates'])) {
            $query += $params['predicates'];
        }
        if (($params['include_key'] ?? false) && $this->apiKey !== '') {
            $query['key'] = $this->apiKey;
        }

        return ['url' => $this->baseUrl.'/'.$path.'?'.http_build_query($query), 'path' => $path, 'query' => $query];
    }

    /**
     * Execute a Census API GET request.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    private function get(string $path, array $query = []): array
    {
        if ($this->apiKey !== '' && !isset($query['key'])) {
            $query['key'] = $this->apiKey;
        }

        try {
            $response = Http::acceptJson()
                ->timeout(60)
                ->get($this->baseUrl.'/'.$path, array_filter($query, static fn (mixed $value): bool => $value !== null && $value !== ''));

            return $this->parseResponse($response, $path);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('US Census API connection error: '.$path, ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to US Census API: '.$e->getMessage());
        }
    }

    /**
     * Parse JSON responses and normalize Census errors.
     *
     * @return array<string, mixed>
     */
    private function parseResponse(Response $response, string $path): array
    {
        $json = $response->json();
        if (!$response->successful()) {
            $message = is_array($json) ? (string) ($json['error'] ?? $json['message'] ?? '') : trim(strip_tags($response->body()));
            Log::error('US Census API error: '.$path, ['status' => $response->status(), 'error' => $message]);

            throw new RuntimeException('US Census API error ('.$response->status().'): '.($message !== '' ? $message : 'Unexpected API error.'));
        }

        return is_array($json) ? $json : ['body' => $response->body(), 'status' => $response->status()];
    }

    /**
     * Build a safe Census dataset path.
     *
     * @param  array<string, mixed>  $params  Tool arguments.
     */
    private function datasetPath(array $params): string
    {
        $path = trim((string) ($params['dataset'] ?? ''), '/');
        if ($path === '') {
            $year = trim((string) ($params['year'] ?? ''));
            $name = trim((string) ($params['name'] ?? ''), '/');
            $path = trim($year.'/'.$name, '/');
        }
        if ($path === '' || !preg_match('#^data/[0-9]{4}/[A-Za-z0-9_./-]+$#', 'data/'.$path)) {
            throw new RuntimeException('dataset must be a Census API path such as 2023/acs/acs5.');
        }

        return 'data/'.$path;
    }
}
