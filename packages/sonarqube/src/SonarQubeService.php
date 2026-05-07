<?php

namespace OpenCompany\Integrations\SonarQube;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the SonarQube Server Web API.
 *
 * Handles bearer token authentication, query/form request dispatch, response
 * parsing, and SonarQube error normalization for endpoint-specific tools.
 */
class SonarQubeService
{
    /**
     * @param  string  $apiToken  SonarQube user token for bearer authentication.
     * @param  string  $baseUrl  Base URL of the SonarQube Server instance.
     */
    public function __construct(private string $apiToken = '', private string $baseUrl = 'https://next.sonarqube.com/sonarqube')
    {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->apiToken !== '' && $this->baseUrl !== '';
    }

    /**
     * Execute a SonarQube Web API endpoint.
     *
     * @param  array<string, mixed>  $params  Official Web API parameters.
     * @return array<string, mixed>
     */
    public function request(string $method, string $path, array $params = []): array
    {
        $response = $this->rawRequest($method, $path, $params);

        if ($response->body() === '') {
            return ['success' => true, 'status' => $response->status()];
        }

        return $response->json() ?? ['body' => $response->body(), 'status' => $response->status()];
    }

    /**
     * Dispatch the raw HTTP request using query params for GET and form data for POST.
     *
     * @param  array<string, mixed>  $params  Official Web API parameters.
     */
    private function rawRequest(string $method, string $path, array $params = []): Response
    {
        if (! $this->isConfigured()) {
            throw new RuntimeException('SonarQube API token and base URL are required.');
        }

        try {
            $method = strtoupper($method);
            $url = $this->baseUrl.$path;
            $http = Http::withHeaders([
                'Authorization' => 'Bearer '.$this->apiToken,
                'Accept' => 'application/json',
            ])->timeout(120);

            $response = match ($method) {
                'GET' => $http->get($url, $this->cleanParams($params)),
                'POST' => $http->asForm()->post($url, $this->cleanParams($params)),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $error = $response->json('errors.0.msg')
                    ?? $response->json('message')
                    ?? $response->json('error')
                    ?? $response->body();
                Log::error("SonarQube API error: {$method} {$path}", ['status' => $response->status(), 'error' => $error]);
                throw new RuntimeException('SonarQube API error ('.$response->status().'): '.(is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("SonarQube API connection error: {$method} {$path}", ['error' => $e->getMessage()]);
            throw new RuntimeException("Failed to connect to SonarQube API: {$e->getMessage()}");
        }
    }

    /**
     * Remove empty values while preserving booleans and zero-like values.
     *
     * @param  array<string, mixed>  $params  Request parameters.
     * @return array<string, mixed>
     */
    private function cleanParams(array $params): array
    {
        $clean = [];
        foreach ($params as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }
            $clean[$key] = is_bool($value) ? ($value ? 'true' : 'false') : $value;
        }

        return $clean;
    }
}
