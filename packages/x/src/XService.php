<?php

namespace OpenCompany\Integrations\X;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use OpenCompany\IntegrationCore\Support\OAuth1Signer;

/**
 * HTTP client for the official X API.
 *
 * Executes generated operation metadata from the X OpenAPI spec and selects
 * the strongest configured authentication mode supported by each operation.
 */
class XService
{
    /**
     * @param  string  $bearerToken  App-only bearer token for public read endpoints
     * @param  string  $accessToken  OAuth 2.0 access token or OAuth 1.0a access token
     * @param  string  $apiKey  OAuth 1.0a consumer key
     * @param  string  $apiSecret  OAuth 1.0a consumer secret
     * @param  string  $accessTokenSecret  OAuth 1.0a access token secret
     * @param  string  $baseUrl  X API base URL
     */
    public function __construct(
        private string $bearerToken = '',
        private string $accessToken = '',
        private string $apiKey = '',
        private string $apiSecret = '',
        private string $accessTokenSecret = '',
        private string $baseUrl = 'https://api.x.com/2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether any supported credential mode is configured.
     */
    public function isConfigured(): bool
    {
        return $this->bearerToken !== ''
            || $this->accessToken !== ''
            || ($this->apiKey !== '' && $this->apiSecret !== '' && $this->accessToken !== '' && $this->accessTokenSecret !== '');
    }

    /**
     * Execute one generated X API operation.
     *
     * @param  array<string, mixed>  $operation  Generated operation metadata
     * @param  array<string, mixed>  $args  Tool arguments
     * @return array<string, mixed>|string
     */
    public function executeOperation(array $operation, array $args): array|string
    {
        if (($operation['runtime_mode'] ?? 'request_response') === 'stream') {
            throw new \RuntimeException('This X endpoint is a streaming endpoint. It must be run by a host streaming runner, not as a single request-response tool call.');
        }

        [$url, $query, $body] = $this->prepareRequest($operation, $args);
        $method = strtoupper((string) ($operation['method'] ?? 'GET'));
        $bodyMode = (string) ($operation['body_mode'] ?? 'json');

        $http = Http::timeout(30);
        $headers = $this->authHeaders($operation, $method, $url, $query, $body, $bodyMode);
        if (!empty($headers)) {
            $http = $http->withHeaders($headers);
        }

        if ($bodyMode === 'form') {
            $http = $http->asForm();
        } elseif ($bodyMode === 'multipart') {
            $http = $http->asMultipart();
        } else {
            $http = $http->acceptJson()->asJson();
        }

        $response = match ($method) {
            'GET' => $http->get($url, $query),
            'POST' => $http->post($this->urlWithQuery($url, $query), $body),
            'PUT' => $http->put($this->urlWithQuery($url, $query), $body),
            'PATCH' => $http->patch($this->urlWithQuery($url, $query), $body),
            'DELETE' => $http->delete($this->urlWithQuery($url, $query), $body),
            default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
        };

        if (!$response->successful()) {
            $json = $response->json();
            $error = is_array($json)
                ? ($json['title'] ?? $json['detail'] ?? $json['error'] ?? json_encode($json))
                : $response->body();

            Log::error('X API error', [
                'status' => $response->status(),
                'operation' => $operation['id'] ?? null,
                'error' => $error,
            ]);

            throw new \RuntimeException('X API error (' . $response->status() . '): ' . (string) $error);
        }

        $json = $response->json();

        return is_array($json) ? $json : $response->body();
    }

    /**
     * Test credentials with a lightweight endpoint.
     *
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(): array
    {
        if (!$this->isConfigured()) {
            return ['success' => false, 'error' => 'No X credentials are configured.'];
        }

        try {
            $hasCompleteOAuth1 = $this->apiKey !== '' && $this->apiSecret !== '' && $this->accessToken !== '' && $this->accessTokenSecret !== '';
            $hasOAuth2 = $this->accessToken !== '' && $this->accessTokenSecret === '';
            $operation = $hasCompleteOAuth1 || $hasOAuth2
                ? [
                    'id' => 'getUsersMe',
                    'method' => 'GET',
                    'path' => '/2/users/me',
                    'parameters' => [],
                    'body_mode' => 'json',
                    'auth_modes' => ['oauth2_pkce', 'oauth1a_user_context'],
                    'runtime_mode' => 'request_response',
                ]
                : [
                    'id' => 'getUsersByUsername',
                    'method' => 'GET',
                    'path' => '/2/users/by/username/{username}',
                    'parameters' => [
                        ['name' => 'username', 'in' => 'path', 'required' => true],
                    ],
                    'body_mode' => 'json',
                    'auth_modes' => ['bearer_token'],
                    'runtime_mode' => 'request_response',
                ];
            $args = ($operation['id'] ?? '') === 'getUsersByUsername' ? ['username' => 'XDevelopers'] : [];
            $result = $this->executeOperation($operation, $args);
            $username = is_array($result) ? ($result['data']['username'] ?? 'XDevelopers') : 'unknown';

            return ['success' => true, 'message' => "Connected to X as @{$username}."];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * @param  array<string, mixed>  $operation
     * @param  array<string, mixed>  $args
     * @return array{0: string, 1: array<string, mixed>, 2: array<string, mixed>}
     */
    private function prepareRequest(array $operation, array $args): array
    {
        $path = (string) ($operation['path'] ?? '/');
        $query = [];
        $body = isset($args['body']) && is_array($args['body']) ? $args['body'] : [];

        foreach ($operation['parameters'] ?? [] as $parameter) {
            if (!is_array($parameter)) {
                continue;
            }

            $name = (string) ($parameter['name'] ?? '');
            if ($name === '' || !array_key_exists($name, $args)) {
                continue;
            }

            if (($parameter['in'] ?? '') === 'path') {
                $path = str_replace('{' . $name . '}', rawurlencode((string) $args[$name]), $path);
                continue;
            }

            if (($parameter['in'] ?? '') === 'query') {
                $query[$name] = $this->normalizeQueryValue($args[$name], $parameter);
            }
        }

        return [$this->operationUrl($path), $query, $body];
    }

    /**
     * @param  array<string, mixed>  $parameter
     */
    private function normalizeQueryValue(mixed $value, array $parameter): mixed
    {
        if (is_array($value) && (($parameter['explode'] ?? null) === false || ($parameter['style'] ?? null) !== 'deepObject')) {
            return implode(',', array_map('strval', $value));
        }

        return $value;
    }

    private function operationUrl(string $path): string
    {
        if (str_ends_with($this->baseUrl, '/2') && str_starts_with($path, '/2/')) {
            $path = substr($path, 2);
        }

        return $this->baseUrl . '/' . ltrim($path, '/');
    }

    /**
     * @param  array<string, mixed>  $query
     */
    private function urlWithQuery(string $url, array $query): string
    {
        if (empty($query)) {
            return $url;
        }

        return $url . (str_contains($url, '?') ? '&' : '?') . http_build_query($query);
    }

    /**
     * @param  array<string, mixed>  $operation
     * @param  array<string, mixed>  $query
     * @param  array<string, mixed>  $body
     * @return array<string, string>
     */
    private function authHeaders(array $operation, string $method, string $url, array $query, array $body, string $bodyMode): array
    {
        $modes = $operation['auth_modes'] ?? [];

        if (in_array('oauth1a_user_context', $modes, true) && $this->apiKey !== '' && $this->apiSecret !== '' && $this->accessToken !== '' && $this->accessTokenSecret !== '') {
            return [
                'Authorization' => OAuth1Signer::authorizationHeader(
                    method: $method,
                    url: $url,
                    queryParams: $query,
                    bodyParams: $bodyMode === 'form' ? $body : [],
                    consumerKey: $this->apiKey,
                    consumerSecret: $this->apiSecret,
                    token: $this->accessToken,
                    tokenSecret: $this->accessTokenSecret,
                ),
            ];
        }

        if (in_array('oauth2_pkce', $modes, true) && $this->accessToken !== '') {
            return ['Authorization' => 'Bearer ' . $this->accessToken];
        }

        if (in_array('bearer_token', $modes, true) && $this->bearerToken !== '') {
            return ['Authorization' => 'Bearer ' . $this->bearerToken];
        }

        throw new \RuntimeException('No configured credential matches this X operation. Required auth modes: ' . implode(', ', $modes));
    }
}