<?php

namespace OpenCompany\Integrations\Zoom;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Zoom\Tools\ZoomListMeetings;
use OpenCompany\Integrations\Zoom\Tools\ZoomGetMeeting;
use OpenCompany\Integrations\Zoom\Tools\ZoomCreateMeeting;
use OpenCompany\Integrations\Zoom\Tools\ZoomListUsers;
use OpenCompany\Integrations\Zoom\Tools\ZoomGetUser;
use OpenCompany\Integrations\Zoom\Tools\ZoomListRecordings;
use OpenCompany\Integrations\Zoom\Tools\ZoomGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\Integrations\Zoom\Tools\ZoomCreateUser;
use OpenCompany\Integrations\Zoom\Tools\ZoomCreateWebinar;
use OpenCompany\Integrations\Zoom\Tools\ZoomDeleteMeeting;
use OpenCompany\Integrations\Zoom\Tools\ZoomGetAccount;
use OpenCompany\Integrations\Zoom\Tools\ZoomGetUserSettings;
use OpenCompany\Integrations\Zoom\Tools\ZoomGetWebinar;
use OpenCompany\Integrations\Zoom\Tools\ZoomListPastMeetings;
use OpenCompany\Integrations\Zoom\Tools\ZoomListWebinars;
use OpenCompany\Integrations\Zoom\Tools\ZoomUpdateMeeting;

/**
 * Tool catalog and configuration metadata for the Zoom integration.
 */
class ZoomToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'zoom';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Zoom',
            'description' => 'Video conferencing and meetings',
            'icon' => 'ph:video-camera',
            'logo' => 'simple-icons:zoom',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Zoom',
            'description' => 'Video conferencing, online meetings, and group messaging platform',
            'icon' => 'ph:video-camera',
            'logo' => 'simple-icons:zoom',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.zoom.us/docs/api/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Zoom access token',
                'hint' => 'Use OAuth 2.0 or a Server-to-Server OAuth token from the Zoom App Marketplace',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.zoom.us/v2',
                'hint' => 'The Zoom API base URL (typically https://api.zoom.us/v2)',
                'default' => 'https://api.zoom.us/v2',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.zoom.us/v2', '/');

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
                    'error' => "Could not reach Zoom API at {$baseUrl}. Check the URL.",
                ];
            }

            if (! $response->successful()) {
                $error = $json['message'] ?? $json['error'] ?? $response->body();

                return [
                    'success' => false,
                    'error' => 'Zoom API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
                ];
            }

            $firstName = $json['first_name'] ?? '';
            $lastName = $json['last_name'] ?? '';
            $email = $json['email'] ?? 'unknown';
            $name = trim("{$firstName} {$lastName}") ?: $email;

            return [
                'success' => true,
                'message' => "Connected to Zoom as {$name}.",
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
            'zoom_create_meeting' => [
                'class' => ZoomCreateMeeting::class,
                'type' => 'write',
                'name' => 'Create Meeting',
                'description' => 'Create a new Zoom meeting. Provide a topic, start time (ISO 8601), duration, and optional timezone. Returns the meeting with join URL and password.',
                'icon' => 'ph:wrench',
            ],
            'zoom_get_current_user' => [
                'class' => ZoomGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the profile of the currently authenticated Zoom user. Returns email, name, account type, status, and timezone.',
                'icon' => 'ph:wrench',
            ],
            'zoom_get_meeting' => [
                'class' => ZoomGetMeeting::class,
                'type' => 'read',
                'name' => 'Get Meeting',
                'description' => 'Get details of a specific Zoom meeting by ID. Returns the meeting topic, agenda, start time, duration, join URL, and settings.',
                'icon' => 'ph:wrench',
            ],
            'zoom_get_user' => [
                'class' => ZoomGetUser::class,
                'type' => 'read',
                'name' => 'Get User',
                'description' => 'Get details of a specific Zoom user by ID or "me" for the authenticated user. Returns email, name, type, status, and timezone.',
                'icon' => 'ph:wrench',
            ],
            'zoom_list_meetings' => [
                'class' => ZoomListMeetings::class,
                'type' => 'read',
                'name' => 'List Meetings',
                'description' => 'List meetings for a Zoom user. Returns meeting IDs, topics, start times, durations, and join URLs. Use type "live" for in-progress, "scheduled" for upcoming, or "upcoming" for all upcoming meetings.',
                'icon' => 'ph:wrench',
            ],
            'zoom_list_recordings' => [
                'class' => ZoomListRecordings::class,
                'type' => 'read',
                'name' => 'List Recordings',
                'description' => 'List cloud recordings for a Zoom user. Returns recording IDs, topics, start times, durations, and download URLs for recording files.',
                'icon' => 'ph:wrench',
            ],
            'zoom_list_users' => [
                'class' => ZoomListUsers::class,
                'type' => 'read',
                'name' => 'List Users',
                'description' => 'List users in the Zoom account. Returns user IDs, emails, names, types (1=basic, 2=licensed), and status. Use this to find user IDs for other operations.',
                'icon' => 'ph:wrench',
            ],
            'zoom_create_user' => [
                'class' => ZoomCreateUser::class,
                'type' => 'write',
                'name' => 'Create User',
                'description' => 'Create a new Zoom user in the account.',
                'icon' => 'ph:user-plus',
            ],
            'zoom_create_webinar' => [
                'class' => ZoomCreateWebinar::class,
                'type' => 'write',
                'name' => 'Create Webinar',
                'description' => 'Create a Zoom webinar for a user.',
                'icon' => 'ph:broadcast',
            ],
            'zoom_delete_meeting' => [
                'class' => ZoomDeleteMeeting::class,
                'type' => 'write',
                'name' => 'Delete Meeting',
                'description' => 'Delete a Zoom meeting by ID.',
                'icon' => 'ph:trash',
            ],
            'zoom_get_account' => [
                'class' => ZoomGetAccount::class,
                'type' => 'read',
                'name' => 'Get Account',
                'description' => 'Get the current Zoom account information.',
                'icon' => 'ph:buildings',
            ],
            'zoom_get_user_settings' => [
                'class' => ZoomGetUserSettings::class,
                'type' => 'read',
                'name' => 'Get User Settings',
                'description' => 'Get settings for a Zoom user.',
                'icon' => 'ph:gear',
            ],
            'zoom_get_webinar' => [
                'class' => ZoomGetWebinar::class,
                'type' => 'read',
                'name' => 'Get Webinar',
                'description' => 'Get details of a Zoom webinar by ID.',
                'icon' => 'ph:broadcast',
            ],
            'zoom_list_past_meetings' => [
                'class' => ZoomListPastMeetings::class,
                'type' => 'read',
                'name' => 'List Past Meetings',
                'description' => 'List past instances of a Zoom meeting.',
                'icon' => 'ph:clock-counter-clockwise',
            ],
            'zoom_list_webinars' => [
                'class' => ZoomListWebinars::class,
                'type' => 'read',
                'name' => 'List Webinars',
                'description' => 'List webinars for a Zoom user.',
                'icon' => 'ph:broadcast',
            ],
            'zoom_update_meeting' => [
                'class' => ZoomUpdateMeeting::class,
                'type' => 'write',
                'name' => 'Update Meeting',
                'description' => 'Update an existing Zoom meeting.',
                'icon' => 'ph:pencil-simple',
            ],
        ];
    }


    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/zoom.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.zoom.us/v2'],
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

            $service = new ZoomService(
                accessToken: $creds->get('zoom', 'access_token', '', $account),
                baseUrl: $creds->get('zoom', 'url', 'https://api.zoom.us/v2', $account),
            );

            return new $class($service);
        }

        return new $class(app(ZoomService::class));
    }
}
