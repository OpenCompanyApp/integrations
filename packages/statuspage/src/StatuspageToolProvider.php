<?php

namespace OpenCompany\Integrations\Statuspage;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Statuspage\Tools\StatuspageCreateComponent;
use OpenCompany\Integrations\Statuspage\Tools\StatuspageCreateIncident;
use OpenCompany\Integrations\Statuspage\Tools\StatuspageDeleteComponent;
use OpenCompany\Integrations\Statuspage\Tools\StatuspageDeleteIncident;
use OpenCompany\Integrations\Statuspage\Tools\StatuspageGetComponent;
use OpenCompany\Integrations\Statuspage\Tools\StatuspageGetCurrentUser;
use OpenCompany\Integrations\Statuspage\Tools\StatuspageGetPage;
use OpenCompany\Integrations\Statuspage\Tools\StatuspageListComponents;
use OpenCompany\Integrations\Statuspage\Tools\StatuspageListIncidents;
use OpenCompany\Integrations\Statuspage\Tools\StatuspageListPages;
use OpenCompany\Integrations\Statuspage\Tools\StatuspageListUnresolvedIncidents;
use OpenCompany\Integrations\Statuspage\Tools\StatuspageListUpcomingIncidents;
use OpenCompany\Integrations\Statuspage\Tools\StatuspageUpdateComponent;
use OpenCompany\Integrations\Statuspage\Tools\StatuspageUpdateIncident;

/**
 * Tool provider for the Atlassian Statuspage integration.
 *
 * Defines catalog metadata, credential setup, multi-account service resolution, and tool classes.
 */
class StatuspageToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => [],
                'notes' => [],
            ],
            'host_availability' => [
                'web' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_secret',
                ],
                'cli' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_secret',
                    'runtime_mode' => 'normal',
                ],
            ],
            'runtime_requirements' => [],
            'compatibility' => [
                'web_setup_supported' => true,
                'web_runtime_supported' => true,
                'cli_setup_supported' => true,
                'cli_runtime_supported' => true,
            ],
        ];
    }

    public function appName(): string
    {
        return 'statuspage';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Atlassian Statuspage',
            'description' => 'Service status, component, and incident management.',
            'icon' => 'ph:signal',
            'logo' => 'simple-icons:atlassian',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Atlassian Statuspage',
            'description' => 'Manage pages, components, incidents, and scheduled maintenance with Atlassian Statuspage.',
            'icon' => 'ph:signal',
            'logo' => 'simple-icons:atlassian',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developer.statuspage.io/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Statuspage API key',
                'hint' => 'Generate an API key in your Statuspage account settings under "API Keys".',
                'required' => true,
            ],
            [
                'key' => 'page_id',
                'type' => 'string',
                'label' => 'Page ID',
                'placeholder' => 'e.g. page-test',
                'hint' => 'Use statuspage_list_pages to discover the page ID if you do not know it.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.statuspage.io/v1',
                'hint' => 'Use the default Atlassian cloud URL unless a compatible proxy is required.',
                'default' => 'https://api.statuspage.io/v1',
            ],
        ];
    }

    /**
     * Verify the supplied API key with a lightweight current-user request.
     *
     * @param  array<string, mixed>  $config  Credential form values.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.statuspage.io/v1', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'OAuth ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            if ($response->successful()) {
                $user = $response->json();
                $email = $user['email'] ?? 'unknown';

                return [
                    'success' => true,
                    'message' => "Connected to Statuspage API as {$email}.",
                ];
            }

            return [
                'success' => false,
                'error' => "Statuspage API returned HTTP {$response->status()}. Check your API key.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'page_id' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'statuspage_get_current_user' => [
                'class' => StatuspageGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Statuspage user.',
                'icon' => 'ph:user-circle',
            ],
            'statuspage_list_pages' => [
                'class' => StatuspageListPages::class,
                'type' => 'read',
                'name' => 'List Pages',
                'description' => 'List Statuspage pages visible to the API key.',
                'icon' => 'ph:browser',
            ],
            'statuspage_get_page' => [
                'class' => StatuspageGetPage::class,
                'type' => 'read',
                'name' => 'Get Page',
                'description' => 'Get details for the configured or supplied Statuspage page.',
                'icon' => 'ph:file-text',
            ],
            'statuspage_list_incidents' => [
                'class' => StatuspageListIncidents::class,
                'type' => 'read',
                'name' => 'List Incidents',
                'description' => 'List incidents for the configured Statuspage page.',
                'icon' => 'ph:list-bullets',
            ],
            'statuspage_list_unresolved_incidents' => [
                'class' => StatuspageListUnresolvedIncidents::class,
                'type' => 'read',
                'name' => 'List Unresolved Incidents',
                'description' => 'List currently unresolved incidents.',
                'icon' => 'ph:warning',
            ],
            'statuspage_list_upcoming_incidents' => [
                'class' => StatuspageListUpcomingIncidents::class,
                'type' => 'read',
                'name' => 'List Upcoming Incidents',
                'description' => 'List upcoming scheduled maintenance incidents.',
                'icon' => 'ph:calendar',
            ],
            'statuspage_create_incident' => [
                'class' => StatuspageCreateIncident::class,
                'type' => 'write',
                'name' => 'Create Incident',
                'description' => 'Create a new incident or scheduled maintenance entry.',
                'icon' => 'ph:warning-circle',
            ],
            'statuspage_update_incident' => [
                'class' => StatuspageUpdateIncident::class,
                'type' => 'write',
                'name' => 'Update Incident',
                'description' => 'Update an existing Statuspage incident.',
                'icon' => 'ph:pencil-simple',
            ],
            'statuspage_delete_incident' => [
                'class' => StatuspageDeleteIncident::class,
                'type' => 'write',
                'name' => 'Delete Incident',
                'description' => 'Delete an incident from the configured page.',
                'icon' => 'ph:trash',
            ],
            'statuspage_list_components' => [
                'class' => StatuspageListComponents::class,
                'type' => 'read',
                'name' => 'List Components',
                'description' => 'List components on the configured Statuspage page.',
                'icon' => 'ph:squares-four',
            ],
            'statuspage_get_component' => [
                'class' => StatuspageGetComponent::class,
                'type' => 'read',
                'name' => 'Get Component',
                'description' => 'Get one Statuspage component by ID.',
                'icon' => 'ph:square',
            ],
            'statuspage_create_component' => [
                'class' => StatuspageCreateComponent::class,
                'type' => 'write',
                'name' => 'Create Component',
                'description' => 'Create a component on the configured page.',
                'icon' => 'ph:plus-square',
            ],
            'statuspage_update_component' => [
                'class' => StatuspageUpdateComponent::class,
                'type' => 'write',
                'name' => 'Update Component',
                'description' => 'Update a component status or metadata.',
                'icon' => 'ph:arrows-clockwise',
            ],
            'statuspage_delete_component' => [
                'class' => StatuspageDeleteComponent::class,
                'type' => 'write',
                'name' => 'Delete Component',
                'description' => 'Delete a component from the configured page.',
                'icon' => 'ph:trash-simple',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/statuspage.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'page_id', 'type' => 'string', 'label' => 'Page ID', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.statuspage.io/v1'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new $class(new StatuspageService(
                apiKey: $creds->get('statuspage', 'api_key', '', $account),
                pageId: $creds->get('statuspage', 'page_id', '', $account),
                baseUrl: $creds->get('statuspage', 'url', 'https://api.statuspage.io/v1', $account),
            ));
        }

        return new $class(app(StatuspageService::class));
    }
}
