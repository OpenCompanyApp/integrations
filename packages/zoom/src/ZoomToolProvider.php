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

class ZoomToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'zoom';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'meetings, users, recordings',
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
            'category' => 'communication',
            'badge' => 'verified',
            'docs_url' => 'https://developers.zoom.us/docs/api/',
        ];
    }

    public function configSchema(): array
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
            'zoom_list_meetings' => [
                'class' => ZoomListMeetings::class,
                'type' => 'read',
                'name' => 'List Meetings',
                'description' => 'List meetings for a user.',
                'icon' => 'ph:video-camera',
            ],
            'zoom_get_meeting' => [
                'class' => ZoomGetMeeting::class,
                'type' => 'read',
                'name' => 'Get Meeting',
                'description' => 'Get details of a specific meeting.',
                'icon' => 'ph:video-camera',
            ],
            'zoom_create_meeting' => [
                'class' => ZoomCreateMeeting::class,
                'type' => 'write',
                'name' => 'Create Meeting',
                'description' => 'Create a new meeting.',
                'icon' => 'ph:plus-circle',
            ],
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
                'description' => 'Get details of a specific user.',
                'icon' => 'ph:user',
            ],
            'zoom_list_recordings' => [
                'class' => ZoomListRecordings::class,
                'type' => 'read',
                'name' => 'List Recordings',
                'description' => 'List cloud recordings for a user.',
                'icon' => 'ph:record',
            ],
            'zoom_get_current_user' => [
                'class' => ZoomGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user profile.',
                'icon' => 'ph:user-circle',
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
