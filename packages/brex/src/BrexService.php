<?php

namespace OpenCompany\Integrations\Brex;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Brex APIs.
 *
 * Handles OAuth bearer authentication, path and query construction, JSON
 * request dispatch, response parsing, and Brex API error normalization.
 */
class BrexService
{
    /**
     * @param  string  $accessToken  Brex OAuth access token.
     * @param  string  $baseUrl  Brex API base URL, usually https://api.brex.com.
     */
    public function __construct(private string $accessToken = '', private string $baseUrl = 'https://api.brex.com')
    {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->accessToken !== '';
    }

    /**
     * Execute a Brex API operation.
     *
     * @param  array<string, mixed>  $pathParams  Path parameter values keyed by OpenAPI parameter name.
     * @param  array<string, mixed>  $query  Query string parameters keyed by OpenAPI parameter name.
     * @param  array<string, mixed>  $headers  Extra endpoint-specific headers keyed by OpenAPI header name.
     * @param  array<string, mixed>  $body  JSON request body.
     * @return array<string, mixed>
     */
    public function request(string $method, string $pathTemplate, array $pathParams = [], array $query = [], array $headers = [], array $body = []): array
    {
        $response = $this->rawRequest($method, $this->expandPath($pathTemplate, $pathParams), $query, $headers, $body);
        if ($response->body() === '') return ['success' => true, 'status' => $response->status()];
        return $response->json() ?? ['body' => $response->body(), 'status' => $response->status()];
    }

    /**
     * Perform a raw HTTP request against Brex.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $headers  Extra endpoint-specific headers.
     * @param  array<string, mixed>  $body  JSON request body.
     */
    private function rawRequest(string $method, string $path, array $query = [], array $headers = [], array $body = []): Response
    {
        if (!$this->isConfigured()) throw new RuntimeException('Brex access token is not configured.');
        try {
            $method = strtoupper($method);
            $url = $this->urlWithQuery($this->baseUrl.$path, $query);
            $http = Http::withHeaders(array_merge(['Authorization' => 'Bearer '.$this->accessToken, 'Content-Type' => 'application/json', 'Accept' => 'application/json'], $headers))->timeout(120);
            $response = match ($method) {
                'GET' => $http->get($url),
                'POST' => $http->post($url, $body),
                'PUT' => $http->put($url, $body),
                'PATCH' => $http->patch($url, $body),
                'DELETE' => $http->delete($url, $body),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };
            if (!$response->successful()) {
                $error = $response->json('message') ?? $response->json('error_description') ?? $response->json('error') ?? $response->body();
                Log::error("Brex API error: {$method} {$path}", ['status' => $response->status(), 'error' => $error]);
                throw new RuntimeException('Brex API error ('.$response->status().'): '.(is_string($error) ? $error : json_encode($error)));
            }
            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Brex API connection error: {$method} {$path}", ['error' => $e->getMessage()]);
            throw new RuntimeException("Failed to connect to Brex API: {$e->getMessage()}");
        }
    }

    /** @param  array<string, mixed>  $pathParams  Path parameter values. */
    private function expandPath(string $template, array $pathParams): string
    {
        return (string) preg_replace_callback('/\{([A-Za-z0-9_]+)\}/', function (array $matches) use ($pathParams): string {
            $key = $matches[1];
            if (!array_key_exists($key, $pathParams) || $pathParams[$key] === null || $pathParams[$key] === '') throw new RuntimeException($key.' must be a non-empty path parameter.');
            return rawurlencode((string) $pathParams[$key]);
        }, $template);
    }

    /** @param  array<string, mixed>  $query  Query string parameters. */
    private function urlWithQuery(string $url, array $query): string
    {
        $parts = [];
        foreach ($query as $key => $value) {
            if ($value === null || $value === '') continue;
            foreach (is_array($value) ? $value : [$value] as $item) {
                if ($item === null || $item === '') continue;
                $encodedValue = is_bool($item) ? ($item ? 'true' : 'false') : (string) $item;
                $parts[] = rawurlencode((string) $key).'='.rawurlencode($encodedValue);
            }
        }
        return $parts === [] ? $url : $url.'?'.implode('&', $parts);
    }
}