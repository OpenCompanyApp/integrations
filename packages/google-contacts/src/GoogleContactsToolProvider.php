<?php

namespace OpenCompany\Integrations\GoogleContacts;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\GoogleContacts\Tools\GoogleContactsListConnections;
use OpenCompany\Integrations\GoogleContacts\Tools\GoogleContactsGetConnection;
use OpenCompany\Integrations\GoogleContacts\Tools\GoogleContactsCreateContact;
use OpenCompany\Integrations\GoogleContacts\Tools\GoogleContactsListContactGroups;
use OpenCompany\Integrations\GoogleContacts\Tools\GoogleContactsGetContactGroup;
use OpenCompany\Integrations\GoogleContacts\Tools\GoogleContactsListOtherContacts;
use OpenCompany\Integrations\GoogleContacts\Tools\GoogleContactsGetCurrentUser;

/**
 * Tool provider for the Google Contacts (People API) integration.
 *
 * Implements ConfigurableIntegration for multi-account support, exposes
 * configuration schema, connection testing, and the full list of available
 * tools for the Google People API.
 */
class GoogleContactsToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * Machine name of the integration.
     */
    public function appName(): string
    {
        return 'google_contacts';
    }

    /**
     * Short metadata shown in UI tool listings.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'contacts, groups, people',
            'description' => 'Google Contacts',
            'icon' => 'ph:address-book',
            'logo' => 'simple-icons:google',
        ];
    }

    /**
     * Full integration metadata for the integrations registry.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Google Contacts',
            'description' => 'Manage contacts and contact groups via the Google People API',
            'icon' => 'ph:address-book',
            'logo' => 'simple-icons:google',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.google.com/people/api/rest/v1',
        ];
    }

    /**
     * Configuration schema for the integration settings UI.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Google OAuth2 access token',
                'hint' => 'Provide an OAuth2 access token with <code>https://www.googleapis.com/auth/contacts</code> scope',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://people.googleapis.com',
                'hint' => 'Override only if using a Google Workspace alternate endpoint',
                'default' => 'https://people.googleapis.com',
            ],
        ];
    }

    /**
     * Test the connection to the Google People API using the provided config.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://people.googleapis.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/v1/people/me', [
                'personFields' => 'names',
            ]);

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Google People API at {$baseUrl}. Check the URL and access token.",
                ];
            }

            if (isset($json['error'])) {
                return [
                    'success' => false,
                    'error' => $json['error']['message'] ?? 'Authentication failed',
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Google People API. Authenticated as " . ($json['names'][0]['displayName'] ?? 'unknown user') . ".",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Validation rules for the integration configuration.
     *
     * @return array<string, mixed>
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * List of tools provided by this integration.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            'google_contacts_list_connections' => [
                'class' => GoogleContactsListConnections::class,
                'type' => 'read',
                'name' => 'List Connections',
                'description' => 'List the authenticated user\'s contacts (connections).',
                'icon' => 'ph:address-book',
            ],
            'google_contacts_get_connection' => [
                'class' => GoogleContactsGetConnection::class,
                'type' => 'read',
                'name' => 'Get Connection',
                'description' => 'Get a specific contact by resource name.',
                'icon' => 'ph:user',
            ],
            'google_contacts_create_contact' => [
                'class' => GoogleContactsCreateContact::class,
                'type' => 'write',
                'name' => 'Create Contact',
                'description' => 'Create a new contact with names, emails, phone numbers, and notes.',
                'icon' => 'ph:user-plus',
            ],
            'google_contacts_list_contact_groups' => [
                'class' => GoogleContactsListContactGroups::class,
                'type' => 'read',
                'name' => 'List Contact Groups',
                'description' => 'List all contact groups owned by the user.',
                'icon' => 'ph:users',
            ],
            'google_contacts_get_contact_group' => [
                'class' => GoogleContactsGetContactGroup::class,
                'type' => 'read',
                'name' => 'Get Contact Group',
                'description' => 'Get a specific contact group by resource name.',
                'icon' => 'ph:users',
            ],
            'google_contacts_list_other_contacts' => [
                'class' => GoogleContactsListOtherContacts::class,
                'type' => 'read',
                'name' => 'List Other Contacts',
                'description' => 'List contacts the user has interacted with but not added to a group.',
                'icon' => 'ph:address-book',
            ],
            'google_contacts_get_current_user' => [
                'class' => GoogleContactsGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s profile information.',
                'icon' => 'ph:identification-card',
            ],
        ];
    }

    /**
     * Path to the Lua API reference documentation.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/google-contacts.md';
    }

    /**
     * Credential fields for multi-account support.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://people.googleapis.com'],
        ];
    }

    /**
     * Confirm this is an integration (not a standalone tool).
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally for a specific account.
     *
     * @param  class-string<Tool>  $class    Tool class to instantiate.
     * @param  array<string, mixed> $context  Context containing optional 'account' key.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new GoogleContactsService(
                accessToken: $creds->get('google_contacts', 'access_token', '', $account),
                baseUrl: $creds->get('google_contacts', 'url', 'https://people.googleapis.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(GoogleContactsService::class));
    }
}
