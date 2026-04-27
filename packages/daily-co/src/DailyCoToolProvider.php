<?php

namespace OpenCompany\Integrations\DailyCo;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\DailyCo\Tools\DailyCoCreateRoom;
use OpenCompany\Integrations\DailyCo\Tools\DailyCoDeleteRoom;
use OpenCompany\Integrations\DailyCo\Tools\DailyCoGetMeeting;
use OpenCompany\Integrations\DailyCo\Tools\DailyCoGetRoom;
use OpenCompany\Integrations\DailyCo\Tools\DailyCoListMeetings;
use OpenCompany\Integrations\DailyCo\Tools\DailyCoListRecordings;
use OpenCompany\Integrations\DailyCo\Tools\DailyCoListRooms;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class DailyCoToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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

    public function appName(): string
    {
        return 'daily-co';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'rooms, meetings, recordings',
            'description' => 'Video conferencing and recordings',
            'icon' => 'ph:video-camera',
            'logo' => 'simple-icons:dailydotco',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Daily.co',
            'description' => 'Video and audio conferencing platform with recording capabilities',
            'icon' => 'ph:video-camera',
            'logo' => 'simple-icons:dailydotco',
            'category' => 'communication',
            'badge' => 'verified',
            'docs_url' => 'https://docs.daily.co/reference/rest-api',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Daily.co API key',
                'hint' => 'Find your API key in Daily.co under Developers → API Keys',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.daily.co/v1',
                'hint' => 'Defaults to <code>https://api.daily.co/v1</code>. Change only if using a custom endpoint.',
                'default' => 'https://api.daily.co/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.daily.co/v1', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/rooms', ['limit' => 1]);

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Daily.co API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error'] ?? $json['message'] ?? 'Unknown error';
                return [
                    'success' => false,
                    'error' => "Daily.co API returned an error: {$error}",
                ];
            }

            $roomCount = count($json['data'] ?? []);

            return [
                'success' => true,
                'message' => "Connected to Daily.co API successfully (found {$roomCount} room(s)).",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'daily_co_list_rooms' => [
                'class' => DailyCoListRooms::class,
                'type' => 'read',
                'name' => 'List Rooms',
                'description' => 'List video rooms.',
                'icon' => 'ph:video-camera',
            ],
            'daily_co_get_room' => [
                'class' => DailyCoGetRoom::class,
                'type' => 'read',
                'name' => 'Get Room',
                'description' => 'Get details of a specific room.',
                'icon' => 'ph:video-camera',
            ],
            'daily_co_create_room' => [
                'class' => DailyCoCreateRoom::class,
                'type' => 'write',
                'name' => 'Create Room',
                'description' => 'Create a new video room.',
                'icon' => 'ph:plus-circle',
            ],
            'daily_co_delete_room' => [
                'class' => DailyCoDeleteRoom::class,
                'type' => 'write',
                'name' => 'Delete Room',
                'description' => 'Delete a video room.',
                'icon' => 'ph:trash',
            ],
            'daily_co_list_meetings' => [
                'class' => DailyCoListMeetings::class,
                'type' => 'read',
                'name' => 'List Meetings',
                'description' => 'List meetings with optional filters.',
                'icon' => 'ph:users',
            ],
            'daily_co_get_meeting' => [
                'class' => DailyCoGetMeeting::class,
                'type' => 'read',
                'name' => 'Get Meeting',
                'description' => 'Get details of a specific meeting.',
                'icon' => 'ph:users',
            ],
            'daily_co_list_recordings' => [
                'class' => DailyCoListRecordings::class,
                'type' => 'read',
                'name' => 'List Recordings',
                'description' => 'List recordings with optional filters.',
                'icon' => 'ph:record',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/daily-co.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.daily.co/v1'],
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

            $service = new DailyCoService(
                apiKey: $creds->get('daily-co', 'api_key', '', $account),
                baseUrl: $creds->get('daily-co', 'url', 'https://api.daily.co/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(DailyCoService::class));
    }
}
