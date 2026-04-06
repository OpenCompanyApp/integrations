<?php

namespace OpenCompany\Integrations\GoogleContacts\Tools;

use OpenCompany\Integrations\GoogleContacts\GoogleContactsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the authenticated user's profile information.
 *
 * Retrieves the user's own profile from the Google People API, including
 * their display name, email addresses, and profile photos.
 *
 * @see https://developers.google.com/people/api/rest/v1/people/get
 */
class GoogleContactsGetCurrentUser implements Tool
{
    public function __construct(
        private GoogleContactsService $service,
    ) {}

    public function name(): string
    {
        return 'google_contacts_get_current_user';
    }

    public function description(): string
    {
        return 'Get the authenticated user\'s own Google profile information — display name, email addresses, and profile photo.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Contacts integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            $response = [
                'resourceName' => $result['resourceName'] ?? null,
            ];

            if (!empty($result['names'])) {
                $name = $result['names'][0];
                $response['displayName'] = $name['displayName'] ?? null;
                $response['givenName'] = $name['givenName'] ?? null;
                $response['familyName'] = $name['familyName'] ?? null;
            }

            if (!empty($result['emailAddresses'])) {
                $response['emailAddresses'] = array_map(fn (array $e) => [
                    'value' => $e['value'] ?? null,
                    'primary' => $e['primary'] ?? false,
                ], $result['emailAddresses']);
            }

            if (!empty($result['photos'])) {
                $response['photos'] = array_map(fn (array $p) => [
                    'url' => $p['url'] ?? null,
                    'default' => $p['default'] ?? false,
                ], $result['photos']);
            }

            return ToolResult::success($response);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
