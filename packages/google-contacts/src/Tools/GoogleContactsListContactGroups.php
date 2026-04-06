<?php

namespace OpenCompany\Integrations\GoogleContacts\Tools;

use OpenCompany\Integrations\GoogleContacts\GoogleContactsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all contact groups owned by the authenticated user.
 *
 * Returns contact groups (e.g., "My Contacts", "Starred", and user-created
 * groups) with their names, types, and member counts.
 *
 * @see https://developers.google.com/people/api/rest/v1/contactGroups/list
 */
class GoogleContactsListContactGroups implements Tool
{
    public function __construct(
        private GoogleContactsService $service,
    ) {}

    public function name(): string
    {
        return 'google_contacts_list_contact_groups';
    }

    public function description(): string
    {
        return 'List all contact groups in the user\'s Google Contacts. Includes system groups (e.g., "My Contacts", "Starred") and user-created groups. Returns group name, type, and member count.';
    }

    public function parameters(): array
    {
        return [
            'pageSize' => ['type' => 'integer', 'description' => 'Number of groups to return per page (1–2000, default 200).'],
            'pageToken' => ['type' => 'string', 'description' => 'Token from a previous response to retrieve the next page.'],
            'syncToken' => ['type' => 'string', 'description' => 'Sync token from a previous list response to return only groups that changed.'],
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
            $syncToken = $args['syncToken'] ?? null;

            $result = $this->service->listContactGroups($pageSize, $pageToken, $syncToken);

            $groups = $result['contactGroups'] ?? [];
            $nextPageToken = $result['nextPageToken'] ?? null;
            $nextSyncToken = $result['nextSyncToken'] ?? null;

            $response = [
                'contactGroups' => array_map(fn (array $group) => [
                    'resourceName' => $group['resourceName'] ?? null,
                    'name' => $group['name'] ?? null,
                    'groupType' => $group['groupType'] ?? null,
                    'memberCount' => $group['memberCount'] ?? 0,
                ], $groups),
                'totalItems' => count($groups),
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
}
