<?php

namespace OpenCompany\Integrations\Browserless;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Browserless API.
 *
 * Handles token query authentication, JSON and JavaScript request bodies, path
 * expansion, error logging, and response parsing for endpoint tools.
 */
class BrowserlessService
{
    /**
     * @param  string  $apiKey  Browserless API token.
     * @param  string  $baseUrl  Browserless API base URL.
     */
    public function __construct(private string $apiKey = '', private string $baseUrl = 'https://production-sfo.browserless.io')
    {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->apiKey !== '' && $this->baseUrl !== '';
    }

    /**
     * Make a Browserless API request and return parsed response data.
     *
     * @param  array<string, mixed>  $pathParams  Path placeholder values.
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $headers  Additional request headers.
     * @param  array<string, mixed>  $body  JSON body or raw JavaScript body wrapper.
     * @return array<string, mixed>|list<mixed>
     */
    public function request(string $method, string $pathTemplate, array $pathParams = [], array $query = [], array $headers = [], array $body = [], string $bodyContentType = 'json'): array
    {
        $response = $this->rawRequest($method, $this->expandPath($pathTemplate, $pathParams), $query, $headers, $body, $bodyContentType);
        if ($response->body() === '') { return ['success' => true, 'status' => $response->status()]; }
        return $response->json() ?? ['body' => $response->body(), 'status' => $response->status()];
    }

    /**
     * Execute an HTTP request against Browserless.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $headers  Additional request headers.
     * @param  array<string, mixed>  $body  JSON body or raw JavaScript body wrapper.
     */
    private function rawRequest(string $method, string $path, array $query = [], array $headers = [], array $body = [], string $bodyContentType = 'json'): Response
    {
        if (!$this->isConfigured()) { throw new RuntimeException('Browserless API token is not configured.'); }
        $query['token'] = $query['token'] ?? $this->apiKey;
        $method = strtoupper($method);
        $contentType = $bodyContentType === 'javascript' ? 'application/javascript' : 'application/json';
        $request = Http::withHeaders(array_merge(['Accept' => 'application/json', 'Content-Type' => $contentType], $headers))->timeout(120);
        $url = $this->urlWithQuery($this->baseUrl . $path, $query);
        $options = [];
        if ($bodyContentType === 'javascript') { $options['body'] = (string) ($body['code'] ?? ''); }
        elseif (($method !== 'GET' && $method !== 'DELETE') || $body !== []) { $options['json'] = $body; }
        $response = $request->send($method, $url, $options);
        if (!$response->successful()) {
            Log::error('Browserless API request failed', ['method' => $method, 'path' => $path, 'status' => $response->status(), 'body' => $response->body()]);
            $message = $response->json('message') ?? $response->json('error') ?? $response->body() ?: 'Browserless API request failed.';
            throw new RuntimeException('Browserless API error: ' . $message);
        }
        return $response;
    }

    /**
     * Expand required path placeholders and remove optional empty placeholders.
     * @param  array<string, mixed>  $pathParams  Path placeholder values.
     */
    private function expandPath(string $pathTemplate, array $pathParams): string
    {
        foreach ($pathParams as $key => $value) { $pathTemplate = str_replace('{' . $key . '}', rawurlencode((string) $value), $pathTemplate); }
        return preg_replace('#/?\{[A-Za-z0-9_-]+\}#', '', $pathTemplate) ?: '/';
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
