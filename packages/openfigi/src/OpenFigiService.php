<?php

namespace OpenCompany\Integrations\OpenFigi;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the OpenFIGI API.
 *
 * Handles optional API-key headers, v3 endpoint routing, request validation,
 * response parsing, and OpenFIGI error normalization.
 */
class OpenFigiService
{
    /**
     * @param  string  $apiKey  Optional OpenFIGI API key for higher rate limits.
     * @param  string  $baseUrl  OpenFIGI API base URL.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.openfigi.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return true;
    }

    public function hasApiKey(): bool
    {
        return trim($this->apiKey) !== '';
    }

    /**
     * Map third-party identifiers to FIGIs using v3 mapping jobs.
     *
     * @param  list<array<string, mixed>>  $jobs  Mapping jobs with idType and idValue.
     * @return array<string, mixed>|list<mixed>
     */
    public function mapping(array $jobs): array
    {
        if ($jobs === []) {
            throw new RuntimeException('jobs must contain at least one mapping job.');
        }

        foreach ($jobs as $index => $job) {
            if (!is_array($job) || ($job['idType'] ?? '') === '' || ($job['idValue'] ?? '') === '') {
                throw new RuntimeException("jobs[{$index}] must include idType and idValue.");
            }
        }

        return $this->request('POST', '/v3/mapping', $jobs);
    }

    /**
     * Retrieve current enum values for a mapping-job property.
     *
     * @return array<string, mixed>
     */
    public function mappingValues(string $key): array
    {
        $allowed = ['idType', 'exchCode', 'micCode', 'currency', 'marketSecDes', 'securityType', 'securityType2', 'stateCode'];
        if (!in_array($key, $allowed, true)) {
            throw new RuntimeException('key must be one of: '.implode(', ', $allowed).'.');
        }

        return $this->request('GET', '/v3/mapping/values/'.rawurlencode($key));
    }

    /**
     * Search for FIGIs using query text and optional filters.
     *
     * @param  array<string, mixed>  $filters  Search payload.
     * @return array<string, mixed>
     */
    public function search(array $filters = []): array
    {
        return $this->request('POST', '/v3/search', $this->cleanPayload($filters));
    }

    /**
     * Filter for FIGIs using supported instrument filters.
     *
     * @param  array<string, mixed>  $filters  Filter payload.
     * @return array<string, mixed>
     */
    public function filter(array $filters = []): array
    {
        return $this->request('POST', '/v3/filter', $this->cleanPayload($filters));
    }

    /**
     * Retrieve the OpenFIGI OpenAPI schema.
     *
     * @return array<string, mixed>
     */
    public function schema(): array
    {
        return $this->request('GET', '/schema');
    }

    /**
     * Execute an OpenFIGI request.
     *
     * @param  array<string, mixed>|list<mixed>  $payload  JSON request payload for POST requests.
     * @return array<string, mixed>|list<mixed>
     */
    private function request(string $method, string $path, array $payload = []): array
    {
        try {
            $request = Http::acceptJson()
                ->asJson()
                ->timeout(60);

            if ($this->hasApiKey()) {
                $request = $request->withHeaders(['X-OPENFIGI-APIKEY' => $this->apiKey]);
            }

            $response = strtoupper($method) === 'GET'
                ? $request->get($this->baseUrl.$path)
                : $request->post($this->baseUrl.$path, $payload);

            return $this->parseResponse($response, $path);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("OpenFIGI API connection error: {$path}", ['error' => $e->getMessage()]);

            throw new RuntimeException("Failed to connect to OpenFIGI API: {$e->getMessage()}");
        }
    }

    /**
     * Remove empty filter values and preserve valid false/zero values.
     *
     * @param  array<string, mixed>  $payload  Request payload.
     * @return array<string, mixed>
     */
    private function cleanPayload(array $payload): array
    {
        $clean = [];
        foreach ($payload as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }
            $clean[$key] = $value;
        }

        return $clean;
    }

    /**
     * Parse OpenFIGI responses and normalize HTTP-level errors.
     *
     * @return array<string, mixed>|list<mixed>
     */
    private function parseResponse(Response $response, string $path): array
    {
        $json = $response->json();

        if (!$response->successful()) {
            $message = null;
            if (is_array($json)) {
                $message = $json['error'] ?? $json['message'] ?? $json['warning'] ?? null;
            }
            $message = is_string($message) ? $message : $response->body();
            Log::error("OpenFIGI API error: {$path}", ['status' => $response->status(), 'error' => $message]);

            throw new RuntimeException('OpenFIGI API error ('.$response->status().'): '.$message);
        }

        if (is_array($json)) {
            return $json;
        }

        return ['body' => $response->body(), 'status' => $response->status()];
    }
}
