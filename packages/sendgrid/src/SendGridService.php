<?php

namespace OpenCompany\Integrations\SendGrid;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the SendGrid v3 REST API covering email delivery, marketing contacts, lists,
 * sender identities, statistics, suppressions, and templates.
 *
 * Authentication uses a Bearer API key via the Authorization header.
 */
class SendGridService
{
    private const BASE_URL = 'https://api.sendgrid.com/v3';

    /** @param string $apiKey SendGrid API key */
    public function __construct(
        private string $apiKey = '',
    ) {}

    /**
     * Check whether the API key is configured.
     *
     * @return bool
     */
    public function isConfigured(): bool
    {
        return ! empty($this->apiKey);
    }

    // ── Email ───────────────────────────────────────────

    /**
     * Send an email via the SendGrid Mail Send API.
     *
     * POST /mail/send returns 202 Accepted with no body — this method returns a success indicator.
     *
     * @param  string                $to           Recipient email address.
     * @param  string                $from         Sender email address.
     * @param  string                $subject      Email subject line.
     * @param  string|null           $htmlContent  HTML body content.
     * @param  string|null           $plainContent Plain-text body content.
     * @param  string|null           $replyTo      Reply-to email address.
     * @param  array<int, string>    $cc           CC recipient email addresses.
     * @param  array<int, string>    $bcc          BCC recipient email addresses.
     * @param  array<int, string>    $categories   Categories to attach to the email.
     * @param  array<string, mixed>  $customArgs   Custom arguments for event webhooks.
     * @return array<string, mixed>  Success indicator.
     */
    public function sendEmail(
        string $to,
        string $from,
        string $subject,
        ?string $htmlContent = null,
        ?string $plainContent = null,
        ?string $replyTo = null,
        array $cc = [],
        array $bcc = [],
        array $categories = [],
        array $customArgs = [],
    ): array {
        $payload = [
            'personalizations' => [
                array_filter([
                    'to' => [['email' => $to]],
                    'cc' => array_map(fn (string $e) => ['email' => $e], $cc) ?: null,
                    'bcc' => array_map(fn (string $e) => ['email' => $e], $bcc) ?: null,
                ]),
            ],
            'from' => ['email' => $from],
            'subject' => $subject,
        ];

        $content = [];
        if ($plainContent !== null) {
            $content[] = ['type' => 'text/plain', 'value' => $plainContent];
        }
        if ($htmlContent !== null) {
            $content[] = ['type' => 'text/html', 'value' => $htmlContent];
        }
        if (! empty($content)) {
            $payload['content'] = $content;
        }

        if ($replyTo !== null) {
            $payload['reply_to'] = ['email' => $replyTo];
        }
        if (! empty($categories)) {
            $payload['categories'] = $categories;
        }
        if (! empty($customArgs)) {
            $payload['custom_args'] = $customArgs;
        }

        $this->request('POST', '/mail/send', $payload, true);

        return ['success' => true, 'message' => 'Email sent successfully.'];
    }

    // ── Contacts ────────────────────────────────────────

    /**
     * List marketing contacts.
     *
     * @param  int  $limit  Maximum number of contacts to return.
     * @return array<string, mixed>
     */
    public function listContacts(int $limit = 100): array
    {
        return $this->request('GET', '/marketing/contacts', ['page_size' => $limit]);
    }

    /**
     * Add or update a contact (upsert via PUT).
     *
     * @param  string                $email         Contact email address.
     * @param  string|null           $firstName     Contact first name.
     * @param  string|null           $lastName      Contact last name.
     * @param  array<string, mixed>  $customFields  Custom field values.
     * @param  array<int, string>    $listIds       List IDs to add the contact to.
     * @return array<string, mixed>
     */
    public function addContact(
        string $email,
        ?string $firstName = null,
        ?string $lastName = null,
        array $customFields = [],
        array $listIds = [],
    ): array {
        $contact = array_filter([
            'email' => $email,
            'first_name' => $firstName,
            'last_name' => $lastName,
        ]);

        if (! empty($customFields)) {
            $contact['custom_fields'] = $customFields;
        }

        $payload = ['contacts' => [$contact]];

        if (! empty($listIds)) {
            $payload['list_ids'] = $listIds;
        }

        return $this->request('PUT', '/marketing/contacts', $payload);
    }

    /**
     * Search marketing contacts with a query.
     *
     * @param  string  $query  Search query (e.g., "email LIKE '%@example.com'").
     * @return array<string, mixed>
     */
    public function searchContacts(string $query): array
    {
        return $this->request('POST', '/marketing/contacts/search', ['query' => $query]);
    }

    /**
     * Delete one or more contacts by ID.
     *
     * @param  array<int, string>  $ids  Contact IDs to delete.
     * @return array<string, mixed>
     */
    public function deleteContact(array $ids): array
    {
        $idsParam = implode(',', $ids);

        return $this->request('DELETE', '/marketing/contacts', ['ids' => $idsParam]);
    }

    /**
     * Get a contact by email address.
     *
     * @param  string  $email  The contact's email address.
     * @return array<string, mixed>
     */
    public function getContactByEmail(string $email): array
    {
        return $this->request('POST', '/marketing/contacts/search', [
            'query' => "email = '{$email}'",
        ]);
    }

    // ── Lists ───────────────────────────────────────────

    /**
     * List marketing lists.
     *
     * @param  int  $limit  Maximum number of lists to return.
     * @return array<string, mixed>
     */
    public function listLists(int $limit = 100): array
    {
        return $this->request('GET', '/marketing/lists', ['page_size' => $limit]);
    }

