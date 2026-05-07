<?php

namespace OpenCompany\Integrations\Helicone;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Helicone REST API and AI Gateway.
 *
 * Handles bearer authentication, separate observability and gateway base URLs,
 * JSON dispatch, error logging, and response parsing for Helicone tools.
 */
class HeliconeService
{
    /**
     * @param  string  $apiKey  Helicone API key.
     * @param  string  $apiUrl  Helicone observability API base URL.
     * @param  string  $gatewayUrl  Helicone AI Gateway base URL.
     */
    public function __construct(
        private string $apiKey = '',
        private string $apiUrl = 'https://api.helicone.ai',
        private string $gatewayUrl = 'https://ai-gateway.helicone.ai',
    ) {
        $this->apiUrl = rtrim($this->apiUrl, '/');
        $this->gatewayUrl = rtrim($this->gatewayUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    /**
     * Query request table data with the ClickHouse-optimized endpoint.
     *
     * @param  array<string, mixed>  $body  Request query body.
     * @return array<string, mixed>
     */
    public function queryRequests(array $body): array
    {
        return $this->apiRequest('POST', '/v1/request/query-clickhouse', $body);
    }

    /**
     * Query request table data by explicit request IDs.
     *
     * @param  array<string, mixed>  $body  Body containing requestIds.
     * @return array<string, mixed>
     */
    public function queryRequestsByIds(array $body): array
    {
        return $this->apiRequest('POST', '/v1/request/query-ids', $body);
    }

    /**
     * Retrieve a single request by ID.
     *
     * @return array<string, mixed>
     */
    public function getRequest(string $requestId): array
    {
        return $this->apiRequest('GET', '/v1/request/' . rawurlencode($requestId));
    }

    /**
     * Submit boolean user feedback for a request.
     *
     * @param  array<string, mixed>  $body  Feedback body, usually rating boolean.
     * @return array<string, mixed>
     */
    public function submitFeedback(string $requestId, array $body): array
    {
        return $this->apiRequest('POST', '/v1/request/' . rawurlencode($requestId) . '/feedback', $body);
    }

    /**
     * Query user metrics.
     *
     * @param  array<string, mixed>  $body  User metrics query body.
     * @return array<string, mixed>
     */
    public function queryUserMetrics(array $body): array
    {
        return $this->apiRequest('POST', '/v1/user/metrics/query', $body);
    }

    /**
     * Query user metrics overview.
     *
     * @param  array<string, mixed>  $body  User metrics overview query body.
     * @return array<string, mixed>
     */
    public function queryUserMetricsOverview(array $body): array
    {
        return $this->apiRequest('POST', '/v1/user/metrics-overview/query', $body);
    }

    /**
     * List models available through the Helicone AI Gateway.
     *
     * @return array<string, mixed>
     */
    public function listGatewayModels(): array
    {
        return $this->gatewayRequest('GET', '/v1/models');
    }

    /**
     * Create an OpenAI-compatible gateway chat completion.
     *
     * @param  array<string, mixed>  $body  Chat completion body.
     * @return array<string, mixed>
     */
    public function gatewayChatCompletions(array $body): array
    {
        return $this->gatewayRequest('POST', '/v1/chat/completions', $body);
    }

    /**
     * Create an OpenAI-compatible gateway Responses API response.
     *
     * @param  array<string, mixed>  $body  Responses API body.
     * @return array<string, mixed>
     */
    public function gatewayResponses(array $body): array
    {
        return $this->gatewayRequest('POST', '/v1/responses', $body);
    }

    /**
     * Make a request to the observability API.
     *
     * @param  array<string, mixed>  $body  JSON body.
     * @return array<string, mixed>
     */
    private function apiRequest(string $method, string $path, array $body = []): array
    {
        return $this->request($this->apiUrl, $method, $path, $body);
    }

    /**
     * Make a request to the AI Gateway API.
     *
     * @param  array<string, mixed>  $body  JSON body.
     * @return array<string, mixed>
     */
    private function gatewayRequest(string $method, string $path, array $body = []): array
    {
        return $this->request($this->gatewayUrl, $method, $path, $body);
    }

    /**
     * Make a JSON HTTP request and return parsed JSON.
     *
     * @param  array<string, mixed>  $body  JSON body.
     * @return array<string, mixed>
     */
    private function request(string $baseUrl, string $method, string $path, array $body = []): array
    {
        $response = $this->rawRequest($baseUrl, $method, $path, $body);

        return $response->json() ?? [];
    }

    /**
     * Make a raw JSON HTTP request.
     *
     * @param  array<string, mixed>  $body  JSON body.
     */
    private function rawRequest(string $baseUrl, string $method, string $path, array $body = []): Response
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Helicone API key is not configured.');
        }

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(120);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($baseUrl . $path),
                'POST' => $http->post($baseUrl . $path, $body),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('error')
                    ?? $response->json('message')
                    ?? $response->body();

                Log::error("Helicone API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new RuntimeException("Helicone API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Helicone API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new RuntimeException("Failed to connect to Helicone API: {$e->getMessage()}");
        }
    }
}
