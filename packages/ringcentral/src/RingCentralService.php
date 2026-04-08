<?php

namespace OpenCompany\Integrations\RingCentral;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * RingCentral API service for communicating with the RingCentral REST API.
 *
 * Handles authentication via Bearer token and provides methods for
 * messages, SMS, call logs, contacts, and current user information.
 */
class RingCentralService
{
    /**
     * Create a new RingCentral service instance.
     *
     * @param  string  $accessToken  The OAuth access token for API authentication.
     * @param  string  $baseUrl      The RingCentral API base URL (defaults to https://platform.ringcentral.com).
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://platform.ringcentral.com',
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
     * List messages from the authenticated extension's message store.
     *
     * @param  array  $params  Query parameters (e.g., messageType, dateFrom, dateTo, perPage, page).
     * @return array The parsed JSON response containing messages.
     */
    public function listMessages(array $params = []): array
    {
        return $this->request('GET', '/restapi/v1.0/account/~/extension/~/message-store', $params);
    }

    /**
     * Get a single message by its ID.
     *
     * @param  string  $messageId  The message record ID.
     * @return array The parsed JSON response for the message.
     */
    public function getMessage(string $messageId): array
    {
        return $this->request('GET', '/restapi/v1.0/account/~/extension/~/message-store/' . urlencode($messageId));
    }

    /**
     * Send an SMS message from the authenticated extension.
     *
     * @param  string  $from  The phone number to send from (must be a RingCentral number).
     * @param  string  $to    The destination phone number.
     * @param  string  $text  The SMS message body.
     * @return array The parsed JSON response for the sent message.
     */
    public function sendSms(string $from, string $to, string $text): array
    {
        return $this->request('POST', '/restapi/v1.0/account/~/extension/~/sms', [
            'from' => ['phoneNumber' => $from],
            'to' => [['phoneNumber' => $to]],
            'text' => $text,
        ]);
    }

    /**
     * List call log records for the authenticated extension.
     *
     * @param  array  $params  Query parameters (e.g., dateFrom, dateTo, perPage, page, direction, type).
     * @return array The parsed JSON response containing call records.
     */
    public function listCalls(array $params = []): array
    {
        return $this->request('GET', '/restapi/v1.0/account/~/extension/~/call-log', $params);
    }

    /**
     * List contacts from the authenticated extension's personal address book.
     *
     * @param  array  $params  Query parameters (e.g., perPage, page, startsWith).
     * @return array The parsed JSON response containing contacts.
     */
    public function listContacts(array $params = []): array
    {
        return $this->request('GET', '/restapi/v1.0/account/~/extension/~/address-book/contact', $params);
    }

    /**
     * Get the current authenticated user's extension information.
     *
     * @return array The parsed JSON response for the extension.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/restapi/v1.0/account/~/extension/~');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  The HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    The API endpoint path.
     * @param  array   $data    Query parameters or request body.
     * @return array The parsed JSON response.
     *
     * @throws \RuntimeException If the access token is missing or the request fails.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the RingCentral REST API.
     *
     * @param  string  $method  The HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    The API endpoint path.
     * @param  array   $data    Query parameters or request body.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If the access token is missing.
     * @throws \RuntimeException If the API returns a non-successful response.
     * @throws \RuntimeException If the connection to the API fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('RingCentral access token is not configured.');
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
                    Log::warning("RingCentral API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("RingCentral API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the service may be unavailable.");
                }

                $error = $response->json('message') ?? $response->json('error') ?? $body;
                Log::error("RingCentral API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("RingCentral API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("RingCentral API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to RingCentral API: {$e->getMessage()}");
        }
    }
}
