<?php

namespace OpenCompany\Integrations\MessageBird;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the MessageBird REST API.
 *
 * Handles AccessKey authentication, JSON request dispatch, and normalized errors
 * for SMS, voice messages, contacts, groups, lookup, verify, balance, and numbers.
 */
class MessageBirdService
{
    /**
     * @param  string  $apiKey  MessageBird API access key
     * @param  string  $baseUrl  MessageBird REST API base URL
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://rest.messagebird.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    /**
     * Send an SMS message.
     *
     * @param  string  $originator  Sender name or phone number
     * @param  array<int, string>  $recipients  Recipient phone numbers or contact IDs
     * @param  string  $body  Message body
     * @param  array<string, mixed>  $options  Optional SMS parameters
     * @return array<string, mixed>
     */
    public function sendSms(string $originator, array $recipients, string $body, array $options = []): array
    {
        return $this->request('POST', '/messages', array_merge($options, [
            'originator' => $originator,
            'recipients' => array_values($recipients),
            'body' => $body,
        ]));
    }

    /**
     * List SMS messages.
     *
     * @param  array<string, mixed>  $params  Query filters such as limit, offset, originator, recipient, status, direction, contact_id
     * @return array<string, mixed>
     */
    public function listMessages(array $params = []): array
    {
        return $this->request('GET', '/messages', $params);
    }

    /**
     * Get an SMS message.
     *
     * @param  string  $id  Message ID
     * @return array<string, mixed>
     */
    public function getMessage(string $id): array
    {
        return $this->request('GET', '/messages/' . rawurlencode($id));
    }

    /**
     * Delete a scheduled SMS message.
     *
     * @param  string  $id  Message ID
     * @return array<string, mixed>
     */
    public function deleteMessage(string $id): array
    {
        return $this->request('DELETE', '/messages/' . rawurlencode($id));
    }

    /**
     * Send a voice message.
     *
     * @param  string  $originator  Sender phone number
     * @param  array<int, string>  $recipients  Recipient phone numbers or contact IDs
     * @param  string  $body  Voice message text
     * @param  array<string, mixed>  $options  Optional voice message parameters
     * @return array<string, mixed>
     */
    public function sendVoiceMessage(string $originator, array $recipients, string $body, array $options = []): array
    {
        return $this->request('POST', '/voicemessages', array_merge($options, [
            'originator' => $originator,
            'recipients' => array_values($recipients),
            'body' => $body,
        ]));
    }

    /**
     * List voice messages.
     *
     * @param  array<string, mixed>  $params  Query filters such as limit, offset, originator, recipient, status, contact_id
     * @return array<string, mixed>
     */
    public function listVoiceMessages(array $params = []): array
    {
        return $this->request('GET', '/voicemessages', $params);
    }

    /**
     * Get a voice message.
     *
     * @param  string  $id  Voice message ID
     * @return array<string, mixed>
     */
    public function getVoiceMessage(string $id): array
    {
        return $this->request('GET', '/voicemessages/' . rawurlencode($id));
    }

    /**
     * Delete a scheduled voice message.
     *
     * @param  string  $id  Voice message ID
     * @return array<string, mixed>
     */
    public function deleteVoiceMessage(string $id): array
    {
        return $this->request('DELETE', '/voicemessages/' . rawurlencode($id));
    }

    /**
     * List contacts.
     *
     * @param  array<string, mixed>  $params  Query parameters such as limit and offset
     * @return array<string, mixed>
     */
    public function listContacts(array $params = []): array
    {
        return $this->request('GET', '/contacts', $params);
    }

    /**
     * Create a contact.
     *
     * @param  array<string, mixed>  $contact  Contact payload
     * @return array<string, mixed>
     */
    public function createContact(array $contact): array
    {
        return $this->request('POST', '/contacts', $contact);
    }

    /**
     * Get a contact.
     *
     * @param  string  $id  Contact ID
     * @return array<string, mixed>
     */
    public function getContact(string $id): array
    {
        return $this->request('GET', '/contacts/' . rawurlencode($id));
    }

    /**
     * Update a contact.
     *
     * @param  string  $id  Contact ID
     * @param  array<string, mixed>  $contact  Contact fields
     * @return array<string, mixed>
     */
    public function updateContact(string $id, array $contact): array
    {
        return $this->request('PATCH', '/contacts/' . rawurlencode($id), $contact);
    }

