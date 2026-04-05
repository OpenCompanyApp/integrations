<?php

namespace OpenCompany\Integrations\BlandAI;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * BlandAI API service — handles authentication and HTTP communication with the Bland.ai v1 API.
 *
 * Supports making phone calls, retrieving call details, listing calls, and analyzing call transcripts.
 */
class BlandAIService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.bland.ai/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has a configured API key.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * Initiate a new phone call via BlandAI.
     *
     * @param  string  $phoneNumber  The phone number to call (E.164 format recommended, e.g. "+1234567890").
     * @param  string  $task  Instructions or task description for the AI agent on the call.
     * @param  string|null  $voice  Optional voice identifier to use for the call.
     * @param  array  $options  Additional optional parameters (e.g. wait_for_greeting, record, etc.).
     * @return array The API response containing call details (including call_id).
     */
    public function makeCall(string $phoneNumber, string $task, ?string $voice = null, array $options = []): array
    {
        $data = array_merge([
            'phone_number' => $phoneNumber,
            'task' => $task,
        ], $options);

        if ($voice !== null) {
            $data['voice'] = $voice;
        }

        return $this->request('POST', '/calls', $data);
    }

    /**
     * Retrieve details for a specific call.
     *
     * @param  string  $callId  The unique identifier of the call.
     * @return array The call details including transcript, status, and metadata.
     */
    public function getCall(string $callId): array
    {
        return $this->request('GET', '/calls/' . urlencode($callId));
    }

    /**
     * List calls with optional filtering and pagination.
     *
     * @param  int  $limit  Maximum number of calls to return.
     * @param  int  $offset  Number of calls to skip for pagination.
     * @param  array  $filters  Optional query filters (e.g. status, date range).
     * @return array List of calls and pagination metadata.
     */
    public function listCalls(int $limit = 50, int $offset = 0, array $filters = []): array
    {
        $params = array_merge([
            'limit' => $limit,
            'offset' => $offset,
        ], $filters);

        return $this->request('GET', '/calls', $params);
    }

    /**
     * Analyze a completed call's transcript.
     *
     * @param  string  $callId  The unique identifier of the call to analyze.
     * @param  string|array  $prompt  Analysis prompt or structured query for the transcript.
     * @param  array  $options  Additional analysis options.
     * @return array The analysis results.
     */
    public function analyzeCall(string $callId, string|array $prompt, array $options = []): array
    {
        $data = array_merge([
            'prompt' => $prompt,
        ], $options);

        return $this->request('POST', '/calls/' . urlencode($callId) . '/analyze', $data);
    }

    /**
     * Get the current authenticated user's information.
     *
     * @return array User account details.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/calls');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path (relative to base URL).
     * @param  array  $data  Request payload or query parameters.
     * @return array The parsed JSON response body.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the BlandAI API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array  $data  Request payload or query parameters.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If the API key is missing, the connection fails, or the API returns an error.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('BlandAI API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("BlandAI API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("BlandAI API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be unavailable or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("BlandAI API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("BlandAI API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("BlandAI API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to BlandAI API: {$e->getMessage()}");
        }
    }
}
