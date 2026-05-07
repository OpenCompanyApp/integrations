<?php

namespace OpenCompany\Integrations\LangSmith;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the LangSmith REST API.
 *
 * Handles API key or bearer-token authentication, workspace and organization
 * headers, JSON and multipart dispatch, error logging, and response parsing.
 */
class LangSmithService
{
    /**
     * @param  string  $apiKey  LangSmith API key sent as the x-api-key header.
     * @param  string  $bearerToken  Optional bearer token for OAuth-style calls.
     * @param  string  $tenantId  Optional LangSmith workspace ID sent as x-tenant-id.
     * @param  string  $organizationId  Optional organization ID sent as x-organization-id.
     * @param  string  $baseUrl  LangSmith API base URL, for example https://api.smith.langchain.com.
     */
    public function __construct(
        private string $apiKey = '',
        private string $bearerToken = '',
        private string $tenantId = '',
        private string $organizationId = '',
        private string $baseUrl = 'https://api.smith.langchain.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->apiKey !== '' || $this->bearerToken !== '';
    }

    /**
     * Execute a LangSmith REST API operation.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $body  JSON or multipart request body.
     * @return array<string, mixed>
     */
    public function request(string $method, string $path, array $query = [], array $body = [], bool $multipart = false): array
    {
        $response = $this->rawRequest($method, $path, $query, $body, $multipart);

        if ($response->body() === '') {
            return ['success' => true, 'status' => $response->status()];
        }

        return $response->json() ?? ['body' => $response->body(), 'status' => $response->status()];
    }

    /**
     * Perform a raw HTTP request against LangSmith.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $body  JSON or multipart request body.
     */
    private function rawRequest(string $method, string $path, array $query = [], array $body = [], bool $multipart = false): Response
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('LangSmith API key or bearer token is not configured.');
        }

        try {
            $http = $this->http();
            $url = $this->urlWithQuery($this->baseUrl . $path, strtoupper($method) === 'GET' ? [] : $query);
            $method = strtoupper($method);

            if ($multipart) {
                $http = $this->withMultipartBody($http, $body);
                $body = [];
            }

            $response = match ($method) {
                'GET' => $http->get($this->baseUrl . $path, $query),
                'POST' => $http->post($url, $body),
                'PUT' => $http->put($url, $body),
                'PATCH' => $http->patch($url, $body),
                'DELETE' => $http->delete($url, $body),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('detail')
                    ?? $response->json('error')
                    ?? $response->json('message')
                    ?? $response->body();

                Log::error("LangSmith API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new RuntimeException("LangSmith API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("LangSmith API connection error: {$method} {$path}", ['error' => $e->getMessage()]);

            throw new RuntimeException("Failed to connect to LangSmith API: {$e->getMessage()}");
        }
    }

    /**
     * Build the authenticated HTTP request object.
     */
    private function http(): PendingRequest
    {
        $headers = ['Accept' => 'application/json'];

        if ($this->apiKey !== '') {
            $headers['x-api-key'] = $this->apiKey;
        }

        if ($this->bearerToken !== '') {
            $headers['Authorization'] = 'Bearer ' . $this->bearerToken;
        }

        if ($this->tenantId !== '') {
            $headers['x-tenant-id'] = $this->tenantId;
        }

        if ($this->organizationId !== '') {
            $headers['x-organization-id'] = $this->organizationId;
        }

        return Http::withHeaders($headers)->timeout(120);
    }

    /**
     * Attach multipart body fields, including local file paths when provided.
     *
     * @param  array<string, mixed>  $body  Multipart fields.
     */
    private function withMultipartBody(PendingRequest $http, array $body): PendingRequest
    {
        foreach ($body as $key => $value) {
            if ($key === 'file_path' && is_string($value) && is_file($value)) {
                $http = $http->attach('file', fopen($value, 'r'), basename($value));
                continue;
            }

            if (is_array($value)) {
                $value = json_encode($value, JSON_UNESCAPED_SLASHES);
            }

            $http = $http->attach((string) $key, (string) $value);
        }

        return $http;
    }

    /**
     * Append query parameters for non-GET requests.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     */
    private function urlWithQuery(string $url, array $query): string
    {
        if ($query === []) {
            return $url;
        }

        return $url . '?' . http_build_query($query);
    }
}