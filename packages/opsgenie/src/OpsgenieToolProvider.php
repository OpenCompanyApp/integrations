<?php

namespace OpenCompany\Integrations\Opsgenie;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;
use OpenCompany\Integrations\Opsgenie\Tools\OpsgenieListAlerts;
use OpenCompany\Integrations\Opsgenie\Tools\OpsgenieGetAlert;
use OpenCompany\Integrations\Opsgenie\Tools\OpsgenieCreateAlert;
use OpenCompany\Integrations\Opsgenie\Tools\OpsgenieListIncidents;
use OpenCompany\Integrations\Opsgenie\Tools\OpsgenieGetIncident;
use OpenCompany\Integrations\Opsgenie\Tools\OpsgenieListTeams;
use OpenCompany\Integrations\Opsgenie\Tools\OpsgenieGetCurrentUser;
use Illuminate\Support\ServiceProvider;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class OpsgenieToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
     * Get the application name identifier.
     */
    public function appName(): string
    {
        return 'opsgenie';
    }

/**
     * Get metadata for the app listing.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Opsgenie',
            'description' => 'Incident management & alerting',
            'icon' => 'ph:bell-ringing',
            'logo' => 'simple-icons:opsgenie',
        ];
    }

/**
     * Get metadata for the integration catalog.
     *
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Opsgenie',
            'description' => 'Incident management and alerting platform by Atlassian',
            'icon' => 'ph:bell-ringing',
            'logo' => 'simple-icons:opsgenie',
            'category' => 'analytics',
            'badge' => 'verified',
            'docs_url' => 'https://docs.opsgenie.com/docs/api-overview',
        ];
    }/**
     * Get the configuration schema for Opsgenie credentials.
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
                'placeholder' => 'Enter your Opsgenie API key',
                'hint' => 'Find your API key in Opsgenie under <strong>Settings → API Key Management</strong>',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the connection to Opsgenie using the /v2/user endpoint.
     *
     * @param  array<string, mixed>  $config  Configuration containing api_key
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'GenieKey ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get('https://api.opsgenie.com/v2/user');

            $json = $response->json();

            if ($response->successful()) {
                $name = trim(($json['data']['fullName'] ?? '') ?: ($json['data']['username'] ?? 'unknown'));

                return [
                    'success' => true,
                    'message' => "Connected to Opsgenie as {$name}.",
                ];
            }

            $error = $json['message'] ?? 'Unknown error';

            return [
                'success' => false,
                'error' => "Opsgenie authentication failed: {$error}",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get the validation rules for configuration fields.
     *
     * @return array<string, string>
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
        ];
    }

    /**
     * Get the list of tools provided by this integration.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            'opsgenie_list_alerts' => [
                'class' => OpsgenieListAlerts::class,
                'type' => 'read',
                'name' => 'List Alerts',
                'description' => 'List Opsgenie alerts with optional filtering by query, status, or priority.',
                'icon' => 'ph:bell',
            ],
            'opsgenie_get_alert' => [
                'class' => OpsgenieGetAlert::class,
                'type' => 'read',
                'name' => 'Get Alert',
                'description' => 'Get details of a specific Opsgenie alert.',
                'icon' => 'ph:bell-ringing',
            ],
            'opsgenie_create_alert' => [
                'class' => OpsgenieCreateAlert::class,
                'type' => 'write',
                'name' => 'Create Alert',
                'description' => 'Create a new Opsgenie alert with message, priority, and routing options.',
                'icon' => 'ph:plus-circle',
            ],
            'opsgenie_list_incidents' => [
                'class' => OpsgenieListIncidents::class,
                'type' => 'read',
                'name' => 'List Incidents',
                'description' => 'List Opsgenie incidents with optional filtering.',
                'icon' => 'ph:warning',
            ],
            'opsgenie_get_incident' => [
                'class' => OpsgenieGetIncident::class,
                'type' => 'read',
                'name' => 'Get Incident',
                'description' => 'Get details of a specific Opsgenie incident.',
                'icon' => 'ph:warning-circle',
            ],
            'opsgenie_list_teams' => [
                'class' => OpsgenieListTeams::class,
                'type' => 'read',
                'name' => 'List Teams',
                'description' => 'List all Opsgenie teams.',
                'icon' => 'ph:users',
            ],
            'opsgenie_get_current_user' => [
                'class' => OpsgenieGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Opsgenie user. Useful for verifying credentials.',
                'icon' => 'ph:user',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/opsgenie.md';
    }

    /**
     * Get the credential fields for Opsgenie authentication.
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
     * Confirm this class is an integration provider.
     */
    public function isIntegration(): bool
    {        return true;
    }

    /**
     * Create a tool instance, optionally resolving credentials for a specific account.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate
     * @param  array<string, mixed>  $context  Context containing optional 'account' key
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            $service = new OpsgenieService(
                apiKey: $creds->get('opsgenie', 'api_key', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(OpsgenieService::class));
    }
}
