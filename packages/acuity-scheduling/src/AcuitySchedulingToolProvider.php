<?php

namespace OpenCompany\Integrations\AcuityScheduling;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\AcuityScheduling\Tools\AcuityApiDelete;
use OpenCompany\Integrations\AcuityScheduling\Tools\AcuityApiGet;
use OpenCompany\Integrations\AcuityScheduling\Tools\AcuityApiPost;
use OpenCompany\Integrations\AcuityScheduling\Tools\AcuityApiPut;
use OpenCompany\Integrations\AcuityScheduling\Tools\AcuityCancelAppointment;
use OpenCompany\Integrations\AcuityScheduling\Tools\AcuityCreateAppointment;
use OpenCompany\Integrations\AcuityScheduling\Tools\AcuityCreateBlock;
use OpenCompany\Integrations\AcuityScheduling\Tools\AcuityCreateCertificate;
use OpenCompany\Integrations\AcuityScheduling\Tools\AcuityCreateClient;
use OpenCompany\Integrations\AcuityScheduling\Tools\AcuityCreateWebhook;
use OpenCompany\Integrations\AcuityScheduling\Tools\AcuityDeleteBlock;
use OpenCompany\Integrations\AcuityScheduling\Tools\AcuityDeleteWebhook;
use OpenCompany\Integrations\AcuityScheduling\Tools\AcuityGetAppointment;
use OpenCompany\Integrations\AcuityScheduling\Tools\AcuityGetAvailability;
use OpenCompany\Integrations\AcuityScheduling\Tools\AcuityGetAvailabilityClasses;
use OpenCompany\Integrations\AcuityScheduling\Tools\AcuityGetAvailabilityDates;
use OpenCompany\Integrations\AcuityScheduling\Tools\AcuityGetCurrentUser;
use OpenCompany\Integrations\AcuityScheduling\Tools\AcuityGetOrder;
use OpenCompany\Integrations\AcuityScheduling\Tools\AcuityListAppointmentTypes;
use OpenCompany\Integrations\AcuityScheduling\Tools\AcuityListAppointmentPayments;
use OpenCompany\Integrations\AcuityScheduling\Tools\AcuityListAppointments;
use OpenCompany\Integrations\AcuityScheduling\Tools\AcuityListBlocks;
use OpenCompany\Integrations\AcuityScheduling\Tools\AcuityListCalendars;
use OpenCompany\Integrations\AcuityScheduling\Tools\AcuityListClients;
use OpenCompany\Integrations\AcuityScheduling\Tools\AcuityListForms;
use OpenCompany\Integrations\AcuityScheduling\Tools\AcuityListOrders;
use OpenCompany\Integrations\AcuityScheduling\Tools\AcuityListProducts;
use OpenCompany\Integrations\AcuityScheduling\Tools\AcuityListWebhooks;
use OpenCompany\Integrations\AcuityScheduling\Tools\AcuityRescheduleAppointment;
use OpenCompany\Integrations\AcuityScheduling\Tools\AcuityUpdateAppointment;
use OpenCompany\Integrations\AcuityScheduling\Tools\AcuityUpdateClient;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the Acuity Scheduling tool catalog and integration metadata.
 */
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
            'strategy' => 'basic_or_bearer',
            'legacy_auth_type' => 'api_key',
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
              1 => 'user_id',
              2 => 'api_key',
            ],
            'notes' =>
            [
              0 => 'Acuity recommends Basic Auth with numeric user ID and API key for single-account integrations; OAuth bearer tokens remain supported for multi-user apps.',
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
            'icon' => 'ph:calendar-check',
            'logo' => 'ph:calendar-check',
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
            'icon' => 'ph:calendar-check',
            'logo' => 'ph:calendar-check',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.acuityscheduling.com/reference',
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
                'label' => 'OAuth Access Token',
                'placeholder' => 'Enter your Acuity OAuth access token',
                'hint' => 'Use this for OAuth-connected Acuity accounts. For a single account, prefer user ID + API key below.',
                'required' => false,
            ],
            [
                'key' => 'user_id',
                'type' => 'text',
                'label' => 'User ID',
                'placeholder' => 'Acuity numeric user ID',
                'hint' => 'Used with API Key for Acuity Basic Auth.',
                'required' => false,
            ],
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Acuity API key',
                'hint' => 'Used with User ID for Acuity Basic Auth.',
                'required' => false,
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
        $userId = $config['user_id'] ?? '';
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://acuityscheduling.com/api/v1', '/');

        if (empty($accessToken) && (empty($userId) || empty($apiKey))) {
            return ['success' => false, 'error' => 'Provide either an OAuth access token or both user ID and API key'];
        }

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->timeout(10);

            if (!empty($userId) && !empty($apiKey)) {
                $response = $response->withBasicAuth($userId, $apiKey);
            } else {
                $response = $response->withToken($accessToken);
            }

            $response = $response->get($baseUrl . '/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Acuity Scheduling API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'error' => 'Acuity Scheduling API returned an error: '.($json['message'] ?? $response->body()),
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
            'user_id' => 'nullable|string',
            'api_key' => 'nullable|string',
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
            'acuity_create_appointment' => [
                'class' => AcuityCreateAppointment::class,
                'type' => 'write',
                'name' => 'Create Appointment',
                'description' => 'Create a new appointment.',
                'icon' => 'ph:calendar-plus',
            ],
            'acuity_update_appointment' => [
                'class' => AcuityUpdateAppointment::class,
                'type' => 'write',
                'name' => 'Update Appointment',
                'description' => 'Update editable appointment details.',
                'icon' => 'ph:pencil-simple',
            ],
            'acuity_reschedule_appointment' => [
                'class' => AcuityRescheduleAppointment::class,
                'type' => 'write',
                'name' => 'Reschedule Appointment',
                'description' => 'Move an appointment to a new date, time, or calendar.',
                'icon' => 'ph:calendar-plus',
            ],
            'acuity_list_appointment_payments' => [
                'class' => AcuityListAppointmentPayments::class,
                'type' => 'read',
                'name' => 'List Appointment Payments',
                'description' => 'List payment transactions for an appointment.',
                'icon' => 'ph:credit-card',
            ],
            'acuity_list_clients' => [
                'class' => AcuityListClients::class,
                'type' => 'read',
                'name' => 'List Clients',
                'description' => 'List and search clients.',
                'icon' => 'ph:users',
            ],
            'acuity_create_client' => [
                'class' => AcuityCreateClient::class,
                'type' => 'write',
                'name' => 'Create Client',
                'description' => 'Create a new client record.',
                'icon' => 'ph:user-plus',
            ],
            'acuity_update_client' => [
                'class' => AcuityUpdateClient::class,
                'type' => 'write',
                'name' => 'Update Client',
                'description' => 'Update a client record using lookup parameters.',
                'icon' => 'ph:user-gear',
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
            'acuity_get_availability_dates' => [
                'class' => AcuityGetAvailabilityDates::class,
                'type' => 'read',
                'name' => 'Get Availability Dates',
                'description' => 'Get dates with availability for a month and appointment type.',
                'icon' => 'ph:calendar-blank',
            ],
            'acuity_get_availability_classes' => [
                'class' => AcuityGetAvailabilityClasses::class,
                'type' => 'read',
                'name' => 'Get Availability Classes',
                'description' => 'Get available class offerings for a month.',
                'icon' => 'ph:users-three',
            ],
            'acuity_list_forms' => [
                'class' => AcuityListForms::class,
                'type' => 'read',
                'name' => 'List Forms',
                'description' => 'List intake forms and form fields.',
                'icon' => 'ph:list-checks',
            ],
            'acuity_list_products' => [
                'class' => AcuityListProducts::class,
                'type' => 'read',
                'name' => 'List Products',
                'description' => 'List products and packages.',
                'icon' => 'ph:package',
            ],
            'acuity_list_orders' => [
                'class' => AcuityListOrders::class,
                'type' => 'read',
                'name' => 'List Orders',
                'description' => 'List store orders.',
                'icon' => 'ph:receipt',
            ],
            'acuity_get_order' => [
                'class' => AcuityGetOrder::class,
                'type' => 'read',
                'name' => 'Get Order',
                'description' => 'Get details about a single order.',
                'icon' => 'ph:receipt',
            ],
            'acuity_create_certificate' => [
                'class' => AcuityCreateCertificate::class,
                'type' => 'write',
                'name' => 'Create Certificate',
                'description' => 'Create a package or coupon certificate.',
                'icon' => 'ph:ticket',
            ],
            'acuity_list_blocks' => [
                'class' => AcuityListBlocks::class,
                'type' => 'read',
                'name' => 'List Blocks',
                'description' => 'List blocked-off times.',
                'icon' => 'ph:calendar-x',
            ],
            'acuity_create_block' => [
                'class' => AcuityCreateBlock::class,
                'type' => 'write',
                'name' => 'Create Block',
                'description' => 'Block off time on a calendar.',
                'icon' => 'ph:calendar-x',
            ],
            'acuity_delete_block' => [
                'class' => AcuityDeleteBlock::class,
                'type' => 'write',
                'name' => 'Delete Block',
                'description' => 'Delete a blocked-off time.',
                'icon' => 'ph:trash',
            ],
            'acuity_list_webhooks' => [
                'class' => AcuityListWebhooks::class,
                'type' => 'read',
                'name' => 'List Webhooks',
                'description' => 'List dynamic webhook subscriptions.',
                'icon' => 'ph:webhooks-logo',
            ],
            'acuity_create_webhook' => [
                'class' => AcuityCreateWebhook::class,
                'type' => 'write',
                'name' => 'Create Webhook',
                'description' => 'Create a dynamic webhook subscription.',
                'icon' => 'ph:webhooks-logo',
            ],
            'acuity_delete_webhook' => [
                'class' => AcuityDeleteWebhook::class,
                'type' => 'write',
                'name' => 'Delete Webhook',
                'description' => 'Delete a dynamic webhook subscription.',
                'icon' => 'ph:trash',
            ],
            'acuity_api_get' => [
                'class' => AcuityApiGet::class,
                'type' => 'read',
                'name' => 'API GET',
                'description' => 'Call any Acuity API v1 GET endpoint.',
                'icon' => 'ph:terminal-window',
            ],
            'acuity_api_post' => [
                'class' => AcuityApiPost::class,
                'type' => 'write',
                'name' => 'API POST',
                'description' => 'Call any Acuity API v1 POST endpoint.',
                'icon' => 'ph:terminal-window',
            ],
            'acuity_api_put' => [
                'class' => AcuityApiPut::class,
                'type' => 'write',
                'name' => 'API PUT',
                'description' => 'Call any Acuity API v1 PUT endpoint.',
                'icon' => 'ph:terminal-window',
            ],
            'acuity_api_delete' => [
                'class' => AcuityApiDelete::class,
                'type' => 'write',
                'name' => 'API DELETE',
                'description' => 'Call any Acuity API v1 DELETE endpoint.',
                'icon' => 'ph:terminal-window',
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
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'OAuth Access Token', 'required' => false],
            ['key' => 'user_id', 'type' => 'text', 'label' => 'User ID', 'required' => false],
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => false],
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
                userId: $creds->get('acuity-scheduling', 'user_id', '', $account),
                apiKey: $creds->get('acuity-scheduling', 'api_key', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(AcuitySchedulingService::class));
    }
}
