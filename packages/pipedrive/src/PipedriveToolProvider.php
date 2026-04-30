<?php

namespace OpenCompany\Integrations\Pipedrive;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Pipedrive\Tools\PipedriveCreateDeal;
use OpenCompany\Integrations\Pipedrive\Tools\PipedriveGetCurrentUser;
use OpenCompany\Integrations\Pipedrive\Tools\PipedriveGetDeal;
use OpenCompany\Integrations\Pipedrive\Tools\PipedriveGetPerson;
use OpenCompany\Integrations\Pipedrive\Tools\PipedriveListDeals;
use OpenCompany\Integrations\Pipedrive\Tools\PipedriveListOrganizations;
use OpenCompany\Integrations\Pipedrive\Tools\PipedriveListPersons;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\Integrations\Pipedrive\Tools\PipedriveCreateNote;
use OpenCompany\Integrations\Pipedrive\Tools\PipedriveCreateOrganization;
use OpenCompany\Integrations\Pipedrive\Tools\PipedriveCreatePerson;
use OpenCompany\Integrations\Pipedrive\Tools\PipedriveGetOrganization;
use OpenCompany\Integrations\Pipedrive\Tools\PipedriveListPipelines;
use OpenCompany\Integrations\Pipedrive\Tools\PipedriveListStages;
use OpenCompany\Integrations\Pipedrive\Tools\PipedriveSearchOrganizations;
use OpenCompany\Integrations\Pipedrive\Tools\PipedriveSearchPersons;
use OpenCompany\Integrations\Pipedrive\Tools\PipedriveUpdateDeal;
use OpenCompany\Integrations\Pipedrive\Tools\PipedriveUpdateOrganization;
use OpenCompany\Integrations\Pipedrive\Tools\PipedriveUpdatePerson;

/**
 * Registers the integration provider and exposes its tools.
 */
class PipedriveToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{

/**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
          'auth' => [
            'strategy' => 'api_token',
            'legacy_auth_type' => 'api_token',
            'credential_mode' => 'secret',
            'setup_flows' =>
            [
              0 => 'manual_secret',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
            ],
            'notes' =>
            [
            ],
          ],
          'host_availability' => [
            'web' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_secret',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_secret',
              'runtime_mode' => 'normal',
            ],
          ],
          'runtime_requirements' => [
          ],
          'compatibility' => [
            'web_setup_supported' => true,
            'web_runtime_supported' => true,
            'cli_setup_supported' => true,
            'cli_runtime_supported' => true,
          ],
        ];
    }




/**
     * Get the application identifier for this integration.
     */
    public function appName(): string
    {
        return 'pipedrive';
    }

/**
     * Get short metadata describing the integration's capabilities.
     */
    public function appMeta(): array
    {
        return [
            'label'       => 'Pipedrive',
            'description' => 'CRM & sales pipeline',
            'icon'        => 'ph:chart-line-up',
            'logo'        => 'simple-icons:pipedrive',
        ];
    }

/**
     * Get full integration metadata for display and categorization.
     */
    public function integrationMeta(): array
    {
        return [
            'name'        => 'Pipedrive',
            'description' => 'Sales CRM & pipeline management platform',
            'icon'        => 'ph:chart-line-up',
            'logo'        => 'simple-icons:pipedrive',
            'category'    => 'productivity',
            'badge'       => 'verified',
            'docs_url'    => 'https://developers.pipedrive.com/docs/api/v1/',
        ];
    }/**
     * Get the configuration schema for the Pipedrive integration settings UI.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key'         => 'api_token',
                'type'        => 'secret',
                'label'       => 'API Token',
                'placeholder' => 'Enter your Pipedrive API token',
                'hint'        => 'Find your API token in Pipedrive Settings → Personal → API',
                'required'    => true,
            ],
            [
                'key'         => 'url',
                'type'        => 'url',
                'label'       => 'API Base URL',
                'placeholder' => 'https://api.pipedrive.com/v1',
                'hint'        => 'Change only if using a custom Pipedrive API endpoint',
                'default'     => 'https://api.pipedrive.com/v1',
            ],
        ];
    }

    /**
     * Test the connection to the Pipedrive API using the provided config.
     *
     * @param  array<string, mixed>  $config  Configuration containing api_token and optionally url.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiToken = $config['api_token'] ?? '';
        $baseUrl  = rtrim($config['url'] ?? 'https://api.pipedrive.com/v1', '/');

        if (empty($apiToken)) {
            return ['success' => false, 'error' => 'No API token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiToken,
                'Content-Type'  => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error'   => "Could not reach Pipedrive API at {$baseUrl}. Check the URL.",
                ];
            }

            $data = $json['data'] ?? [];
            $name = trim(($data['name'] ?? '') . ' ' . ($data['email'] ?? []));

            return [
                'success' => true,
                'message' => "Connected to Pipedrive API as " . ($name ?: 'authenticated user') . '.',
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the configuration fields.
     *
     * @return array<string, mixed>
     */
    public function validationRules(): array
    {
        return [
            'api_token' => 'nullable|string',
            'url'       => 'nullable|url',
        ];
    }