    /**
     * Create a new marketing list.
     *
     * @param  string  $name  The list name.
     * @return array<string, mixed>
     */
    public function createList(string $name): array
    {
        return $this->request('POST', '/marketing/lists', ['name' => $name]);
    }

    /**
     * Add contacts to a marketing list.
     *
     * @param  string              $listId      The list ID.
     * @param  array<int, string>  $contactIds  Contact IDs to add.
     * @return array<string, mixed>
     */
    public function addContactToList(string $listId, array $contactIds): array
    {
        return $this->request('PUT', "/marketing/lists/{$listId}/contacts", [
            'contact_ids' => implode(',', $contactIds),
        ]);
    }

    /**
     * Remove contacts from a marketing list.
     *
     * @param  string              $listId      The list ID.
     * @param  array<int, string>  $contactIds  Contact IDs to remove.
     * @return array<string, mixed>
     */
    public function removeContactFromList(string $listId, array $contactIds): array
    {
        $idsParam = implode(',', $contactIds);

        return $this->request('DELETE', "/marketing/lists/{$listId}/contacts", ['contact_ids' => $idsParam]);
    }

    // ── Sender Identities ───────────────────────────────

    /**
     * List all verified sender identities.
     *
     * @return array<string, mixed>
     */
    public function listSenderIdentities(): array
    {
        return $this->request('GET', '/senders');
    }

    // ── Stats ───────────────────────────────────────────

    /**
     * Get email statistics.
     *
     * @param  string       $startDate    Start date in YYYY-MM-DD format.
     * @param  string|null  $endDate      End date in YYYY-MM-DD format.
     * @param  string|null  $aggregatedBy Aggregation period: day, week, or month.
     * @return array<string, mixed>
     */
    public function getEmailStats(string $startDate, ?string $endDate = null, ?string $aggregatedBy = null): array
    {
        $params = ['start_date' => $startDate];
        if ($endDate !== null) {
            $params['end_date'] = $endDate;
        }
        if ($aggregatedBy !== null) {
            $params['aggregated_by'] = $aggregatedBy;
        }

        return $this->request('GET', '/stats', $params);
    }

    // ── Suppressions ────────────────────────────────────

    /**
     * List bounce suppressions.
     *
     * @param  int|null     $startTime  Start time as a Unix timestamp.
     * @param  int|null     $endTime    End time as a Unix timestamp.
     * @param  int|null     $limit      Maximum number of results to return.
     * @return array<string, mixed>
     */
    public function listSuppressions(?int $startTime = null, ?int $endTime = null, ?int $limit = null): array
    {
        $params = [];
        if ($startTime !== null) {
            $params['start_time'] = $startTime;
        }
        if ($endTime !== null) {
            $params['end_time'] = $endTime;
        }
        if ($limit !== null) {
            $params['limit'] = $limit;
        }

        return $this->request('GET', '/suppression/bounces', $params);
    }

    /**
     * Add email addresses to the suppression list.
     *
     * @param  array<int, string>  $emails  Email addresses to suppress.
     * @return array<string, mixed>
     */
    public function addSuppression(array $emails): array
    {
        return $this->request('POST', '/asm/suppressions', [
            'recipient_emails' => $emails,
        ]);
    }

    // ── Templates ───────────────────────────────────────

    /**
     * List email templates.
     *
     * @param  int  $limit  Maximum number of templates to return.
     * @return array<string, mixed>
     */
    public function getTemplates(int $limit = 100): array
    {
        return $this->request('GET', '/templates', ['page_size' => $limit]);
    }

    // ── User / Connection Test ──────────────────────────

    /**
     * Get the authenticated user's profile.
     *
     * @return array<string, mixed>
     */
    public function getUserProfile(): array
    {
        return $this->request('GET', '/user/profile');
    }

    // ── HTTP ────────────────────────────────────────────

    /**
     * Send an authenticated request to the SendGrid API.
     *
     * @param  string                $method       HTTP method (GET, POST, PUT, PATCH, DELETE).
     * @param  string                $path         API path (e.g. /mail/send).
     * @param  array<string, mixed>  $data         Query params (GET/DELETE) or JSON body (POST/PUT/PATCH).
     * @param  bool                  $acceptNoBody If true, treat 202 with empty body as success.
     * @return array<string, mixed>
     *
     * @throws \RuntimeException If the API key is missing or the request fails.
     */
    private function request(string $method, string $path, array $data = [], bool $acceptNoBody = false): array
    {
        if (! $this->isConfigured()) {
            throw new \RuntimeException('SendGrid API key is not configured.');
        }

        $url = self::BASE_URL . $path;

        try {
            $http = Http::withToken($this->apiKey)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'PATCH' => $http->patch($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if ($response->failed()) {
                $body = $response->json();
                $message = $body['errors'][0]['message'] ?? $response->body();

                Log::error('SendGrid API error', [
                    'method' => $method,
                    'path' => $path,
                    'status' => $response->status(),
                    'body' => $body,
                ]);

                throw new \RuntimeException("SendGrid API error ({$response->status()}): {$message}");
            }

            // POST /mail/send returns 202 with no body
            if ($acceptNoBody && ($response->status() === 202 || empty($response->body()))) {
                return [];
            }

            return $response->json() ?? [];
        } catch (ConnectionException $e) {
            Log::error('SendGrid connection error', ['method' => $method, 'path' => $path, 'error' => $e->getMessage()]);
            throw new \RuntimeException("SendGrid connection error: {$e->getMessage()}");
        }
    }
}
