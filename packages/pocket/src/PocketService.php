<?php

namespace OpenCompany\Integrations\Pocket;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Pocket v3 API.
 *
 * Handles Pocket's OAuth request-token flow, JSON API calls, endpoint
 * shaping, authenticated request enrichment, and normalized API errors.
 */
class PocketService
{
    private const DEFAULT_BASE_URL = 'https://getpocket.com';

    /**
     * @param  string  $consumerKey  Pocket platform consumer key.
     * @param  string  $accessToken  Pocket user access token.
     * @param  string  $baseUrl  Pocket base URL.
     */
    public function __construct(
        private string $consumerKey = '',
        private string $accessToken = '',
        private string $baseUrl = self::DEFAULT_BASE_URL,
    ) {
        $this->baseUrl = rtrim($this->baseUrl ?: self::DEFAULT_BASE_URL, '/');
    }

    /**
     * Check whether authenticated data API credentials are available.
     */
    public function isConfigured(): bool
    {
        return trim($this->consumerKey) !== '' && trim($this->accessToken) !== '' && trim($this->baseUrl) !== '';
    }

    /**
     * Check whether OAuth setup credentials are available.
     */
    public function canStartOAuth(): bool
    {
        return trim($this->consumerKey) !== '' && trim($this->baseUrl) !== '';
    }

    /**
     * Create a Pocket OAuth request token.
     *
     * @param  array<string, mixed>  $params  OAuth request fields, including redirect_uri.
     * @return array<string, mixed>
     */
    public function requestToken(array $params): array
    {
        $this->ensureConsumerKey();
        $payload = $this->withConsumerKey($params, false);

        return $this->request('POST', '/v3/oauth/request', $payload, false);
    }

    /**
     * Build the browser URL used to authorize a request token.
     *
     * @param  string  $requestToken  Request token from requestToken().
     * @param  string  $redirectUri  Redirect URI used for the request token.
     * @param  array<string, mixed>  $params  Optional authorize query fields.
     * @return array<string, mixed>
     */
    public function authorizeUrl(string $requestToken, string $redirectUri, array $params = []): array
    {
        if ($requestToken === '' || $redirectUri === '') {
            throw new RuntimeException('request_token and redirect_uri are required.');
        }

        $query = array_merge($params, ['request_token' => $requestToken, 'redirect_uri' => $redirectUri]);

        return ['url' => $this->baseUrl.'/auth/authorize?'.http_build_query($query, '', '&', PHP_QUERY_RFC3986)];
    }

    /**
     * Build the browser authorization URL from tool-style payload fields.
     *
     * @param  array<string, mixed>  $params  Authorize URL fields.
     * @return array<string, mixed>
     */
    public function authorizeUrlFromPayload(array $params): array
    {
        $requestToken = (string) ($params['request_token'] ?? '');
        $redirectUri = (string) ($params['redirect_uri'] ?? '');
        unset($params['request_token'], $params['redirect_uri']);

        return $this->authorizeUrl($requestToken, $redirectUri, $params);
    }

    /**
     * Exchange an authorized request token for a Pocket access token.
     *
     * @param  array<string, mixed>  $params  OAuth authorize fields, including code.
     * @return array<string, mixed>
     */
    public function accessToken(array $params): array
    {
        $this->ensureConsumerKey();
        $payload = $this->withConsumerKey($params, false);

        return $this->request('POST', '/v3/oauth/authorize', $payload, false);
    }

    /**
     * Save one URL to Pocket.
     *
     * @param  array<string, mixed>  $params  Add endpoint fields.
     * @return array<string, mixed>
     */
    public function add(array $params): array
    {
        return $this->request('POST', '/v3/add', $this->withCredentials($params));
    }

    /**
     * Retrieve saved items from Pocket.
     *
     * @param  array<string, mixed>  $params  Retrieve filters and pagination fields.
     * @return array<string, mixed>
     */
    public function retrieve(array $params = []): array
    {
        return $this->request('POST', '/v3/get', $this->withCredentials($params));
    }

    /**
     * Send one or more Pocket modify actions.
     *
     * @param  array<int, array<string, mixed>>  $actions  Pocket modify action objects.
     * @return array<string, mixed>
     */
    public function sendActions(array $actions): array
    {
        if ($actions === []) {
            throw new RuntimeException('actions is required.');
        }

        return $this->request('POST', '/v3/send', $this->withCredentials(['actions' => array_values($actions)]));
    }

