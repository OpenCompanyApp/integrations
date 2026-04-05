<?php

namespace OpenCompany\Integrations\Zoom;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Zoom\Tools\ZoomCreateMeeting;
use OpenCompany\Integrations\Zoom\Tools\ZoomCreateUser;
use OpenCompany\Integrations\Zoom\Tools\ZoomCreateWebinar;
use OpenCompany\Integrations\Zoom\Tools\ZoomDeleteMeeting;
use OpenCompany\Integrations\Zoom\Tools\ZoomGetAccount;
use OpenCompany\Integrations\Zoom\Tools\ZoomGetMeeting;
use OpenCompany\Integrations\Zoom\Tools\ZoomGetUser;
use OpenCompany\Integrations\Zoom\Tools\ZoomGetUserSettings;
use OpenCompany\Integrations\Zoom\Tools\ZoomGetWebinar;
use OpenCompany\Integrations\Zoom\Tools\ZoomListMeetings;
use OpenCompany\Integrations\Zoom\Tools\ZoomListPastMeetings;
use OpenCompany\Integrations\Zoom\Tools\ZoomListRecordings;
use OpenCompany\Integrations\Zoom\Tools\ZoomListUsers;
use OpenCompany\Integrations\Zoom\Tools\ZoomListWebinars;
use OpenCompany\Integrations\Zoom\Tools\ZoomUpdateMeeting;

/**
 * Registers all Zoom tools and provides integration metadata.
 *
 * Exposes 15 tools covering meetings, webinars, users,
 * recordings, and account management via the ToolProvider contract.
 */
class ZoomToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'zoom';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'meetings, webinars, users, recordings',
            'description' => 'Video Conferencing',
            'icon' => 'ph:video-camera',
            'logo' => 'simple-icons:zoom',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Zoom',
            'description' => 'Meetings, webinars, users, recordings, and account management',
            'icon' => 'ph:video-camera',
            'logo' => 'simple-icons:zoom',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.zoom.us/docs/api/rest/reference/zoom-api/methods/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Zoom OAuth2 access token',
                'hint' => 'OAuth2 access token obtained from the Zoom OAuth2 flow. Requires Server-to-Server or OAuth app credentials.',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the Zoom connection using the provided credentials.
     *
     * @param  array<string, mixed>  $config  Configuration containing 'access_token'
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided. Obtain one via the Zoom OAuth2 flow.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get('https://api.zoom.us/v2/users/me');

            if ($response->successful()) {
                $body = $response->json() ?? [];
                $firstName = $body['first_name'] ?? '';
                $lastName = $body['last_name'] ?? '';
                $name = trim("$firstName $lastName") ?: ($body['email'] ?? 'Unknown');

                return [
                    'success' => true,
                    'message' => "Connected to Zoom as {$name}.",
                ];
            }

            $body = $response->json() ?? [];
            $error = $body['message'] ?? $response->body();

            return [
                'success' => false,
                'error' => 'Zoom API error: ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string> */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            // Meetings
            'zoom_create_meeting' => [
                'class' => ZoomCreateMeeting::class,
                'type' => 'write',
                'name' => 'Create Meeting',
                'description' => 'Create a Zoom meeting for a user.',
                'icon' => 'ph:video-camera-plus',
            ],
            'zoom_get_meeting' => [
                'class' => ZoomGetMeeting::class,
                'type' => 'read',
                'name' => 'Get Meeting',
                'description' => 'Get details of a Zoom meeting.',
                'icon' => 'ph:video-camera',
            ],
            'zoom_update_meeting' => [
                'class' => ZoomUpdateMeeting::class,
                'type' => 'write',
                'name' => 'Update Meeting',
                'description' => 'Update an existing Zoom meeting.',
                'icon' => 'ph:pencil-simple',
            ],
            'zoom_delete_meeting' => [
                'class' => ZoomDeleteMeeting::class,
                'type' => 'write',
                'name' => 'Delete Meeting',
                'description' => 'Delete a Zoom meeting.',
                'icon' => 'ph:trash',
            ],
            'zoom_list_meetings' => [
                'class' => ZoomListMeetings::class,
                'type' => 'read',
                'name' => 'List Meetings',
                'description' => 'List meetings for a Zoom user.',
                'icon' => 'ph:list',
            ],
            'zoom_list_past_meetings' => [
                'class' => ZoomListPastMeetings::class,
                'type' => 'read',
                'name' => 'List Past Meetings',
                'description' => 'List past instances of a Zoom meeting.',
                'icon' => 'ph:clock-counter-clockwise',
            ],
            // Webinars
            'zoom_create_webinar' => [
                'class' => ZoomCreateWebinar::class,
                'type' => 'write',
                'name' => 'Create Webinar',
                'description' => 'Create a Zoom webinar.',
                'icon' => 'ph:presentation-chart',
            ],
            'zoom_list_webinars' => [
                'class' => ZoomListWebinars::class,
                'type' => 'read',
                'name' => 'List Webinars',
                'description' => 'List webinars for a Zoom user.',
                'icon' => 'ph:list',
            ],
            'zoom_get_webinar' => [
                'class' => ZoomGetWebinar::class,
                'type' => 'read',
                'name' => 'Get Webinar',
                'description' => 'Get details of a Zoom webinar.',
                'icon' => 'ph:presentation-chart',
            ],
            // Users
            'zoom_list_users' => [
                'class' => ZoomListUsers::class,
                'type' => 'read',
                'name' => 'List Users',
                'description' => 'List users in the Zoom account.',
                'icon' => 'ph:users',
            ],
            'zoom_get_user' => [
                'class' => ZoomGetUser::class,
                'type' => 'read',
                'name' => 'Get User',
                'description' => 'Get a Zoom user by ID or email.',
                'icon' => 'ph:user',
            ],
            'zoom_create_user' => [
                'class' => ZoomCreateUser::class,
                'type' => 'write',
                'name' => 'Create User',
                'description' => 'Create a new Zoom user.',
                'icon' => 'ph:user-plus',
            ],
            'zoom_get_user_settings' => [
                'class' => ZoomGetUserSettings::class,
                'type' => 'read',
                'name' => 'Get User Settings',
                'description' => 'Get settings for a Zoom user.',
                'icon' => 'ph:gear',
            ],
            // Account
            'zoom_get_account' => [
                'class' => ZoomGetAccount::class,
                'type' => 'read',
                'name' => 'Get Account',
                'description' => 'Get Zoom account information.',
                'icon' => 'ph:buildings',
            ],
            // Recordings
            'zoom_list_recordings' => [
                'class' => ZoomListRecordings::class,
                'type' => 'read',
                'name' => 'List Recordings',
                'description' => 'List cloud recordings for a Zoom user.',
                'icon' => 'ph:record',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/zoom.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /** @param  array<string, mixed>  $context */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the ZoomService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): ZoomService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new ZoomService(
                accessToken: $creds->get('zoom', 'access_token', '', $account),
            );
        }

        return app(ZoomService::class);
    }
}