    /**
     * Delete a contact.
     *
     * @param  string  $id  Contact ID
     * @return array<string, mixed>
     */
    public function deleteContact(string $id): array
    {
        return $this->request('DELETE', '/contacts/' . rawurlencode($id));
    }

    /**
     * List groups for a contact.
     *
     * @param  string  $id  Contact ID
     * @return array<string, mixed>
     */
    public function listContactGroups(string $id): array
    {
        return $this->request('GET', '/contacts/' . rawurlencode($id) . '/groups');
    }

    /**
     * List messages for a contact.
     *
     * @param  string  $id  Contact ID
     * @param  array<string, mixed>  $params  Query parameters
     * @return array<string, mixed>
     */
    public function listContactMessages(string $id, array $params = []): array
    {
        return $this->request('GET', '/contacts/' . rawurlencode($id) . '/messages', $params);
    }

    /**
     * List groups.
     *
     * @param  array<string, mixed>  $params  Query parameters such as limit and offset
     * @return array<string, mixed>
     */
    public function listGroups(array $params = []): array
    {
        return $this->request('GET', '/groups', $params);
    }

    /**
     * Create a group.
     *
     * @param  string  $name  Group name
     * @return array<string, mixed>
     */
    public function createGroup(string $name): array
    {
        return $this->request('POST', '/groups', ['name' => $name]);
    }

    /**
     * Get a group.
     *
     * @param  string  $id  Group ID
     * @return array<string, mixed>
     */
    public function getGroup(string $id): array
    {
        return $this->request('GET', '/groups/' . rawurlencode($id));
    }

    /**
     * Update a group.
     *
     * @param  string  $id  Group ID
     * @param  string  $name  New group name
     * @return array<string, mixed>
     */
    public function updateGroup(string $id, string $name): array
    {
        return $this->request('PATCH', '/groups/' . rawurlencode($id), ['name' => $name]);
    }

    /**
     * Delete a group.
     *
     * @param  string  $id  Group ID
     * @return array<string, mixed>
     */
    public function deleteGroup(string $id): array
    {
        return $this->request('DELETE', '/groups/' . rawurlencode($id));
    }

    /**
     * List contacts in a group.
     *
     * @param  string  $id  Group ID
     * @param  array<string, mixed>  $params  Query parameters
     * @return array<string, mixed>
     */
    public function listGroupContacts(string $id, array $params = []): array
    {
        return $this->request('GET', '/groups/' . rawurlencode($id) . '/contacts', $params);
    }

    /**
     * Add a contact to a group.
     *
     * @param  string  $groupId  Group ID
     * @param  string  $contactId  Contact ID
     * @return array<string, mixed>
     */
    public function addContactToGroup(string $groupId, string $contactId): array
    {
        return $this->request('PUT', '/groups/' . rawurlencode($groupId) . '/contacts/' . rawurlencode($contactId));
    }

    /**
     * Remove a contact from a group.
     *
     * @param  string  $groupId  Group ID
     * @param  string  $contactId  Contact ID
     * @return array<string, mixed>
     */
    public function removeContactFromGroup(string $groupId, string $contactId): array
    {
        return $this->request('DELETE', '/groups/' . rawurlencode($groupId) . '/contacts/' . rawurlencode($contactId));
    }

    /**
     * Look up a phone number.
     *
     * @param  string  $phoneNumber  Phone number
     * @param  string|null  $countryCode  Optional ISO country code for national format numbers
     * @return array<string, mixed>
     */
    public function lookupPhoneNumber(string $phoneNumber, ?string $countryCode = null): array
    {
        return $this->request('GET', '/lookup/' . rawurlencode($phoneNumber), array_filter([
            'countryCode' => $countryCode,
        ], static fn (mixed $value): bool => $value !== null));
    }

    /**
     * Get an HLR lookup for a phone number.
     *
     * @param  string  $phoneNumber  Phone number
     * @return array<string, mixed>
     */
    public function getHlrLookup(string $phoneNumber): array
    {
        return $this->request('GET', '/lookup/' . rawurlencode($phoneNumber) . '/hlr');
    }

    /**
     * Request an HLR lookup for a phone number.
     *
     * @param  string  $phoneNumber  Phone number
     * @param  array<string, mixed>  $options  Optional HLR parameters
     * @return array<string, mixed>
     */
    public function requestHlrLookup(string $phoneNumber, array $options = []): array
    {
        return $this->request('POST', '/lookup/' . rawurlencode($phoneNumber) . '/hlr', $options);
    }