    /**
     * Send one Pocket modify action.
     *
     * @param  string  $action  Pocket action name.
     * @param  array<string, mixed>  $params  Action fields.
     * @return array<string, mixed>
     */
    public function sendAction(string $action, array $params): array
    {
        if ($action === '') {
            throw new RuntimeException('action is required.');
        }

        return $this->sendActions([array_merge($params, ['action' => $action])]);
    }

    /**
     * Execute a safe raw Pocket v3 POST request.
     *
     * @param  string  $path  Relative Pocket API path.
     * @param  array<string, mixed>  $payload  JSON body.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $payload = []): array
    {
        return $this->request('POST', $this->normalizePath($path), $this->withCredentials($payload));
    }

    /**
     * Dispatch a JSON Pocket API request.
     *
     * @param  array<string, mixed>  $payload  JSON request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $payload, bool $requiresAccessToken = true): array
    {
        if ($requiresAccessToken && !$this->isConfigured()) {
            throw new RuntimeException('Pocket consumer key and access token are required.');
        }

        $response = $this->rawRequest($method, $path, $payload);
        if (!$response->successful()) {
            $this->throwApiError($method, $path, $response);
        }

        return $this->decodeResponse($response);
    }

    /**
     * Make a raw HTTP request.
     *
     * @param  array<string, mixed>  $payload  JSON request body.
     */
    private function rawRequest(string $method, string $path, array $payload): Response
    {
        $url = $this->baseUrl.$path;
        $http = Http::withHeaders([
            'Accept' => 'application/json',
            'X-Accept' => 'application/json',
            'Content-Type' => 'application/json; charset=UTF8',
        ])->timeout(30);

        try {
            return match (strtoupper($method)) {
                'POST' => $http->post($url, $payload),
                default => throw new RuntimeException("Unsupported Pocket method: {$method}"),
            };
        } catch (\Throwable $e) {
            Log::error("Pocket API connection error: {$method} {$path}", ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to Pocket API: '.$e->getMessage());
        }
    }

    /**
     * Add consumer and access credentials to a request body.
     *
     * @param  array<string, mixed>  $params  Request fields.
     * @return array<string, mixed>
     */
    private function withCredentials(array $params): array
    {
        return $this->withConsumerKey(array_merge(['access_token' => $this->accessToken], $params));
    }

    /**
     * Add the consumer key to a request body.
     *
     * @param  array<string, mixed>  $params  Request fields.
     * @return array<string, mixed>
     */
    private function withConsumerKey(array $params, bool $preserveProvidedKey = true): array
    {
        if (!$preserveProvidedKey || !isset($params['consumer_key'])) {
            $params['consumer_key'] = $this->consumerKey;
        }

        return $params;
    }

    /**
     * Ensure a consumer key is available for OAuth setup calls.
     */
    private function ensureConsumerKey(): void
    {
        if (!$this->canStartOAuth()) {
            throw new RuntimeException('Pocket consumer key is required.');
        }
    }

    /**
     * Throw a normalized Pocket API error.
     */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $json = $response->json();
        $message = is_array($json) ? (string) ($json['error'] ?? $json['message'] ?? '') : '';
        $message = $message !== '' ? $message : (string) ($response->header('X-Error') ?? '');
        $code = (string) ($response->header('X-Error-Code') ?? '');
        $detail = $code !== '' ? "Pocket API error {$code}" : 'Pocket API error';

        Log::error("Pocket API error: {$method} {$path}", ['status' => $response->status(), 'body' => $response->body(), 'error_code' => $code]);

        throw new RuntimeException($detail.' ('.$response->status().'): '.($message !== '' ? $message : 'Unexpected API error.'));
    }

    /**
     * Decode JSON, qline, text, or empty Pocket responses.
     *
     * @return array<string, mixed>
     */
    private function decodeResponse(Response $response): array
    {
        $body = trim($response->body());
        if ($body === '') {
            return ['success' => true];
        }

        $json = $response->json();
        if (is_array($json)) {
            return $json;
        }

        if (str_contains($body, '=')) {
            parse_str($body, $parsed);
            if (is_array($parsed) && $parsed !== []) {
                return $parsed;
            }
        }

        return ['value' => $body];
    }

    private function normalizePath(string $path): string
    {
        $path = trim($path);
        if ($path === '' || str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, '//')) {
            throw new RuntimeException('Pocket API path must be a non-empty relative path.');
        }

        return '/'.ltrim($path, '/');
    }
}
