<?php

namespace OpenCompany\Integrations\ElasticEmail;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for Elastic Email REST API v4.
 *
 * Handles API-key authentication and request mapping for transactional email,
 * contacts, lists, templates, campaigns, events, suppressions, statistics, and
 * generic read/write endpoint access.
 */
class ElasticEmailService
{
    /**
     * @param  string  $apiKey  Elastic Email API key.
     * @param  string  $baseUrl  Base URL for Elastic Email REST API v4.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.elasticemail.com/v4',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return ! empty($this->apiKey);
    }

    /**
     * Send a transactional email.
     *
     * @param  string|array<int, string>  $to  Recipient email addresses.
     * @param  array<string, mixed>  $options  Additional v4 content/options fields.
     * @return array<string, mixed>
     */
    public function sendEmail(string|array $to, string $subject, string $body, array $options = []): array
    {
        $recipients = is_array($to) ? array_values($to) : array_values(array_filter(array_map('trim', preg_split('/[;,]/', $to) ?: [])));

        $payload = [
            'Recipients' => ['To' => $recipients],
            'Content' => [
                'Subject' => $subject,
                'Body' => [
                    ['ContentType' => 'HTML', 'Content' => $body],
                ],
            ],
        ];

        if (isset($options['from'])) {
            $payload['Content']['From'] = $options['from'];
        }
        if (isset($options['from_name'])) {
            $payload['Content']['FromName'] = $options['from_name'];
        }
        if (isset($options['reply_to'])) {
            $payload['Content']['ReplyTo'] = $options['reply_to'];
        }
        if (isset($options['cc'])) {
            $payload['Recipients']['CC'] = $this->emails($options['cc']);
        }
        if (isset($options['bcc'])) {
            $payload['Recipients']['BCC'] = $this->emails($options['bcc']);
        }

        return $this->request('POST', '/emails/transactional', array_replace_recursive($payload, $options['body'] ?? []));
    }

    /**
     * Send a bulk email payload through /emails.
     *
     * @param  array<string, mixed>  $payload  Elastic Email EmailMessageData payload.
     * @return array<string, mixed>
     */
    public function sendBulkEmail(array $payload): array
    {
        return $this->request('POST', '/emails', $payload);
    }

    /**
     * Get delivery status for a transaction ID.
     *
     * @return array<string, mixed>
     */
    public function getEmailStatus(string $transactionId): array
    {
        return $this->request('GET', '/emails/' . $this->segment($transactionId) . '/status');
    }

    /**
     * View the raw email body for a message ID.
     *
     * @return array<string, mixed>
     */
    public function viewEmail(string $messageId): array
    {
        return $this->request('GET', '/emails/' . $this->segment($messageId) . '/view');
    }

    /**
     * List email templates.
     *
     * @param  array<string, mixed>  $params  Optional limit and offset.
     * @return array<string, mixed>|array<int, mixed>
     */
    public function listTemplates(array|int $params = [], int $offset = 0): array
    {
        if (is_int($params)) {
            $params = ['limit' => $params, 'offset' => $offset];
        }

        return $this->request('GET', '/templates', $params);
    }

    /**
     * Get a template by name.
     *
     * @return array<string, mixed>
     */
    public function getTemplate(int|string $name): array
    {
        return $this->request('GET', '/templates/' . $this->segment((string) $name));
    }

    /**
     * Add a template.
     *
     * @param  array<string, mixed>  $payload  Template payload.
     * @return array<string, mixed>
     */
    public function createTemplate(array $payload): array
    {
        return $this->request('POST', '/templates', $payload);
    }

    /**
     * Update a template.
     *
     * @param  array<string, mixed>  $payload  Template payload.
     * @return array<string, mixed>
     */
    public function updateTemplate(string $name, array $payload): array
    {
        return $this->request('PUT', '/templates/' . $this->segment($name), $payload);
    }

    /**
     * Delete a template by name.
     *
     * @return array<string, mixed>
     */
    public function deleteTemplate(string $name): array
    {
        return $this->request('DELETE', '/templates/' . $this->segment($name));
    }

