<?php

namespace OpenCompany\Integrations\Binance;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Binance Spot REST API.
 *
 * Handles public, API-key, and signed endpoint authentication, HMAC SHA256
 * signing, query encoding, URL expansion, error logging, and response parsing.
 */
class BinanceService
{
    /**
     * @param  string  $apiKey  Binance API key for API-key and signed endpoints.
     * @param  string  $apiSecret  Binance API secret for signed endpoint HMAC signatures.
     * @param  string  $baseUrl  Binance REST API base URL.
     */
    public function __construct(private string $apiKey = '', private string $apiSecret = '', private string $baseUrl = 'https://api.binance.com')
    {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(string $authMode = 'api_key'): bool
    {
        return match ($authMode) {
            'public' => true,
            'signed' => $this->apiKey !== '' && $this->apiSecret !== '',
            default => $this->apiKey !== '',
        };
    }

    /**
     * Make a Binance API request and return decoded response data.
     *
     * @param  array<string, mixed>  $pathParams  Path placeholder values.
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $headers  Additional request headers.
     * @return array<string, mixed>|list<mixed>
     */
    public function request(string $method, string $pathTemplate, array $pathParams = [], array $query = [], array $headers = [], string $authMode = 'api_key'): array
    {
        $response = $this->rawRequest($method, $this->expandPath($pathTemplate, $pathParams), $query, $headers, $authMode);

        if ($response->body() === '') {
            return ['success' => true, 'status' => $response->status()];
        }

        return $response->json() ?? ['body' => $response->body(), 'status' => $response->status(), 'content_type' => $response->header('Content-Type')];
    }

    /**
     * Execute an HTTP request against Binance.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $headers  Additional request headers.
     */
    private function rawRequest(string $method, string $path, array $query = [], array $headers = [], string $authMode = 'api_key'): Response
    {
        $baseHeaders = ['Accept' => 'application/json'];
        if ($authMode !== 'public') {
            if ($this->apiKey === '') {
                throw new RuntimeException('Binance API key is required for this endpoint.');
            }
            $baseHeaders['X-MBX-APIKEY'] = $this->apiKey;
        }
        if ($authMode === 'signed') {
            if ($this->apiSecret === '') {
                throw new RuntimeException('Binance API secret is required for signed endpoints.');
            }
            if (!isset($query['timestamp']) || $query['timestamp'] === '' || $query['timestamp'] === null) {
                $query['timestamp'] = (int) floor(microtime(true) * 1000);
            }
            unset($query['signature']);
            $query['signature'] = hash_hmac('sha256', $this->queryString($query), $this->apiSecret);
        }

        $method = strtoupper($method);
        $url = $this->urlWithQuery($this->baseUrl . $path, $query);
        $response = Http::withHeaders(array_merge($baseHeaders, $headers))->timeout(60)->send($method, $url);

        if (!$response->successful()) {
            Log::error('Binance API request failed', ['method' => $method, 'path' => $path, 'status' => $response->status(), 'body' => $response->body()]);
            $message = $response->json('msg') ?? $response->json('message') ?? $response->body() ?: 'Binance API request failed.';
            throw new RuntimeException('Binance API error: ' . (is_string($message) ? $message : json_encode($message)));
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
        $queryString = $this->queryString($query);

        return $queryString === '' ? $url : $url . '?' . $queryString;
    }

    /**
     * Build Binance's query string form used for both URLs and HMAC signing.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     */
    private function queryString(array $query): string
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

        return implode('&', $parts);
    }
}
