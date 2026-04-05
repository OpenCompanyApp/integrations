<?php

namespace OpenCompany\Integrations\Aws;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AwsService
{
    /**
     * Create a new AWS service instance.
     *
     * @param  string  $accessToken  The Bearer token for API authentication.
     * @param  string  $baseUrl  The base URL for the AWS API.
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.aws.amazon.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an access token.
     *
     * @return bool True if an access token is set.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * Send a GET request to the AWS API.
     *
     * @param  string  $path  The API endpoint path (e.g., "/s3/buckets").
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed> The parsed JSON response.
     */
    public function get(string $path, array $params = []): array
    {
        return $this->request('GET', $path, $params);
    }

    /**
     * Send a POST request to the AWS API.
     *
     * @param  string  $path  The API endpoint path (e.g., "/ec2/describe-instances").
     * @param  array<string, mixed>  $data  Request body data.
     * @return array<string, mixed> The parsed JSON response.
     */
    public function post(string $path, array $data = []): array
    {
        return $this->request('POST', $path, $data);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  The HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  The API endpoint path.
     * @param  array<string, mixed>  $data  Request parameters or body.
     * @return array<string, mixed> The parsed JSON response.
     *
     * @throws \RuntimeException If the access token is missing or the request fails.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the AWS API.
     *
     * @param  string  $method  The HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  The API endpoint path.
     * @param  array<string, mixed>  $data  Request parameters or body.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If the access token is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('AWS access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('message') ?? $response->json('error') ?? $response->body();
                Log::error("AWS API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("AWS API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("AWS API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to AWS API: {$e->getMessage()}");
        }
    }
}
