<?php

namespace OpenCompany\Integrations\MicrosoftOutlook;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * OutlookService — thin HTTP client for the Microsoft Graph API v1.0.
 *
 * Handles Bearer-token authentication, request/response lifecycle, and
 * error reporting. All public methods map 1-to-1 to a Graph endpoint.
 */
class OutlookService
{
    /**
     * Create a new OutlookService instance.
     *
     * @param  string  $accessToken  OAuth2 access token for Microsoft Graph.
     * @param  string  $baseUrl      Microsoft Graph base URL (configurable for testing / sovereign clouds).
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://graph.microsoft.com/v1.0',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Whether the service has an access token configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    // ─── Mail ──────────────────────────────────────────────────────────

    /**
     * List messages in the signed-in user's mailbox.
     *
     * @param  array<string, mixed>  $params  Query parameters ($top, $filter, $select, $orderby, etc.).
     * @return array<string, mixed>
     */
    public function listMessages(array $params = []): array
    {
        return $this->request('GET', '/me/messages', $params);
    }

    /**
     * Get a single message by its id.
     *
     * @param  string  $id  The message's unique id.
     * @param  array<string, mixed>  $params  Optional query parameters ($select, etc.).
     * @return array<string, mixed>
     */
    public function getMessage(string $id, array $params = []): array
    {
        return $this->request('GET', '/me/messages/' . rawurlencode($id), $params);
    }

    /**
     * Send an email message via the /sendMail endpoint.
     *
     * @param  array<string, mixed>  $payload  The message payload (to, subject, body, etc.).
     * @return array<string, mixed>  Empty array on success (Graph returns 202 with no body).
     */
    public function sendMessage(array $payload): array
    {
        $this->rawRequest('POST', '/me/sendMail', $payload);

        return [];
    }

    // ─── Calendar ──────────────────────────────────────────────────────

    /**
     * List the signed-in user's calendars.
     *
     * @param  array<string, mixed>  $params  Query parameters ($top, $select, etc.).
     * @return array<string, mixed>
     */
    public function listCalendars(array $params = []): array
    {
        return $this->request('GET', '/me/calendars', $params);
    }

    /**
     * List events on the default calendar.
     *
     * @param  array<string, mixed>  $params  Query parameters ($top, $filter, $select, $orderby, etc.).
     * @return array<string, mixed>
     */
    public function listEvents(array $params = []): array
    {
        return $this->request('GET', '/me/calendar/events', $params);
    }

    /**
     * Create a new event on the default calendar.
     *
     * @param  array<string, mixed>  $payload  The event payload (subject, start, end, body, attendees, etc.).
     * @return array<string, mixed>
     */
    public function createEvent(array $payload): array
    {
        return $this->request('POST', '/me/calendar/events', $payload);
    }

    // ─── User ──────────────────────────────────────────────────────────

    /**
     * Get the signed-in user's profile (displayName, mail, id, etc.).
     *
     * @param  array<string, mixed>  $params  Query parameters ($select, etc.).
     * @return array<string, mixed>
     */
    public function getCurrentUser(array $params = []): array
    {
        return $this->request('GET', '/me', $params);
    }

    // ─── Internals ─────────────────────────────────────────────────────

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, PATCH, DELETE).
     * @param  string  $path    Relative path (e.g. /me/messages).
     * @param  array<string, mixed>  $data  Query params (GET) or body (POST/PUT/PATCH).
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        if ($response->status() === 204 || $response->status() === 202) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Microsoft Graph API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    Relative path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException  On missing token, connection failure, or API error.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Microsoft Outlook access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
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
                $json = $response->json();
                $error = $json['error']['message'] ?? $response->body();

                Log::error("Microsoft Graph API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error'  => $error,
                ]);

                throw new \RuntimeException(
                    "Microsoft Graph API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error))
                );
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Microsoft Graph API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Microsoft Graph API: {$e->getMessage()}");
        }
    }
}
