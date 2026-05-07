<?php

namespace OpenCompany\Integrations\CheckoutCom;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Checkout.com API.
 *
 * Handles bearer-style Authorization headers, JSON, form-encoded and multipart
 * bodies, token-host routing, URL expansion, error logging, and response parsing.
 */
class CheckoutComService
{
    /**
     * @param  string  $apiKey  Checkout.com secret key, public key, session secret, or OAuth access token.
     * @param  string  $baseUrl  Checkout.com API base URL.
     * @param  string  $accessBaseUrl  Checkout.com OAuth token base URL.
     */
    public function __construct(private string $apiKey = '', private string $baseUrl = 'https://api.sandbox.checkout.com', private string $accessBaseUrl = 'https://access.sandbox.checkout.com')
    {
        $this->baseUrl = rtrim($this->baseUrl, '/');
        $this->accessBaseUrl = rtrim($this->accessBaseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    /**
     * Make a Checkout.com API request and return parsed response data.
     *
     * @param  array<string, mixed>  $pathParams  Path placeholder values.
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $headers  Additional request headers.
     * @param  array<string, mixed>  $body  Request body fields.
     * @return array<string, mixed>|list<mixed>
     */
    public function request(string $method, string $pathTemplate, array $pathParams = [], array $query = [], array $headers = [], array $body = [], string $bodyContentType = 'application/json', bool $requiresAuth = true): array
    {
        $response = $this->rawRequest($method, $this->expandPath($pathTemplate, $pathParams), $query, $headers, $body, $bodyContentType, $requiresAuth);

        if ($response->body() === '') {
            return ['success' => true, 'status' => $response->status()];
        }

        return $response->json() ?? ['body' => $response->body(), 'status' => $response->status(), 'content_type' => $response->header('Content-Type')];
    }

    /**
     * Execute an HTTP request against Checkout.com.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $headers  Additional request headers.
     * @param  array<string, mixed>  $body  Request body fields.
     */
    private function rawRequest(string $method, string $path, array $query = [], array $headers = [], array $body = [], string $bodyContentType = 'application/json', bool $requiresAuth = true): Response
    {
        if ($requiresAuth && !$this->isConfigured()) {
            throw new RuntimeException('Checkout.com API key or access token is not configured.');
        }

        $baseHeaders = ['Accept' => 'application/json'];
        if ($bodyContentType !== 'multipart/form-data') {
            $baseHeaders['Content-Type'] = $bodyContentType;
        }
        if ($requiresAuth) {
            $baseHeaders['Authorization'] = 'Bearer ' . $this->apiKey;
        }

        $request = Http::withHeaders(array_merge($baseHeaders, $headers))->timeout(60);
        $method = strtoupper($method);
        $url = $this->urlWithQuery($this->baseUrlForPath($path) . $path, $query);
        $response = $request->send($method, $url, $this->requestOptions($method, $body, $bodyContentType));

        if (!$response->successful()) {
            Log::error('Checkout.com API request failed', ['method' => $method, 'path' => $path, 'status' => $response->status(), 'body' => $response->body()]);
            $message = $response->json('error.message') ?? $response->json('message') ?? $response->json('error') ?? $response->body() ?: 'Checkout.com API request failed.';
            throw new RuntimeException('Checkout.com API error: ' . (is_string($message) ? $message : json_encode($message)));
        }

        return $response;
    }

    private function baseUrlForPath(string $path): string
    {
        return $path === '/connect/token' ? $this->accessBaseUrl : $this->baseUrl;
    }

    /**
     * Build Guzzle request options for supported body content types.
     *
     * @param  array<string, mixed>  $body  Request body fields.
     * @return array<string, mixed>
     */
    private function requestOptions(string $method, array $body, string $bodyContentType): array
    {
        if (($method === 'GET' || $method === 'DELETE') && $body === []) {
            return [];
        }

        if ($bodyContentType === 'application/x-www-form-urlencoded') {
            return ['form_params' => $body];
        }

        if ($bodyContentType === 'multipart/form-data') {
            $multipart = [];
            foreach ($body as $name => $contents) {
                $multipart[] = ['name' => (string) $name, 'contents' => is_scalar($contents) ? (string) $contents : json_encode($contents)];
            }

            return ['multipart' => $multipart];
        }

        return ['json' => $body];
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
