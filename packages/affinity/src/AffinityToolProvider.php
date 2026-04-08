<?php

namespace OpenCompany\Integrations\Affinity;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Affinity\Tools\AffinityListContacts;
use OpenCompany\Integrations\Affinity\Tools\AffinityGetContact;
use OpenCompany\Integrations\Affinity\Tools\AffinityCreateContact;
use OpenCompany\Integrations\Affinity\Tools\AffinityListOrganizations;
use OpenCompany\Integrations\Affinity\Tools\AffinityGetOrganization;
use OpenCompany\Integrations\Affinity\Tools\AffinityCreateOrganization;
use OpenCompany\Integrations\Affinity\Tools\AffinityListLists;
use OpenCompany\Integrations\Affinity\Tools\AffinityGetCurrentUser;

/**
 * Tool provider for the Affinity CRM integration.
 *
 * Implements ConfigurableIntegration for multi-account support and
 * registers all Affinity tools with the integration core.
 */
class AffinityToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * The application name used as the integration identifier.
     */
    public function appName(): string
    {
        return 'affinity';
    }

    /**
     * Metadata for the integration UI.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'contacts, organizations, lists',
            'description' => 'CRM & relationship intelligence',
            'icon' => 'ph:address-book',
            'logo' => 'simple-icons:affinity',
        ];
    }

    /**
     * Integration metadata for marketplace and documentation.
     *
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Affinity',
            'description' => 'Relationship intelligence platform for managing contacts and organizations',
            'icon' => 'ph:address-book',
            'logo' => 'simple-icons:affinity',
            'category' => 'crm',
            'badge' => 'verified',
            'docs_url' => 'https://api-docs.affinity.co/',
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
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Affinity API key',
                'hint' => 'Find your API key in Affinity Settings &gt; API',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the connection to the Affinity API.
     *
     * @param  array<string, mixed>  $config  Configuration values to test.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.affinity.co', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withBasicAuth($apiKey, '')
                ->withHeaders(['Content-Type' => 'application/json'])
                ->timeout(10)
                ->get($baseUrl . '/auth/user');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Affinity API at {$baseUrl}. Check the URL.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Affinity API as {$json['first_name']} {$json['last_name']}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Validation rules for the configuration values.
     *
     * @return array<string, string|array<int, string>>
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
        ];
    }

    /**
     * Return all available Affinity tools.
     *
     * @return array<string, array{class: string, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'affinity_list_contacts' => [
                'class' => AffinityListContacts::class,
                'type' => 'read',
                'name' => 'List Contacts',
                'description' => 'List contacts in Affinity CRM.',
                'icon' => 'ph:users',
            ],
            'affinity_get_contact' => [
                'class' => AffinityGetContact::class,
                'type' => 'read',
                'name' => 'Get Contact',
                'description' => 'Get details for a specific contact.',
                'icon' => 'ph:user',
            ],
            'affinity_create_contact' => [
                'class' => AffinityCreateContact::class,
                'type' => 'write',
                'name' => 'Create Contact',
                'description' => 'Create a new contact in Affinity.',
                'icon' => 'ph:user-plus',
            ],
            'affinity_list_organizations' => [
                'class' => AffinityListOrganizations::class,
                'type' => 'read',
                'name' => 'List Organizations',
                'description' => 'List organizations in Affinity CRM.',
                'icon' => 'ph:buildings',
            ],
            'affinity_get_organization' => [
                'class' => AffinityGetOrganization::class,
                'type' => 'read',
                'name' => 'Get Organization',
                'description' => 'Get details for a specific organization.',
                'icon' => 'ph:building',
            ],
            'affinity_create_organization' => [
                'class' => AffinityCreateOrganization::class,
                'type' => 'write',
                'name' => 'Create Organization',
                'description' => 'Create a new organization in Affinity.',
                'icon' => 'ph:building',
            ],
            'affinity_list_lists' => [
                'class' => AffinityListLists::class,
                'type' => 'read',
                'name' => 'List Lists',
                'description' => 'List all lists in Affinity.',
                'icon' => 'ph:list-bullets',
            ],
            'affinity_get_current_user' => [
                'class' => AffinityGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Affinity user.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    /**
     * Path to the Lua documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/affinity.md';
    }

    /**
     * Credential fields for the integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
        ];
    }

    /**
     * Whether this class represents an integration (always true).
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally for a specific account.
     *
     * Supports multi-account by resolving credentials for the given account.
     *
     * @param  string  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Context containing optional 'account' key.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new AffinityService(
                apiKey: $creds->get('affinity', 'api_key', '', $account),
                baseUrl: $creds->get('affinity', 'url', 'https://api.affinity.co', $account),
            );

            return new $class($service);
        }

        return new $class(app(AffinityService::class));
    }
}
