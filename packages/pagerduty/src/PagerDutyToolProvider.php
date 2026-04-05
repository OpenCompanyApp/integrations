<?php

namespace OpenCompany\Integrations\PagerDuty;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\PagerDuty\Tools\PagerDutyCreateIncidentNote;
use OpenCompany\Integrations\PagerDuty\Tools\PagerDutyGetIncident;
use OpenCompany\Integrations\PagerDuty\Tools\PagerDutyGetService;
use OpenCompany\Integrations\PagerDuty\Tools\PagerDutyGetUser;
use OpenCompany\Integrations\PagerDuty\Tools\PagerDutyListIncidents;
use OpenCompany\Integrations\PagerDuty\Tools\PagerDutyListOnCalls;
use OpenCompany\Integrations\PagerDuty\Tools\PagerDutyListServices;
use OpenCompany\Integrations\PagerDuty\Tools\PagerDutyListTeams;
use OpenCompany\Integrations\PagerDuty\Tools\PagerDutyListUsers;
use OpenCompany\Integrations\PagerDuty\Tools\PagerDutyUpdateIncident;

/**
 * Registers all PagerDuty tools and provides integration metadata.
 *
 * Implements both {@see ToolProvider} (for tool registration) and
 * {@see ConfigurableIntegration} (for configuration schema, connection
 * testing, and credential field definitions).
 */
class PagerDutyToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * Return the integration slug used for credential lookup.
     */
    public function appName(): string
    {
        return 'pagerduty';
    }

    /**
     * Return short metadata for tool-catalog display.
     *
     * @return array{label: string, description: string, icon: string, logo: string}
     */
    public function appMeta(): array
    {
        return [
            'label' => 'incidents, services, on-call',
            'description' => 'Incident management & monitoring',
            'icon' => 'ph:siren',
            'logo' => 'simple-icons:pagerduty',
        ];
    }

    /**
     * Return full integration metadata for the settings UI.
     *
     * @return array{name: string, description: string, icon: string, logo: string, category: string, badge: string, docs_url: string}
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'PagerDuty',
            'description' => 'Incident management, on-call scheduling, and service monitoring',
            'icon' => 'ph:siren',
            'logo' => 'simple-icons:pagerduty',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developer.pagerduty.com/api-reference/',
        ];
    }

    /**
     * Return the credential configuration schema for the settings UI.
     *
     * @return array<int, array{key: string, type: string, label: string, placeholder: string, hint: string, required: bool}>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'y_NbAkKc66ryYTWUXYEu...',
                'hint' => 'Generate in PagerDuty → Developer → API Access Keys. Use a token with read/write permissions for incidents, services, teams, and users.',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the PagerDuty connection by fetching a single user.
     *
     * Validates that the API token is correct and the PagerDuty account
     * is reachable. Returns the total user count on success.
     *
     * @param  array<string, mixed>  $config  Configuration containing 'api_token'
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiToken = $config['api_token'] ?? '';

        if (empty($apiToken)) {
            return ['success' => false, 'error' => 'No API token provided. Generate one at PagerDuty → Developer → API Access Keys.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Token token=' . $apiToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(10)
              ->get('https://api.pagerduty.com/users', ['limit' => 1]);

            if ($response->successful()) {
                $json = $response->json() ?? [];
                $total = $json['total'] ?? 0;
                $count = count($json['users'] ?? []);

                return [
                    'success' => true,
                    'message' => "Connected to PagerDuty. Found {$total} user(s) in the account.",
                ];
            }

            $error = $response->json('error.message') ?? $response->body();

            return [
                'success' => false,
                'error' => 'PagerDuty API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Return Laravel validation rules for the configuration fields.
     *
     * @return array<string, string>
     */
    public function validationRules(): array
    {
        return [
            'api_token' => 'nullable|string',
        ];
    }

    /**
     * Return the full catalog of PagerDuty tools.
     *
     * Each entry maps a tool slug to its class, type, display name,
     * description, and icon for the tool registry.
     *
     * @return array<string, array{class: string, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            // Incidents
            'pagerduty_list_incidents' => [
                'class' => PagerDutyListIncidents::class,
                'type' => 'read',
                'name' => 'List Incidents',
                'description' => 'List PagerDuty incidents with optional filtering by status, service, and urgency.',
                'icon' => 'ph:list-bullets',
            ],
            'pagerduty_get_incident' => [
                'class' => PagerDutyGetIncident::class,
                'type' => 'read',
                'name' => 'Get Incident',
                'description' => 'Retrieve a PagerDuty incident by ID.',
                'icon' => 'ph:warning-circle',
            ],
            'pagerduty_update_incident' => [
                'class' => PagerDutyUpdateIncident::class,
                'type' => 'write',
                'name' => 'Update Incident',
                'description' => 'Update a PagerDuty incident\'s status and priority.',
                'icon' => 'ph:pencil-simple',
            ],
            'pagerduty_create_incident_note' => [
                'class' => PagerDutyCreateIncidentNote::class,
                'type' => 'write',
                'name' => 'Create Incident Note',
                'description' => 'Add a note to a PagerDuty incident.',
                'icon' => 'ph:note',
            ],
            // Services
            'pagerduty_list_services' => [
                'class' => PagerDutyListServices::class,
                'type' => 'read',
                'name' => 'List Services',
                'description' => 'List PagerDuty services with optional filtering by team.',
                'icon' => 'ph:gear-six',
            ],
            'pagerduty_get_service' => [
                'class' => PagerDutyGetService::class,
                'type' => 'read',
                'name' => 'Get Service',
                'description' => 'Retrieve a PagerDuty service by ID.',
                'icon' => 'ph:gear-six',
            ],
            // Teams
            'pagerduty_list_teams' => [
                'class' => PagerDutyListTeams::class,
                'type' => 'read',
                'name' => 'List Teams',
                'description' => 'List PagerDuty teams.',
                'icon' => 'ph:users-three',
            ],
            // Users
            'pagerduty_list_users' => [
                'class' => PagerDutyListUsers::class,
                'type' => 'read',
                'name' => 'List Users',
                'description' => 'List PagerDuty users with optional filtering by team.',
                'icon' => 'ph:users',
            ],
            'pagerduty_get_user' => [
                'class' => PagerDutyGetUser::class,
                'type' => 'read',
                'name' => 'Get User',
                'description' => 'Retrieve a PagerDuty user by ID.',
                'icon' => 'ph:user',
            ],
            // On-Call
            'pagerduty_list_on_calls' => [
                'class' => PagerDutyListOnCalls::class,
                'type' => 'read',
                'name' => 'List On-Calls',
                'description' => 'List current PagerDuty on-call entries.',
                'icon' => 'ph:bell-ringing',
            ],
        ];
    }

    /**
     * Return the path to the Lua documentation file for PagerDuty tools.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/pagerduty.md';
    }

    /**
     * Return simplified credential field definitions for CLI flows.
     *
     * @return array<int, array{key: string, type: string, label: string, required: bool}>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
        ];
    }

    /**
     * Indicate that this provider is an integration (requires credentials).
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance with the resolved PagerDuty service.
     *
     * @param  string  $class  Fully-qualified tool class name
     * @param  array<string, mixed>  $context  Optional context (may include 'account' for multi-tenant)
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the PagerDutyService, with optional account-specific credentials.
     *
     * When an `account` key is present in the context, credentials are
     * resolved for that specific account. Otherwise, the default singleton
     * service from the container is used.
     *
     * @param  array<string, mixed>  $context  Resolution context
     */
    private function resolveService(array $context = []): PagerDutyService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new PagerDutyService(
                apiToken: $creds->get('pagerduty', 'api_token', '', $account),
            );
        }

        return app(PagerDutyService::class);
    }
}
