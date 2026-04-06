<?php

namespace OpenCompany\Integrations\GoogleContacts\Tools;

use OpenCompany\Integrations\GoogleContacts\GoogleContactsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List the authenticated user's contacts (connections).
 *
 * Returns a paginated list of people in the user's "My Contacts" group.
 * Supports sync tokens for incremental sync and page tokens for pagination.
 *
 * @see https://developers.google.com/people/api/rest/v1/people.connections/list
 */
class GoogleContactsListConnections implements Tool
{
    public function __construct(
        private GoogleContactsService $service,
    ) {}

    public function name(): string
    {
        return 'google_contacts_list_connections';
    }

    public function description(): string
    {
        return 'List contacts (connections) from the authenticated user\'s Google Contacts. Returns names, emails, phone numbers, biographies, organizations, and photos. Supports pagination and incremental sync.';
    }

    public function parameters(): array
    {
        return [
            'pageSize' => ['type' => 'integer', 'description' => 'Number of connections to return per page (1–2000, default 200).'],
            'pageToken' => ['type' => 'string', 'description' => 'Token from a previous response to retrieve the next page of results.'],
            'sortOrder' => ['type' => 'string', 'description' => 'Sort order for results: "LAST_NAME_ASCENDING" or "LAST_NAME_DESCENDING".'],
            'syncToken' => ['type' => 'string', 'description' => 'Sync token from a previous list response to return only contacts that changed since then.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Contacts integration is not configured.');
            }

            $pageSize = isset($args['pageSize']) ? (int) $args['pageSize'] : 200;
            $pageToken = $args['pageToken'] ?? null;
            $sortOrder = $args['sortOrder'] ?? null;
            $syncToken = $args['syncToken'] ?? null;

            $result = $this->service->listConnections($pageSize, $pageToken, $sortOrder, $syncToken);

            $connections = $result['connections'] ?? [];
            $totalItems = $result['totalItems'] ?? count($connections);
            $nextPageToken = $result['nextPageToken'] ?? null;
            $nextSyncToken = $result['nextSyncToken'] ?? null;

            $response = [
                'connections' => array_map([$this, 'formatPerson'], $connections),
                'totalItems' => $totalItems,
            ];

            if ($nextPageToken !== null) {
                $response['nextPageToken'] = $nextPageToken;
            }
            if ($nextSyncToken !== null) {
                $response['nextSyncToken'] = $nextSyncToken;
            }

            return ToolResult::success($response);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Format a person resource into a simplified contact summary.
     *
     * @param  array<string, mixed>  $person
     * @return array<string, mixed>
     */
    private function formatPerson(array $person): array
    {
        $formatted = [
            'resourceName' => $person['resourceName'] ?? null,
        ];

        if (!empty($person['names'])) {
            $name = $person['names'][0];
            $formatted['displayName'] = $name['displayName'] ?? null;
            $formatted['givenName'] = $name['givenName'] ?? null;
            $formatted['familyName'] = $name['familyName'] ?? null;
        }

        if (!empty($person['emailAddresses'])) {
            $formatted['emailAddresses'] = array_map(fn (array $e) => [
                'value' => $e['value'] ?? null,
                'type' => $e['type'] ?? null,
            ], $person['emailAddresses']);
        }

        if (!empty($person['phoneNumbers'])) {
            $formatted['phoneNumbers'] = array_map(fn (array $p) => [
                'value' => $p['value'] ?? null,
                'type' => $p['type'] ?? null,
            ], $person['phoneNumbers']);
        }

        if (!empty($person['organizations'])) {
            $org = $person['organizations'][0];
            $formatted['organization'] = $org['name'] ?? null;
            $formatted['title'] = $org['title'] ?? null;
        }

        if (!empty($person['biographies'])) {
            $formatted['biography'] = $person['biographies'][0]['value'] ?? null;
        }

        if (!empty($person['photos'])) {
            $formatted['photoUrl'] = $person['photos'][0]['url'] ?? null;
        }

        return $formatted;
    }
}
