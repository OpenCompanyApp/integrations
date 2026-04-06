<?php

namespace OpenCompany\Integrations\Dialpad;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Dialpad API service for managing calls, SMS messages, and users.
 *
 * Handles authentication via Bearer token and provides methods for all
 * Dialpad API endpoints used by the integration tools.
 */
class DialpadService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://dialpad.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List call history records.
     *
     * @param  int|null  $startTime  Unix timestamp for the start of the date range.
     * @param  int|null  $endTime    Unix timestamp for the end of the date range.
     * @param  int       $limit      Maximum number of records to return (default: 50).
     * @param  string|null  $cursor  Pagination cursor from a previous response.
     * @return array<string, mixed>
     */
    public function listCalls(?int $startTime = null, ?int $endTime = null, int $limit = 50, ?string $cursor = null): array
    {
        $params = ['limit' => $limit];

        if ($startTime !== null) {
            $params['startTime'] = $startTime;
        }
        if ($endTime !== null) {
            $params['endTime'] = $endTime;
        }
        if ($cursor !== null) {
            $params['cursor'] = $cursor;
        }

        return $this->request('GET', '/v1/call-history', $params);
    }

    /**
     * Get a single call record by ID.
     *
     * @param  string  $id  The call history record ID.
     * @return array<string, mixed>
     */
    public function getCall(string $id): array
    {
        return $this->request('GET', '/v1/call-history/' . urlencode($id));
    }

    /**
     * List SMS messages.
     *
     * @param  int|null  $startTime  Unix timestamp for the start of the date range.
     * @param  int|null  $endTime    Unix timestamp for the end of the date range.
     * @param  int       $limit      Maximum number of records to return (default: 50).
     * @param  string|null  $cursor  Pagination cursor from a previous response.
     * @return array<string, mixed>
     */
    public function listSms(?int $startTime = null, ?int $endTime = null, int $limit = 50, ?string $cursor = null): array
    {
        $params = ['limit' => $limit];

        if ($startTime !== null) {
            $params['startTime'] = $startTime;
        }
        if ($endTime !== null) {
            $params['endTime'] = $endTime;
        }
        if ($cursor !== null) {
            $params['cursor'] = $cursor;
        }

        return $this->request('GET', '/v1/sms', $params);
    }

    /**
     * Send an SMS message.
     *
     * @param  string  $to    The recipient phone number (E.164 format).
     * @param  string  $from  The sender phone number or department ID (E.164 format).
     * @param  string  $text  The message body.
     * @return array<string, mixed>
     */
    public function sendSms(string $to, string $from, string $text): array
    {
        return $this->request('POST', '/v1/sms', [
            'to' => $to,
            'from' => $from,
            'text' => $text,
        ]);
    }

    /**
     * List users in the Dialpad organization.
     *
     * @param  int          $limit   Maximum number of users to return (default: 50).
     * @param  string|null  $cursor  Pagination cursor from a previous response.
     * @return array<string, mixed>
     */
    public function listUsers(int $limit = 50, ?string $cursor = null): array
    {
        $params = ['limit' => $limit];

        if ($cursor !== null) {
            $params['cursor'] = $cursor;
        }

        return $this->request('GET', '/v1/users', $params);
    }

    /**
     * Get a single user by ID.
     *
     * @param  string  $id  The user ID.
     * @return array<string, mixed>
     */
    public function getUser(string $id): array
    {
        return $this->request('GET', '/v1/users/' . urlencode($id));
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/v1/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API endpoint path (e.g., "/v1/users").
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Dialpad API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    API endpoint path.
     * @param  array<string, mixed>  $data  Request data.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException If the access token is missing or the API returns an error.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Dialpad access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
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
                    Log::warning("Dialpad API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Dialpad API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Dialpad API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Dialpad API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Dialpad API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Dialpad API: {$e->getMessage()}");
        }
    }
}