    /**
     * List contacts.
     *
     * @param  array<string, mixed>  $params  Optional limit, offset, listName, email, orderBy.
     * @return array<string, mixed>|array<int, mixed>
     */
    public function listContacts(array|int $params = [], int $offset = 0): array
    {
        if (is_int($params)) {
            $params = ['limit' => $params, 'offset' => $offset];
        }

        return $this->request('GET', '/contacts', $params);
    }

    /**
     * Get a contact by email address.
     *
     * @return array<string, mixed>
     */
    public function getContact(string $email): array
    {
        return $this->request('GET', '/contacts/' . $this->segment($email));
    }

    /**
     * Create or add a contact.
     *
     * @param  array<string, mixed>  $options  Additional contact fields.
     * @return array<string, mixed>
     */
    public function createContact(string $email, ?string $listName = null, array $options = []): array
    {
        $payload = array_merge(['Email' => $email], $options);

        if ($listName !== null) {
            $payload['ListNames'] = [$listName];
        }

        return $this->request('POST', '/contacts', $payload);
    }

    /**
     * Update a contact.
     *
     * @param  array<string, mixed>  $payload  Contact payload.
     * @return array<string, mixed>
     */
    public function updateContact(string $email, array $payload): array
    {
        return $this->request('PUT', '/contacts/' . $this->segment($email), $payload);
    }

    /**
     * Delete a contact.
     *
     * @return array<string, mixed>
     */
    public function deleteContact(string $email): array
    {
        return $this->request('DELETE', '/contacts/' . $this->segment($email));
    }

    /**
     * List contact lists.
     *
     * @param  array<string, mixed>  $params  Optional limit and offset.
     * @return array<string, mixed>|array<int, mixed>
     */
    public function listLists(array $params = []): array
    {
        return $this->request('GET', '/lists', $params);
    }

    /**
     * Get a contact list by name.
     *
     * @return array<string, mixed>
     */
    public function getList(string $name): array
    {
        return $this->request('GET', '/lists/' . $this->segment($name));
    }

    /**
     * List contacts in a contact list.
     *
     * @param  array<string, mixed>  $params  Optional limit and offset.
     * @return array<string, mixed>|array<int, mixed>
     */
    public function listListContacts(string $name, array $params = []): array
    {
        return $this->request('GET', '/lists/' . $this->segment($name) . '/contacts', $params);
    }

    /**
     * Add contacts to a list.
     *
     * @param  array<int, string>  $emails  Contact email addresses.
     * @return array<string, mixed>
     */
    public function addContactsToList(string $name, array $emails): array
    {
        return $this->request('POST', '/lists/' . $this->segment($name) . '/contacts', ['Emails' => $emails]);
    }

    /**
     * Remove contacts from a list.
     *
     * @param  array<int, string>  $emails  Contact email addresses.
     * @return array<string, mixed>
     */
    public function removeContactsFromList(string $name, array $emails): array
    {
        return $this->request('POST', '/lists/' . $this->segment($name) . '/contacts/remove', ['Emails' => $emails]);
    }

    /**
     * List campaigns.
     *
     * @param  array<string, mixed>  $params  Optional limit and offset.
     * @return array<string, mixed>|array<int, mixed>
     */
    public function listCampaigns(array $params = []): array
    {
        return $this->request('GET', '/campaigns', $params);
    }

    /**
     * Get a campaign by name.
     *
     * @return array<string, mixed>
     */
    public function getCampaign(string $name): array
    {
        return $this->request('GET', '/campaigns/' . $this->segment($name));
    }

    /**
     * Pause a campaign by name.
     *
     * @return array<string, mixed>
     */
    public function pauseCampaign(string $name): array
    {
        return $this->request('PUT', '/campaigns/' . $this->segment($name) . '/pause');
    }

    /**
     * Delete a campaign by name.
     *
     * @return array<string, mixed>
     */
    public function deleteCampaign(string $name): array
    {
        return $this->request('DELETE', '/campaigns/' . $this->segment($name));
    }

