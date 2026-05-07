<?php

namespace OpenCompany\Integrations\Shippo;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Shippo API.
 *
 * Handles ShippoToken authentication, API-version headers, URL expansion,
 * query serialization, error logging, and response parsing for all tools.
 */
class ShippoService
{
    /**
     * @param  string  $apiToken  Shippo live or test API token.
     * @param  string  $baseUrl  Shippo API base URL.
     * @param  string  $apiVersion  Shippo API version header value.
     */
    public function __construct(private string $apiToken = '', private string $baseUrl = 'https://api.goshippo.com', private string $apiVersion = '2018-02-08')
    {
        $this->baseUrl = rtrim($this->baseUrl, '/');
        $this->apiVersion = $this->apiVersion !== '' ? $this->apiVersion : '2018-02-08';
    }

    public function isConfigured(): bool
    {
        return $this->apiToken !== '';
    }

    /**
     * Make a Shippo API request and return decoded response data.
     *
     * @param  array<string, mixed>  $pathParams  Path placeholder values.
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $headers  Additional request headers.
     * @param  array<string, mixed>  $body  JSON request body.
     * @return array<string, mixed>|list<mixed>
     */
    public function request(string $method, string $pathTemplate, array $pathParams = [], array $query = [], array $headers = [], array $body = []): array
    {
        $response = $this->rawRequest($method, $this->expandPath($pathTemplate, $pathParams), $query, $headers, $body);

        if ($response->body() === '') {
            return ['success' => true, 'status' => $response->status()];
        }

        return $response->json() ?? ['body' => $response->body(), 'status' => $response->status(), 'content_type' => $response->header('Content-Type')];
    }

    /**
     * Execute an HTTP request against Shippo.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $headers  Additional request headers.
     * @param  array<string, mixed>  $body  JSON request body.
     */
    private function rawRequest(string $method, string $path, array $query = [], array $headers = [], array $body = []): Response
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Shippo API token is required.');
        }

        $baseHeaders = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'ShippoToken ' . $this->apiToken,
            'SHIPPO-API-VERSION' => $this->apiVersion,
        ];

        $method = strtoupper($method);
        $url = $this->urlWithQuery($this->baseUrl . $path, $query);
        $response = Http::withHeaders(array_merge($baseHeaders, $headers))->timeout(60)->send($method, $url, $this->requestOptions($method, $body));

        if (!$response->successful()) {
            Log::error('Shippo API request failed', ['method' => $method, 'path' => $path, 'status' => $response->status(), 'body' => $response->body()]);
            $message = $response->json('detail') ?? $response->json('message') ?? $response->json('error') ?? $response->body() ?: 'Shippo API request failed.';
            throw new RuntimeException('Shippo API error: ' . (is_string($message) ? $message : json_encode($message)));
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
     * Append query parameters to a URL using Shippo's documented REST query shape.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     */
    private function urlWithQuery(string $url, array $query): string
    {
        $parts = [];
        foreach ($query as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }
            if (is_array($value)) {
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
