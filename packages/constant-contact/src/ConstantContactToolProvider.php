<?php

namespace OpenCompany\Integrations\ConstantContact;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\ConstantContact\Tools\ConstantContactListContacts;
use OpenCompany\Integrations\ConstantContact\Tools\ConstantContactGetContact;
use OpenCompany\Integrations\ConstantContact\Tools\ConstantContactCreateContact;
use OpenCompany\Integrations\ConstantContact\Tools\ConstantContactListCampaigns;
use OpenCompany\Integrations\ConstantContact\Tools\ConstantContactListLists;
use OpenCompany\Integrations\ConstantContact\Tools\ConstantContactGetCurrentUser;

/**
 * Tool provider for the Constant Contact email marketing integration.
 *
 * Declares 6 tools for managing contacts, campaigns, lists, and user info.
 * Implements ConfigurableIntegration for the OpenCompany settings UI.
 */
class ConstantContactToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * Unique identifier for this integration.
     */
    public function appName(): string
    {
        return 'constant_contact';
    }

    /**
     * Metadata for the tool catalog and UI.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'contacts, campaigns, lists',
            'description' => 'Email marketing',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:constantcontact',
        ];
    }

    /**
     * Integration metadata for the OpenCompany settings UI.
     *
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Constant Contact',
            'description' => 'Email marketing platform — manage contacts, campaigns, and lists',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:constantcontact',
            'category' => 'email',
            'badge' => 'verified',
            'docs_url' => 'https://developer.constantcontact.com/api_reference/api-reference.html',
        ];
    }

    /**
     * Configuration schema for the integration settings form.
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
                'placeholder' => 'Enter your Constant Contact OAuth2 access token',
                'hint' => 'Generate an access token in your Constant Contact developer account or via the OAuth2 flow',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.cc.email/v3',
                'hint' => 'Use the default Constant Contact v3 API URL, or override for testing',
                'default' => 'https://api.cc.email/v3',
            ],
        ];
    }

    /**
     * Test the API connection using the provided configuration.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.cc.email/v3', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/user');

            if ($response->status() === 401) {
                return ['success' => false, 'error' => 'Invalid or expired access token.'];
            }

            if ($response->successful()) {
                return ['success' => true, 'message' => 'Connected to Constant Contact API.'];
            }

            return [
                'success' => false,
                'error' => "API returned HTTP {$response->status()}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Laravel validation rules for the configuration fields.
     *
     * @return array<string, string>
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Declare all available tools for this integration.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            'constantcontact_list_contacts' => [
                'class' => ConstantContactListContacts::class,
                'type' => 'read',
                'name' => 'List Contacts',
                'description' => 'List contacts from Constant Contact with pagination and status filtering.',
                'icon' => 'ph:users',
            ],
            'constantcontact_get_contact' => [
                'class' => ConstantContactGetContact::class,
                'type' => 'read',
                'name' => 'Get Contact',
                'description' => 'Get detailed information for a single Constant Contact contact.',
                'icon' => 'ph:user',
            ],
            'constantcontact_create_contact' => [
                'class' => ConstantContactCreateContact::class,
                'type' => 'write',
                'name' => 'Create Contact',
                'description' => 'Create a new contact in Constant Contact.',
                'icon' => 'ph:user-plus',
            ],
            'constantcontact_list_campaigns' => [
                'class' => ConstantContactListCampaigns::class,
                'type' => 'read',
                'name' => 'List Campaigns',
                'description' => 'List email campaigns from Constant Contact.',
                'icon' => 'ph:envelope',
            ],
            'constantcontact_list_lists' => [
                'class' => ConstantContactListLists::class,
                'type' => 'read',
                'name' => 'List Lists',
                'description' => 'List all contact lists in Constant Contact.',
                'icon' => 'ph:list-bullets',
            ],
            'constantcontact_get_current_user' => [
                'class' => ConstantContactGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s Constant Contact account information.',
                'icon' => 'ph:identification-card',
            ],
        ];
    }

    /**
     * Path to the supplementary Lua documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/constant-contact.md';
    }

    /**
     * Declare the credential fields required by this integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.cc.email/v3'],
        ];
    }

    /**
     * Confirm this is an integration (toggleable per agent).
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally with per-account credentials.
     *
     * @param  string               $class   Fully-qualified tool class name.
     * @param  array<string, mixed> $context Runtime context (may contain 'account' for multi-account).
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new ConstantContactService(
                accessToken: $creds->get('constant_contact', 'access_token', '', $account),
                baseUrl: $creds->get('constant_contact', 'url', 'https://api.cc.email/v3', $account),
            );

            return new $class($service);
        }

        return new $class(app(ConstantContactService::class));
    }
}
