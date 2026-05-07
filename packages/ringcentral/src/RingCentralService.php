<?php

namespace OpenCompany\Integrations\RingCentral;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

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
        return $this->request('GET', '/restapi/v1.0/account/~/extension/~/message-store/' . rawurlencode($messageId));
    }

    /**
     * Update a message record, commonly to change read status.
     *
     * @param  string  $messageId  Message record ID.
     * @param  array<string, mixed>  $payload  Message update payload.
     * @return array<string, mixed>
     */
    public function updateMessage(string $messageId, array $payload): array
    {
        return $this->request('PUT', '/restapi/v1.0/account/~/extension/~/message-store/' . rawurlencode($messageId), $payload);
    }

    /**
     * Delete a message from the authenticated extension's message store.
     *
     * @param  string  $messageId  Message record ID.
     * @return array<string, mixed>
     */
    public function deleteMessage(string $messageId): array
    {
        return $this->request('DELETE', '/restapi/v1.0/account/~/extension/~/message-store/' . rawurlencode($messageId));
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
     * List account-level call log records.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listAccountCalls(array $params = []): array
    {
        return $this->request('GET', '/restapi/v1.0/account/~/call-log', $params);
    }

    /**
     * Get a single call log record for the authenticated extension.
     *
     * @param  string  $callId  Call log record ID.
     * @return array<string, mixed>
     */
    public function getCall(string $callId): array
    {
        return $this->request('GET', '/restapi/v1.0/account/~/extension/~/call-log/' . rawurlencode($callId));
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
     * Get one personal address book contact.
     *
     * @param  string  $contactId  Contact ID.
     * @return array<string, mixed>
     */
    public function getContact(string $contactId): array
    {
        return $this->request('GET', '/restapi/v1.0/account/~/extension/~/address-book/contact/' . rawurlencode($contactId));
    }

    /**
     * Create a personal address book contact.
     *
     * @param  array<string, mixed>  $payload  Contact payload.
     * @return array<string, mixed>
     */
    public function createContact(array $payload): array
    {
        return $this->request('POST', '/restapi/v1.0/account/~/extension/~/address-book/contact', $payload);
    }

    /**
     * Update a personal address book contact.
     *
     * @param  string  $contactId  Contact ID.
     * @param  array<string, mixed>  $payload  Contact payload.
     * @return array<string, mixed>
     */
    public function updateContact(string $contactId, array $payload): array
    {
        return $this->request('PUT', '/restapi/v1.0/account/~/extension/~/address-book/contact/' . rawurlencode($contactId), $payload);
    }

    /**
     * Delete a personal address book contact.
     *
     * @param  string  $contactId  Contact ID.
     * @return array<string, mixed>
     */
    public function deleteContact(string $contactId): array
    {
        return $this->request('DELETE', '/restapi/v1.0/account/~/extension/~/address-book/contact/' . rawurlencode($contactId));
    }

    /**
     * Get account metadata for the authenticated token.
     *
     * @return array<string, mixed>
     */
    public function getAccount(): array
    {
        return $this->request('GET', '/restapi/v1.0/account/~');
    }

    /**
     * List extensions in the authenticated account.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listExtensions(array $params = []): array
    {
        return $this->request('GET', '/restapi/v1.0/account/~/extension', $params);
    }

    /**
     * Get one extension by ID.
     *
     * @param  string  $extensionId  Extension ID.
     * @return array<string, mixed>
     */
    public function getExtension(string $extensionId): array
    {
        return $this->request('GET', '/restapi/v1.0/account/~/extension/' . rawurlencode($extensionId));
    }

    /**
     * List account phone numbers.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listAccountPhoneNumbers(array $params = []): array
    {
        return $this->request('GET', '/restapi/v1.0/account/~/phone-number', $params);
    }

    /**
     * List phone numbers assigned to the authenticated extension.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listExtensionPhoneNumbers(array $params = []): array
    {
        return $this->request('GET', '/restapi/v1.0/account/~/extension/~/phone-number', $params);
    }

    /**
     * Get presence for the authenticated extension.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function getPresence(array $params = []): array
    {
        return $this->request('GET', '/restapi/v1.0/account/~/extension/~/presence', $params);
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
     * Send a GET request to a relative RingCentral API path.
     *
     * @param  string  $path  Relative RingCentral API path.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $params = []): array
    {
        return $this->request('GET', $this->normalizePath($path), $params);
    }

    /**
     * Send a POST request to a relative RingCentral API path.
     *
     * @param  string  $path  Relative RingCentral API path.
     * @param  array<string, mixed>  $payload  JSON body.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $payload = []): array
    {
        return $this->request('POST', $this->normalizePath($path), $payload);
    }

    /**
     * Send a PUT request to a relative RingCentral API path.
     *
     * @param  string  $path  Relative RingCentral API path.
     * @param  array<string, mixed>  $payload  JSON body.
     * @return array<string, mixed>
     */
    public function apiPut(string $path, array $payload = []): array
    {
        return $this->request('PUT', $this->normalizePath($path), $payload);
    }

    /**
     * Send a DELETE request to a relative RingCentral API path.
     *
     * @param  string  $path  Relative RingCentral API path.
     * @param  array<string, mixed>  $payload  Optional JSON body.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $payload = []): array
    {
        return $this->request('DELETE', $this->normalizePath($path), $payload);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  The HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    The API endpoint path.
     * @param  array<string, mixed>  $data    Query parameters or request body.
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
     * Make a raw HTTP request to the RingCentral REST API.
     *
     * @param  string  $method  The HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    The API endpoint path.
     * @param  array<string, mixed>  $data    Query parameters or request body.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If the access token is missing.
     * @throws \RuntimeException If the API returns a non-successful response.
     * @throws \RuntimeException If the connection to the API fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new RuntimeException('RingCentral access token is not configured.');
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
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains((string) $contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("RingCentral API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new RuntimeException("RingCentral API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the service may be unavailable.");
                }

                $error = $response->json('message') ?? $response->json('error') ?? $body;
                Log::error("RingCentral API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new RuntimeException("RingCentral API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("RingCentral API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new RuntimeException("Failed to connect to RingCentral API: {$e->getMessage()}");
        }
    }

    /**
     * Normalize and validate caller-supplied relative API paths.
     */
    private function normalizePath(string $path): string
    {
        $path = trim($path);

        if ($path === '' || str_contains($path, '://') || str_starts_with($path, '//')) {
            throw new RuntimeException('RingCentral API path must be relative, such as /restapi/v1.0/account/~.');
        }

        return str_starts_with($path, '/') ? $path : '/'.$path;
    }
}
