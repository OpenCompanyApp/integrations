<?php

namespace OpenCompany\Integrations\GoogleCloudStorage;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Google Cloud Storage JSON API.
 *
 * Handles OAuth bearer authentication, Discovery path expansion, JSON request
 * dispatch, media uploads, response parsing, and Google API error handling.
 */
class GoogleCloudStorageService
{
    /**
     * @param  string  $accessToken  Google OAuth 2.0 access token with Cloud Storage scopes.
     * @param  string  $baseUrl  Cloud Storage JSON API base URL.
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://storage.googleapis.com/storage/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->accessToken !== '';
    }

    /**
     * Execute a Google Cloud Storage REST method.
     *
     * @param  array<string, mixed>  $pathParams  Path parameter values keyed by Discovery parameter name.
     * @param  string[]  $reservedPathParams  Path parameters using reserved expansion.
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $body  JSON body or media upload payload.
     * @return array<string, mixed>
     */
    public function request(string $method, string $pathTemplate, array $pathParams = [], array $reservedPathParams = [], array $query = [], array $body = [], bool $mediaUpload = false, string $uploadPathTemplate = '', bool $mediaDownload = false): array
    {
        $path = $this->expandPath($pathTemplate, $pathParams, $reservedPathParams);

        if ($mediaUpload && $this->hasMediaPayload($body)) {
            $uploadPath = $this->expandPath($uploadPathTemplate, $pathParams, $reservedPathParams);
            $response = $this->rawMediaUpload($uploadPath, $query, $body);
        } else {
            if ($mediaDownload && !array_key_exists('alt', $query)) {
                $query['alt'] = 'json';
            }
            $response = $this->rawRequest($method, $path, $query, $body);
        }

        if ($response->body() === '') {
            return ['success' => true, 'status' => $response->status()];
        }

        return $response->json() ?? ['body' => $response->body(), 'status' => $response->status()];
    }

    /**
     * Perform a JSON API request.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $body  JSON request body.
     */
    private function rawRequest(string $method, string $path, array $query = [], array $body = []): Response
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Google Cloud Storage access token is not configured.');
        }

        try {
            $http = Http::withHeaders($this->headers())->timeout(120);
            $method = strtoupper($method);
            $url = $this->baseUrl . $path;
            $urlWithQuery = $this->urlWithQuery($url, $method === 'GET' ? [] : $query);

            $response = match ($method) {
                'GET' => $http->get($url, $query),
                'POST' => $http->post($urlWithQuery, $body),
                'PUT' => $http->put($urlWithQuery, $body),
                'PATCH' => $http->patch($urlWithQuery, $body),
                'DELETE' => $http->delete($urlWithQuery, $body),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            return $this->checked($response, $method, $path);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Google Cloud Storage API connection error: {$method} {$path}", ['error' => $e->getMessage()]);
            throw new RuntimeException("Failed to connect to Google Cloud Storage API: {$e->getMessage()}");
        }
    }

    /**
     * Upload object media through the official /upload endpoint.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $body  Upload payload containing file_path or content.
     */
    private function rawMediaUpload(string $uploadPath, array $query, array $body): Response
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Google Cloud Storage access token is not configured.');
        }

        $content = $this->mediaContent($body);
        $contentType = (string) ($body['content_type'] ?? 'application/octet-stream');
        $query['uploadType'] = 'media';

        $url = $this->uploadRootUrl() . $uploadPath;
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->accessToken,
            'Accept' => 'application/json',
            'Content-Type' => $contentType,
        ])->timeout(300)->withBody($content, $contentType)->post($this->urlWithQuery($url, $query));

        return $this->checked($response, 'POST', $uploadPath);
    }

    /**
     * Return common JSON API headers.
     *
     * @return array<string, string>
     */
    private function headers(): array
    {
        return [
            'Authorization' => 'Bearer ' . $this->accessToken,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }

    /**
     * Validate a Google API response or throw a normalized error.
     */
    private function checked(Response $response, string $method, string $path): Response
    {
        if (!$response->successful()) {
            $error = $response->json('error.message') ?? $response->json('error') ?? $response->body();
            Log::error("Google Cloud Storage API error: {$method} {$path}", ['status' => $response->status(), 'error' => $error]);
            throw new RuntimeException("Google Cloud Storage API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
        }

        return $response;
    }

    /**
     * Determine whether a request body contains upload media.
     *
     * @param  array<string, mixed>  $body  Request body.
     */
    private function hasMediaPayload(array $body): bool
    {
        return isset($body['file_path']) || array_key_exists('content', $body);
    }

    /**
     * Read upload bytes from file_path or content.
     *
     * @param  array<string, mixed>  $body  Upload body.
     */
    private function mediaContent(array $body): string
    {
        if (isset($body['file_path'])) {
            $path = (string) $body['file_path'];
            if (!is_file($path)) {
                throw new RuntimeException('file_path must point to a readable local file.');
            }

            return (string) file_get_contents($path);
        }

        return (string) ($body['content'] ?? '');
    }

    /**
     * Expand Discovery path templates such as `{bucket}` and `{object}`.
     *
     * @param  array<string, mixed>  $pathParams  Path parameter values.
     * @param  string[]  $reservedPathParams  Parameters using reserved expansion.
     */
    private function expandPath(string $template, array $pathParams, array $reservedPathParams): string
    {
        return (string) preg_replace_callback('/\{(\+?)([A-Za-z0-9_]+)\}/', function (array $matches) use ($pathParams, $reservedPathParams): string {
            $key = $matches[2];
            if (!array_key_exists($key, $pathParams) || $pathParams[$key] === null || $pathParams[$key] === '') {
                throw new RuntimeException($key . ' must be a non-empty path parameter.');
            }

            $value = (string) $pathParams[$key];
            $reserved = $matches[1] === '+' || in_array($key, $reservedPathParams, true);

            return $reserved ? str_replace('%2F', '/', rawurlencode($value)) : rawurlencode($value);
        }, $template);
    }

    /**
     * Get the upload endpoint root from the configured JSON API base URL.
     */
    private function uploadRootUrl(): string
    {
        return preg_replace('#/storage/v1$#', '', $this->baseUrl) ?: 'https://storage.googleapis.com';
    }

    /**
     * Append query parameters to a URL.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     */
    private function urlWithQuery(string $url, array $query): string
    {
        if ($query === []) {
            return $url;
        }

        return $url . '?' . http_build_query($query);
    }
}