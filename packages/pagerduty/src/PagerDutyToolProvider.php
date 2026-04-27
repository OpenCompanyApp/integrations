<?php

namespace OpenCompany\Integrations\Pagerduty;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Pagerduty\Tools\PagerdutyListIncidents;
use OpenCompany\Integrations\Pagerduty\Tools\PagerdutyGetIncident;
use OpenCompany\Integrations\Pagerduty\Tools\PagerdutyListServices;
use OpenCompany\Integrations\Pagerduty\Tools\PagerdutyGetService;
use OpenCompany\Integrations\Pagerduty\Tools\PagerdutyListTeams;
use OpenCompany\Integrations\Pagerduty\Tools\PagerdutyGetTeam;
use OpenCompany\Integrations\Pagerduty\Tools\PagerdutyGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class PagerDutyToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'pagerduty';
    }

/**
     * Get short metadata describing the integration's capabilities.
     */
    public function appMeta(): array
    {
        return [
            'label'       => 'incidents, services, teams',
            'description' => 'Incident management & response',
            'icon'        => 'ph:siren',
            'logo'        => 'simple-icons:pagerduty',
        ];
    }

/**
     * Get full integration metadata for display and categorization.
     */
    public function integrationMeta(): array
    {
        return [
            'name'        => 'PagerDuty',
            'description' => 'Incident management and real-time operations platform',
            'icon'        => 'ph:siren',
            'logo'        => 'simple-icons:pagerduty',
            'category'    => 'productivity',
            'badge'       => 'verified',
            'docs_url'    => 'https://developer.pagerduty.com/api-reference/',
        ];
    }/**
     * Get the configuration schema for the PagerDuty integration settings UI.
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
                'placeholder' => 'Enter your PagerDuty API token',
                'hint'        => 'Generate a General Access REST API token in PagerDuty under Developer Tools → API Access Keys',
                'required'    => true,
            ],
            [
                'key'         => 'base_url',
                'type'        => 'url',
                'label'       => 'API Base URL',
                'placeholder' => 'https://api.pagerduty.com',
                'hint'        => 'Change only if using a PagerDuty account with a custom API endpoint',
                'default'     => 'https://api.pagerduty.com',
            ],
        ];
    }

    /**
     * Test the connection to the PagerDuty API using the provided config.
     *
     * @param  array<string, mixed>  $config  Configuration containing api_token and optionally base_url.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiToken = $config['api_token'] ?? '';
        $baseUrl  = rtrim($config['base_url'] ?? 'https://api.pagerduty.com', '/');

        if (empty($apiToken)) {
            return ['success' => false, 'error' => 'No API token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiToken,
                'Accept' => 'application/vnd.pagerduty+json;version=2',
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error'   => "Could not reach PagerDuty API at {$baseUrl}. Check the URL.",
                ];
            }

            $name = ($json['user']['name'] ?? 'Unknown');

            return [
                'success' => true,
                'message' => "Connected to PagerDuty as {$name}.",
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
            'base_url'  => 'nullable|url',
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
            'pagerduty_list_incidents' => [
                'class'       => PagerdutyListIncidents::class,
                'type'        => 'read',
                'name'        => 'List Incidents',
                'description' => 'List PagerDuty incidents with optional filters.',
                'icon'        => 'ph:warning-circle',
            ],
            'pagerduty_get_incident' => [
                'class'       => PagerdutyGetIncident::class,
                'type'        => 'read',
                'name'        => 'Get Incident',
                'description' => 'Get details for a single PagerDuty incident.',
                'icon'        => 'ph:warning-circle',
            ],
            'pagerduty_list_services' => [
                'class'       => PagerdutyListServices::class,
                'type'        => 'read',
                'name'        => 'List Services',
                'description' => 'List PagerDuty services.',
                'icon'        => 'ph:cube',
            ],
            'pagerduty_get_service' => [
                'class'       => PagerdutyGetService::class,
                'type'        => 'read',
                'name'        => 'Get Service',
                'description' => 'Get details for a single PagerDuty service.',
                'icon'        => 'ph:cube',
            ],
            'pagerduty_list_teams' => [
                'class'       => PagerdutyListTeams::class,
                'type'        => 'read',
                'name'        => 'List Teams',
                'description' => 'List PagerDuty teams.',
                'icon'        => 'ph:users-three',
            ],
            'pagerduty_get_team' => [
                'class'       => PagerdutyGetTeam::class,
                'type'        => 'read',
                'name'        => 'Get Team',
                'description' => 'Get details for a single PagerDuty team.',
                'icon'        => 'ph:users-three',
            ],
            'pagerduty_get_current_user' => [
                'class'       => PagerdutyGetCurrentUser::class,
                'type'        => 'read',
                'name'        => 'Get Current User',
                'description' => 'Get the authenticated PagerDuty user profile.',
                'icon'        => 'ph:user-circle',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/pagerduty.md';
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
            ['key' => 'base_url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.pagerduty.com'],
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

            $service = new PagerdutyService(
                apiToken: $creds->get('pagerduty', 'api_token', '', $account),
                baseUrl: $creds->get('pagerduty', 'base_url', 'https://api.pagerduty.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(PagerdutyService::class));
    }
}
