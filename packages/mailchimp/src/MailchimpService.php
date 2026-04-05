<?php

namespace OpenCompany\Integrations\Mailchimp;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Mailchimp Marketing API covering audiences, subscribers, campaigns, segments, and reports.
 *
 * Wraps the Mailchimp v3 REST API with HTTP Basic authentication. The datacenter suffix embedded in
 * the API key determines the base URL.
 */
class MailchimpService
{
    private string $dc;

    /** @param string $apiKey Mailchimp API key in the format `{key}-{datacenter}` */
    public function __construct(
        private string $apiKey = '',
    ) {
        $this->dc = $apiKey !== '' ? substr(strrchr($apiKey, '-'), 1) : '';
    }

    public function isConfigured(): bool
    {
        return ! empty($this->apiKey) && ! empty($this->dc);
    }

    // ── Audiences / Lists ────────────────────────────────

    /**
     * List all audiences in the account.
     *
     * @param  int  $count   Number of records to return (max 1000).
     * @param  int  $offset  Number of records to skip.
     * @return array<string, mixed>
     */
    public function listAudiences(int $count = 100, int $offset = 0): array
    {
        return $this->request('GET', '/lists', ['count' => $count, 'offset' => $offset]);
    }

    /**
     * Get details for a single audience.
     *
     * @param  string  $listId  The audience/list ID.
     * @return array<string, mixed>
     */
    public function getAudience(string $listId): array
    {
        return $this->request('GET', "/lists/{$listId}");
    }

    /**
     * Create a new audience.
     *
     * @param  array<string, mixed>  $payload  Audience definition including name, contact, permission_reminder, etc.
     * @return array<string, mixed>
     */
    public function createAudience(array $payload): array
    {
        return $this->request('POST', '/lists', $payload);
    }

    // ── Subscribers ──────────────────────────────────────

    /**
     * Add or update a list member (upsert via PUT).
     *
     * @param  string                $listId   The audience/list ID.
     * @param  string                $email    Subscriber email address.
     * @param  string                $status   Subscription status (subscribed, unsubscribed, cleaned, pending).
     * @param  array<string, mixed>  $mergeFields  Merge field values (e.g. FNAME, LNAME).
     * @param  array<int, string>    $tags     Tags to apply.
     * @return array<string, mixed>
     */
    public function addSubscriber(string $listId, string $email, string $status = 'subscribed', array $mergeFields = [], array $tags = []): array
    {
        $hash = md5(strtolower($email));
        $payload = [
            'email_address' => $email,
            'status' => $status,
        ];
        if (! empty($mergeFields)) {
            $payload['merge_fields'] = $mergeFields;
        }
        if (! empty($tags)) {
            $payload['tags'] = $tags;
        }

        return $this->request('PUT', "/lists/{$listId}/members/{$hash}", $payload);
    }

    /**
     * Get a subscriber's details.
     *
     * @param  string  $listId  The audience/list ID.
     * @param  string  $email   Subscriber email address.
     * @return array<string, mixed>
     */
    public function getSubscriber(string $listId, string $email): array
    {
        $hash = md5(strtolower($email));

        return $this->request('GET', "/lists/{$listId}/members/{$hash}");
    }

    /**
     * Update a subscriber's details.
     *
     * @param  string                $listId       The audience/list ID.
     * @param  string                $email        Subscriber email address.
     * @param  array<string, mixed>  $mergeFields  Merge fields to update.
     * @param  string|null           $status       New subscription status, or null to keep current.
     * @return array<string, mixed>
     */
    public function updateSubscriber(string $listId, string $email, array $mergeFields = [], ?string $status = null): array
    {
        $hash = md5(strtolower($email));
        $payload = [];
        if (! empty($mergeFields)) {
            $payload['merge_fields'] = $mergeFields;
        }
        if ($status !== null) {
            $payload['status'] = $status;
        }

        return $this->request('PATCH', "/lists/{$listId}/members/{$hash}", $payload);
    }

    /**
     * Search subscribers across or within lists.
     *
     * @param  string       $query   Search query.
     * @param  string|null  $listId  Optional list ID to scope the search.
     * @param  int          $count   Number of results to return.
     * @return array<string, mixed>
     */
    public function searchSubscribers(string $query, ?string $listId = null, int $count = 10): array
    {
        $params = ['query' => $query, 'count' => $count];
        if ($listId !== null) {
            $params['list_id'] = $listId;
        }

        return $this->request('GET', '/search-members', $params);
    }

    /**
     * Remove (archive) a subscriber from a list.
     *
     * @param  string  $listId  The audience/list ID.
     * @param  string  $email   Subscriber email address.
     * @return array<string, mixed>
     */
    public function removeSubscriber(string $listId, string $email): array
    {
        $hash = md5(strtolower($email));

        return $this->request('DELETE', "/lists/{$listId}/members/{$hash}");
    }

    // ── Campaigns ────────────────────────────────────────

