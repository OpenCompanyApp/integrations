<?php

namespace OpenCompany\Integrations\ShipEngine;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the ShipEngine API.
 *
 * Handles API-Key authentication, URL expansion, query serialization, error
 * logging, and response parsing for all ShipEngine endpoint tools.
 */
class ShipEngineService
{
    /**
     * @param  string  $apiKey  ShipEngine API key.
     * @param  string  $baseUrl  ShipEngine API base URL.
     */
    public function __construct(private string $apiKey = '', private string $baseUrl = 'https://api.shipengine.com')
    {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    /**
     * Make a ShipEngine API request and return decoded response data.
     *
     * @param  array<string, mixed>  $pathParams  Path placeholder values.
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $headers  Additional request headers.
     * @param  array<string, mixed>  $body  JSON request body.
     * @param  array<string, string>  $queryStyles  Query serialization hints.
     * @return array<string, mixed>|list<mixed>
     */
    public function request(string $method, string $pathTemplate, array $pathParams = [], array $query = [], array $headers = [], array $body = [], array $queryStyles = []): array
    {
        $response = $this->rawRequest($method, $this->expandPath($pathTemplate, $pathParams), $query, $headers, $body, $queryStyles);

        if ($response->body() === '') {
            return ['success' => true, 'status' => $response->status()];
        }

        return $response->json() ?? ['body' => $response->body(), 'status' => $response->status(), 'content_type' => $response->header('Content-Type')];
    }

    /**
     * Execute an HTTP request against ShipEngine.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $headers  Additional request headers.
     * @param  array<string, mixed>  $body  JSON request body.
     * @param  array<string, string>  $queryStyles  Query serialization hints.
     */
    private function rawRequest(string $method, string $path, array $query = [], array $headers = [], array $body = [], array $queryStyles = []): Response
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('ShipEngine API key is required.');
        }

        $baseHeaders = ['Accept' => 'application/json', 'Content-Type' => 'application/json', 'API-Key' => $this->apiKey];
        $method = strtoupper($method);
        $url = $this->urlWithQuery($this->baseUrl . $path, $query, $queryStyles);
        $response = Http::withHeaders(array_merge($baseHeaders, $headers))->timeout(60)->send($method, $url, $this->requestOptions($method, $body));

        if (!$response->successful()) {
            Log::error('ShipEngine API request failed', ['method' => $method, 'path' => $path, 'status' => $response->status(), 'body' => $response->body()]);
            $message = $response->json('message') ?? $response->json('error') ?? $response->json('errors') ?? $response->body() ?: 'ShipEngine API request failed.';
            throw new RuntimeException('ShipEngine API error: ' . (is_string($message) ? $message : json_encode($message)));
        }

        return $response;
    }

    /**
     * @param  array<string, mixed>  $body  JSON request body.
     * @return array<string, mixed>
     */
    private function requestOptions(string $method, array $body): array
    {
        if (($method === 'GET' || $method === 'DELETE') && $body === []) {
            return [];
        }

        return $body === [] ? [] : ['json' => $body];
    }

    /**
     * Expand path placeholders with raw URL encoded values.
     *
     * @param  array<string, mixed>  $pathParams  Path placeholder values.
     */
    private function expandPath(string $pathTemplate, array $pathParams): string
    {
        foreach ($pathParams as $key => $value) {
            $pathTemplate = str_replace('{' . $key . '}', rawurlencode((string) $value), $pathTemplate);
        }

        return $pathTemplate;
    }

    /**
     * Append query parameters to a URL using ShipEngine's documented REST query shape.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, string>  $queryStyles  Query serialization hints.
     */
    private function urlWithQuery(string $url, array $query, array $queryStyles): string
    {
        $parts = [];
        foreach ($query as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }
            if (is_array($value)) {
                if (($queryStyles[$key] ?? '') === 'comma') {
                    $parts[] = rawurlencode((string) $key) . '=' . rawurlencode(implode(',', array_map(static fn (mixed $item): string => is_scalar($item) ? (string) $item : json_encode($item), $value)));
                    continue;
                }
                foreach ($value as $item) {
                    if ($item === null || $item === '') {
                        continue;
                    }
                    $parts[] = rawurlencode((string) $key) . '=' . rawurlencode(is_scalar($item) ? (string) $item : json_encode($item));
                }
                continue;
            }
            $parts[] = rawurlencode((string) $key) . '=' . rawurlencode((string) $value);
        }

        return $parts === [] ? $url : $url . '?' . implode('&', $parts);
    }
}
