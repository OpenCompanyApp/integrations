<?php

namespace OpenCompany\Integrations\Plaid;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Plaid API.
 *
 * Handles Plaid header authentication, environment selection, JSON request
 * dispatch, response parsing, and API error normalization.
 */
class PlaidService
{
    /**
     * @param  string  $clientId  Plaid client_id value sent as PLAID-CLIENT-ID.
     * @param  string  $secret  Plaid secret value sent as PLAID-SECRET.
     * @param  string  $plaidVersion  Plaid API version header.
     * @param  string  $baseUrl  Plaid environment base URL, such as https://sandbox.plaid.com.
     */
    public function __construct(
        private string $clientId = '',
        private string $secret = '',
        private string $plaidVersion = '2020-09-14',
        private string $baseUrl = 'https://sandbox.plaid.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->clientId !== '' && $this->secret !== '';
    }

    /**
     * Execute a Plaid API operation.
     *
     * @param  array<string, mixed>  $pathParams  Path parameter values keyed by OpenAPI parameter name.
     * @param  array<string, mixed>  $body  JSON request body.
     * @return array<string, mixed>
     */
    public function request(string $method, string $pathTemplate, array $pathParams = [], array $body = []): array
    {
        $response = $this->rawRequest($method, $this->expandPath($pathTemplate, $pathParams), $body);

        if ($response->body() === '') {
            return ['success' => true, 'status' => $response->status()];
        }

        return $response->json() ?? ['body' => $response->body(), 'status' => $response->status()];
    }

    /**
     * Perform a raw HTTP request against Plaid.
     *
     * @param  array<string, mixed>  $body  JSON request body.
     */
    private function rawRequest(string $method, string $path, array $body = []): Response
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Plaid client ID and secret are not configured.');
        }

        try {
            $method = strtoupper($method);
            $url = $this->baseUrl.$path;
            $http = Http::withHeaders([
                'PLAID-CLIENT-ID' => $this->clientId,
                'PLAID-SECRET' => $this->secret,
                'Plaid-Version' => $this->plaidVersion,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(120);

            $response = match ($method) {
                'GET' => $http->get($url),
                'POST' => $http->post($url, $body),
                'PUT' => $http->put($url, $body),
                'PATCH' => $http->patch($url, $body),
                'DELETE' => $http->delete($url, $body),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('error_message')
                    ?? $response->json('display_message')
                    ?? $response->json('error')
                    ?? $response->json('message')
                    ?? $response->body();

                Log::error("Plaid API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new RuntimeException('Plaid API error ('.$response->status().'): '.(is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Plaid API connection error: {$method} {$path}", ['error' => $e->getMessage()]);

            throw new RuntimeException("Failed to connect to Plaid API: {$e->getMessage()}");
        }
    }

    /**
     * Expand OpenAPI path templates with encoded path parameters.
     *
     * @param  array<string, mixed>  $pathParams  Path parameter values.
     */
    private function expandPath(string $template, array $pathParams): string
    {
        return (string) preg_replace_callback('/\{([A-Za-z0-9_]+)\}/', function (array $matches) use ($pathParams): string {
            $key = $matches[1];
            if (!array_key_exists($key, $pathParams) || $pathParams[$key] === null || $pathParams[$key] === '') {
                throw new RuntimeException($key.' must be a non-empty path parameter.');
            }

            return rawurlencode((string) $pathParams[$key]);
        }, $template);
    }
}