    /**
     * Create a new campaign.
     *
     * @param  array<string, mixed>  $payload  Campaign definition.
     * @return array<string, mixed>
     */
    public function createCampaign(array $payload): array
    {
        return $this->request('POST', '/campaigns', $payload);
    }

    /**
     * Get details for a single campaign.
     *
     * @param  string  $campaignId  The campaign ID.
     * @return array<string, mixed>
     */
    public function getCampaign(string $campaignId): array
    {
        return $this->request('GET', "/campaigns/{$campaignId}");
    }

    /**
     * Update a campaign's settings.
     *
     * @param  string                $campaignId  The campaign ID.
     * @param  array<string, mixed>  $settings    Settings to update.
     * @return array<string, mixed>
     */
    public function updateCampaign(string $campaignId, array $settings): array
    {
        return $this->request('PATCH', "/campaigns/{$campaignId}", ['settings' => $settings]);
    }

    /**
     * Send a campaign immediately.
     *
     * @param  string  $campaignId  The campaign ID.
     * @return array<string, mixed>
     */
    public function sendCampaign(string $campaignId): array
    {
        return $this->request('POST', "/campaigns/{$campaignId}/actions/send");
    }

    /**
     * List campaigns with optional filters.
     *
     * @param  int          $count   Number of records to return.
     * @param  int          $offset  Number of records to skip.
     * @param  string|null  $status  Filter by status (save, paused, schedule, sending, sent).
     * @param  string|null  $type    Filter by type (regular, plaintext, absplit, rss, automation, variate).
     * @return array<string, mixed>
     */
    public function listCampaigns(int $count = 100, int $offset = 0, ?string $status = null, ?string $type = null): array
    {
        $params = ['count' => $count, 'offset' => $offset];
        if ($status !== null) {
            $params['status'] = $status;
        }
        if ($type !== null) {
            $params['type'] = $type;
        }

        return $this->request('GET', '/campaigns', $params);
    }

    // ── Tags & Segments ──────────────────────────────────

    /**
     * Add or remove tags on a subscriber.
     *
     * @param  string                $listId  The audience/list ID.
     * @param  string                $email   Subscriber email address.
     * @param  array<int, mixed>     $tags    Array of `{name: string, status: "active"|"inactive"}`.
     * @return array<string, mixed>
     */
    public function tagSubscriber(string $listId, string $email, array $tags): array
    {
        $hash = md5(strtolower($email));

        return $this->request('POST', "/lists/{$listId}/members/{$hash}/tags", ['tags' => $tags]);
    }

    /**
     * List all segments for an audience.
     *
     * @param  string  $listId  The audience/list ID.
     * @param  int     $count   Number of records to return.
     * @return array<string, mixed>
     */
    public function listSegments(string $listId, int $count = 100): array
    {
        return $this->request('GET', "/lists/{$listId}/segments", ['count' => $count]);
    }

    /**
     * Add a subscriber to a static segment.
     *
     * @param  string  $listId     The audience/list ID.
     * @param  string  $segmentId  The segment ID.
     * @param  string  $email      Subscriber email address.
     * @return array<string, mixed>
     */
    public function addToSegment(string $listId, string $segmentId, string $email): array
    {
        return $this->request('POST', "/lists/{$listId}/segments/{$segmentId}/members", [
            'email_address' => $email,
        ]);
    }

    // ── Reports ──────────────────────────────────────────

    /**
     * Get a campaign report with send, open, click, and bounce stats.
     *
     * @param  string  $campaignId  The campaign ID.
     * @return array<string, mixed>
     */
    public function getCampaignReport(string $campaignId): array
    {
        return $this->request('GET', "/reports/{$campaignId}");
    }

    // ── Account ──────────────────────────────────────────

    /**
     * Get the authenticated user's account information.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/');
    }

    // ── HTTP ─────────────────────────────────────────────

    /**
     * Send an authenticated request to the Mailchimp API.
     *
     * @param  array<string, mixed>  $data  Query parameters (GET/DELETE) or JSON body (POST/PUT/PATCH).
     * @return array<string, mixed>
     *
     * @throws \RuntimeException If the API key is missing or the request fails.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->isConfigured()) {
            throw new \RuntimeException('Mailchimp API key is not configured.');
        }

        $url = "https://{$this->dc}.api.mailchimp.com/3.0" . $path;

        try {
            $http = Http::withBasicAuth('anystring', $this->apiKey)
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
                $message = $body['detail'] ?? $body['title'] ?? $response->body();

                Log::error('Mailchimp API error', [
                    'method' => $method,
                    'path' => $path,
                    'status' => $response->status(),
                    'body' => $body,
                ]);

                throw new \RuntimeException("Mailchimp API error ({$response->status()}): {$message}");
            }

            // DELETE may return empty body
            return $response->json() ?? [];
        } catch (ConnectionException $e) {
            Log::error('Mailchimp connection error', ['method' => $method, 'path' => $path, 'error' => $e->getMessage()]);
            throw new \RuntimeException("Mailchimp connection error: {$e->getMessage()}");
        }
    }
}
