<?php

namespace OpenCompany\Integrations\AbuseIpdb;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the AbuseIPDB API v2.
 *
 * Handles API-key authentication, endpoint routing, query/form normalization,
 * CSV upload payloads, text blacklist responses, and API error parsing.
 */
class AbuseIpdbService
{
    /**
     * @param  string  $apiKey  AbuseIPDB API v2 key.
     * @param  string  $baseUrl  AbuseIPDB API v2 base URL.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.abuseipdb.com/api/v2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return trim($this->apiKey) !== '';
    }

    /**
     * Check one IPv4 or IPv6 address reputation.
     *
     * @param  array<string, mixed>  $params  max_age_in_days and verbose options.
     * @return array<string, mixed>
     */
    public function check(string $ipAddress, array $params = []): array
    {
        $query = ['ipAddress' => $ipAddress];
        $this->copyIfPresent($params, $query, 'max_age_in_days', 'maxAgeInDays');
        if (($params['verbose'] ?? false) === true) {
            $query['verbose'] = 1;
        }

        return $this->request('GET', '/check', $query);
    }

    /**
     * List reports for one IPv4 or IPv6 address.
     *
     * @param  array<string, mixed>  $params  max_age_in_days, page, and per_page options.
     * @return array<string, mixed>
     */
    public function reports(string $ipAddress, array $params = []): array
    {
        $query = ['ipAddress' => $ipAddress];
        $this->copyIfPresent($params, $query, 'max_age_in_days', 'maxAgeInDays');
        $this->copyIfPresent($params, $query, 'page', 'page');
        $this->copyIfPresent($params, $query, 'per_page', 'perPage');

        return $this->request('GET', '/reports', $query);
    }

    /**
     * Retrieve the AbuseIPDB blacklist in JSON or plaintext form.
     *
     * @param  array<string, mixed>  $params  confidence_minimum, limit, countries, IP version, and plaintext options.
     * @return array<string, mixed>
     */
    public function blacklist(array $params = []): array
    {
        $query = [];
        $this->copyIfPresent($params, $query, 'confidence_minimum', 'confidenceMinimum');
        $this->copyIfPresent($params, $query, 'limit', 'limit');
        $this->copyIfPresent($params, $query, 'only_countries', 'onlyCountries');
        $this->copyIfPresent($params, $query, 'except_countries', 'exceptCountries');
        $this->copyIfPresent($params, $query, 'ip_version', 'ipVersion');
        if (($params['plaintext'] ?? false) === true) {
            $query['plaintext'] = 1;
        }

        return $this->request('GET', '/blacklist', $query, [], [], ($params['plaintext'] ?? false) === true ? 'text/plain' : 'application/json');
    }

    /**
     * Report abusive activity for one IP address.
     *
     * @param  array<int|string, mixed>  $categories  AbuseIPDB category IDs.
     * @return array<string, mixed>
     */
    public function report(string $ipAddress, array $categories, string $comment = '', string $timestamp = ''): array
    {
        if ($categories === []) {
            throw new RuntimeException('categories is required.');
        }

        $form = [
            'ip' => $ipAddress,
            'categories' => implode(',', array_map('strval', $categories)),
        ];
        if ($comment !== '') {
            $form['comment'] = $comment;
        }
        if ($timestamp !== '') {
            $form['timestamp'] = $timestamp;
        }

        return $this->request('POST', '/report', [], $form);
    }

    /**
     * Check an IPv4 or IPv6 CIDR block.
     *
     * @param  array<string, mixed>  $params  max_age_in_days option.
     * @return array<string, mixed>
     */
    public function checkBlock(string $network, array $params = []): array
    {
        $query = ['network' => $network];
        $this->copyIfPresent($params, $query, 'max_age_in_days', 'maxAgeInDays');

        return $this->request('GET', '/check-block', $query);
    }

    /**
     * Submit a CSV payload of abusive IP reports.
     *
     * @return array<string, mixed>
     */
    public function bulkReport(string $csv): array
    {
        if (trim($csv) === '') {
            throw new RuntimeException('csv is required.');
        }

        return $this->request('POST', '/bulk-report', [], [], [['name' => 'csv', 'contents' => $csv, 'filename' => 'report.csv']]);
    }

    /**
     * Clear reports for one IP address from the configured account.
     *
     * @return array<string, mixed>
     */
    public function clearAddress(string $ipAddress): array
    {
        return $this->request('DELETE', '/clear-address', ['ipAddress' => $ipAddress]);
    }

    /**
     * Execute an AbuseIPDB request.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $form  Form parameters.
     * @param  list<array<string, mixed>>  $multipart  Multipart parts.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $query = [], array $form = [], array $multipart = [], string $accept = 'application/json'): array
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('AbuseIPDB API key is required.');
        }

        try {
            $request = Http::withHeaders(['Key' => $this->apiKey, 'Accept' => $accept])->timeout(60);
            $url = $this->baseUrl.$path;
            $query = array_filter($query, static fn (mixed $value): bool => $value !== null && $value !== false && $value !== '');

            $response = match ($method) {
                'GET' => $request->get($url, $query),
                'DELETE' => $request->send('DELETE', $url, ['query' => $query]),
                'POST' => $multipart !== []
                    ? $request->asMultipart()->post($url, $multipart)
                    : $request->asForm()->post($url.($query !== [] ? '?'.http_build_query($query) : ''), $form),
                default => throw new RuntimeException('Unsupported AbuseIPDB request method.'),
            };

            return $this->parseResponse($response, $path, $accept);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('AbuseIPDB API connection error: '.$path, ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to AbuseIPDB API: '.$e->getMessage());
        }
    }

    /**
     * Parse JSON or plaintext responses and normalize API errors.
     *
     * @return array<string, mixed>
     */
    private function parseResponse(Response $response, string $path, string $accept): array
    {
        $json = $response->json();

        if (!$response->successful()) {
            $message = null;
            if (is_array($json)) {
                $first = $json['errors'][0] ?? null;
                $message = is_array($first) ? ($first['detail'] ?? null) : ($json['message'] ?? $json['error'] ?? null);
            }
            $message = is_string($message) && $message !== '' ? $message : trim(strip_tags($response->body()));
            Log::error('AbuseIPDB API error: '.$path, ['status' => $response->status(), 'error' => $message]);

            throw new RuntimeException('AbuseIPDB API error ('.$response->status().'): '.($message !== '' ? $message : 'Unexpected API error.'));
        }

        if ($accept === 'text/plain') {
            return ['data' => array_values(array_filter(preg_split('/\r?\n/', trim($response->body())) ?: [])), 'body' => $response->body()];
        }

        return is_array($json) ? $json : ['body' => $response->body(), 'status' => $response->status()];
    }

    /**
     * Copy snake_case tool parameters to AbuseIPDB API parameter names.
     *
     * @param  array<string, mixed>  $source  Tool parameters.
     * @param  array<string, mixed>  $target  API parameters.
     */
    private function copyIfPresent(array $source, array &$target, string $from, string $to): void
    {
        if (array_key_exists($from, $source)) {
            $target[$to] = $source[$from];
        }
    }
}
