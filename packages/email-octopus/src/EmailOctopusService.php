<?php

namespace OpenCompany\Integrations\EmailOctopus;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the public EmailOctopus API documentation.
 *
 * Targets the documented v1.6 surface for lists, contacts, fields, tags,
 * campaigns, campaign reports, and automation queueing.
 */
class EmailOctopusService
{
    private const REPORT_TYPES = [
        'summary',
        'links',
        'bounced',
        'clicked',
        'complained',
        'opened',
        'sent',
        'unsubscribed',
        'not-clicked',
        'not-opened',
    ];

    /**
     * @param  string  $apiKey  EmailOctopus API key.
     * @param  string  $baseUrl  EmailOctopus API base URL, without the version path.
     * @param  string  $listId  Optional default list ID for contact/list-scoped operations.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://emailoctopus.com/api',
        private string $listId = '',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has an API key configured.
     */
    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    /**
     * Get the configured default list ID.
     */
    public function getListId(): string
    {
        return $this->listId;
    }

    /**
     * List EmailOctopus lists.
     *
     * @param  array<string, mixed>  $args  Pagination arguments (limit, page).
     * @return array<string, mixed>
     */
    public function listLists(array $args = []): array
    {
        return $this->request('GET', '/1.6/lists', $this->pagination($args));
    }

    /**
     * Get a list by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (list_id).
     * @return array<string, mixed>
     */
    public function getList(array $args): array
    {
        return $this->request('GET', '/1.6/lists/'.$this->path($this->requireListId($args)));
    }

    /**
     * Create a list.
     *
     * @param  array<string, mixed>  $args  List fields (name).
     * @return array<string, mixed>
     */
    public function createList(array $args): array
    {
        return $this->request('POST', '/1.6/lists', $this->onlyKeys($args, ['name']));
    }

    /**
     * Update a list.
     *
     * @param  array<string, mixed>  $args  List fields (list_id, name).
     * @return array<string, mixed>
     */
    public function updateList(array $args): array
    {
        return $this->request('PUT', '/1.6/lists/'.$this->path($this->requireListId($args)), $this->onlyKeys($args, ['name']));
    }

    /**
     * Delete a list.
     *
     * @param  array<string, mixed>  $args  Tool arguments (list_id).
     * @return array<string, mixed>
     */
    public function deleteList(array $args): array
    {
        return $this->request('DELETE', '/1.6/lists/'.$this->path($this->requireListId($args)));
    }

    /**
     * List tags on a list.
     *
     * @param  array<string, mixed>  $args  Tool arguments (list_id).
     * @return array<string, mixed>
     */
    public function listTags(array $args): array
    {
        return $this->request('GET', '/1.6/lists/'.$this->path($this->requireListId($args)).'/tags');
    }

    /**
     * Create a tag on a list.
     *
     * @param  array<string, mixed>  $args  Tool arguments (list_id, tag).
     * @return array<string, mixed>
     */
    public function createTag(array $args): array
    {
        return $this->request('POST', '/1.6/lists/'.$this->path($this->requireListId($args)).'/tags', $this->onlyKeys($args, ['tag']));
    }

    /**
     * Update a tag on a list.
     *
     * @param  array<string, mixed>  $args  Tool arguments (list_id, tag, new_tag).
     * @return array<string, mixed>
     */
    public function updateTag(array $args): array
    {
        return $this->request('PUT', '/1.6/lists/'.$this->path($this->requireListId($args)).'/tags/'.$this->path((string) ($args['tag'] ?? '')), [
            'tag' => $args['new_tag'] ?? $args['tag'] ?? null,
        ]);
    }

    /**
     * Delete a tag from a list.
     *
     * @param  array<string, mixed>  $args  Tool arguments (list_id, tag).
     * @return array<string, mixed>
     */
    public function deleteTag(array $args): array
    {
        return $this->request('DELETE', '/1.6/lists/'.$this->path($this->requireListId($args)).'/tags/'.$this->path((string) ($args['tag'] ?? '')));
    }

    /**
     * List contacts on a list.
     *
     * @param  array<string, mixed>  $args  Tool arguments (list_id, limit, page).
     * @return array<string, mixed>
     */
    public function listContacts(array $args = []): array
    {
        return $this->request('GET', '/1.6/lists/'.$this->path($this->requireListId($args)).'/contacts', $this->pagination($args));
    }

