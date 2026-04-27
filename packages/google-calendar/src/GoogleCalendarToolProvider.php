<?php

namespace OpenCompany\Integrations\GoogleCalendar;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\GoogleCalendar\Tools\GoogleCalendarCreateEvent;
use OpenCompany\Integrations\GoogleCalendar\Tools\GoogleCalendarGetCalendar;
use OpenCompany\Integrations\GoogleCalendar\Tools\GoogleCalendarGetCurrentUser;
use OpenCompany\Integrations\GoogleCalendar\Tools\GoogleCalendarGetEvent;
use OpenCompany\Integrations\GoogleCalendar\Tools\GoogleCalendarListCalendars;
use OpenCompany\Integrations\GoogleCalendar\Tools\GoogleCalendarListColors;
use OpenCompany\Integrations\GoogleCalendar\Tools\GoogleCalendarListEvents;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class GoogleCalendarToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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

    public function appName(): string
    {
        return 'google-calendar';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'events, calendars, colors',
            'description' => 'Google Calendar',
            'icon' => 'ph:calendar',
            'logo' => 'simple-icons:googlecalendar',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Google Calendar',
            'description' => 'View and manage Google Calendar events and calendars',
            'icon' => 'ph:calendar',
            'logo' => 'simple-icons:googlecalendar',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.google.com/calendar/api/v3/reference',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Google OAuth2 access token',
                'hint' => 'Provide an OAuth2 access token with calendar scope. Generate one via the Google OAuth2 playground or your app\'s auth flow.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://www.googleapis.com',
                'hint' => 'Override only if using a Google API proxy or compatible endpoint.',
                'default' => 'https://www.googleapis.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://www.googleapis.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/oauth2/v2/userinfo');

            $json = $response->json();

            if ($response->successful() && isset($json['email'])) {
                return [
                    'success' => true,
                    'message' => "Connected to Google Calendar as {$json['email']}.",
                ];
            }

            $error = $json['error']['message'] ?? $response->body();

            return [
                'success' => false,
                'error' => "Google API error: {$error}",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'gcalendar_list_events' => [
                'class' => GoogleCalendarListEvents::class,
                'type' => 'read',
                'name' => 'List Events',
                'description' => 'List events on a Google Calendar.',
                'icon' => 'ph:calendar-dots',
            ],
            'gcalendar_get_event' => [
                'class' => GoogleCalendarGetEvent::class,
                'type' => 'read',
                'name' => 'Get Event',
                'description' => 'Get details of a specific calendar event.',
                'icon' => 'ph:calendar-check',
            ],
            'gcalendar_create_event' => [
                'class' => GoogleCalendarCreateEvent::class,
                'type' => 'write',
                'name' => 'Create Event',
                'description' => 'Create a new event on a Google Calendar.',
                'icon' => 'ph:calendar-plus',
            ],
            'gcalendar_list_calendars' => [
                'class' => GoogleCalendarListCalendars::class,
                'type' => 'read',
                'name' => 'List Calendars',
                'description' => 'List all calendars on the user\'s account.',
                'icon' => 'ph:calendars',
            ],
            'gcalendar_get_calendar' => [
                'class' => GoogleCalendarGetCalendar::class,
                'type' => 'read',
                'name' => 'Get Calendar',
                'description' => 'Get details of a specific calendar.',
                'icon' => 'ph:calendar',
            ],
            'gcalendar_list_colors' => [
                'class' => GoogleCalendarListColors::class,
                'type' => 'read',
                'name' => 'List Colors',
                'description' => 'Get available color definitions for events and calendars.',
                'icon' => 'ph:palette',
            ],
            'gcalendar_get_current_user' => [
                'class' => GoogleCalendarGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s profile information.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/google-calendar.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://www.googleapis.com'],
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
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new GoogleCalendarService(
                accessToken: $creds->get('google-calendar', 'access_token', '', $account),
                baseUrl: $creds->get('google-calendar', 'url', 'https://www.googleapis.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(GoogleCalendarService::class));
    }
}
