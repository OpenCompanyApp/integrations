<?php

namespace OpenCompany\Integrations\Browserbase;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Browserbase API.
 *
 * Handles X-BB-API-Key authentication, JSON and multipart requests, URL
 * expansion, error logging, and response parsing for endpoint tools.
 */
class BrowserbaseService
{
    /**
     * @param  string  $apiKey  Browserbase API key.
     * @param  string  $baseUrl  Browserbase API base URL.
     */
    public function __construct(private string $apiKey = '', private string $baseUrl = 'https://api.browserbase.com')
    {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    /**
     * Make a Browserbase API request and return parsed response data.
     *
     * @param  array<string, mixed>  $pathParams  Path placeholder values.
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $headers  Additional request headers.
     * @param  array<string, mixed>  $body  JSON body or multipart fields.
     * @return array<string, mixed>|list<mixed>
     */
    public function request(string $method, string $pathTemplate, array $pathParams = [], array $query = [], array $headers = [], array $body = [], string $bodyContentType = 'json'): array
    {
        $response = $this->rawRequest($method, $this->expandPath($pathTemplate, $pathParams), $query, $headers, $body, $bodyContentType);

        if ($response->body() === '') { return ['success' => true, 'status' => $response->status()]; }

        return $response->json() ?? ['body' => $response->body(), 'status' => $response->status()];
    }

    /**
     * Execute an HTTP request against Browserbase.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $headers  Additional request headers.
     * @param  array<string, mixed>  $body  JSON body or multipart fields.
     */
    private function rawRequest(string $method, string $path, array $query = [], array $headers = [], array $body = [], string $bodyContentType = 'json'): Response
    {
        if (!$this->isConfigured()) { throw new RuntimeException('Browserbase API key is not configured.'); }

        $request = Http::withHeaders(array_merge(['Accept' => 'application/json', 'Content-Type' => 'application/json', 'X-BB-API-Key' => $this->apiKey], $headers))->timeout(60);
        $url = $this->urlWithQuery($this->baseUrl . $path, $query);
        $method = strtoupper($method);
        $response = $bodyContentType === 'multipart'
            ? $this->applyMultipart($request, $body)->send($method, $url)
            : $request->send($method, $url, ($method === 'GET' || $method === 'DELETE') && $body === [] ? [] : ['json' => $body]);

        if (!$response->successful()) {
            Log::error('Browserbase API request failed', ['method' => $method, 'path' => $path, 'status' => $response->status(), 'body' => $response->body()]);
            $message = $response->json('message') ?? $response->json('error') ?? $response->body() ?: 'Browserbase API request failed.';
            throw new RuntimeException('Browserbase API error: ' . $message);
        }

        return $response;
    }

    /**
     * Attach multipart file paths and fields to a pending request.
     *
     * @param  array<string, mixed>  $body  Multipart fields; file fields should be local paths.
     */
    private function applyMultipart(PendingRequest $request, array $body): PendingRequest
    {
        foreach ($body as $key => $value) {
            if (is_string($value) && is_file($value)) { $request = $request->attach((string) $key, fopen($value, 'r'), basename($value)); continue; }
            if ($value !== null && $value !== '') { $request = $request->attach((string) $key, (string) $value); }
        }
        return $request;
    }

    /**
     * Expand path placeholders with raw URL encoded values.
     * @param  array<string, mixed>  $pathParams  Path placeholder values.
     */
    private function expandPath(string $pathTemplate, array $pathParams): string
    {
        foreach ($pathParams as $key => $value) { $pathTemplate = str_replace('{' . $key . '}', rawurlencode((string) $value), $pathTemplate); }
        return $pathTemplate;
    }

    /**
     * Append query parameters to a URL.
     * @param  array<string, mixed>  $query  Query string parameters.
     */
    private function urlWithQuery(string $url, array $query): string
    {
        $query = array_filter($query, static fn ($value): bool => $value !== null && $value !== '');
        return $query === [] ? $url : $url . '?' . http_build_query($query);
    }
}
