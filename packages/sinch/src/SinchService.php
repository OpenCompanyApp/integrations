<?php

namespace OpenCompany\Integrations\Sinch;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Sinch SMS API.
 *
 * Wraps HTTP calls to Sinch's xms/v1 endpoints for SMS messaging,
 * phone number management, groups, and batch operations using
 * Bearer token authentication.
 */
class SinchService
{
    private const BASE_URL = 'https://us.sms.api.sinch.com/xms/v1';

    /**
     * @param  string  $servicePlanId  Sinch Service Plan ID
     * @param  string  $apiToken       Sinch API token (Bearer token)
     */
    public function __construct(
        private string $servicePlanId = '',
        private string $apiToken = '',
    ) {}

    /**
     * Check whether the service has credentials configured.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->servicePlanId) && ! empty($this->apiToken);
    }

    // ── Messages ─────────────────────────────────────────────

    /**
     * List inbound/outbound messages with optional filtering.
     *
     * @param  array<string, mixed>  $params  Query parameters (direction, to, from, start_date, end_date, page, page_size)
     * @return array<string, mixed>
     */
    public function listMessages(array $params = []): array
    {
        return $this->request('GET', '/messages', $params);
    }

    /**
     * Send an SMS message to one or more recipients.
     *
     * @param  array<string, mixed>  $data  Message payload (to, from, body)
     * @return array<string, mixed>
     */
    public function sendSms(array $data): array
    {
        return $this->request('POST', '/messages', $data);
    }

    // ── Phone Numbers ────────────────────────────────────────

    /**
     * List rented phone numbers.
     *
     * @param  array<string, mixed>  $params  Query parameters (page, page_size)
     * @return array<string, mixed>
     */
    public function listPhoneNumbers(array $params = []): array
    {
        return $this->request('GET', '/numbers', $params);
    }

    /**
     * Get details for a specific phone number.
     *
     * @param  string  $phoneNumber  The phone number to retrieve
     * @return array<string, mixed>
     */
    public function getPhoneNumber(string $phoneNumber): array
    {
        return $this->request('GET', '/numbers/' . urlencode($phoneNumber));
    }

    // ── Groups ───────────────────────────────────────────────

    /**
     * List all groups.
     *
     * @param  array<string, mixed>  $params  Query parameters (page, page_size)
     * @return array<string, mixed>
     */
    public function listGroups(array $params = []): array
    {
        return $this->request('GET', '/groups', $params);
    }

    /**
     * Get details for a specific group.
     *
     * @param  string  $groupId  The group ID to retrieve
     * @return array<string, mixed>
     */
    public function getGroup(string $groupId): array
    {
        return $this->request('GET', '/groups/' . urlencode($groupId));
    }

    // ── Batches ──────────────────────────────────────────────

    /**
     * List all message batches.
     *
     * @param  array<string, mixed>  $params  Query parameters (page, page_size)
     * @return array<string, mixed>
     */
    public function listBatches(array $params = []): array
    {
        return $this->request('GET', '/batches', $params);
    }

    // ── HTTP ─────────────────────────────────────────────────

    /**
     * Make an authenticated API request to Sinch.
     *
     * @param  string               $method  HTTP method (GET, POST)
     * @param  string               $path    API endpoint path (e.g. '/messages')
     * @param  array<string, mixed> $data    Query params (GET) or JSON body (POST)
     * @return array<string, mixed>
     *
     * @throws \RuntimeException If credentials are missing or the request fails.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->isConfigured()) {
            throw new \RuntimeException('Sinch credentials are not configured.');
        }

        $url = self::BASE_URL . '/' . $this->servicePlanId . $path;

        try {
            $http = Http::withToken($this->apiToken)
                ->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if ($response->failed()) {
                $body = $response->json() ?? [];
                $message = $body['message'] ?? $response->body();

                Log::error('Sinch API error', [
                    'method' => $method,
                    'path' => $path,
                    'status' => $response->status(),
                    'body' => $body,
                ]);

                throw new \RuntimeException("Sinch API error ({$response->status()}): {$message}");
            }

            return $response->json() ?? [];
        } catch (ConnectionException $e) {
            Log::error('Sinch connection error', [
                'method' => $method,
                'path' => $path,
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Sinch connection error: {$e->getMessage()}");
        }
    }
}
