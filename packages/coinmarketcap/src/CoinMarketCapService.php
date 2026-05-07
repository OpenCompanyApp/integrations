<?php

namespace OpenCompany\Integrations\CoinMarketCap;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the CoinMarketCap Pro API.
 *
 * Handles X-CMC_PRO_API_KEY authentication, query encoding, JSON body dispatch,
 * error logging, and response parsing for market, exchange, DEX, and utility endpoints.
 */
class CoinMarketCapService
{
    /**
     * @param  string  $apiKey  CoinMarketCap Pro API key.
     * @param  string  $baseUrl  CoinMarketCap Pro API base URL.
     */
    public function __construct(private string $apiKey = '', private string $baseUrl = 'https://pro-api.coinmarketcap.com')
    {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    /**
     * Make a CoinMarketCap API request and return decoded response data.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $body  JSON request body fields.
     * @return array<string, mixed>|list<mixed>
     */
    public function request(string $method, string $path, array $query = [], array $body = []): array
    {
        $response = $this->rawRequest($method, $path, $query, $body);

        if ($response->body() === '') {
            return ['success' => true, 'status' => $response->status()];
        }

        return $response->json() ?? ['body' => $response->body(), 'status' => $response->status(), 'content_type' => $response->header('Content-Type')];
    }

    /**
     * Execute an HTTP request against CoinMarketCap.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $body  JSON request body fields.
     */
    private function rawRequest(string $method, string $path, array $query = [], array $body = []): Response
    {
        if ($this->apiKey === '') {
            throw new RuntimeException('CoinMarketCap API key is not configured.');
        }

        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Accept-Encoding' => 'deflate, gzip',
            'X-CMC_PRO_API_KEY' => $this->apiKey,
        ])->timeout(60);

        $method = strtoupper($method);
        $url = $this->urlWithQuery($this->baseUrl . $path, $query);
        $options = $body === [] ? [] : ['json' => $body];
        $response = $request->send($method, $url, $options);

        if (!$response->successful()) {
            Log::error('CoinMarketCap API request failed', ['method' => $method, 'path' => $path, 'status' => $response->status(), 'body' => $response->body()]);
            $message = $response->json('status.error_message') ?? $response->json('message') ?? $response->body() ?: 'CoinMarketCap API request failed.';
            throw new RuntimeException('CoinMarketCap API error: ' . (is_string($message) ? $message : json_encode($message)));
        }

        return $response;
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