    /**
     * Get all tools provided by this integration.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
        public function tools(): array
    {
        return [
            'pipedrive_create_deal' => [
                'class' => PipedriveCreateDeal::class,
                'type' => 'write',
                'name' => 'Create Deal',
                'description' => 'Create a new deal in Pipedrive. Provide a title and optionally set value, currency, person, organization, stage, and other deal fields.',
                'icon' => 'ph:wrench',
            ],
            'pipedrive_create_note' => [
                'class' => PipedriveCreateNote::class,
                'type' => 'write',
                'name' => 'Create Note',
                'description' => 'Create a note in Pipedrive CRM attached to a deal, person, or organization. Requires content and at least one associated object ID.',
                'icon' => 'ph:wrench',
            ],
            'pipedrive_create_organization' => [
                'class' => PipedriveCreateOrganization::class,
                'type' => 'write',
                'name' => 'Create Organization',
                'description' => 'Create a new organization in Pipedrive CRM. Requires at least a name.',
                'icon' => 'ph:wrench',
            ],
            'pipedrive_create_person' => [
                'class' => PipedriveCreatePerson::class,
                'type' => 'write',
                'name' => 'Create Person',
                'description' => 'Create a new person in Pipedrive CRM. Requires at least a name. Optionally associate with an organization.',
                'icon' => 'ph:wrench',
            ],
            'pipedrive_get_current_user' => [
                'class' => PipedriveGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the profile of the currently authenticated Pipedrive user â name, email, company, timezone, and other account details.',
                'icon' => 'ph:wrench',
            ],
            'pipedrive_get_deal' => [
                'class' => PipedriveGetDeal::class,
                'type' => 'read',
                'name' => 'Get Deal',
                'description' => 'Get full details for a single deal in Pipedrive, including value, stage, person, organization, and custom fields.',
                'icon' => 'ph:wrench',
            ],
            'pipedrive_get_organization' => [
                'class' => PipedriveGetOrganization::class,
                'type' => 'read',
                'name' => 'Get Organization',
                'description' => 'Retrieve a Pipedrive organization by its ID. Returns name, address, and other details.',
                'icon' => 'ph:wrench',
            ],
            'pipedrive_get_person' => [
                'class' => PipedriveGetPerson::class,
                'type' => 'read',
                'name' => 'Get Person',
                'description' => 'Get full details for a single person (contact) in Pipedrive, including email, phone, organization, and custom fields.',
                'icon' => 'ph:wrench',
            ],
            'pipedrive_list_deals' => [
                'class' => PipedriveListDeals::class,
                'type' => 'read',
                'name' => 'List Deals',
                'description' => 'List deals in Pipedrive with optional filters for user, person, organization, and status. Returns a paginated list of deals with key details.',
                'icon' => 'ph:wrench',
            ],
            'pipedrive_list_organizations' => [
                'class' => PipedriveListOrganizations::class,
                'type' => 'read',
                'name' => 'List Organizations',
                'description' => 'List organizations in Pipedrive. Returns a paginated list with name, address, owner, and other details.',
                'icon' => 'ph:wrench',
            ],
            'pipedrive_list_persons' => [
                'class' => PipedriveListPersons::class,
                'type' => 'read',
                'name' => 'List Persons',
                'description' => 'List persons (contacts) in Pipedrive. Returns a paginated list with name, email, phone, organization, and owner details.',
                'icon' => 'ph:wrench',
            ],
            'pipedrive_list_pipelines' => [
                'class' => PipedriveListPipelines::class,
                'type' => 'read',
                'name' => 'List Pipelines',
                'description' => 'List all pipelines in Pipedrive. Returns pipeline names, IDs, and their stages.',
                'icon' => 'ph:wrench',
            ],
            'pipedrive_list_stages' => [
                'class' => PipedriveListStages::class,
                'type' => 'read',
                'name' => 'List Stages',
                'description' => 'List stages in Pipedrive. Optionally filter by pipeline_id to get stages for a specific pipeline.',
                'icon' => 'ph:wrench',
            ],
            'pipedrive_search_organizations' => [
                'class' => PipedriveSearchOrganizations::class,
                'type' => 'read',
                'name' => 'Search Organizations',
                'description' => 'Search for organizations in Pipedrive by name or other searchable fields.',
                'icon' => 'ph:wrench',
            ],
            'pipedrive_search_persons' => [
                'class' => PipedriveSearchPersons::class,
                'type' => 'read',
                'name' => 'Search Persons',
                'description' => 'Search for persons in Pipedrive by name, email, or other searchable fields.',
                'icon' => 'ph:wrench',
            ],
            'pipedrive_update_deal' => [
                'class' => PipedriveUpdateDeal::class,
                'type' => 'write',
                'name' => 'Update Deal',
                'description' => 'Update an existing deal in Pipedrive CRM. Provide the deal ID and at least one field to update (title, value, stage_id, status).',
                'icon' => 'ph:wrench',
            ],
            'pipedrive_update_organization' => [
                'class' => PipedriveUpdateOrganization::class,
                'type' => 'write',
                'name' => 'Update Organization',
                'description' => 'Update an existing organization in Pipedrive CRM. Provide the organization ID and at least one field to update.',
                'icon' => 'ph:wrench',
            ],
            'pipedrive_update_person' => [
                'class' => PipedriveUpdatePerson::class,
                'type' => 'write',
                'name' => 'Update Person',
                'description' => 'Update an existing person in Pipedrive CRM. Provide the person ID and at least one field to update.',
                'icon' => 'ph:wrench',
            ],
        ];
    }


    /**
     * Get the path to the Lua documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/pipedrive.md';
    }

    /**
     * Get credential field definitions for the integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.pipedrive.com/v1'],
        ];
    }

    /**
     * Confirm this class represents an integration.
     */
    public function isIntegration(): bool
    {        return true;
    }

    /**
     * Create a tool instance, optionally scoped to a specific account.
     *
     * When an account context is provided, credentials are resolved for that
     * specific account. Otherwise the default app-bound service is used.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Context containing optional 'account' key.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new PipedriveService(
                apiToken: $creds->get('pipedrive', 'api_token', '', $account),
                baseUrl: $creds->get('pipedrive', 'url', 'https://api.pipedrive.com/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(PipedriveService::class));
    }
}
