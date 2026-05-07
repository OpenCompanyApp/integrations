<?php

namespace OpenCompany\Integrations\GoogleDriveActivity;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Google Drive Activity REST API.
 *
 * Handles OAuth bearer authentication, JSON request dispatch, response parsing,
 * and Google API error normalization.
 */
class GoogleDriveActivityService
{
    /**
     * @param  string  $accessToken  Google OAuth 2.0 access token with Drive Activity scopes.
     * @param  string  $baseUrl  Google Drive Activity REST API base URL.
     */
    public function __construct(private string $accessToken = '', private string $baseUrl = 'https://driveactivity.googleapis.com')
    {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool { return $this->accessToken !== ''; }

    /**
     * Query past activity in Google Drive.
     *
     * @param  array<string, mixed>  $body  QueryDriveActivityRequest body.
     * @return array<string, mixed>
     */
    public function queryActivity(array $body): array
    {
        return $this->request('POST', '/v2/activity:query', body: $body);
    }

    /**
     * Execute a Google Drive Activity REST method.
     *
     * @param  array<string, mixed>  $pathParams  Path parameter values keyed by Discovery parameter name.
     * @param  string[]  $reservedPathParams  Path parameters using `{+param}` reserved expansion.
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $body  JSON request body.
     * @return array<string, mixed>
     */
    public function request(string $method, string $pathTemplate, array $pathParams = [], array $reservedPathParams = [], array $query = [], array $body = []): array
    {
        $response = $this->rawRequest($method, $pathTemplate, $query, $body);
        if ($response->body() === '') return ['success' => true, 'status' => $response->status()];
        return $response->json() ?? ['body' => $response->body(), 'status' => $response->status()];
    }

    /**
     * Perform a raw HTTP request against Google Drive Activity.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $body  JSON request body.
     */
    private function rawRequest(string $method, string $path, array $query = [], array $body = []): Response
    {
        if (!$this->isConfigured()) throw new RuntimeException('Google Drive Activity access token is not configured.');
        try {
            $http = Http::withHeaders(['Authorization' => 'Bearer '.$this->accessToken, 'Content-Type' => 'application/json', 'Accept' => 'application/json'])->timeout(120);
            $method = strtoupper($method); $url = $this->baseUrl.$path; $urlWithQuery = $query === [] ? $url : $url.'?'.http_build_query($query);
            $response = match ($method) {
                'GET' => $http->get($url, $query),
                'POST' => $http->post($urlWithQuery, $body),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };
            if (!$response->successful()) {
                $error = $response->json('error.message') ?? $response->json('error') ?? $response->body();
                Log::error("Google Drive Activity API error: {$method} {$path}", ['status' => $response->status(), 'error' => $error]);
                throw new RuntimeException("Google Drive Activity API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }
            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Google Drive Activity API connection error: {$method} {$path}", ['error' => $e->getMessage()]);
            throw new RuntimeException("Failed to connect to Google Drive Activity API: {$e->getMessage()}");
        }
    }
}
