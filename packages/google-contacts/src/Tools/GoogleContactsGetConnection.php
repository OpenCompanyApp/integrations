<?php

namespace OpenCompany\Integrations\GoogleContacts\Tools;

use OpenCompany\Integrations\GoogleContacts\GoogleContactsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a specific contact (person) by resource name.
 *
 * Retrieves detailed information about a single contact, including all
 * requested person fields.
 *
 * @see https://developers.google.com/people/api/rest/v1/people/get
 */
class GoogleContactsGetConnection implements Tool
{
    public function __construct(
        private GoogleContactsService $service,
    ) {}

    public function name(): string
    {
        return 'google_contacts_get_connection';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific contact by resource name (e.g., "people/c123456789"). Returns names, emails, phone numbers, biographies, organizations, and photos.';
    }

    public function parameters(): array
    {
        return [
            'resourceName' => ['type' => 'string', 'required' => true, 'description' => 'The resource name of the person to retrieve (e.g., "people/c123456789").'],
            'personFields' => ['type' => 'string', 'description' => 'Comma-separated person fields to include (default: "names,emailAddresses,phoneNumbers,biographies,organizations,photos").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Contacts integration is not configured.');
            }

            $resourceName = $args['resourceName'];
            $personFields = $args['personFields'] ?? 'names,emailAddresses,phoneNumbers,biographies,organizations,photos';

            $result = $this->service->getConnection($resourceName, $personFields);

            return ToolResult::success($this->formatPerson($result));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Format a person resource into a detailed contact summary.
     *
     * @param  array<string, mixed>  $person
     * @return array<string, mixed>
     */
    private function formatPerson(array $person): array
    {
        $formatted = [
            'resourceName' => $person['resourceName'] ?? null,
            'etag' => $person['etag'] ?? null,
        ];

        if (!empty($person['names'])) {
            $name = $person['names'][0];
            $formatted['displayName'] = $name['displayName'] ?? null;
            $formatted['givenName'] = $name['givenName'] ?? null;
            $formatted['familyName'] = $name['familyName'] ?? null;
            $formatted['honorificPrefix'] = $name['honorificPrefix'] ?? null;
        }

        if (!empty($person['emailAddresses'])) {
            $formatted['emailAddresses'] = array_map(fn (array $e) => [
                'value' => $e['value'] ?? null,
                'type' => $e['type'] ?? null,
                'primary' => $e['primary'] ?? false,
            ], $person['emailAddresses']);
        }

        if (!empty($person['phoneNumbers'])) {
            $formatted['phoneNumbers'] = array_map(fn (array $p) => [
                'value' => $p['value'] ?? null,
                'type' => $p['type'] ?? null,
                'primary' => $p['primary'] ?? false,
            ], $person['phoneNumbers']);
        }

        if (!empty($person['organizations'])) {
            $org = $person['organizations'][0];
            $formatted['organization'] = $org['name'] ?? null;
            $formatted['title'] = $org['title'] ?? null;
            $formatted['department'] = $org['department'] ?? null;
        }

        if (!empty($person['biographies'])) {
            $formatted['biography'] = $person['biographies'][0]['value'] ?? null;
        }

        if (!empty($person['photos'])) {
            $formatted['photos'] = array_map(fn (array $p) => [
                'url' => $p['url'] ?? null,
                'default' => $p['default'] ?? false,
            ], $person['photos']);
        }

        if (!empty($person['memberships'])) {
            $formatted['groups'] = array_map(fn (array $m) => [
                'contactGroupResourceName' => $m['contactGroupMembership']['contactGroupResourceName'] ?? null,
            ], $person['memberships']);
        }

        return $formatted;
    }
}
