<?php

namespace OpenCompany\Integrations\GoogleVault;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Google Vault REST API.
 *
 * Handles OAuth bearer authentication, Discovery path expansion, JSON request
 * dispatch, response parsing, and Google API error normalization.
 */
class GoogleVaultService
{
    /**
     * @param  string  $accessToken  Google OAuth 2.0 access token with Vault scopes.
     * @param  string  $baseUrl  Google Vault REST API base URL.
     */
    public function __construct(private string $accessToken = '', private string $baseUrl = 'https://vault.googleapis.com')
    {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool { return $this->accessToken !== ''; }

    /**
     * Execute a Google Vault REST method.
     *
     * @param  array<string, mixed>  $pathParams  Path parameter values keyed by Discovery parameter name.
     * @param  string[]  $reservedPathParams  Path parameters using `{+param}` reserved expansion.
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $body  JSON request body.
     * @return array<string, mixed>
     */
    public function request(string $method, string $pathTemplate, array $pathParams = [], array $reservedPathParams = [], array $query = [], array $body = []): array
    {
        $response = $this->rawRequest($method, $this->expandPath($pathTemplate, $pathParams, $reservedPathParams), $query, $body);
        if ($response->body() === '') return ['success' => true, 'status' => $response->status()];
        return $response->json() ?? ['body' => $response->body(), 'status' => $response->status()];
    }

    /**
     * Perform a raw HTTP request against Google Vault.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $body  JSON request body.
     */
    private function rawRequest(string $method, string $path, array $query = [], array $body = []): Response
    {
        if (!$this->isConfigured()) throw new RuntimeException('Google Vault access token is not configured.');
        try {
            $http = Http::withHeaders(['Authorization' => 'Bearer '.$this->accessToken, 'Content-Type' => 'application/json', 'Accept' => 'application/json'])->timeout(120);
            $method = strtoupper($method); $url = $this->baseUrl.$path; $urlWithQuery = $this->urlWithQuery($url, $method === 'GET' ? [] : $query);
            $response = match ($method) {
                'GET' => $http->get($url, $query),
                'POST' => $http->post($urlWithQuery, $body),
                'PUT' => $http->put($urlWithQuery, $body),
                'PATCH' => $http->patch($urlWithQuery, $body),
                'DELETE' => $http->delete($urlWithQuery, $body),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };
            if (!$response->successful()) {
                $error = $response->json('error.message') ?? $response->json('error') ?? $response->body();
                Log::error("Google Vault API error: {$method} {$path}", ['status' => $response->status(), 'error' => $error]);
                throw new RuntimeException("Google Vault API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }
            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Google Vault API connection error: {$method} {$path}", ['error' => $e->getMessage()]);
            throw new RuntimeException("Failed to connect to Google Vault API: {$e->getMessage()}");
        }
    }

    /**
     * Expand Discovery path templates such as `{+name}` and `{matterId}`.
     *
     * @param  array<string, mixed>  $pathParams  Path parameter values.
     * @param  string[]  $reservedPathParams  Parameters using reserved expansion.
     */
    private function expandPath(string $template, array $pathParams, array $reservedPathParams): string
    {
        return (string) preg_replace_callback('/\{(\+?)([A-Za-z0-9_]+)\}/', function (array $matches) use ($pathParams, $reservedPathParams): string {
            $key = $matches[2];
            if (!array_key_exists($key, $pathParams) || $pathParams[$key] === null || $pathParams[$key] === '') throw new RuntimeException($key.' must be a non-empty path parameter.');
            $reserved = $matches[1] === '+' || in_array($key, $reservedPathParams, true);
            return $reserved ? str_replace('%2F', '/', rawurlencode((string) $pathParams[$key])) : rawurlencode((string) $pathParams[$key]);
        }, $template);
    }

    /**
     * Append query parameters for non-GET requests.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     */
    private function urlWithQuery(string $url, array $query): string
    {
        return $query === [] ? $url : $url.'?'.http_build_query($query);
    }
}