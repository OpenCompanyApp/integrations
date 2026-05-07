<?php

namespace OpenCompany\Integrations\Greenhouse;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Greenhouse Harvest v3 API.
 *
 * Handles bearer-token requests, client-credentials token acquisition, URL
 * expansion, query serialization, error logging, and response parsing.
 */
class GreenhouseService
{
    private ?string $cachedAccessToken = null;

    /**
     * @param  string  $accessToken  Greenhouse Harvest v3 bearer token.
     * @param  string  $clientId  Greenhouse Harvest v3 OAuth client ID.
     * @param  string  $clientSecret  Greenhouse Harvest v3 OAuth client secret.
     * @param  string  $baseUrl  Greenhouse Harvest API base URL.
     */
    public function __construct(private string $accessToken = '', private string $clientId = '', private string $clientSecret = '', private string $baseUrl = 'https://harvest.greenhouse.io')
    {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(string $authMode = 'bearer'): bool
    {
        return match ($authMode) {
            'client_credentials_request' => $this->clientId !== '' && $this->clientSecret !== '',
            default => $this->accessToken !== '' || ($this->clientId !== '' && $this->clientSecret !== ''),
        };
    }

    /**
     * Make a Greenhouse Harvest API request and return decoded response data.
     *
     * @param  array<string, mixed>  $pathParams  Path placeholder values.
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $headers  Additional request headers.
     * @param  array<string, mixed>  $body  JSON request body.
     * @param  array<string, string>  $queryStyles  Official query parameter serialization styles.
     * @return array<string, mixed>|list<mixed>
     */
    public function request(string $method, string $pathTemplate, array $pathParams = [], array $query = [], array $headers = [], array $body = [], string $authMode = 'bearer', array $queryStyles = []): array
    {
        $response = $this->rawRequest($method, $this->expandPath($pathTemplate, $pathParams), $query, $headers, $body, $authMode, $queryStyles);

        if ($response->body() === '') {
            return ['success' => true, 'status' => $response->status(), 'link' => $response->header('Link')];
        }

        return $response->json() ?? ['body' => $response->body(), 'status' => $response->status(), 'content_type' => $response->header('Content-Type'), 'link' => $response->header('Link')];
    }

    /**
     * Execute an HTTP request against Greenhouse.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $headers  Additional request headers.
     * @param  array<string, mixed>  $body  JSON request body.
     * @param  array<string, string>  $queryStyles  Query serialization styles.
     */
    private function rawRequest(string $method, string $path, array $query = [], array $headers = [], array $body = [], string $authMode = 'bearer', array $queryStyles = []): Response
    {
        $baseHeaders = ['Accept' => 'application/json', 'Content-Type' => 'application/json'];
        if ($authMode === 'client_credentials_request') {
            if ($this->clientId === '' || $this->clientSecret === '') {
                throw new RuntimeException('Greenhouse client ID and client secret are required for token requests.');
            }
            $baseHeaders['Authorization'] = 'Basic ' . base64_encode($this->clientId . ':' . $this->clientSecret);
        } else {
            $baseHeaders['Authorization'] = 'Bearer ' . $this->bearerToken();
        }

        $method = strtoupper($method);
        $url = $this->urlWithQuery($this->baseUrl . $path, $query, $queryStyles);
        $response = Http::withHeaders(array_merge($baseHeaders, $headers))->timeout(60)->send($method, $url, $this->requestOptions($method, $body));

        if (!$response->successful()) {
            Log::error('Greenhouse API request failed', ['method' => $method, 'path' => $path, 'status' => $response->status(), 'body' => $response->body()]);
            $message = $response->json('message') ?? $response->json('error') ?? $response->body() ?: 'Greenhouse API request failed.';
            throw new RuntimeException('Greenhouse API error: ' . (is_string($message) ? $message : json_encode($message)));
        }

        return $response;
    }

    private function bearerToken(): string
    {
        if ($this->accessToken !== '') {
            return $this->accessToken;
        }
        if ($this->cachedAccessToken !== null) {
            return $this->cachedAccessToken;
        }
        if ($this->clientId === '' || $this->clientSecret === '') {
            throw new RuntimeException('Greenhouse access token or client credentials are required.');
        }

        $data = $this->request('POST', '/auth/token', [], [], [], [], 'client_credentials_request');
        $token = $data['access_token'] ?? null;
        if (!is_string($token) || $token === '') {
            throw new RuntimeException('Greenhouse token response did not include access_token.');
        }

        return $this->cachedAccessToken = $token;
    }

    /**
     * @param  array<string, mixed>  $body  JSON request body.
     * @return array<string, mixed>
     */
    private function requestOptions(string $method, array $body): array
    {
        if (($method === 'GET' || $method === 'DELETE') && $body === []) {
            return [];
        }

        return $body === [] ? [] : ['json' => $body];
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
     * Append query parameters to a URL using Harvest v3 list-filter styles.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, string>  $queryStyles  Official query parameter serialization styles.
     */
    private function urlWithQuery(string $url, array $query, array $queryStyles): string
    {
        $parts = [];
        foreach ($query as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }
            $style = $queryStyles[$key] ?? '';
            if (is_array($value)) {
                $parts[] = rawurlencode((string) $key) . '=' . rawurlencode($this->serializeArrayQuery($value, $style));
                continue;
            }
            $parts[] = rawurlencode((string) $key) . '=' . rawurlencode((string) $value);
        }

        return $parts === [] ? $url : $url . '?' . implode('&', $parts);
    }

    /** @param  array<mixed>  $value  Query value to serialize. */
    private function serializeArrayQuery(array $value, string $style): string
    {
        $assoc = array_keys($value) !== range(0, count($value) - 1);
        if ($assoc) {
            $pairs = [];
            foreach ($value as $key => $item) {
                $pairs[] = (string) $key;
                $pairs[] = is_scalar($item) ? (string) $item : json_encode($item);
            }

            return implode($style === 'pipeDelimited' ? '|' : ',', $pairs);
        }

        return implode(',', array_map(static fn (mixed $item): string => is_scalar($item) ? (string) $item : json_encode($item), $value));
    }
}
