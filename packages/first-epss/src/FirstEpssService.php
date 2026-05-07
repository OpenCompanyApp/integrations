<?php

namespace OpenCompany\Integrations\FirstEpss;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the FIRST EPSS API.
 *
 * Handles official query parameters, CVE list normalization, threshold queries,
 * time-series scope, historical CSV URL construction, and API error handling.
 */
class FirstEpssService
{
    /**
     * @param  string  $baseUrl  FIRST API v1 base URL.
     * @param  string  $csvBaseUrl  Historical EPSS CSV base URL.
     */
    public function __construct(
        private string $baseUrl = 'https://api.first.org/data/v1',
        private string $csvBaseUrl = 'https://epss.empiricalsecurity.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
        $this->csvBaseUrl = rtrim($this->csvBaseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return true;
    }

    /**
     * Run a general FIRST EPSS query with official parameters.
     *
     * @param  array<string, mixed>  $params  EPSS query parameters.
     * @return array<string, mixed>
     */
    public function query(array $params = []): array
    {
        return $this->request($this->queryParams($params));
    }

    /**
     * Get EPSS score for one CVE, optionally on a specific date.
     *
     * @return array<string, mixed>
     */
    public function cve(string $cve, ?string $date = null): array
    {
        return $this->query(array_filter(['cve' => strtoupper(trim($cve)), 'date' => $date], static fn (mixed $value): bool => $value !== null && $value !== ''));
    }

    /**
     * Get EPSS scores for multiple CVEs.
     *
     * @param  list<string>  $cves  CVE identifiers.
     * @return array<string, mixed>
     */
    public function batch(array $cves, ?string $date = null): array
    {
        if ($cves === []) {
            throw new RuntimeException('cves must contain at least one CVE.');
        }

        return $this->query(array_filter(['cve' => $this->cveList($cves), 'date' => $date], static fn (mixed $value): bool => $value !== null && $value !== ''));
    }

    /**
     * Get EPSS time-series scores for one CVE.
     *
     * @return array<string, mixed>
     */
    public function timeSeries(string $cve, ?string $date = null): array
    {
        return $this->query(array_filter(['cve' => strtoupper(trim($cve)), 'date' => $date, 'scope' => 'time-series'], static fn (mixed $value): bool => $value !== null && $value !== ''));
    }

    /**
     * List highest scoring CVEs ordered by EPSS or percentile.
     *
     * @return array<string, mixed>
     */
    public function top(int $limit = 100, string $by = 'epss', ?string $date = null): array
    {
        if (!in_array($by, ['epss', 'percentile'], true)) {
            throw new RuntimeException('by must be epss or percentile.');
        }

        return $this->query(array_filter(['order' => '!'.$by, 'limit' => $limit, 'date' => $date], static fn (mixed $value): bool => $value !== null && $value !== ''));
    }

    /**
     * List CVEs above EPSS or percentile thresholds.
     *
     * @param  array<string, mixed>  $params  Threshold query parameters.
     * @return array<string, mixed>
     */
    public function threshold(array $params): array
    {
        if (!isset($params['epss_gt']) && !isset($params['percentile_gt'])) {
            throw new RuntimeException('epss_gt or percentile_gt is required.');
        }

        return $this->query($params + ['order' => '!epss']);
    }

    /**
     * Return the official historical EPSS daily CSV gzip URL for a date.
     *
     * @return array{date: string, url: string}
     */
    public function historicalCsvUrl(string $date): array
    {
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
            throw new RuntimeException('date must use YYYY-MM-DD format.');
        }

        return ['date' => $date, 'url' => $this->csvBaseUrl.'/epss_scores-'.$date.'.csv.gz'];
    }

    /**
     * Execute a FIRST EPSS GET request.
     *
     * @param  array<string, mixed>  $query  Query-string parameters.
     * @return array<string, mixed>
     */
    private function request(array $query): array
    {
        try {
            $response = Http::acceptJson()
                ->timeout(60)
                ->get($this->baseUrl.'/epss', $query);

            return $this->parseResponse($response);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('FIRST EPSS API connection error', ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to FIRST EPSS API: '.$e->getMessage());
        }
    }

    /**
     * Convert tool-style snake-case parameters to FIRST query parameters.
     *
     * @param  array<string, mixed>  $params  Tool arguments.
     * @return array<string, mixed>
     */
    private function queryParams(array $params): array
    {
        $map = [
            'epss_gt' => 'epss-gt',
            'percentile_gt' => 'percentile-gt',
            'results_per_page' => 'limit',
            'fields' => 'fields',
            'limit' => 'limit',
            'offset' => 'offset',
            'order' => 'order',
            'sort' => 'sort',
            'date' => 'date',
            'scope' => 'scope',
            'envelope' => 'envelope',
            'pretty' => 'pretty',
        ];

        $query = [];
        foreach ($params as $key => $value) {
            if ($value === null || $value === '' || (is_array($value) && $value === [])) {
                continue;
            }
            if ($key === 'cves' && is_array($value)) {
                $query['cve'] = $this->cveList($value);
                continue;
            }
            if ($key === 'cve') {
                $query['cve'] = is_array($value) ? $this->cveList($value) : strtoupper((string) $value);
                continue;
            }
            $query[$map[$key] ?? $key] = is_bool($value) ? ($value ? 'true' : 'false') : $value;
        }

        return $query;
    }

    /**
     * Normalize a list of CVE identifiers into FIRST's comma-separated cve parameter.
     *
     * @param  list<string>  $cves  CVE identifiers.
     */
    private function cveList(array $cves): string
    {
        $normalized = array_values(array_filter(array_map(static fn (mixed $cve): string => strtoupper(trim((string) $cve)), $cves)));
        if ($normalized === []) {
            throw new RuntimeException('cves must contain at least one CVE.');
        }

        return implode(',', $normalized);
    }

    /**
     * Parse FIRST API responses and normalize API errors.
     *
     * @return array<string, mixed>
     */
    private function parseResponse(Response $response): array
    {
        $json = $response->json();

        if (!$response->successful()) {
            $message = is_array($json) ? ($json['message'] ?? $json['status-code'] ?? null) : null;
            $message = is_string($message) && $message !== '' ? $message : $response->body();
            Log::error('FIRST EPSS API error', ['status' => $response->status(), 'error' => $message]);

            throw new RuntimeException('FIRST EPSS API error ('.$response->status().'): '.$message);
        }

        if (is_array($json)) {
            return $json;
        }

        return ['body' => $response->body(), 'status' => $response->status()];
    }
}
