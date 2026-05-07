<?php

namespace OpenCompany\Integrations\Urlscan;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the urlscan.io API.
 *
 * Handles api-key header authentication, URL expansion, error logging, and
 * response parsing for the official urlscan.io OpenAPI endpoint tools.
 */
class UrlscanService
{
    /**
     * @param  string  $apiKey  urlscan.io API key.
     * @param  string  $baseUrl  urlscan.io API base URL.
     */
    public function __construct(private string $apiKey = '', private string $baseUrl = 'https://urlscan.io')
    {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    /**
     * Make a urlscan.io API request and return parsed response data.
     *
     * @param  array<string, mixed>  $pathParams  Path placeholder values.
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $headers  Additional request headers.
     * @param  array<string, mixed>  $body  JSON body fields.
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
     * Execute an HTTP request against urlscan.io.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $headers  Additional request headers.
     * @param  array<string, mixed>  $body  JSON body fields.
     */
    private function rawRequest(string $method, string $path, array $query = [], array $headers = [], array $body = []): Response
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('urlscan.io API key is not configured.');
        }

        $request = Http::withHeaders(array_merge(['Accept' => 'application/json', 'Content-Type' => 'application/json', 'api-key' => $this->apiKey], $headers))->timeout(60);
        $method = strtoupper($method);
        $url = $this->urlWithQuery($this->baseUrl . $path, $query);
        $response = $request->send($method, $url, ($method === 'GET' || $method === 'DELETE') && $body === [] ? [] : ['json' => $body]);

        if (!$response->successful()) {
            Log::error('urlscan.io API request failed', ['method' => $method, 'path' => $path, 'status' => $response->status(), 'body' => $response->body()]);
            $message = $response->json('message') ?? $response->json('error') ?? $response->body() ?: 'urlscan.io API request failed.';
            throw new RuntimeException('urlscan.io API error: ' . $message);
        }

        return $response;
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
     * Append query parameters to a URL.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     */
    private function urlWithQuery(string $url, array $query): string
    {
        $query = array_filter($query, static fn ($value): bool => $value !== null && $value !== '');

        return $query === [] ? $url : $url . '?' . http_build_query($query);
    }
}
