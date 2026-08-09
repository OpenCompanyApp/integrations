<?php

namespace OpenCompany\Integrations\CalCom;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\CalCom\Tools\CalComListEventTypes;
use OpenCompany\Integrations\CalCom\Tools\CalComGetEventType;
use OpenCompany\Integrations\CalCom\Tools\CalComListBookings;
use OpenCompany\Integrations\CalCom\Tools\CalComGetBooking;
use OpenCompany\Integrations\CalCom\Tools\CalComCreateBooking;
use OpenCompany\Integrations\CalCom\Tools\CalComListTeams;
use OpenCompany\Integrations\CalCom\Tools\CalComGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class CalComToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'bearer_token',
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
     * Get the application name identifier.
     */
    public function appName(): string
    {
        return 'cal-com';
    }

/**
     * Get application metadata for display purposes.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Cal.com',
            'description' => 'Legacy alias for Cal.com',
            'icon' => 'ph:calendar-check',
            'logo' => 'simple-icons:calcom',
        ];
    }

/**
     * Get integration metadata including category and documentation links.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Cal.com Legacy Alias',
            'description' => 'Legacy cal-com package alias. Use the canonical cal integration for new work.',
            'icon' => 'ph:calendar-check',
            'logo' => 'simple-icons:calcom',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://cal.com/docs/api-reference/v2/introduction',
            'catalog_visibility' => 'hidden',
        ];
    }    /**
     * Get the configuration schema for Cal.com credentials.
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Cal.com personal access token',
                'hint' => 'Generate a personal access token in your Cal.com account settings under "API Keys"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.cal.com/v2',
                'hint' => 'Use <code>https://api.cal.com/v2</code> for cloud, or your self-hosted Cal.com API URL',
                'default' => 'https://api.cal.com/v2',
            ],
        ];
    }

    /**
     * Test the connection to the Cal.com API using the provided configuration.
     *
     * @param  array<string, mixed>  $config  Configuration array with access_token and optional url.
     * @return array{success: bool, message?: string, error?: string} Connection test result.
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.cal.com/v2', '/');

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
                    'error' => "Could not reach Cal.com API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error'] ?? $json['message'] ?? 'Unknown error';
                return [
                    'success' => false,
                    'error' => "Cal.com API returned an error: {$error}",
                ];
            }

            $userName = $json['user']['name'] ?? $json['user']['username'] ?? 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to Cal.com API as {$userName}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the configuration fields.
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Get all available Cal.com tools.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'cal_com_list_event_types' => [
                'class' => CalComListEventTypes::class,
                'type' => 'read',
                'name' => 'List Event Types',
                'description' => 'List available event types (booking link templates).',
                'icon' => 'ph:calendar',
            ],
            'cal_com_get_event_type' => [
                'class' => CalComGetEventType::class,
                'type' => 'read',
                'name' => 'Get Event Type',
                'description' => 'Get details for a specific event type.',
                'icon' => 'ph:calendar',
            ],
            'cal_com_create_booking' => [
                'class' => CalComCreateBooking::class,
                'type' => 'write',
                'name' => 'Create Booking',
                'description' => 'Create a new booking for an event type.',
                'icon' => 'ph:calendar-plus',
            ],
            'cal_com_list_bookings' => [
                'class' => CalComListBookings::class,
                'type' => 'read',
                'name' => 'List Bookings',
                'description' => 'List bookings with optional filters.',
                'icon' => 'ph:calendar-dots',
            ],
            'cal_com_get_booking' => [
                'class' => CalComGetBooking::class,
                'type' => 'read',
                'name' => 'Get Booking',
                'description' => 'Get details for a specific booking.',
                'icon' => 'ph:calendar-dots',
            ],
            'cal_com_list_teams' => [
                'class' => CalComListTeams::class,
                'type' => 'read',
                'name' => 'List Teams',
                'description' => 'List teams in your Cal.com organization.',
                'icon' => 'ph:users',
            ],
            'cal_com_get_current_user' => [
                'class' => CalComGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s profile.',
                'icon' => 'ph:user',
            ],
        ];
    }

    /**
     * Get the path to the JavaScript documentation file.
     */
    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/cal-com.md';
    }

    /**
     * Get the credential fields for multi-account support.
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.cal.com/v2'],
        ];
    }

    /**
     * Whether this provider represents an integration (always true).
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally using account-specific credentials.
     *
     * @param  class-string<Tool>  $class   The tool class to instantiate.
     * @param  array<string, mixed>  $context  Context containing optional 'account' key.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new CalComService(
                accessToken: $creds->get('cal-com', 'access_token', '', $account),
                baseUrl: $creds->get('cal-com', 'url', 'https://api.cal.com/v2', $account),
            );

            return new $class($service);
        }

        return new $class(app(CalComService::class));
    }
}
