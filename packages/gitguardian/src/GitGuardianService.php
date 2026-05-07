<?php

namespace OpenCompany\Integrations\GitGuardian;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the GitGuardian API.
 *
 * Handles Token header authentication, JSON and SCIM JSON requests, URL
 * expansion, error logging, and response parsing for endpoint tools.
 */
class GitGuardianService
{
    /**
     * @param  string  $apiKey  GitGuardian API key.
     * @param  string  $baseUrl  GitGuardian API base URL.
     */
    public function __construct(private string $apiKey = '', private string $baseUrl = 'https://api.gitguardian.com')
    {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    /**
     * Make a GitGuardian API request and return parsed response data.
     *
     * @param  array<string, mixed>  $pathParams  Path placeholder values.
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $headers  Additional request headers.
     * @param  array<string, mixed>  $body  JSON request body fields.
     * @return array<string, mixed>|list<mixed>
     */
    public function request(string $method, string $pathTemplate, array $pathParams = [], array $query = [], array $headers = [], array $body = [], string $bodyContentType = 'application/json'): array
    {
        $response = $this->rawRequest($method, $this->expandPath($pathTemplate, $pathParams), $query, $headers, $body, $bodyContentType);

        if ($response->body() === '') {
            return ['success' => true, 'status' => $response->status()];
        }

        return $response->json() ?? ['body' => $response->body(), 'status' => $response->status(), 'content_type' => $response->header('Content-Type')];
    }

    /**
     * Execute an HTTP request against GitGuardian.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $headers  Additional request headers.
     * @param  array<string, mixed>  $body  JSON request body fields.
     */
    private function rawRequest(string $method, string $path, array $query = [], array $headers = [], array $body = [], string $bodyContentType = 'application/json'): Response
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('GitGuardian API key is not configured.');
        }

        $baseHeaders = ['Accept' => 'application/json', 'Content-Type' => $bodyContentType, 'Authorization' => 'Token ' . $this->apiKey];
        $request = Http::withHeaders(array_merge($baseHeaders, $headers))->timeout(60);
        $method = strtoupper($method);
        $url = $this->urlWithQuery($this->baseUrl . $path, $query);
        $response = $request->send($method, $url, ($method === 'GET' || $method === 'DELETE') && $body === [] ? [] : ['json' => $body]);

        if (!$response->successful()) {
            Log::error('GitGuardian API request failed', ['method' => $method, 'path' => $path, 'status' => $response->status(), 'body' => $response->body()]);
            $message = $response->json('detail') ?? $response->json('message') ?? $response->json('error') ?? $response->body() ?: 'GitGuardian API request failed.';
            throw new RuntimeException('GitGuardian API error: ' . (is_string($message) ? $message : json_encode($message)));
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
     * Append query parameters to a URL, repeating array values where needed.
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
            foreach (is_array($value) ? $value : [$value] as $item) {
                if ($item === null || $item === '') {
                    continue;
                }
                $parts[] = rawurlencode((string) $key) . '=' . rawurlencode((string) $item);
            }
        }

        return $parts === [] ? $url : $url . '?' . implode('&', $parts);
    }
}
