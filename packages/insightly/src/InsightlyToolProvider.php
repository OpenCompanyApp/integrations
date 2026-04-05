<?php

namespace OpenCompany\Integrations\Insightly;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Insightly\Tools\InsightlyCreateContact;
use OpenCompany\Integrations\Insightly\Tools\InsightlyCreateDeal;
use OpenCompany\Integrations\Insightly\Tools\InsightlyGetContact;
use OpenCompany\Integrations\Insightly\Tools\InsightlyGetDeal;
use OpenCompany\Integrations\Insightly\Tools\InsightlyGetCurrentUser;
use OpenCompany\Integrations\Insightly\Tools\InsightlyListContacts;
use OpenCompany\Integrations\Insightly\Tools\InsightlyListDeals;
use OpenCompany\Integrations\Insightly\Tools\InsightlyListProjects;
use OpenCompany\Integrations\Insightly\Tools\InsightlyUpdateContact;

/**
 * Tool provider for the Insightly CRM integration.
 *
 * Implements ConfigurableIntegration for multi-account support with
 * api_key and region configuration. Provides 9 tools for managing
 * contacts, deals (opportunities), projects, and user info.
 */
class InsightlyToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * Get the application name identifier.
     */
    public function appName(): string
    {
        return 'insightly';
    }

    /**
     * Get metadata for the application display.
     *
     * @return array<string, mixed> Application metadata with label, description, icons.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'contacts, deals, projects',
            'description' => 'CRM & project management',
            'icon' => 'ph:address-book',
            'logo' => 'simple-icons:insightly',
        ];
    }

    /**
     * Get integration metadata for the OpenCompany integrations UI.
     *
     * @return array<string, mixed> Integration metadata with name, description, category, etc.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Insightly CRM',
            'description' => 'CRM platform for managing contacts, deals, and projects',
            'icon' => 'ph:address-book',
            'logo' => 'simple-icons:insightly',
            'category' => 'crm',
            'badge' => 'verified',
            'docs_url' => 'https://api.na1.insightly.com/v3.1/Help',
        ];
    }

    /**
     * Get the configuration schema for the Insightly integration.
     *
     * Defines the api_key and region fields required to connect to the Insightly API.
     *
     * @return array<int, array<string, mixed>> Configuration field definitions.
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Insightly API key',
                'hint' => 'Find your API key in Insightly under <strong>User Settings &gt; API Keys</strong>',
                'required' => true,
            ],
            [
                'key' => 'region',
                'type' => 'select',
                'label' => 'API Region',
                'hint' => 'Select the region that matches your Insightly account. Find it in your Insightly URL (e.g., <code>na1</code> from <code>na1.insightly.com</code>).',
                'required' => true,
                'default' => 'na1',
                'options' => [
                    ['value' => 'na1', 'label' => 'North America (na1)'],
                    ['value' => 'eu1', 'label' => 'Europe (eu1)'],
                    ['value' => 'au1', 'label' => 'Australia (au1)'],
                ],
            ],
        ];
    }

    /**
     * Test the connection to the Insightly API using the provided configuration.
     *
     * @param  array<string, mixed>  $config  Configuration containing 'api_key' and 'region'.
     * @return array{success: bool, message?: string, error?: string} Connection test result.
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $region = $config['region'] ?? 'na1';

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $baseUrl = 'https://api.' . $region . '.insightly.com/v3.1';

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->withBasicAuth($apiKey, '')->timeout(10)->get($baseUrl . '/Users/me');

            if ($response->successful()) {
                $user = $response->json();
                $name = trim(($user['FIRST_NAME'] ?? '') . ' ' . ($user['LAST_NAME'] ?? ''));

                return [
                    'success' => true,
                    'message' => "Connected to Insightly API ({$region}) as {$name}.",
                ];
            }

            return [
                'success' => false,
                'error' => "API returned HTTP {$response->status()}. Check your API key and region.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the Insightly configuration.
     *
     * @return array<string, string|array<int, string>> Laravel validation rules.
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'region' => 'nullable|string|in:na1,eu1,au1',
        ];
    }

    /**
     * Get the list of tools provided by this integration.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'insightly_list_contacts' => [
                'class' => InsightlyListContacts::class,
                'type' => 'read',
                'name' => 'List Contacts',
                'description' => 'List contacts from Insightly CRM.',
                'icon' => 'ph:users',
            ],
            'insightly_get_contact' => [
                'class' => InsightlyGetContact::class,
                'type' => 'read',
                'name' => 'Get Contact',
                'description' => 'Get a single contact by ID.',
                'icon' => 'ph:user',
            ],
            'insightly_create_contact' => [
                'class' => InsightlyCreateContact::class,
                'type' => 'write',
                'name' => 'Create Contact',
                'description' => 'Create a new contact in Insightly.',
                'icon' => 'ph:user-plus',
            ],
            'insightly_update_contact' => [
                'class' => InsightlyUpdateContact::class,
                'type' => 'write',
                'name' => 'Update Contact',
                'description' => 'Update an existing contact in Insightly.',
                'icon' => 'ph:pencil',
            ],
            'insightly_list_deals' => [
                'class' => InsightlyListDeals::class,
                'type' => 'read',
                'name' => 'List Deals',
                'description' => 'List deals (opportunities) from Insightly.',
                'icon' => 'ph:handshake',
            ],
            'insightly_get_deal' => [
                'class' => InsightlyGetDeal::class,
                'type' => 'read',
                'name' => 'Get Deal',
                'description' => 'Get a single deal (opportunity) by ID.',
                'icon' => 'ph:handshake',
            ],
            'insightly_create_deal' => [
                'class' => InsightlyCreateDeal::class,
                'type' => 'write',
                'name' => 'Create Deal',
                'description' => 'Create a new deal (opportunity) in Insightly.',
                'icon' => 'ph:plus',
            ],
            'insightly_list_projects' => [
                'class' => InsightlyListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List projects from Insightly.',
                'icon' => 'ph:folder',
            ],
            'insightly_get_current_user' => [
                'class' => InsightlyGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Insightly user.',
                'icon' => 'ph:identification-card',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/insightly.md';
    }

    /**
     * Get the credential fields required for this integration.
     *
     * @return array<int, array<string, mixed>> Credential field definitions.
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'region', 'type' => 'select', 'label' => 'API Region', 'required' => true, 'default' => 'na1'],
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
     * Create a tool instance, optionally using account-specific credentials.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Context containing optional 'account' for multi-account support.
     * @return Tool The instantiated tool.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new InsightlyService(
                apiKey: $creds->get('insightly', 'api_key', '', $account),
                region: $creds->get('insightly', 'region', 'na1', $account),
            );

            return new $class($service);
        }

        return new $class(app(InsightlyService::class));
    }
}