    /**
     * List events.
     *
     * @param  array<string, mixed>  $params  Optional from, to, eventTypes, limit, offset.
     * @return array<string, mixed>|array<int, mixed>
     */
    public function listEvents(array $params = []): array
    {
        return $this->request('GET', '/events', $params);
    }

    /**
     * List events for a transaction ID.
     *
     * @return array<string, mixed>|array<int, mixed>
     */
    public function listEmailEvents(string $transactionId): array
    {
        return $this->request('GET', '/events/' . $this->segment($transactionId));
    }

    /**
     * List suppressions by type.
     *
     * @return array<string, mixed>|array<int, mixed>
     */
    public function listSuppressions(string $type = 'unsubscribes'): array
    {
        if (! in_array($type, ['unsubscribes', 'bounces', 'complaints'], true)) {
            throw new \RuntimeException('type must be unsubscribes, bounces, or complaints.');
        }

        return $this->request('GET', '/suppressions/' . $type);
    }

    /**
     * Delete all suppressions for an email address.
     *
     * @return array<string, mixed>
     */
    public function deleteSuppression(string $email): array
    {
        return $this->request('DELETE', '/suppressions/' . $this->segment($email));
    }

    /**
     * Get account-wide statistics.
     *
     * @param  array<string, mixed>  $params  Optional from and to dates.
     * @return array<string, mixed>
     */
    public function getStatistics(array $params = []): array
    {
        return $this->request('GET', '/statistics', $params);
    }

    /**
     * Get campaign statistics by name.
     *
     * @return array<string, mixed>
     */
    public function getCampaignStatistics(string $name): array
    {
        return $this->request('GET', '/statistics/campaigns/' . $this->segment($name));
    }

    /**
     * List uploaded files.
     *
     * @return array<string, mixed>|array<int, mixed>
     */
    public function listFiles(): array
    {
        return $this->request('GET', '/files');
    }

    /**
     * Call an Elastic Email GET endpoint.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>|array<int, mixed>
     */
    public function apiGet(string $path, array $params = []): array
    {
        return $this->request('GET', $this->path($path), $params);
    }

    /**
     * Call an Elastic Email POST endpoint.
     *
     * @param  array<string, mixed>  $payload  JSON request body.
     * @return array<string, mixed>|array<int, mixed>
     */
    public function apiPost(string $path, array $payload = []): array
    {
        return $this->request('POST', $this->path($path), $payload);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  array<string, mixed>  $data  Query parameters or JSON body.
     * @return array<string, mixed>|array<int, mixed>
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
     * Make a raw HTTP request to the Elastic Email API.
     *
     * @param  array<string, mixed>  $data  Query parameters or JSON body.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (! $this->apiKey) {
            throw new \RuntimeException('Elastic Email API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'X-ElasticEmail-ApiKey' => $this->apiKey,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $data = array_filter($data, static fn ($value) => $value !== null && $value !== '');

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType ?? '', 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Elastic Email API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Elastic Email API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect.");
                }

                $error = $response->json('error') ?? $body;
                Log::error("Elastic Email API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Elastic Email API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (ConnectionException $e) {
            Log::error("Elastic Email API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Elastic Email API: {$e->getMessage()}");
        }
    }

    /**
     * Normalize email strings or arrays into email arrays.
     *
     * @param  mixed  $value  Email string or array.
     * @return array<int, string>
     */
    private function emails(mixed $value): array
    {
        if (is_array($value)) {
            return array_values(array_filter(array_map(static fn ($item): string => trim((string) $item), $value)));
        }

        return array_values(array_filter(array_map('trim', preg_split('/[;,]/', (string) $value) ?: [])));
    }

    /**
     * Encode one URL path segment.
     */
    private function segment(string $value): string
    {
        return str_replace('%2F', '/', rawurlencode($value));
    }

    /**
     * Validate and normalize a generic API path.
     */
    private function path(string $path): string
    {
        $path = '/' . ltrim($path, '/');

        if (str_starts_with($path, '//') || str_contains($path, '://')) {
            throw new \RuntimeException('path must be an Elastic Email API path such as /contacts.');
        }

        return $path;
    }
}
