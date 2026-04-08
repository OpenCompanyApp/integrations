<?php

namespace OpenCompany\Integrations\Cal;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Cal\Tools\CalListEventTypes;
use OpenCompany\Integrations\Cal\Tools\CalGetEventType;
use OpenCompany\Integrations\Cal\Tools\CalListBookings;
use OpenCompany\Integrations\Cal\Tools\CalGetBooking;
use OpenCompany\Integrations\Cal\Tools\CalCreateBooking;
use OpenCompany\Integrations\Cal\Tools\CalGetCurrentUser;

/**
 * Tool provider for the Cal.com scheduling integration.
 *
 * Implements ConfigurableIntegration for multi-account support and
 * provides all Cal.com tools (event types, bookings, user info).
 */
class CalToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * Get the application name identifier.
     */
    public function appName(): string
    {
        return 'cal';
    }

    /**
     * Get application metadata for display purposes.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'event types, bookings, user',
            'description' => 'Scheduling & bookings',
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
            'name' => 'Cal.com',
            'description' => 'Open scheduling infrastructure for booking and calendar management',
            'icon' => 'ph:calendar-check',
            'logo' => 'simple-icons:calcom',
            'category' => 'scheduling',
            'badge' => 'verified',
            'docs_url' => 'https://developer.cal.com/api',
        ];
    }

    /**
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
                'placeholder' => 'https://api.cal.com/v1',
                'hint' => 'Use <code>https://api.cal.com/v1</code> for cloud, or your self-hosted Cal.com API URL',
                'default' => 'https://api.cal.com/v1',
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
        $baseUrl = rtrim($config['url'] ?? 'https://api.cal.com/v1', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

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
            'cal_list_event_types' => [
                'class' => CalListEventTypes::class,
                'type' => 'read',
                'name' => 'List Event Types',
                'description' => 'List available event types (booking link templates).',
                'icon' => 'ph:calendar',
            ],
            'cal_get_event_type' => [
                'class' => CalGetEventType::class,
                'type' => 'read',
                'name' => 'Get Event Type',
                'description' => 'Get details for a specific event type.',
                'icon' => 'ph:calendar',
            ],
            'cal_list_bookings' => [
                'class' => CalListBookings::class,
                'type' => 'read',
                'name' => 'List Bookings',
                'description' => 'List bookings with optional filters.',
                'icon' => 'ph:calendar-dots',
            ],
            'cal_get_booking' => [
                'class' => CalGetBooking::class,
                'type' => 'read',
                'name' => 'Get Booking',
                'description' => 'Get details for a specific booking.',
                'icon' => 'ph:calendar-dots',
            ],
            'cal_create_booking' => [
                'class' => CalCreateBooking::class,
                'type' => 'write',
                'name' => 'Create Booking',
                'description' => 'Create a new booking for an event type.',
                'icon' => 'ph:calendar-plus',
            ],
            'cal_get_current_user' => [
                'class' => CalGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s profile.',
                'icon' => 'ph:user',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/cal.md';
    }

    /**
     * Get the credential fields for multi-account support.
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.cal.com/v1'],
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

            $service = new CalService(
                accessToken: $creds->get('cal', 'access_token', '', $account),
                baseUrl: $creds->get('cal', 'url', 'https://api.cal.com/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(CalService::class));
    }
}
