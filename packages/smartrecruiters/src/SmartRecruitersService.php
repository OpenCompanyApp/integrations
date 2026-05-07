<?php

namespace OpenCompany\Integrations\SmartRecruiters;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for SmartRecruiters APIs.
 *
 * Handles x-smarttoken, bearer OAuth, client-credentials token acquisition,
 * URL expansion, query serialization, body encoding, error logging, and response parsing.
 */
class SmartRecruitersService
{
    private ?string $cachedAccessToken = null;

    /**
     * @param  string  $apiKey  SmartRecruiters API key sent as x-smarttoken.
     * @param  string  $accessToken  OAuth bearer token.
     * @param  string  $clientId  OAuth client ID for client-credentials token acquisition.
     * @param  string  $clientSecret  OAuth client secret for client-credentials token acquisition.
     * @param  string  $baseUrl  Default SmartRecruiters API base URL.
     * @param  string  $tokenUrl  OAuth token endpoint.
     */
    public function __construct(private string $apiKey = '', private string $accessToken = '', private string $clientId = '', private string $clientSecret = '', private string $baseUrl = 'https://api.smartrecruiters.com', private string $tokenUrl = 'https://api.smartrecruiters.com/identity/oauth/token')
    {
        $this->baseUrl = rtrim($this->baseUrl, '/');
        $this->tokenUrl = $this->tokenUrl !== '' ? $this->tokenUrl : 'https://api.smartrecruiters.com/identity/oauth/token';
    }

    public function isConfigured(string $authMode = 'either'): bool
    {
        return match ($authMode) {
            'public' => true,
            'bearer' => $this->accessToken !== '' || ($this->clientId !== '' && $this->clientSecret !== ''),
            default => $this->apiKey !== '' || $this->accessToken !== '' || ($this->clientId !== '' && $this->clientSecret !== ''),
        };
    }

    /**
     * Make a SmartRecruiters API request and return decoded response data.
     *
     * @param  array<string, mixed>  $pathParams  Path placeholder values.
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $headers  Additional request headers.
     * @param  array<string, mixed>  $body  Request body payload.
     * @param  array<string, string>  $queryStyles  Query serialization hints.
     * @return array<string, mixed>|list<mixed>
     */
    public function request(string $method, string $baseUrl, string $pathTemplate, array $pathParams = [], array $query = [], array $headers = [], array $body = [], string $authMode = 'either', string $bodyMode = 'json', array $queryStyles = []): array
    {
        $baseUrl = $baseUrl !== '' ? rtrim($baseUrl, '/') : $this->baseUrl;
        $response = $this->rawRequest($method, $baseUrl, $this->expandPath($pathTemplate, $pathParams), $query, $headers, $body, $authMode, $bodyMode, $queryStyles);

        if ($response->body() === '') {
            return ['success' => true, 'status' => $response->status()];
        }

        return $response->json() ?? ['body' => $response->body(), 'status' => $response->status(), 'content_type' => $response->header('Content-Type')];
    }

    /**
     * Execute an HTTP request against SmartRecruiters.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $headers  Additional request headers.
     * @param  array<string, mixed>  $body  Request body payload.
     * @param  array<string, string>  $queryStyles  Query serialization hints.
     */
    private function rawRequest(string $method, string $baseUrl, string $path, array $query = [], array $headers = [], array $body = [], string $authMode = 'either', string $bodyMode = 'json', array $queryStyles = []): Response
    {
        $baseHeaders = ['Accept' => 'application/json'];
        if ($authMode !== 'public') {
            if ($this->apiKey !== '' && $authMode !== 'bearer') {
                $baseHeaders['x-smarttoken'] = $this->apiKey;
            } else {
                $baseHeaders['Authorization'] = 'Bearer ' . $this->bearerToken();
            }
        }
        if ($bodyMode === 'json') {
            $baseHeaders['Content-Type'] = 'application/json';
        }

        $method = strtoupper($method);
        $url = $this->urlWithQuery($baseUrl . $path, $query, $queryStyles);
        $response = Http::withHeaders(array_merge($baseHeaders, $headers))->timeout(128)->send($method, $url, $this->requestOptions($method, $body, $bodyMode));

        if (!$response->successful()) {
            Log::error('SmartRecruiters API request failed', ['method' => $method, 'path' => $path, 'status' => $response->status(), 'body' => $response->body()]);
            $message = $response->json('message') ?? $response->json('error') ?? $response->json('errors') ?? $response->body() ?: 'SmartRecruiters API request failed.';
            throw new RuntimeException('SmartRecruiters API error: ' . (is_string($message) ? $message : json_encode($message)));
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
            throw new RuntimeException('SmartRecruiters access token or client credentials are required.');
        }

        $response = Http::asForm()->withHeaders(['Accept' => 'application/json'])->timeout(30)->post($this->tokenUrl, ['grant_type' => 'client_credentials', 'client_id' => $this->clientId, 'client_secret' => $this->clientSecret]);
        if (!$response->successful()) {
            throw new RuntimeException('SmartRecruiters token request failed: HTTP ' . $response->status());
        }
        $token = $response->json('access_token');
        if (!is_string($token) || $token === '') {
            throw new RuntimeException('SmartRecruiters token response did not include access_token.');
        }

        return $this->cachedAccessToken = $token;
    }

    /**
     * @param  array<string, mixed>  $body  Request body payload.
     * @return array<string, mixed>
     */
    private function requestOptions(string $method, array $body, string $bodyMode): array
    {
        if (($method === 'GET' || $method === 'DELETE') && $body === []) {
            return [];
        }
        if ($body === []) {
            return [];
        }
        if ($bodyMode === 'form') {
            return ['form_params' => $body];
        }
        if ($bodyMode === 'multipart') {
            $multipart = [];
            foreach ($body as $name => $value) {
                $multipart[] = ['name' => (string) $name, 'contents' => is_scalar($value) ? (string) $value : json_encode($value)];
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
     * Append query parameters to a URL.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, string>  $queryStyles  Query serialization hints.
     */
    private function urlWithQuery(string $url, array $query, array $queryStyles): string
    {
        $parts = [];
        foreach ($query as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }
            if (is_array($value)) {
                if (($queryStyles[$key] ?? '') === 'comma') {
                    $parts[] = rawurlencode((string) $key) . '=' . rawurlencode(implode(',', array_map(static fn (mixed $item): string => is_scalar($item) ? (string) $item : json_encode($item), $value)));
                    continue;
                }
                foreach ($value as $item) {
                    if ($item === null || $item === '') {
                        continue;
                    }
                    $parts[] = rawurlencode((string) $key) . '=' . rawurlencode(is_scalar($item) ? (string) $item : json_encode($item));
                }
                continue;
            }
            $parts[] = rawurlencode((string) $key) . '=' . rawurlencode((string) $value);
        }

        return $parts === [] ? $url : $url . '?' . implode('&', $parts);
    }
}
