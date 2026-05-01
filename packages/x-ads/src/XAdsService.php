<?php

namespace OpenCompany\Integrations\XAds;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use OpenCompany\IntegrationCore\Support\OAuth1Signer;

/**
 * HTTP client for the X Ads API.
 *
 * Signs every request with OAuth 1.0a user-context credentials and executes
 * generated operation metadata from the official X Ads Postman collection.
 */
class XAdsService
{
    public function __construct(
        private string $apiKey = '',
        private string $apiSecret = '',
        private string $accessToken = '',
        private string $accessTokenSecret = '',
        private string $accountId = '',
        private string $apiVersion = '12',
        private string $baseUrl = 'https://ads-api.x.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether OAuth 1.0a credentials are configured.
     */
    public function isConfigured(): bool
    {
        return $this->apiKey !== ''
            && $this->apiSecret !== ''
            && $this->accessToken !== ''
            && $this->accessTokenSecret !== '';
    }

    /**
     * Execute one generated X Ads API operation.
     *
     * @param  array<string, mixed>  $operation  Generated operation metadata
     * @param  array<string, mixed>  $args  Tool arguments
     * @return array<string, mixed>|string
     */
    public function executeOperation(array $operation, array $args): array|string
    {
        if (!$this->isConfigured()) {
            throw new \RuntimeException('X Ads OAuth 1.0a credentials are not configured.');
        }

        [$url, $query, $body] = $this->prepareRequest($operation, $args);
        $method = strtoupper((string) ($operation['method'] ?? 'GET'));
        $bodyMode = (string) ($operation['body_mode'] ?? 'form');

        $headers = [
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

        $http = Http::withHeaders($headers)->acceptJson()->timeout(30);
        $http = $bodyMode === 'form' ? $http->asForm() : $http->asJson();

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
                ? ($json['errors'][0]['message'] ?? $json['error'] ?? json_encode($json))
                : $response->body();

            Log::error('X Ads API error', [
                'status' => $response->status(),
                'operation' => $operation['id'] ?? null,
                'error' => $error,
            ]);

            throw new \RuntimeException('X Ads API error (' . $response->status() . '): ' . (string) $error);
        }

        $json = $response->json();

        return is_array($json) ? $json : $response->body();
    }

    /**
     * Test credentials by listing accessible ad accounts.
     *
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(): array
    {
        if (!$this->isConfigured()) {
            return ['success' => false, 'error' => 'X Ads OAuth 1.0a credentials are not configured.'];
        }

        try {
            $result = $this->executeOperation([
                'id' => 'get_accounts',
                'method' => 'GET',
                'path' => '/{version}/accounts',
                'parameters' => [['name' => 'version', 'in' => 'path', 'required' => false]],
                'body_mode' => 'form',
                'runtime_mode' => 'request_response',
            ], []);

            $count = is_array($result) && isset($result['data']) && is_array($result['data']) ? count($result['data']) : 0;

            return ['success' => true, 'message' => "Connected to X Ads. Accessible ad accounts: {$count}."];
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
            if ($name === '') {
                continue;
            }

            $value = $args[$name] ?? null;
            if ($name === 'version') {
                $value = $value ?: $this->apiVersion;
            } elseif ($name === 'account_id' && ($value === null || $value === '') && $this->accountId !== '') {
                $value = $this->accountId;
            }

            if ($value === null || $value === '') {
                continue;
            }

            if (($parameter['in'] ?? '') === 'path') {
                $path = str_replace('{' . $name . '}', rawurlencode((string) $value), $path);
                continue;
            }

            if (($parameter['in'] ?? '') === 'query') {
                $query[$name] = is_array($value) ? implode(',', array_map('strval', $value)) : $value;
            }
        }

        return [$this->baseUrl . '/' . ltrim($path, '/'), $query, $body];
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
}