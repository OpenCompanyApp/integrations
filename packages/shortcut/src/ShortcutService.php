<?php

namespace OpenCompany\Integrations\Shortcut;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Shortcut REST API.
 *
 * Handles Shortcut-Token authentication, JSON and multipart requests, error
 * logging, URL expansion, and response parsing for generated endpoint tools.
 */
class ShortcutService
{
    /**
     * @param  string  $apiKey  Shortcut API token.
     * @param  string  $baseUrl  Shortcut API origin, usually https://api.app.shortcut.com.
     */
    public function __construct(private string $apiKey = '', private string $baseUrl = 'https://api.app.shortcut.com')
    {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    /**
     * Make a Shortcut API request and return parsed response data.
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

        if ($response->body() === '') {
            return ['success' => true, 'status' => $response->status()];
        }

        return $response->json() ?? ['body' => $response->body(), 'status' => $response->status()];
    }

    /**
     * Execute an HTTP request against Shortcut.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $headers  Additional request headers.
     * @param  array<string, mixed>  $body  JSON body or multipart fields.
     */
    private function rawRequest(string $method, string $path, array $query = [], array $headers = [], array $body = [], string $bodyContentType = 'json'): Response
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Shortcut API token is not configured.');
        }

        $request = Http::withHeaders(array_merge(['Accept' => 'application/json', 'Content-Type' => 'application/json', 'Shortcut-Token' => $this->apiKey], $headers))->timeout(60);
        $url = $this->urlWithQuery($this->baseUrl . $path, $query);
        $method = strtoupper($method);

        if ($bodyContentType === 'multipart') {
            $response = $this->applyMultipart($request, $body)->send($method, $url);
        } elseif ($method === 'GET' || $method === 'DELETE') {
            $response = $request->send($method, $url, $body === [] ? [] : ['json' => $body]);
        } else {
            $response = $request->send($method, $url, ['json' => $body]);
        }

        if (!$response->successful()) {
            Log::error('Shortcut API request failed', ['method' => $method, 'path' => $path, 'status' => $response->status(), 'body' => $response->body()]);
            $message = $response->json('message') ?? $response->json('error') ?? $response->body() ?: 'Shortcut API request failed.';
            throw new RuntimeException('Shortcut API error: ' . $message);
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
            if (str_starts_with((string) $key, 'file') && is_string($value) && is_file($value)) {
                $request = $request->attach((string) $key, fopen($value, 'r'), basename($value));
                continue;
            }

            if ($value !== null && $value !== '') {
                $request = $request->attach((string) $key, (string) $value);
            }
        }

        return $request;
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
     * Append query parameters to a URL while preserving zero and false values.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     */
    private function urlWithQuery(string $url, array $query): string
    {
        $query = array_filter($query, static fn ($value): bool => $value !== null && $value !== '');

        if ($query === []) {
            return $url;
        }

        return $url . '?' . http_build_query($query);
    }
}
