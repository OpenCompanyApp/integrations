<?php

namespace OpenCompany\Integrations\Airwallex;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Airwallex API.
 *
 * Handles API key login, bearer-token runtime calls, API and file hosts,
 * request signing headers, multipart uploads, URL expansion, and response parsing.
 */
class AirwallexService
{
    /**
     * @param  string  $accessToken  Airwallex bearer access token for runtime API calls.
     * @param  string  $clientId  Airwallex client ID used by the login endpoint.
     * @param  string  $apiKey  Airwallex API key used by the login endpoint.
     * @param  string  $baseUrl  Airwallex API base URL.
     * @param  string  $fileUrl  Airwallex file API base URL.
     * @param  string  $apiVersion  Optional Airwallex date-based API version header.
     * @param  string  $loginAs  Optional target account ID for x-login-as.
     * @param  string  $onBehalfOf  Optional connected account ID for x-on-behalf-of.
     */
    public function __construct(
        private string $accessToken = '',
        private string $clientId = '',
        private string $apiKey = '',
        private string $baseUrl = 'https://api-demo.airwallex.com',
        private string $fileUrl = 'https://files-demo.airwallex.com',
        private string $apiVersion = '',
        private string $loginAs = '',
        private string $onBehalfOf = '',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
        $this->fileUrl = rtrim($this->fileUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->accessToken !== '' || ($this->clientId !== '' && $this->apiKey !== '');
    }

    /**
     * Make an Airwallex API request and return decoded response data.
     *
     * @param  array<string, mixed>  $pathParams  Path placeholder values.
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $headers  Additional request headers.
     * @param  array<string, mixed>  $body  JSON or multipart body fields.
     * @return array<string, mixed>|list<mixed>
     */
    public function request(string $method, string $pathTemplate, array $pathParams = [], array $query = [], array $headers = [], array $body = [], string $bodyContentType = 'application/json', string $authMode = 'bearer', string $base = 'api'): array
    {
        $response = $this->rawRequest($method, $this->expandPath($pathTemplate, $pathParams), $query, $headers, $body, $bodyContentType, $authMode, $base);

        if ($response->body() === '') {
            return ['success' => true, 'status' => $response->status(), 'location' => $response->header('Location')];
        }

        return $response->json() ?? ['body' => $response->body(), 'status' => $response->status(), 'content_type' => $response->header('Content-Type'), 'location' => $response->header('Location')];
    }

    /**
     * Execute an HTTP request against Airwallex.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $headers  Additional request headers.
     * @param  array<string, mixed>  $body  JSON or multipart body fields.
     */
    private function rawRequest(string $method, string $path, array $query = [], array $headers = [], array $body = [], string $bodyContentType = 'application/json', string $authMode = 'bearer', string $base = 'api'): Response
    {
        $baseHeaders = ['Accept' => 'application/json'];
        if ($bodyContentType !== 'multipart/form-data') {
            $baseHeaders['Content-Type'] = $bodyContentType;
        }
        if ($this->apiVersion !== '') {
            $baseHeaders['x-api-version'] = $this->apiVersion;
        }
        if ($this->loginAs !== '') {
            $baseHeaders['x-login-as'] = $this->loginAs;
        }
        if ($this->onBehalfOf !== '') {
            $baseHeaders['x-on-behalf-of'] = $this->onBehalfOf;
        }

        if ($authMode === 'api_key') {
            if ($this->clientId === '' || $this->apiKey === '') {
                throw new RuntimeException('Airwallex client ID and API key are required for the login endpoint.');
            }
            $baseHeaders['x-client-id'] = $this->clientId;
            $baseHeaders['x-api-key'] = $this->apiKey;
        } else {
            if ($this->accessToken === '') {
                throw new RuntimeException('Airwallex access token is not configured. Use airwallex_authentication_obtain_access_token with client ID and API key first.');
            }
            $baseHeaders['Authorization'] = 'Bearer ' . $this->accessToken;
        }

        $request = Http::withHeaders(array_merge($baseHeaders, $headers))->timeout(60);
        $method = strtoupper($method);
        $root = $base === 'file' ? $this->fileUrl : $this->baseUrl;
        $url = $this->urlWithQuery($root . $path, $query);
        $response = $request->send($method, $url, $this->requestOptions($method, $body, $bodyContentType));

        if (!$response->successful()) {
            Log::error('Airwallex API request failed', ['method' => $method, 'path' => $path, 'status' => $response->status(), 'body' => $response->body()]);
            $message = $response->json('message') ?? $response->json('error') ?? $response->body() ?: 'Airwallex API request failed.';
            throw new RuntimeException('Airwallex API error: ' . (is_string($message) ? $message : json_encode($message)));
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
        if ($bodyContentType === 'multipart/form-data') {
            return ['multipart' => $this->multipart($body)];
        }

        return $body === [] ? [] : ['json' => $body];
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
