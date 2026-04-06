<?php

namespace OpenCompany\Integrations\Mailtrap;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Mailtrap API v3.
 *
 * Communicates with {@link https://mailtrap.io/api/v3} using
 * Bearer-token authentication.
 */
class MailtrapService
{
    private string $baseUrl;

    public function __construct(
        private string $apiToken = '',
        string $baseUrl = 'https://mailtrap.io/api/v3',
    ) {
        $this->baseUrl = rtrim($baseUrl, '/');
    }

    /**
     * Determine whether the service has enough configuration to make requests.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiToken);
    }

    /**
     * List all inboxes in the account.
     *
     * @param  array  $params  Query parameters (page, per_page, etc.)
     * @return array Decoded JSON response
     */
    public function listInboxes(array $params = []): array
    {
        return $this->request('GET', '/inboxes', $params);
    }

    /**
     * Get a single inbox by ID.
     *
     * @param  int|string  $inboxId  The inbox ID
     * @return array Decoded JSON response
     */
    public function getInbox(int|string $inboxId): array
    {
        return $this->request('GET', '/inboxes/' . urlencode((string) $inboxId));
    }

    /**
     * List messages in an inbox.
     *
     * @param  int|string  $inboxId  The inbox ID
     * @param  array  $params  Query parameters (page, per_page, search, etc.)
     * @return array Decoded JSON response
     */
    public function listMessages(int|string $inboxId, array $params = []): array
    {
        return $this->request('GET', '/inboxes/' . urlencode((string) $inboxId) . '/messages', $params);
    }

    /**
     * Get a single message by ID.
     *
     * @param  int|string  $inboxId   The inbox ID
     * @param  int|string  $messageId The message ID
     * @return array Decoded JSON response
     */
    public function getMessage(int|string $inboxId, int|string $messageId): array
    {
        return $this->request('GET', '/inboxes/' . urlencode((string) $inboxId) . '/messages/' . urlencode((string) $messageId));
    }

    /**
     * Send a test email through Mailtrap.
     *
     * @param  array  $data  Email payload (from, to, subject, text, html, etc.)
     * @return array Decoded JSON response
     */
    public function sendTestEmail(array $data): array
    {
        return $this->request('POST', '/send', $data);
    }

    /**
     * List suppressions for an inbox.
     *
     * @param  int|string  $inboxId  The inbox ID
     * @param  array  $params  Query parameters (page, per_page, etc.)
     * @return array Decoded JSON response
     */
    public function listSuppressions(int|string $inboxId, array $params = []): array
    {
        return $this->request('GET', '/inboxes/' . urlencode((string) $inboxId) . '/suppressions', $params);
    }

    /**
     * Get the current user's account information.
     *
     * @return array Decoded JSON response
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method
     * @param  string  $path    API path
     * @param  array   $data    Query params (GET) or JSON body (POST)
     * @return array Decoded JSON response
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        if ($response->status() === 204) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Execute a raw HTTP request against the Mailtrap API.
     *
     * @param  string  $method  HTTP method
     * @param  string  $path    API path
     * @param  array   $data    Query params or JSON body
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException On configuration, connection, or API errors
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->isConfigured()) {
            throw new \RuntimeException('Mailtrap API token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiToken,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET'    => $http->get($url, $data),
                'POST'   => $http->post($url, $data),
                'PUT'    => $http->put($url, $data),
                'PATCH'  => $http->patch($url, $data),
                'DELETE' => $http->delete($url, $data),
                default  => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('error') ?? $response->json('message') ?? $response->body();
                Log::error("Mailtrap API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error'  => $error,
                ]);
                throw new \RuntimeException(
                    "Mailtrap API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error))
                );
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Mailtrap API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Mailtrap API: {$e->getMessage()}");
        }
    }
}
