<?php

namespace OpenCompany\Integrations\Close;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Close\Tools\CloseCreateTask;
use OpenCompany\Integrations\Close\Tools\CloseCreateLead;
use OpenCompany\Integrations\Close\Tools\CloseDeleteLead;
use OpenCompany\Integrations\Close\Tools\CloseGetCurrentUser;
use OpenCompany\Integrations\Close\Tools\CloseGetLead;
use OpenCompany\Integrations\Close\Tools\CloseListActivities;
use OpenCompany\Integrations\Close\Tools\CloseListContacts;
use OpenCompany\Integrations\Close\Tools\CloseListLeads;
use OpenCompany\Integrations\Close\Tools\CloseUpdateLead;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class CloseToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'api_key',
            'legacy_auth_type' => 'api_key',
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
        return 'close';
    }

/**
     * Get short metadata describing the integration's capabilities.
     */
    public function appMeta(): array
    {
        return [
            'label'       => 'Close CRM',
            'description' => 'CRM & sales engagement',
            'icon'        => 'ph:buildings',
            'logo'        => 'simple-icons:close',
        ];
    }

/**
     * Get full integration metadata for display and categorization.
     */
    public function integrationMeta(): array
    {
        return [
            'name'        => 'Close CRM',
            'description' => 'Sales-driven CRM for startups and SMBs',
            'icon'        => 'ph:buildings',
            'logo'        => 'simple-icons:close',
            'category'    => 'crm',
            'badge'       => 'verified',
            'docs_url'    => 'https://developer.close.com/',
        ];
    }/**
     * Get the configuration schema for the Close integration settings UI.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key'         => 'api_key',
                'type'        => 'secret',
                'label'       => 'API Key',
                'placeholder' => 'Enter your Close API key',
                'hint'        => 'Generate an API key in Close under Settings → API Keys',
                'required'    => true,
            ],
            [
                'key'         => 'url',
                'type'        => 'url',
                'label'       => 'API Base URL',
                'placeholder' => 'https://api.close.com/api/v1',
                'hint'        => 'Change only if using a custom Close API endpoint',
                'default'     => 'https://api.close.com/api/v1',
            ],
        ];
    }

    /**
     * Test the connection to the Close API using the provided config.
     *
     * @param  array<string, mixed>  $config  Configuration containing api_key and optionally url.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey  = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.close.com/api/v1', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withBasicAuth($apiKey, '')
                ->withHeaders(['Content-Type' => 'application/json'])
                ->timeout(10)
                ->get($baseUrl . '/user/');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error'   => "Could not reach Close API at {$baseUrl}. Check the URL.",
                ];
            }

            $name = $json['first_name'] ?? '' . ' ' . $json['last_name'] ?? '';
            $org  = $json['organizations'][0]['name'] ?? '';

            return [
                'success' => true,
                'message' => "Connected to Close API as {$name}" . ($org ? " ({$org})" : '') . '.',
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
            'api_key' => 'nullable|string',
            'url'     => 'nullable|url',
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
            'close_list_leads' => [
                'class'       => CloseListLeads::class,
                'type'        => 'read',
                'name'        => 'List Leads',
                'description' => 'Search and list leads in Close.',
                'icon'        => 'ph:magnifying-glass',
            ],
            'close_get_lead' => [
                'class'       => CloseGetLead::class,
                'type'        => 'read',
                'name'        => 'Get Lead',
                'description' => 'Get details for a single lead.',
                'icon'        => 'ph:buildings',
            ],
            'close_create_lead' => [
                'class'       => CloseCreateLead::class,
                'type'        => 'write',
                'name'        => 'Create Lead',
                'description' => 'Create a new lead with contacts.',
                'icon'        => 'ph:plus-circle',
            ],
            'close_update_lead' => [
                'class'       => CloseUpdateLead::class,
                'type'        => 'write',
                'name'        => 'Update Lead',
                'description' => 'Update an existing lead.',
                'icon'        => 'ph:pencil-simple',
            ],
            'close_delete_lead' => [
                'class'       => CloseDeleteLead::class,
                'type'        => 'write',
                'name'        => 'Delete Lead',
                'description' => 'Delete a lead.',
                'icon'        => 'ph:trash',
            ],
            'close_list_contacts' => [
                'class'       => CloseListContacts::class,
                'type'        => 'read',
                'name'        => 'List Contacts',
                'description' => 'List contacts in Close.',
                'icon'        => 'ph:users',
            ],
            'close_list_activities' => [
                'class'       => CloseListActivities::class,
                'type'        => 'read',
                'name'        => 'List Activities',
                'description' => 'List activities (emails, calls, notes).',
                'icon'        => 'ph:list-bullets',
            ],
            'close_create_task' => [
                'class'       => CloseCreateTask::class,
                'type'        => 'write',
                'name'        => 'Create Task',
                'description' => 'Create a new task.',
                'icon'        => 'ph:check-square',
            ],
            'close_get_current_user' => [
                'class'       => CloseGetCurrentUser::class,
                'type'        => 'read',
                'name'        => 'Get Current User',
                'description' => 'Get the authenticated user profile.',
                'icon'        => 'ph:user-circle',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/close.md';
    }

    /**
     * Get credential field definitions for the integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.close.com/api/v1'],
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

            $service = new CloseService(
                apiKey: $creds->get('close', 'api_key', '', $account),
                baseUrl: $creds->get('close', 'url', 'https://api.close.com/api/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(CloseService::class));
    }
}
