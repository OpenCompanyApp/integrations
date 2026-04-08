<?php

namespace OpenCompany\Integrations\GoogleContacts\Tools;

use OpenCompany\Integrations\GoogleContacts\GoogleContactsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a specific contact group by resource name.
 *
 * Returns the group's name, type, member count, and member resource names.
 *
 * @see https://developers.google.com/people/api/rest/v1/contactGroups/get
 */
class GoogleContactsGetContactGroup implements Tool
{
    public function __construct(
        private GoogleContactsService $service,
    ) {}

    public function name(): string
    {
        return 'google_contacts_get_contact_group';
    }

    public function description(): string
    {
        return 'Get details of a specific contact group by resource name (e.g., "contactGroups/myContacts"). Returns the group name, type, member count, and member resource names.';
    }

    public function parameters(): array
    {
        return [
            'resourceName' => ['type' => 'string', 'required' => true, 'description' => 'The resource name of the contact group (e.g., "contactGroups/myContacts" or "contactGroups/123").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Contacts integration is not configured.');
            }

            $resourceName = $args['resourceName'];

            $result = $this->service->getContactGroup($resourceName);

            return ToolResult::success([
                'resourceName' => $result['resourceName'] ?? null,
                'name' => $result['name'] ?? null,
                'groupType' => $result['groupType'] ?? null,
                'memberCount' => $result['memberCount'] ?? 0,
                'memberResourceNames' => $result['memberResourceNames'] ?? [],
                'etag' => $result['etag'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
