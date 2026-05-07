<?php

namespace OpenCompany\Integrations\GoogleDrive;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Google Drive API v3.
 *
 * Handles OAuth bearer authentication, Discovery path expansion, JSON request
 * dispatch, multipart uploads, response parsing, and API error handling.
 */
class GoogleDriveService
{
    /**
     * @param  string  $accessToken  Google OAuth 2.0 access token with Drive scopes.
     * @param  string  $baseUrl  Google APIs base URL.
     */
    public function __construct(private string $accessToken = '', private string $baseUrl = 'https://www.googleapis.com')
    {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool { return $this->accessToken !== ''; }

    /**
     * Execute a Google Drive REST method.
     *
     * @param  array<string, mixed>  $pathParams  Path parameter values keyed by Discovery parameter name.
     * @param  string[]  $reservedPathParams  Path parameters using `{+param}` reserved expansion.
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $body  JSON request body.
     * @return array<string, mixed>
     */
    public function request(string $method, string $pathTemplate, array $pathParams = [], array $reservedPathParams = [], array $query = [], array $body = []): array
    {
        $response = $this->rawRequest($method, $this->expandPath($pathTemplate, $pathParams, $reservedPathParams), $query, $body);
        if ($response->body() === '') return ['success' => true, 'status' => $response->status()];
        return $response->json() ?? ['body' => $response->body(), 'status' => $response->status()];
    }

    /**
     * Upload media to a Google Drive multipart upload endpoint.
     *
     * @param  array<string, mixed>  $pathParams  Path parameter values.
     * @param  string[]  $reservedPathParams  Reserved path parameters.
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $metadata  Drive file metadata.
     * @return array<string, mixed>
     */
    public function upload(string $pathTemplate, array $pathParams, array $reservedPathParams, array $query, array $metadata, string $filePath, string $mimeType = 'application/octet-stream'): array
    {
        if (!$this->isConfigured()) throw new RuntimeException('Google Drive access token is not configured.');
        if (!is_file($filePath) || !is_readable($filePath)) throw new RuntimeException('file_path must point to a readable local file.');
        $boundary = 'opencompany-drive-'.bin2hex(random_bytes(8));
        $metadataJson = json_encode($metadata === [] ? new \stdClass : $metadata, JSON_UNESCAPED_SLASHES);
        $body = "--{$boundary}\r\nContent-Type: application/json; charset=UTF-8\r\n\r\n{$metadataJson}\r\n";
        $body .= "--{$boundary}\r\nContent-Type: {$mimeType}\r\n\r\n".file_get_contents($filePath)."\r\n--{$boundary}--\r\n";
        $query['uploadType'] = 'multipart';
        $response = $this->rawRequest('POST', $this->expandPath($pathTemplate, $pathParams, $reservedPathParams), $query, [], 'multipart/related; boundary='.$boundary, $body);
        if ($response->body() === '') return ['success' => true, 'status' => $response->status()];
        return $response->json() ?? ['body' => $response->body(), 'status' => $response->status()];
    }

    /**
     * Perform a raw HTTP request against Google Drive.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>|string  $body  JSON request body or raw multipart body.
     */
    private function rawRequest(string $method, string $path, array $query = [], array|string $body = [], ?string $contentType = null, ?string $rawBody = null): Response
    {
        if (!$this->isConfigured()) throw new RuntimeException('Google Drive access token is not configured.');
        try {
            $method = strtoupper($method);
            $url = $this->urlWithQuery($this->baseUrl.$path, $query);
            $http = Http::withHeaders(['Authorization' => 'Bearer '.$this->accessToken, 'Content-Type' => $contentType ?? 'application/json', 'Accept' => 'application/json'])->timeout(120);
            if ($rawBody !== null) $http = $http->withBody($rawBody, $contentType ?? 'application/octet-stream');
            $response = match ($method) {
                'GET' => $http->get($url),
                'POST' => $rawBody !== null ? $http->post($url) : $http->post($url, is_array($body) ? $body : []),
                'PUT' => $http->put($url, is_array($body) ? $body : []),
                'PATCH' => $http->patch($url, is_array($body) ? $body : []),
                'DELETE' => $http->delete($url, is_array($body) ? $body : []),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };
            if (!$response->successful()) {
                $error = $response->json('error.message') ?? $response->json('error') ?? $response->body();
                Log::error("Google Drive API error: {$method} {$path}", ['status' => $response->status(), 'error' => $error]);
                throw new RuntimeException('Google Drive API error ('.$response->status().'): '.(is_string($error) ? $error : json_encode($error)));
            }
            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Google Drive API connection error: {$method} {$path}", ['error' => $e->getMessage()]);
            throw new RuntimeException("Failed to connect to Google Drive API: {$e->getMessage()}");
        }
    }

    /**
     * Expand Discovery path templates.
     *
     * @param  array<string, mixed>  $pathParams  Path parameter values.
     * @param  string[]  $reservedPathParams  Parameters using reserved expansion.
     */
    private function expandPath(string $template, array $pathParams, array $reservedPathParams): string
    {
        return (string) preg_replace_callback('/\{(\+?)([A-Za-z0-9_]+)(?:=[^}]*)?\}/', function (array $matches) use ($pathParams, $reservedPathParams): string {
            $key = $matches[2];
            if (!array_key_exists($key, $pathParams) || $pathParams[$key] === null || $pathParams[$key] === '') throw new RuntimeException($key.' must be a non-empty path parameter.');
            $reserved = $matches[1] === '+' || in_array($key, $reservedPathParams, true);
            return $reserved ? str_replace('%2F', '/', rawurlencode((string) $pathParams[$key])) : rawurlencode((string) $pathParams[$key]);
        }, $template);
    }

    /**
     * Append query parameters while preserving repeated keys.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     */
    private function urlWithQuery(string $url, array $query): string
    {
        $parts = [];
        foreach ($query as $key => $value) {
            if ($value === null || $value === '') continue;
            foreach (is_array($value) ? $value : [$value] as $item) {
                if ($item === null || $item === '') continue;
                $encodedValue = is_bool($item) ? ($item ? '1' : '0') : (string) $item;
                $parts[] = rawurlencode((string) $key).'='.rawurlencode($encodedValue);
            }
        }
        return $parts === [] ? $url : $url.'?'.implode('&', $parts);
    }
}
