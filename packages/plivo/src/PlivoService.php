<?php

namespace OpenCompany\Integrations\Plivo;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Plivo REST API.
 *
 * Handles authentication via HTTP Basic Auth (auth_id:auth_token), request/response
 * processing, error handling, and logging. All tool classes delegate to this service —
 * they never make HTTP calls directly.
 *
 * @see https://www.plivo.com/docs/sms/api/
 */
class PlivoService
{
    /**
     * Create a new PlivoService instance.
     *
     * @param  string  $authId  The Plivo auth ID (used in the base URL and Basic Auth).
     * @param  string  $authToken  The Plivo auth token (used in Basic Auth).
     */
    public function __construct(
        private string $authId = '',
        private string $authToken = '',
    ) {}

    /**
     * Check whether the Plivo integration is properly configured.
     *
     * Returns true when both auth_id and auth_token are present.
     */
    public function isConfigured(): bool
    {
        return !empty($this->authId) && !empty($this->authToken);
    }

    // --------------------------------------------------------------------------
    // Messages
    // --------------------------------------------------------------------------

    /**
     * List messages with optional filters and pagination.
     *
     * @param  array<string, mixed>  $params  Query parameters such as `limit`, `offset`, `message_direction`, `message_state`, etc.
     * @return array<string, mixed> The parsed JSON response containing messages.
     *
     * @see https://www.plivo.com/docs/sms/api/message#list-messages
     */
    public function listMessages(array $params = []): array
    {
        return $this->request('GET', '/Message/', $params);
    }

    /**
     * Send an SMS message.
     *
     * @param  array<string, mixed>  $data  Message payload: `src`, `dst`, `text`, `type`, etc.
     * @return array<string, mixed> The parsed JSON response containing the message UUID and details.
     *
     * @see https://www.plivo.com/docs/sms/api/message#send-a-message
     */
    public function sendMessage(array $data): array
    {
        return $this->request('POST', '/Message/', $data);
    }

    // --------------------------------------------------------------------------
    // Numbers
    // --------------------------------------------------------------------------

    /**
     * List phone numbers on the account.
     *
     * @param  array<string, mixed>  $params  Query parameters such as `limit`, `offset`, `number_type`, etc.
     * @return array<string, mixed> The parsed JSON response containing numbers.
     *
     * @see https://www.plivo.com/docs/numbers/api/number#list-numbers
     */
    public function listNumbers(array $params = []): array
    {
        return $this->request('GET', '/Number/', $params);
    }

    /**
     * Retrieve details of a specific phone number.
     *
     * @param  string  $number  The phone number to retrieve (e.g., "+14155552671").
     * @return array<string, mixed> The parsed JSON response containing number details.
     *
     * @see https://www.plivo.com/docs/numbers/api/number#get-a-number
     */
    public function getNumber(string $number): array
    {
        return $this->request('GET', '/Number/' . urlencode($number) . '/');
    }

    // --------------------------------------------------------------------------
    // Calls
    // --------------------------------------------------------------------------

    /**
     * List calls with optional filters and pagination.
     *
     * @param  array<string, mixed>  $params  Query parameters such as `limit`, `offset`, `call_direction`, `call_state`, etc.
     * @return array<string, mixed> The parsed JSON response containing calls.
     *
     * @see https://www.plivo.com/docs/voice/api/call#list-calls
     */
    public function listCalls(array $params = []): array
    {
        return $this->request('GET', '/Call/', $params);
    }

    /**
     * Retrieve details of a specific call by its UUID.
     *
     * @param  string  $callId  The unique call UUID.
     * @return array<string, mixed> The parsed JSON response containing call details.
     *
     * @see https://www.plivo.com/docs/voice/api/call#get-a-call
     */
    public function getCall(string $callId): array
    {
        return $this->request('GET', '/Call/' . $callId . '/');
    }

    // --------------------------------------------------------------------------
    // Applications
    // --------------------------------------------------------------------------

    /**
     * List Plivo applications.
     *
     * @param  array<string, mixed>  $params  Query parameters such as `limit`, `offset`, etc.
     * @return array<string, mixed> The parsed JSON response containing applications.
     *
     * @see https://www.plivo.com/docs/voice/api/application#list-applications
     */
    public function listApplications(array $params = []): array
    {
        return $this->request('GET', '/Application/', $params);
    }

    // --------------------------------------------------------------------------
    // HTTP layer
    // --------------------------------------------------------------------------

    /**
     * Make an authenticated API request and return parsed JSON.
     *
     * @param  string  $method  The HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  The API endpoint path (e.g., "/Message/").
     * @param  array<string, mixed>  $data  Request body (POST/PUT) or query parameters (GET).
     * @return array<string, mixed> The parsed JSON response body.
     *
     * @throws \RuntimeException When the API returns an error or the service is not configured.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Plivo API using Basic Auth.
     *
     * @param  string  $method  The HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  The API endpoint path.
     * @param  array<string, mixed>  $data  Request body or query parameters.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException When credentials are missing, the connection fails, or the API returns an error.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->authId || !$this->authToken) {
            throw new \RuntimeException('Plivo auth ID and auth token are not configured.');
        }

        $url = "https://api.plivo.com/v1/Account/{$this->authId}" . $path;

        try {
            $http = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->withBasicAuth($this->authId, $this->authToken)
              ->timeout(30);

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
                    Log::warning("Plivo API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Plivo API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be unavailable or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Plivo API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Plivo API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Plivo API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Plivo API: {$e->getMessage()}");
        }
    }
}
