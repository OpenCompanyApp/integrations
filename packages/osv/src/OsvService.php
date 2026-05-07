<?php

namespace OpenCompany\Integrations\Osv;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the OSV.dev API.
 *
 * Handles v1 and v1experimental endpoint routing, package query normalization,
 * request validation, response parsing, and OSV error reporting.
 */
class OsvService
{
    /**
     * @param  string  $baseUrl  OSV API base URL.
     */
    public function __construct(private string $baseUrl = 'https://api.osv.dev')
    {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return true;
    }

    /**
     * Query vulnerabilities for one project by package version, purl, or commit.
     *
     * @param  array<string, mixed>  $params  Query payload fields.
     * @return array<string, mixed>
     */
    public function query(array $params): array
    {
        return $this->request('POST', '/v1/query', $this->buildQuery($params));
    }

    /**
     * Query vulnerabilities for multiple packages or commits.
     *
     * @param  list<array<string, mixed>>  $queries  OSV query payloads.
     * @return array<string, mixed>
     */
    public function queryBatch(array $queries): array
    {
        if ($queries === []) {
            throw new RuntimeException('queries must contain at least one query.');
        }
        if (count($queries) > 1000) {
            throw new RuntimeException('queries may contain at most 1000 query items.');
        }

        $payload = [];
        foreach ($queries as $index => $query) {
            if (!is_array($query)) {
                throw new RuntimeException("queries[{$index}] must be an object.");
            }
            $payload[] = $this->buildQuery($query);
        }

        return $this->request('POST', '/v1/querybatch', ['queries' => $payload]);
    }

    /**
     * Retrieve one OSV vulnerability by ID.
     *
     * @return array<string, mixed>
     */
    public function vulnerability(string $id): array
    {
        return $this->request('GET', '/v1/vulns/'.rawurlencode(trim($id)));
    }

    /**
     * Retrieve experimental import-quality findings for a source.
     *
     * @return array<string, mixed>
     */
    public function importFindings(string $source): array
    {
        return $this->request('GET', '/v1experimental/importfindings/'.rawurlencode(trim($source)));
    }

    /**
     * Determine probable C/C++ package versions from file hashes.
     *
     * @param  array<string, mixed>  $params  Version query payload.
     * @return array<string, mixed>
     */
    public function determineVersion(array $params): array
    {
        $payload = isset($params['payload']) && is_array($params['payload']) ? $params['payload'] : $params;
        $fileHashes = $payload['file_hashes'] ?? null;
        if (!is_array($fileHashes) || $fileHashes === []) {
            throw new RuntimeException('file_hashes must contain at least one file hash.');
        }

        return $this->request('POST', '/v1experimental/determineversion', $this->cleanPayload($payload));
    }

    /**
     * Execute an OSV API request.
     *
     * @param  array<string, mixed>  $payload  JSON request payload.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $payload = []): array
    {
        try {
            $request = Http::acceptJson()
                ->asJson()
                ->timeout(60);

            $response = strtoupper($method) === 'GET'
                ? $request->get($this->baseUrl.$path)
                : $request->post($this->baseUrl.$path, $payload);

            return $this->parseResponse($response, $path);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('OSV API connection error: '.$path, ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to OSV API: '.$e->getMessage());
        }
    }

    /**
     * Build and validate one OSV query object.
     *
     * @param  array<string, mixed>  $params  Tool arguments or raw OSV query payload.
     * @return array<string, mixed>
     */
    private function buildQuery(array $params): array
    {
        $query = isset($params['payload']) && is_array($params['payload']) ? $params['payload'] : $params;
        unset($query['payload']);

        if (isset($query['package']) && is_array($query['package'])) {
            $package = $query['package'];
        } else {
            $package = [];
            if (($query['package_name'] ?? '') !== '') {
                $package['name'] = $query['package_name'];
            }
            if (($query['ecosystem'] ?? '') !== '') {
                $package['ecosystem'] = $query['ecosystem'];
            }
            if (($query['purl'] ?? '') !== '') {
                $package['purl'] = $query['purl'];
            }
        }

        $payload = [];
        foreach (['commit', 'version', 'page_token'] as $field) {
            if (($query[$field] ?? '') !== '') {
                $payload[$field] = $query[$field];
            }
        }
        if ($package !== []) {
            $payload['package'] = $this->cleanPayload($package);
        }

        $this->validateQuery($payload);

        return $payload;
    }

    /**
     * Validate OSV query rules that commonly cause 400 responses.
     *
     * @param  array<string, mixed>  $payload  OSV query payload.
     */
    private function validateQuery(array $payload): void
    {
        $hasCommit = ($payload['commit'] ?? '') !== '';
        $hasVersion = ($payload['version'] ?? '') !== '';
        $package = isset($payload['package']) && is_array($payload['package']) ? $payload['package'] : [];

        if ($hasCommit && $hasVersion) {
            throw new RuntimeException('commit and version cannot be used together.');
        }
        if (!$hasCommit && $package === []) {
            throw new RuntimeException('package is required when commit is not provided.');
        }
        if (($package['purl'] ?? '') !== '' && (($package['name'] ?? '') !== '' || ($package['ecosystem'] ?? '') !== '')) {
            throw new RuntimeException('package.purl cannot be combined with package name or ecosystem.');
        }
        if (($package['purl'] ?? '') !== '' && $hasVersion && str_contains((string) $package['purl'], '@')) {
            throw new RuntimeException('version cannot be used with a versioned package purl.');
        }
        if (($package['name'] ?? '') !== '' && ($package['ecosystem'] ?? '') === '') {
            throw new RuntimeException('package ecosystem is required when package name is used.');
        }
        if (($package['ecosystem'] ?? '') !== '' && ($package['name'] ?? '') === '') {
            throw new RuntimeException('package name is required when ecosystem is used.');
        }
    }

    /**
     * Remove empty payload values while preserving valid false and zero values.
     *
     * @param  array<string, mixed>  $payload  Request payload.
     * @return array<string, mixed>
     */
    private function cleanPayload(array $payload): array
    {
        $clean = [];
        foreach ($payload as $key => $value) {
            if ($value === null || $value === '' || (is_array($value) && $value === [])) {
                continue;
            }
            $clean[$key] = $value;
        }

        return $clean;
    }

    /**
     * Parse JSON responses and normalize API errors.
     *
     * @return array<string, mixed>
     */
    private function parseResponse(Response $response, string $path): array
    {
        $json = $response->json();

        if (!$response->successful()) {
            $message = null;
            if (is_array($json)) {
                $message = $json['message'] ?? $json['error'] ?? null;
            }
            $message = is_string($message) && $message !== '' ? $message : $response->body();
            Log::error('OSV API error: '.$path, ['status' => $response->status(), 'error' => $message]);

            throw new RuntimeException('OSV API error ('.$response->status().'): '.$message);
        }

        if (is_array($json)) {
            return $json;
        }

        return ['body' => $response->body(), 'status' => $response->status()];
    }
}
