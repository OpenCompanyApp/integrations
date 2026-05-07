<?php

namespace OpenCompany\Integrations\HealthchecksIo;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Healthchecks.io Management and Pinging APIs.
 *
 * Handles X-Api-Key authentication for management requests, unauthenticated ping
 * URL dispatch, URL expansion, error logging, and response parsing.
 */
class HealthchecksIoService
{
    /**
     * @param  string  $apiKey  Healthchecks.io project API key.
     * @param  string  $baseUrl  Healthchecks.io Management API base URL.
     * @param  string  $pingBaseUrl  Healthchecks.io Pinging API base URL.
     */
    public function __construct(private string $apiKey = '', private string $baseUrl = 'https://healthchecks.io/api/v3', private string $pingBaseUrl = 'https://hc-ping.com')
    {
        $this->baseUrl = rtrim($this->baseUrl, '/');
        $this->pingBaseUrl = rtrim($this->pingBaseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    /**
     * Make a Healthchecks.io API request and return parsed response data.
     *
     * @param  array<string, mixed>  $pathParams  Path placeholder values.
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $body  JSON request body fields or ping payload.
     * @return array<string, mixed>|list<mixed>
     */
    public function request(string $method, string $pathTemplate, array $pathParams = [], array $query = [], array $body = [], bool $requiresAuth = true, bool $ping = false): array
    {
        $path = $this->expandPath($pathTemplate, $pathParams);
        $response = $this->rawRequest($method, $path, $query, $body, $requiresAuth, $ping);

        if ($response->body() === '') {
            return ['success' => true, 'status' => $response->status()];
        }

        return $response->json() ?? ['body' => $response->body(), 'status' => $response->status(), 'content_type' => $response->header('Content-Type'), 'ping_body_limit' => $response->header('Ping-Body-Limit')];
    }

    /**
     * Execute an HTTP request against Healthchecks.io.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $body  JSON request body fields or ping payload.
     */
    private function rawRequest(string $method, string $path, array $query = [], array $body = [], bool $requiresAuth = true, bool $ping = false): Response
    {
        if ($requiresAuth && !$this->isConfigured()) {
            throw new RuntimeException('Healthchecks.io API key is not configured.');
        }

        $headers = ['Accept' => 'application/json'];
        if ($requiresAuth) {
            $headers['X-Api-Key'] = $this->apiKey;
            $headers['Content-Type'] = 'application/json';
        }

        $method = strtoupper($method);
        $url = $this->urlWithQuery(($ping ? $this->pingBaseUrl : $this->baseUrl) . $path, $query);
        $request = Http::withHeaders($headers)->timeout(60);
        $payload = $this->requestPayload($method, $body, $ping);
        $response = $request->send($method, $url, $payload);

        if (!$response->successful()) {
            Log::error('Healthchecks.io API request failed', ['method' => $method, 'path' => $path, 'status' => $response->status(), 'body' => $response->body()]);
            $message = $response->json('error') ?? $response->json('message') ?? $response->body() ?: 'Healthchecks.io API request failed.';
            throw new RuntimeException('Healthchecks.io API error: ' . (is_string($message) ? $message : json_encode($message)));
        }

        return $response;
    }

    /**
     * @param  array<string, mixed>  $body  JSON request body fields or ping payload.
     * @return array<string, mixed>
     */
    private function requestPayload(string $method, array $body, bool $ping): array
    {
        if (($method === 'GET' || $method === 'DELETE' || $method === 'HEAD') && $body === []) {
            return [];
        }

        if ($ping) {
            return ['body' => (string) ($body['body_text'] ?? '')];
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