    /**
     * List subscribed contacts on a list.
     *
     * @param  array<string, mixed>  $args  Tool arguments (list_id, limit, page).
     * @return array<string, mixed>
     */
    public function listSubscribedContacts(array $args = []): array
    {
        return $this->request('GET', '/1.6/lists/'.$this->path($this->requireListId($args)).'/contacts/subscribed', $this->pagination($args));
    }

    /**
     * List unsubscribed contacts on a list.
     *
     * @param  array<string, mixed>  $args  Tool arguments (list_id, limit, page).
     * @return array<string, mixed>
     */
    public function listUnsubscribedContacts(array $args = []): array
    {
        return $this->request('GET', '/1.6/lists/'.$this->path($this->requireListId($args)).'/contacts/unsubscribed', $this->pagination($args));
    }

    /**
     * List contacts by tag.
     *
     * @param  array<string, mixed>  $args  Tool arguments (list_id, tag, limit, page).
     * @return array<string, mixed>
     */
    public function listTaggedContacts(array $args): array
    {
        return $this->request('GET', '/1.6/lists/'.$this->path($this->requireListId($args)).'/tags/'.$this->path((string) ($args['tag'] ?? '')).'/contacts', $this->pagination($args));
    }

    /**
     * Get one contact on a list.
     *
     * @param  array<string, mixed>  $args  Tool arguments (list_id, member_id).
     * @return array<string, mixed>
     */
    public function getContact(array $args): array
    {
        return $this->request('GET', '/1.6/lists/'.$this->path($this->requireListId($args)).'/contacts/'.$this->path($this->memberId($args)));
    }

    /**
     * Create one contact on a list.
     *
     * @param  array<string, mixed>  $args  Contact fields (list_id, email_address, fields, tags, status).
     * @return array<string, mixed>
     */
    public function createContact(array $args): array
    {
        return $this->request('POST', '/1.6/lists/'.$this->path($this->requireListId($args)).'/contacts', $this->contactPayload($args));
    }

    /**
     * Update one contact on a list.
     *
     * @param  array<string, mixed>  $args  Contact fields (list_id, member_id, email_address, fields, tags, status).
     * @return array<string, mixed>
     */
    public function updateContact(array $args): array
    {
        return $this->request('PUT', '/1.6/lists/'.$this->path($this->requireListId($args)).'/contacts/'.$this->path($this->memberId($args)), $this->contactPayload($args));
    }

    /**
     * Delete one contact from a list.
     *
     * @param  array<string, mixed>  $args  Tool arguments (list_id, member_id).
     * @return array<string, mixed>
     */
    public function deleteContact(array $args): array
    {
        return $this->request('DELETE', '/1.6/lists/'.$this->path($this->requireListId($args)).'/contacts/'.$this->path($this->memberId($args)));
    }

    /**
     * Update multiple contacts on a list.
     *
     * @param  array<string, mixed>  $args  Tool arguments (list_id, data).
     * @return array<string, mixed>
     */
    public function updateContactsBulk(array $args): array
    {
        return $this->request('PUT', '/1.6/lists/'.$this->path($this->requireListId($args)).'/contacts', [
            'data' => array_slice($args['data'] ?? [], 0, 100),
        ]);
    }

    /**
     * Create a list field.
     *
     * @param  array<string, mixed>  $args  Field fields (list_id, tag, type, label, fallback).
     * @return array<string, mixed>
     */
    public function createField(array $args): array
    {
        return $this->request('POST', '/1.6/lists/'.$this->path($this->requireListId($args)).'/fields', $this->onlyKeys($args, ['tag', 'type', 'label', 'fallback']));
    }

    /**
     * Update a list field.
     *
     * @param  array<string, mixed>  $args  Field fields (list_id, tag, type, label, fallback).
     * @return array<string, mixed>
     */
    public function updateField(array $args): array
    {
        return $this->request('PUT', '/1.6/lists/'.$this->path($this->requireListId($args)).'/fields/'.$this->path((string) ($args['tag'] ?? '')), $this->onlyKeys($args, ['type', 'label', 'fallback']));
    }

    /**
     * Delete a list field.
     *
     * @param  array<string, mixed>  $args  Tool arguments (list_id, tag).
     * @return array<string, mixed>
     */
    public function deleteField(array $args): array
    {
        return $this->request('DELETE', '/1.6/lists/'.$this->path($this->requireListId($args)).'/fields/'.$this->path((string) ($args['tag'] ?? '')));
    }

