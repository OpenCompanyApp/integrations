<?php

namespace OpenCompany\Integrations\AdobeAcrobatSign;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Adobe Acrobat Sign REST API.
 *
 * Handles bearer authentication, JSON and multipart request dispatch,
 * path/query/header construction, and API error normalization.
 */
class AdobeAcrobatSignService
{
    /**
     * @param  string  $accessToken  Adobe Acrobat Sign OAuth access token.
     * @param  string  $baseUrl  REST v6 API base URL including /api/rest/v6.
     */
    public function __construct(private string $accessToken = '', private string $baseUrl = 'https://api.na1.adobesign.com/api/rest/v6')
    {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether an access token is available.
     */
    public function isConfigured(): bool
    {
        return $this->accessToken !== '' && $this->baseUrl !== '';
    }

    /**
     * Return official Adobe Acrobat Sign operation metadata.
     *
     * @return array<string, array<string, mixed>>
     */
    public static function operations(): array
    {
        return AdobeAcrobatSignOperations::all();
    }

    /**
     * Execute an official Adobe Acrobat Sign REST operation.
     *
     * @param  array<string, mixed>  $pathParams  Path parameters keyed by upstream name.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $headers  Extra headers.
     * @param  array<string, mixed>  $body  JSON request body.
     * @param  array<string, mixed>  $form  Multipart form values.
     * @param  array<string, string>  $fileParams  File parameter names keyed by upstream name.
     * @return array<string, mixed>
     */
    public function request(string $method, string $pathTemplate, array $pathParams = [], array $query = [], array $headers = [], array $body = [], array $form = [], array $fileParams = []): array
    {
        $response = $this->rawRequest($method, $this->expandPath($pathTemplate, $pathParams), $query, $headers, $body, $form, $fileParams);

        if ($response->status() === 204 || $response->body() === '') {
            return ['success' => true, 'status' => $response->status()];
        }

        $contentType = (string) $response->header('Content-Type');

        if (! str_contains($contentType, 'json')) {
            return ['body' => $response->body(), 'content_type' => $contentType, 'status' => $response->status()];
        }

        return $response->json() ?? [];
    }

    /**
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $headers  Extra headers.
     * @param  array<string, mixed>  $body  JSON request body.
     * @param  array<string, mixed>  $form  Multipart form values.
     * @param  array<string, string>  $fileParams  File parameter names keyed by upstream name.
     */
    private function rawRequest(string $method, string $path, array $query = [], array $headers = [], array $body = [], array $form = [], array $fileParams = []): Response
    {
        if (! $this->isConfigured()) {
            throw new RuntimeException('Adobe Acrobat Sign access token is not configured.');
        }

        $method = strtoupper($method);
        $url = $this->urlWithQuery($this->baseUrl.$path, $query);

        try {
            $http = Http::withHeaders(array_merge([
                'Authorization' => 'Bearer '.$this->accessToken,
                'Accept' => 'application/json',
            ], $headers))->timeout(120);

            if ($form !== []) {
                $response = $this->sendMultipart($http, $method, $url, $form, $fileParams);
            } else {
                $http = $http->withHeaders(['Content-Type' => 'application/json']);
                $response = match ($method) {
                    'GET' => $http->get($url),
                    'POST' => $http->post($url, $body),
                    'PUT' => $http->put($url, $body),
                    'PATCH' => $http->patch($url, $body),
                    'DELETE' => $http->delete($url, $body),
                    default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
                };
            }
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Adobe Acrobat Sign API connection error: {$method} {$path}", ['error' => $e->getMessage()]);
            throw new RuntimeException('Failed to connect to Adobe Acrobat Sign API: '.$e->getMessage());
        }

        if (! $response->successful()) {
            $error = $response->json('message') ?? $response->json('error_description') ?? $response->json('error') ?? $response->body();
            Log::error("Adobe Acrobat Sign API error: {$method} {$path}", ['status' => $response->status(), 'error' => $error]);
            throw new RuntimeException('Adobe Acrobat Sign API error ('.$response->status().'): '.(is_string($error) ? $error : json_encode($error)));
        }

        return $response;
    }

    /**
     * @param  array<string, mixed>  $form  Multipart form values.
     * @param  array<string, string>  $fileParams  File parameter names keyed by upstream name.
     */
    private function sendMultipart(PendingRequest $http, string $method, string $url, array $form, array $fileParams): Response
    {
        foreach ($form as $name => $value) {
            if (array_key_exists($name, $fileParams)) {
                if (is_array($value)) {
                    $path = (string) ($value['path'] ?? '');
                    $filename = (string) ($value['filename'] ?? basename($path ?: 'upload.bin'));
                    $mime = (string) ($value['mime_type'] ?? 'application/octet-stream');
                    $contents = $path !== '' && is_file($path) ? fopen($path, 'r') : (string) ($value['contents'] ?? '');
                    $http = $http->attach($name, $contents, $filename, ['Content-Type' => $mime]);
                } else {
                    $path = (string) $value;
                    $contents = is_file($path) ? fopen($path, 'r') : $path;
                    $http = $http->attach($name, $contents, basename(is_file($path) ? $path : 'upload.bin'));
                }

                unset($form[$name]);
            }
        }

        return match ($method) {
            'POST' => $http->post($url, $form),
            'PUT' => $http->put($url, $form),
            default => throw new RuntimeException("Multipart is only supported for POST and PUT operations, got {$method}."),
        };
    }

    /**
     * @param  array<string, mixed>  $pathParams  Path parameters.
     */
    private function expandPath(string $template, array $pathParams): string
    {
        return (string) preg_replace_callback('/\{([^}]+)\}/', function (array $matches) use ($pathParams): string {
            $key = $matches[1];
            if (! array_key_exists($key, $pathParams) || $pathParams[$key] === null || $pathParams[$key] === '') {
                throw new RuntimeException($key.' must be a non-empty path parameter.');
            }
            return rawurlencode((string) $pathParams[$key]);
        }, $template);
    }

    /**
     * @param  array<string, mixed>  $query  Query parameters.
     */
    private function urlWithQuery(string $url, array $query): string
    {
        $parts = [];
        foreach ($query as $key => $value) {
            if ($value === null || $value === '') continue;
            foreach (is_array($value) ? $value : [$value] as $item) {
                if ($item === null || $item === '') continue;
                $parts[] = rawurlencode((string) $key).'='.rawurlencode(is_bool($item) ? ($item ? 'true' : 'false') : (string) $item);
            }
        }
        return $parts === [] ? $url : $url.'?'.implode('&', $parts);
    }
}