    /**
     * Create a verification.
     *
     * @param  string  $recipient  Phone number or email address
     * @param  array<string, mixed>  $options  Verify options
     * @return array<string, mixed>
     */
    public function createVerify(string $recipient, array $options = []): array
    {
        return $this->request('POST', '/verify', array_merge($options, ['recipient' => $recipient]));
    }

    /**
     * Get a verification.
     *
     * @param  string  $id  Verify ID
     * @return array<string, mixed>
     */
    public function getVerify(string $id): array
    {
        return $this->request('GET', '/verify/' . rawurlencode($id));
    }

    /**
     * Verify a token.
     *
     * @param  string  $id  Verify ID
     * @param  string  $token  Token sent to the recipient
     * @return array<string, mixed>
     */
    public function verifyToken(string $id, string $token): array
    {
        return $this->request('GET', '/verify/' . rawurlencode($id), ['token' => $token]);
    }

    /**
     * Delete a verification.
     *
     * @param  string  $id  Verify ID
     * @return array<string, mixed>
     */
    public function deleteVerify(string $id): array
    {
        return $this->request('DELETE', '/verify/' . rawurlencode($id));
    }

    /**
     * Get account balance.
     *
     * @return array<string, mixed>
     */
    public function listBalance(): array
    {
        return $this->request('GET', '/balance');
    }

    /**
     * List purchased phone numbers.
     *
     * @param  array<string, mixed>  $params  Query parameters
     * @return array<string, mixed>
     */
    public function listNumbers(array $params = []): array
    {
        return $this->request('GET', '/numbers', $params);
    }

    /**
     * Get a purchased phone number.
     *
     * @param  string  $number  Phone number
     * @return array<string, mixed>
     */
    public function getNumber(string $number): array
    {
        return $this->request('GET', '/numbers/' . rawurlencode($number));
    }

    /**
     * Update a purchased phone number.
     *
     * @param  string  $number  Phone number
     * @param  array<string, mixed>  $settings  Number settings
     * @return array<string, mixed>
     */
    public function updateNumber(string $number, array $settings): array
    {
        return $this->request('PATCH', '/numbers/' . rawurlencode($number), $settings);
    }

    /**
     * Get account information represented by the balance endpoint.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->listBalance();
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method
     * @param  string  $path  API path
     * @param  array<string, mixed>  $data  Query parameters or JSON body
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        if ($response->status() === 204) {
            return [];
        }

        $json = $response->json();
        if (is_array($json)) {
            return $json;
        }

        return ['message' => trim($response->body())];
    }

    /**
     * Dispatch a raw MessageBird REST request.
     *
     * @param  string  $method  HTTP method
     * @param  string  $path  API path
     * @param  array<string, mixed>  $data  Query parameters or JSON body
     * @return Response
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if ($this->apiKey === '') {
            throw new RuntimeException('MessageBird API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'AccessKey ' . $this->apiKey,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'PATCH' => $http->patch($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $this->throwApiError($method, $path, $response);
            }

            return $response;
        } catch (ConnectionException $e) {
            Log::error("MessageBird API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new RuntimeException("Failed to connect to MessageBird API: {$e->getMessage()}");
        }
    }

    /**
     * Log and throw a normalized MessageBird API error.
     *
     * @throws RuntimeException
     */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $contentType = $response->header('Content-Type');
        $body = $response->body();

        if (str_contains($contentType ?? '', 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
            Log::warning("MessageBird API returned HTML for {$method} {$path}", [
                'status' => $response->status(),
            ]);

            throw new RuntimeException("MessageBird API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the service is unavailable.");
        }

        $error = $response->json('errors') ?? $response->json('error') ?? $body;
        $errorMessage = is_array($error)
            ? implode('; ', array_map(static fn (mixed $item): string => is_array($item) ? (string) ($item['description'] ?? json_encode($item)) : (string) $item, $error))
            : (is_string($error) ? $error : json_encode($error));

        Log::error("MessageBird API error: {$method} {$path}", [
            'status' => $response->status(),
            'error' => $error,
        ]);

        throw new RuntimeException("MessageBird API error ({$response->status()}): {$errorMessage}");
    }
}
