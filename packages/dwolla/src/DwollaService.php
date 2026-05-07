<?php

namespace OpenCompany\Integrations\Dwolla;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Dwolla API.
 *
 * Handles bearer access tokens, OAuth client-credentials basic auth, JSON, HAL
 * JSON, form-encoded and multipart bodies, URL expansion, and response parsing.
 */
class DwollaService
{
    /**
     * @param  string  $accessToken  Dwolla OAuth bearer access token.
     * @param  string  $clientId  Dwolla OAuth client ID.
     * @param  string  $clientSecret  Dwolla OAuth client secret.
     * @param  string  $baseUrl  Dwolla API base URL.
     */
    public function __construct(private string $accessToken = '', private string $clientId = '', private string $clientSecret = '', private string $baseUrl = 'https://api-sandbox.dwolla.com')
    {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->accessToken !== '' || ($this->clientId !== '' && $this->clientSecret !== '');
    }

    /**
     * Make a Dwolla API request and return parsed response data.
     *
     * @param  array<string, mixed>  $pathParams  Path placeholder values.
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $headers  Additional request headers.
     * @param  array<string, mixed>  $body  Request body fields.
     * @return array<string, mixed>|list<mixed>
     */
    public function request(string $method, string $pathTemplate, array $pathParams = [], array $query = [], array $headers = [], array $body = [], string $bodyContentType = 'application/json', string $authMode = 'bearer'): array
    {
        $response = $this->rawRequest($method, $this->expandPath($pathTemplate, $pathParams), $query, $headers, $body, $bodyContentType, $authMode);

        if ($response->body() === '') {
            return ['success' => true, 'status' => $response->status(), 'location' => $response->header('Location')];
        }

        return $response->json() ?? ['body' => $response->body(), 'status' => $response->status(), 'content_type' => $response->header('Content-Type'), 'location' => $response->header('Location')];
    }

    /**
     * Execute an HTTP request against Dwolla.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $headers  Additional request headers.
     * @param  array<string, mixed>  $body  Request body fields.
     */
    private function rawRequest(string $method, string $path, array $query = [], array $headers = [], array $body = [], string $bodyContentType = 'application/json', string $authMode = 'bearer'): Response
    {
        $baseHeaders = ['Accept' => 'application/vnd.dwolla.v1.hal+json'];
        if ($bodyContentType !== 'multipart/form-data') {
            $baseHeaders['Content-Type'] = $bodyContentType;
        }

        if ($authMode === 'basic') {
            if ($this->clientId === '' || $this->clientSecret === '') {
                throw new RuntimeException('Dwolla client ID and client secret are required for OAuth token requests.');
            }
            $baseHeaders['Authorization'] = 'Basic ' . base64_encode($this->clientId . ':' . $this->clientSecret);
        } else {
            if ($this->accessToken === '') {
                throw new RuntimeException('Dwolla access token is not configured.');
            }
            $baseHeaders['Authorization'] = 'Bearer ' . $this->accessToken;
        }

        $request = Http::withHeaders(array_merge($baseHeaders, $headers))->timeout(60);
        $method = strtoupper($method);
        $url = $this->urlWithQuery($this->baseUrl . $path, $query);
        $response = $request->send($method, $url, $this->requestOptions($method, $body, $bodyContentType));

        if (!$response->successful()) {
            Log::error('Dwolla API request failed', ['method' => $method, 'path' => $path, 'status' => $response->status(), 'body' => $response->body()]);
            $message = $response->json('message') ?? $response->json('error') ?? $response->body() ?: 'Dwolla API request failed.';
            throw new RuntimeException('Dwolla API error: ' . (is_string($message) ? $message : json_encode($message)));
        }

        return $response;
    }

    /**
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
            return ['multipart' => $this->multipart($body)];
        }

        return ['json' => $body];
    }

    /**
     * @param  array<string, mixed>  $body  Multipart fields; file fields may be local paths.
     * @return list<array<string, mixed>>
     */
    private function multipart(array $body): array
    {
        $parts = [];
        foreach ($body as $name => $contents) {
            $part = ['name' => (string) $name];
            if (is_string($contents) && is_file($contents)) {
                $part['contents'] = fopen($contents, 'r');
                $part['filename'] = basename($contents);
            } else {
                $part['contents'] = is_scalar($contents) ? (string) $contents : json_encode($contents);
            }
            $parts[] = $part;
        }

        return $parts;
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
