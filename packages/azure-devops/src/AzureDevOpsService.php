<?php

namespace OpenCompany\Integrations\AzureDevOps;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for Azure DevOps REST APIs.
 *
 * Handles PAT/basic authentication, bearer-token authentication, host and path
 * expansion, API-version defaults, JSON and octet-stream bodies, and response parsing.
 */
class AzureDevOpsService
{
    /**
     * @param  string  $personalAccessToken  Azure DevOps personal access token.
     * @param  string  $accessToken  Microsoft Entra bearer token for Azure DevOps.
     * @param  string  $baseUrl  Optional full base URL override for tests, proxies, or Azure DevOps Server.
     */
    public function __construct(private string $personalAccessToken = '', private string $accessToken = '', private string $baseUrl = '')
    {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->personalAccessToken !== '' || $this->accessToken !== '';
    }

    /**
     * Execute an Azure DevOps REST request and return decoded response data.
     *
     * @param  array<string, mixed>  $pathParams  Host and path placeholder values.
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $headers  Additional request headers.
     * @param  array<string, mixed>  $body  Request body payload.
     * @return array<string, mixed>|list<mixed>
     */
    public function request(string $method, string $hostTemplate, string $pathTemplate, array $pathParams = [], array $query = [], array $headers = [], array $body = [], string $bodyMode = 'json', string $apiVersion = '7.2'): array
    {
        if (!array_key_exists('api-version', $query) || $query['api-version'] === null || $query['api-version'] === '') {
            $query['api-version'] = $apiVersion;
        }

        $host = $this->expand($hostTemplate, $pathParams);
        $path = $this->expand($pathTemplate, $pathParams);
        $base = $this->baseUrl !== '' ? $this->baseUrl : 'https://' . $host;
        $response = $this->rawRequest($method, $base . $path, $query, $headers, $body, $bodyMode);

        if ($response->status() === 202 || $response->status() === 204 || $response->body() === '') {
            return ['success' => true, 'status' => $response->status()];
        }

        return $response->json() ?? ['body' => $response->body(), 'status' => $response->status(), 'content_type' => $response->header('Content-Type')];
    }

    /**
     * Execute the raw HTTP request.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $headers  Additional request headers.
     * @param  array<string, mixed>  $body  Request body payload.
     */
    private function rawRequest(string $method, string $url, array $query = [], array $headers = [], array $body = [], string $bodyMode = 'json'): Response
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Azure DevOps personal access token or access token is required.');
        }

        $baseHeaders = ['Accept' => 'application/json'];
        if ($this->personalAccessToken !== '') {
            $baseHeaders['Authorization'] = 'Basic ' . base64_encode(':' . $this->personalAccessToken);
        } else {
            $baseHeaders['Authorization'] = 'Bearer ' . $this->accessToken;
        }

        $pending = Http::withHeaders(array_merge($baseHeaders, $headers))->timeout(128);
        $url = $this->urlWithQuery($url, $query);
        $method = strtoupper($method);

        if ($bodyMode === 'octet') {
            $content = $body['content'] ?? '';
            $contentType = is_string($body['content_type'] ?? null) ? $body['content_type'] : 'application/octet-stream';
            $response = $pending->withBody(is_scalar($content) ? (string) $content : json_encode($content), $contentType)->send($method, $url);
        } else {
            $response = $pending->withHeaders(['Content-Type' => 'application/json'])->send($method, $url, $body === [] ? [] : ['json' => $body]);
        }

        if (!$response->successful()) {
            Log::error('Azure DevOps REST request failed', ['method' => $method, 'url' => $url, 'status' => $response->status(), 'body' => $response->body()]);
            $message = $response->json('message') ?? $response->json('error.message') ?? $response->json('error') ?? $response->body() ?: 'Azure DevOps REST request failed.';
            throw new RuntimeException('Azure DevOps API error: ' . (is_string($message) ? $message : json_encode($message)));
        }

        return $response;
    }

    /**
     * Expand host or path placeholders with raw URL encoded values.
     *
     * @param  array<string, mixed>  $params  Placeholder values.
     */
    private function expand(string $template, array $params): string
    {
        foreach ($params as $key => $value) {
            $template = str_replace('${' . $key . '}', rawurlencode((string) $value), $template);
            $template = str_replace('{' . $key . '}', rawurlencode((string) $value), $template);
        }

        return $template;
    }

    /**
     * Append query parameters to a URL.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     */
    private function urlWithQuery(string $url, array $query): string
    {
        $parts = [];
        foreach ($query as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }
            if (is_array($value)) {
                $parts[] = rawurlencode((string) $key) . '=' . rawurlencode(implode(',', array_map(static fn (mixed $item): string => is_scalar($item) ? (string) $item : json_encode($item), $value)));
                continue;
            }
            $parts[] = rawurlencode((string) $key) . '=' . rawurlencode(is_bool($value) ? ($value ? 'true' : 'false') : (string) $value);
        }

        return $parts === [] ? $url : $url . '?' . implode('&', $parts);
    }
}
