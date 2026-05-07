<?php

namespace OpenCompany\Integrations\GoogleSlides;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Google Slides REST API.
 *
 * Handles OAuth bearer authentication, Discovery path expansion, JSON request
 * dispatch, response parsing, and Google API error normalization.
 */
class GoogleSlidesService
{
    /**
     * @param  string  $accessToken  Google OAuth 2.0 access token with Slides scopes.
     * @param  string  $baseUrl  Google Slides REST API base URL.
     */
    public function __construct(private string $accessToken = '', private string $baseUrl = 'https://slides.googleapis.com')
    {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool { return $this->accessToken !== ''; }

    /**
     * Execute a Google Slides REST method.
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
     * Perform a raw HTTP request against Google Slides.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $body  JSON request body.
     */
    private function rawRequest(string $method, string $path, array $query = [], array $body = []): Response
    {
        if (!$this->isConfigured()) throw new RuntimeException('Google Slides access token is not configured.');
        try {
            $method = strtoupper($method);
            $url = $this->urlWithQuery($this->baseUrl.$path, $query);
            $http = Http::withHeaders(['Authorization' => 'Bearer '.$this->accessToken, 'Content-Type' => 'application/json', 'Accept' => 'application/json'])->timeout(120);
            $response = match ($method) {
                'GET' => $http->get($url),
                'POST' => $http->post($url, $body),
                'PUT' => $http->put($url, $body),
                'PATCH' => $http->patch($url, $body),
                'DELETE' => $http->delete($url, $body),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };
            if (!$response->successful()) {
                $error = $response->json('error.message') ?? $response->json('error') ?? $response->body();
                Log::error("Google Slides API error: {$method} {$path}", ['status' => $response->status(), 'error' => $error]);
                throw new RuntimeException('Google Slides API error ('.$response->status().'): '.(is_string($error) ? $error : json_encode($error)));
            }
            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Google Slides API connection error: {$method} {$path}", ['error' => $e->getMessage()]);
            throw new RuntimeException("Failed to connect to Google Slides API: {$e->getMessage()}");
        }
    }

    /**
     * Expand Discovery path templates such as `{formId}` and `{responseId}`.
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