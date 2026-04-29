<?php

namespace OpenCompany\Integrations\AcuityScheduling;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\AcuityScheduling\Tools\AcuityCancelAppointment;
use OpenCompany\Integrations\AcuityScheduling\Tools\AcuityGetAppointment;
use OpenCompany\Integrations\AcuityScheduling\Tools\AcuityGetAvailability;
use OpenCompany\Integrations\AcuityScheduling\Tools\AcuityGetCurrentUser;
use OpenCompany\Integrations\AcuityScheduling\Tools\AcuityListAppointmentTypes;
use OpenCompany\Integrations\AcuityScheduling\Tools\AcuityListAppointments;
use OpenCompany\Integrations\AcuityScheduling\Tools\AcuityListCalendars;
use OpenCompany\Integrations\AcuityScheduling\Tools\AcuityListClients;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class AcuitySchedulingToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'oauth2_manual_token',
            'legacy_auth_type' => 'oauth',
            'credential_mode' => 'stored_token',
            'setup_flows' =>
            [
              0 => 'manual_token',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
              0 => 'access_token',
            ],
            'notes' =>
            [
              0 => 'Token acquisition may happen outside this package, but the host only needs to store the resulting token.',
            ],
          ],
          'host_availability' => [
            'web' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_token',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_token',
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
     * The application name used as the integration identifier.
     */
    public function appName(): string
    {
        return 'acuity-scheduling';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Acuity Scheduling',
            'description' => 'Acuity Scheduling integration for Laravel — manage appointments, clients, calendars…',
            'icon' => 'ph:plug',
            'logo' => 'ph:plug',
        ];
    }

    /**
     * Canonical integration metadata used by settings and generated catalogs.
     *
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Acuity Scheduling',
            'description' => 'Acuity Scheduling integration for Laravel — manage appointments, clients, calendars, and availability.',
            'icon' => 'ph:plug',
            'logo' => 'ph:plug',
            'category' => 'other',
            'badge' => 'verified',
        ];
    }
/**
     * Schema for configuration fields shown in the integration settings UI.
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
                'placeholder' => 'Enter your Acuity Scheduling access token',
                'hint' => 'Generate an OAuth access token in your Acuity Scheduling account under "API & Webhooks" or use the API key as a token',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://acuityscheduling.com/api/v1',
                'hint' => 'The default Acuity API URL. Change only if using a custom endpoint.',
                'default' => 'https://acuityscheduling.com/api/v1',
            ],
        ];
    }

    /**
     * Test the connection using the provided configuration.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://acuityscheduling.com/api/v1', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Acuity Scheduling API at {$baseUrl}. Check the URL.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Acuity Scheduling API as " . ($json['name'] ?? 'unknown user') . ".",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Validation rules for the configuration fields.
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
     * Return all tools provided by this integration.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            'acuity_list_appointments' => [
                'class' => AcuityListAppointments::class,
                'type' => 'read',
                'name' => 'List Appointments',
                'description' => 'List upcoming and past appointments.',
                'icon' => 'ph:calendar-dots',
            ],
            'acuity_get_appointment' => [
                'class' => AcuityGetAppointment::class,
                'type' => 'read',
                'name' => 'Get Appointment',
                'description' => 'Get details of a specific appointment.',
                'icon' => 'ph:calendar-check',
            ],
            'acuity_list_clients' => [
                'class' => AcuityListClients::class,
                'type' => 'read',
                'name' => 'List Clients',
                'description' => 'List and search clients.',
                'icon' => 'ph:users',
            ],
            'acuity_list_calendars' => [
                'class' => AcuityListCalendars::class,
                'type' => 'read',
                'name' => 'List Calendars',
                'description' => 'List all calendars.',
                'icon' => 'ph:calendar',
            ],
            'acuity_list_appointment_types' => [
                'class' => AcuityListAppointmentTypes::class,
                'type' => 'read',
                'name' => 'List Appointment Types',
                'description' => 'List all appointment types / services.',
                'icon' => 'ph:list-dashes',
            ],
            'acuity_cancel_appointment' => [
                'class' => AcuityCancelAppointment::class,
                'type' => 'write',
                'name' => 'Cancel Appointment',
                'description' => 'Cancel an existing appointment.',
                'icon' => 'ph:calendar-x',
            ],
            'acuity_get_availability' => [
                'class' => AcuityGetAvailability::class,
                'type' => 'read',
                'name' => 'Get Availability',
                'description' => 'Get available time slots for booking.',
                'icon' => 'ph:clock',
            ],
            'acuity_get_current_user' => [
                'class' => AcuityGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user profile.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    /**
     * Path to the Lua documentation file for this integration.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/acuity-scheduling.md';
    }

    /**
     * Credential fields required for multi-account support.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://acuityscheduling.com/api/v1'],
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
     * @param  string  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Context with optional 'account' key for multi-account support.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new AcuitySchedulingService(
                accessToken: $creds->get('acuity-scheduling', 'access_token', '', $account),
                baseUrl: $creds->get('acuity-scheduling', 'url', 'https://acuityscheduling.com/api/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(AcuitySchedulingService::class));
    }
}
