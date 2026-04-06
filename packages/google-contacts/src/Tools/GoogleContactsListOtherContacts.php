<?php

namespace OpenCompany\Integrations\GoogleContacts\Tools;

use OpenCompany\Integrations\GoogleContacts\GoogleContactsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List "Other Contacts" — contacts the user has interacted with but not added.
 *
 * These are automatically populated by Google based on email and communication
 * activity. Returns names, email addresses, and phone numbers.
 *
 * @see https://developers.google.com/people/api/rest/v1/otherContacts/list
 */
class GoogleContactsListOtherContacts implements Tool
{
    public function __construct(
        private GoogleContactsService $service,
    ) {}

    public function name(): string
    {
        return 'google_contacts_list_other_contacts';
    }

    public function description(): string
    {
        return 'List "Other Contacts" — people the user has interacted with (e.g., via email) but hasn\'t added to their contacts. Returns names, email addresses, and phone numbers.';
    }

    public function parameters(): array
    {
        return [
            'pageSize' => ['type' => 'integer', 'description' => 'Number of contacts to return per page (1–1000, default 200).'],
            'pageToken' => ['type' => 'string', 'description' => 'Token from a previous response to retrieve the next page.'],
            'syncToken' => ['type' => 'string', 'description' => 'Sync token from a previous list response to return only changed contacts.'],
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

            $result = $this->service->listOtherContacts($pageSize, $pageToken, $syncToken);

            $contacts = $result['otherContacts'] ?? [];
            $nextPageToken = $result['nextPageToken'] ?? null;
            $nextSyncToken = $result['nextSyncToken'] ?? null;

            $response = [
                'otherContacts' => array_map(fn (array $person) => [
                    'resourceName' => $person['resourceName'] ?? null,
                    'displayName' => $person['names'][0]['displayName'] ?? null,
                    'emailAddresses' => array_map(fn (array $e) => $e['value'] ?? null, $person['emailAddresses'] ?? []),
                    'phoneNumbers' => array_map(fn (array $p) => $p['value'] ?? null, $person['phoneNumbers'] ?? []),
                ], $contacts),
                'totalItems' => count($contacts),
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
