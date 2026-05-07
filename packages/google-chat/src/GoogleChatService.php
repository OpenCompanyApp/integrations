<?php

namespace OpenCompany\Integrations\GoogleChat;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Google Chat REST API.
 *
 * Handles OAuth bearer authentication, Discovery path expansion, JSON and media
 * upload dispatch, response parsing, and Google API error normalization.
 */
class GoogleChatService
{
    /**
     * @param  string  $accessToken  Google OAuth 2.0 access token with Chat scopes.
     * @param  string  $baseUrl  Google Chat REST API base URL.
     */
    public function __construct(private string $accessToken = '', private string $baseUrl = 'https://chat.googleapis.com')
    {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool { return $this->accessToken !== ''; }

    /**
     * Execute a Google Chat REST method.
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
     * Upload media to a Google Chat media upload endpoint.
     *
     * @param  array<string, mixed>  $pathParams  Path parameter values.
     * @param  string[]  $reservedPathParams  Reserved path parameters.
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $metadata  Upload metadata request body.
     * @return array<string, mixed>
     */
    public function upload(string $pathTemplate, array $pathParams, array $reservedPathParams, array $query, array $metadata, string $filePath, string $mimeType = 'application/octet-stream'): array
    {
        if (!$this->isConfigured()) throw new RuntimeException('Google Chat access token is not configured.');
        if (!is_file($filePath) || !is_readable($filePath)) throw new RuntimeException('file_path must point to a readable local file.');

        $boundary = 'opencompany-chat-'.bin2hex(random_bytes(8));
        $metadataJson = json_encode($metadata === [] ? new \stdClass : $metadata, JSON_UNESCAPED_SLASHES);
        $body = "--{$boundary}\r\nContent-Type: application/json; charset=UTF-8\r\n\r\n{$metadataJson}\r\n";
        $body .= "--{$boundary}\r\nContent-Type: {$mimeType}\r\n\r\n".file_get_contents($filePath)."\r\n--{$boundary}--\r\n";
        $query['uploadType'] = 'multipart';

        $response = $this->rawRequest('POST', $this->expandPath($pathTemplate, $pathParams, $reservedPathParams), $query, [], 'multipart/related; boundary='.$boundary, $body);
        if ($response->body() === '') return ['success' => true, 'status' => $response->status()];
        return $response->json() ?? ['body' => $response->body(), 'status' => $response->status()];
    }

    /**
     * Perform a raw HTTP request against Google Chat.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>|string  $body  JSON request body or multipart body.
     */
    private function rawRequest(string $method, string $path, array $query = [], array|string $body = [], ?string $contentType = null, ?string $rawBody = null): Response
    {
        if (!$this->isConfigured()) throw new RuntimeException('Google Chat access token is not configured.');
        try {
            $method = strtoupper($method);
            $url = $this->urlWithQuery($this->baseUrl.$path, $query);
            $http = Http::withHeaders([
                'Authorization' => 'Bearer '.$this->accessToken,
                'Content-Type' => $contentType ?? 'application/json',
                'Accept' => 'application/json',
            ])->timeout(120);
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
                Log::error("Google Chat API error: {$method} {$path}", ['status' => $response->status(), 'error' => $error]);
                throw new RuntimeException('Google Chat API error ('.$response->status().'): '.(is_string($error) ? $error : json_encode($error)));
            }
            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Google Chat API connection error: {$method} {$path}", ['error' => $e->getMessage()]);
            throw new RuntimeException("Failed to connect to Google Chat API: {$e->getMessage()}");
        }
    }

    /**
     * Expand Discovery path templates such as `{+name}` and `{+parent}`.
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
     * Append query parameters while preserving repeated Google API keys.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     */
    private function urlWithQuery(string $url, array $query): string
    {
        $parts = [];
        foreach ($query as $key => $value) {
            if ($value === null || $value === '') continue;
            foreach (is_array($value) ? $value : [$value] as $item) if ($item !== null && $item !== '') $parts[] = rawurlencode((string) $key).'='.rawurlencode((string) $item);
        }
        return $parts === [] ? $url : $url.'?'.implode('&', $parts);
    }
}