    /**
     * List campaigns.
     *
     * @param  array<string, mixed>  $args  Pagination arguments (limit, page).
     * @return array<string, mixed>
     */
    public function listCampaigns(array $args = []): array
    {
        return $this->request('GET', '/1.6/campaigns', $this->pagination($args));
    }

    /**
     * Get a campaign by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (campaign_id).
     * @return array<string, mixed>
     */
    public function getCampaign(array $args): array
    {
        return $this->request('GET', '/1.6/campaigns/'.$this->path((string) ($args['campaign_id'] ?? '')));
    }

    /**
     * Get a campaign report endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments (campaign_id, report_type, limit, page).
     * @return array<string, mixed>
     */
    public function getCampaignReport(array $args): array
    {
        $reportType = (string) ($args['report_type'] ?? 'summary');

        if (!in_array($reportType, self::REPORT_TYPES, true)) {
            throw new RuntimeException('Invalid report_type. Use one of: '.implode(', ', self::REPORT_TYPES));
        }

        return $this->request('GET', '/1.6/campaigns/'.$this->path((string) ($args['campaign_id'] ?? '')).'/reports/'.$reportType, $this->pagination($args));
    }

    /**
     * Start an automation for a contact.
     *
     * @param  array<string, mixed>  $args  Tool arguments (automation_id, list_member_id).
     * @return array<string, mixed>
     */
    public function startAutomation(array $args): array
    {
        return $this->request('POST', '/1.6/automations/'.$this->path((string) ($args['automation_id'] ?? '')).'/queue', $this->onlyKeys($args, ['list_member_id']));
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path including version.
     * @param  array<string, mixed>  $data  Query parameters or JSON body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        $json = $response->json();

        if (is_array($json)) {
            return $json;
        }

        $body = $response->body();

        return $body === '' ? ['success' => true] : ['response' => $body];
    }

    /**
     * Make a raw HTTP request to the EmailOctopus API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or JSON body.
     * @return Response
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if (!$this->apiKey) {
            throw new RuntimeException('EmailOctopus API key is not configured.');
        }

        $url = $this->baseUrl.$path;
        $data['api_key'] = $this->apiKey;

        try {
            $http = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $this->throwApiError($method, $path, $response);
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("EmailOctopus API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new RuntimeException("Failed to connect to EmailOctopus API: {$e->getMessage()}");
        }
    }

    /**
     * Throw a normalized API error.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  Response  $response  Failed response.
     */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $error = $response->json('message') ?? $response->json('error.message') ?? $response->json('error') ?? $response->body();

        Log::error("EmailOctopus API error: {$method} {$path}", [
            'status' => $response->status(),
            'error' => $error,
        ]);

        throw new RuntimeException("EmailOctopus API error ({$response->status()}): ".(is_string($error) ? $error : json_encode($error)));
    }

    /**
     * Extract list ID from arguments or default configuration.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    private function requireListId(array $args): string
    {
        $listId = (string) ($args['list_id'] ?? $this->listId);

        if ($listId === '') {
            throw new RuntimeException('list_id is required when no default list_id is configured.');
        }

        return $listId;
    }

    /**
     * Extract a contact member ID from arguments.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    private function memberId(array $args): string
    {
        $memberId = (string) ($args['member_id'] ?? $args['contact_id'] ?? '');

        if ($memberId === '') {
            throw new RuntimeException('member_id is required.');
        }

        return $memberId;
    }

    /**
     * Build a list-contact request payload.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    private function contactPayload(array $args): array
    {
        return $this->onlyKeys($args, ['email_address', 'fields', 'tags', 'status']);
    }

    /**
     * Build standard pagination parameters.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    private function pagination(array $args): array
    {
        return $this->onlyKeys($args, ['limit', 'page']);
    }

    /**
     * Keep only supported keys and remove null values.
     *
     * @param  array<string, mixed>  $data  Source data.
     * @param  array<int, string>  $keys  Allowed keys.
     * @return array<string, mixed>
     */
    private function onlyKeys(array $data, array $keys): array
    {
        return array_filter(array_intersect_key($data, array_flip($keys)), static fn (mixed $value): bool => $value !== null);
    }

    /**
     * URL-encode a path segment.
     *
     * @param  string  $value  Path segment value.
     */
    private function path(string $value): string
    {
        return rawurlencode($value);
    }
}
