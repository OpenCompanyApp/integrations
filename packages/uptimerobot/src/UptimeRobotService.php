<?php

namespace OpenCompany\Integrations\UptimeRobot;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the UptimeRobot v3 API.
 *
 * Handles bearer-token authentication, JSON and multipart requests, URL
 * expansion, error logging, and response parsing for endpoint tools.
 */
class UptimeRobotService
{
    /**
     * @param  string  $apiKey  UptimeRobot API token.
     * @param  string  $baseUrl  UptimeRobot API base URL.
     */
    public function __construct(private string $apiKey = '', private string $baseUrl = 'https://api.uptimerobot.com/v3')
    {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    /**
     * Make an UptimeRobot API request and return parsed response data.
     *
     * @param  array<string, mixed>  $pathParams  Path placeholder values.
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $headers  Additional request headers.
     * @param  array<string, mixed>  $body  JSON or multipart body fields.
     * @return array<string, mixed>|list<mixed>
     */
    public function request(string $method, string $pathTemplate, array $pathParams = [], array $query = [], array $headers = [], array $body = [], string $bodyContentType = 'json'): array
    {
        $response = $this->rawRequest($method, $this->expandPath($pathTemplate, $pathParams), $query, $headers, $body, $bodyContentType);

        if ($response->body() === '') {
            return ['success' => true, 'status' => $response->status()];
        }

        return $response->json() ?? ['body' => $response->body(), 'status' => $response->status(), 'content_type' => $response->header('Content-Type')];
    }

    /**
     * Execute an HTTP request against UptimeRobot.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $headers  Additional request headers.
     * @param  array<string, mixed>  $body  JSON or multipart body fields.
     */
    private function rawRequest(string $method, string $path, array $query = [], array $headers = [], array $body = [], string $bodyContentType = 'json'): Response
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('UptimeRobot API key is not configured.');
        }

        $request = Http::withHeaders(array_merge(['Accept' => 'application/json', 'Content-Type' => 'application/json', 'Authorization' => 'Bearer ' . $this->apiKey], $headers))->timeout(60);
        $method = strtoupper($method);
        $url = $this->urlWithQuery($this->baseUrl . $path, $query);
        $response = $bodyContentType === 'multipart'
            ? $this->applyMultipart($request, $body)->send($method, $url)
            : $request->send($method, $url, ($method === 'GET' || $method === 'DELETE') && $body === [] ? [] : ['json' => $body]);

        if (!$response->successful()) {
            Log::error('UptimeRobot API request failed', ['method' => $method, 'path' => $path, 'status' => $response->status(), 'body' => $response->body()]);
            $message = $response->json('message') ?? $response->json('error') ?? $response->body() ?: 'UptimeRobot API request failed.';
            throw new RuntimeException('UptimeRobot API error: ' . $message);
        }

        return $response;
    }

    /**
     * Attach multipart file paths and fields to a pending request.
     *
     * @param  array<string, mixed>  $body  Multipart fields; file fields should be local paths.
     */
    private function applyMultipart(PendingRequest $request, array $body): PendingRequest
    {
        foreach ($body as $key => $value) {
            if (is_string($value) && is_file($value)) {
                $request = $request->attach((string) $key, fopen($value, 'r'), basename($value));
                continue;
            }
            if ($value !== null && $value !== '') {
                $request = $request->attach((string) $key, (string) $value);
            }
        }

        return $request;
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
