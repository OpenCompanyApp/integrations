<?php

namespace OpenCompany\Integrations\Telnyx;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Telnyx v2 REST API.
 *
 * Handles Bearer authentication, rate limiting, error logging, and response parsing.
 * All tool classes delegate to this service — they never make HTTP calls directly.
 */
class TelnyxService
{
    /**
     * @param  string  $apiKey  Telnyx API key (Bearer token)
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.telnyx.com/v2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    // ─── Phone Numbers ──────────────────────────────────────────────

    /**
     * List phone numbers on the account.
     *
     * @param  array<string, mixed>  $params  Query parameters (page_size, page_number, etc.)
     * @return array<string, mixed>
     */
    public function listPhoneNumbers(array $params = []): array
    {
        return $this->request('GET', '/phone_numbers', $params);
    }

    /**
     * Get details for a single phone number.
     *
     * @return array<string, mixed>
     */
    public function getPhoneNumber(string $phoneNumberId): array
    {
        return $this->request('GET', '/phone_numbers/' . urlencode($phoneNumberId));
    }

    // ─── Messages ───────────────────────────────────────────────────

    /**
     * List messages (SMS/MMS) sent and received.
     *
     * @param  array<string, mixed>  $params  Query parameters (page_size, page_number, direction, etc.)
     * @return array<string, mixed>
     */
    public function listMessages(array $params = []): array
    {
        return $this->request('GET', '/messages', $params);
    }

    /**
     * Send an SMS or MMS message.
     *
     * @param  array<string, mixed>  $payload  Message payload (from, to, text, etc.)
     * @return array<string, mixed>
     */
    public function sendSms(array $payload): array
    {
        return $this->request('POST', '/messages', $payload);
    }

    // ─── Calls ──────────────────────────────────────────────────────

    /**
     * List calls made on the account.
     *
     * @param  array<string, mixed>  $params  Query parameters (page_size, page_number, etc.)
     * @return array<string, mixed>
     */
    public function listCalls(array $params = []): array
    {
        return $this->request('GET', '/calls', $params);
    }

    /**
     * Get details for a single call.
     *
     * @return array<string, mixed>
     */
    public function getCall(string $callSessionId): array
    {
        return $this->request('GET', '/calls/' . urlencode($callSessionId));
    }

    // ─── Call Recordings ────────────────────────────────────────────

    /**
     * List call recordings for the account.
     *
     * @param  array<string, mixed>  $params  Query parameters (page_size, page_number, etc.)
     * @return array<string, mixed>
     */
    public function listCallRecords(array $params = []): array
    {
        return $this->request('GET', '/recordings', $params);
    }

    // ─── HTTP Layer ─────────────────────────────────────────────────

    /**
     * Make an API request and return parsed JSON.
     *
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Telnyx API.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Telnyx API key is not configured.');
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
                $error = $response->json('errors.0.detail') ?? $response->json('message') ?? $response->body();

                Log::error("Telnyx API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Telnyx API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Telnyx API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new \RuntimeException("Failed to connect to Telnyx API: {$e->getMessage()}");
        }
    }
}
