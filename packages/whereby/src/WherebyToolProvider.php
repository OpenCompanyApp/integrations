<?php

namespace OpenCompany\Integrations\Whereby;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Whereby\Tools\WherebyCreateRoom;
use OpenCompany\Integrations\Whereby\Tools\WherebyDeleteRoom;
use OpenCompany\Integrations\Whereby\Tools\WherebyGetCurrentUser;
use OpenCompany\Integrations\Whereby\Tools\WherebyGetMeeting;
use OpenCompany\Integrations\Whereby\Tools\WherebyGetRoom;
use OpenCompany\Integrations\Whereby\Tools\WherebyListMeetings;
use OpenCompany\Integrations\Whereby\Tools\WherebyListRooms;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class WherebyToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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

    public function appName(): string
    {
        return 'whereby';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Whereby',
            'description' => 'Video meetings',
            'icon' => 'ph:video-camera',
            'logo' => 'simple-icons:whereby',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Whereby',
            'description' => 'Video meeting platform for teams — create rooms, host meetings, and manage participants',
            'icon' => 'ph:video-camera',
            'logo' => 'simple-icons:whereby',
            'category' => 'communication',
            'badge' => 'verified',
            'docs_url' => 'https://docs.whereby.dev/reference',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Whereby API key',
                'hint' => 'Find your API key in your Whereby account under "API" settings',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.whereby.dev/v1',
                'hint' => 'The default Whereby API URL. Change only if using a proxy or custom endpoint.',
                'default' => 'https://api.whereby.dev/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.whereby.dev/v1', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            $json = $response->json();
            if ($json === null) {
                return ['success' => false, 'error' => "Could not reach Whereby API at {$baseUrl}. Check the URL."];
            }

            return ['success' => true, 'message' => 'Connected to Whereby API successfully.'];
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
            'whereby_list_rooms' => [
                'class' => WherebyListRooms::class,
                'type' => 'read',
                'name' => 'List Rooms',
                'description' => 'List Whereby rooms with optional pagination.',
                'icon' => 'ph:video-camera',
            ],
            'whereby_get_room' => [
                'class' => WherebyGetRoom::class,
                'type' => 'read',
                'name' => 'Get Room',
                'description' => 'Get detailed information about a specific Whereby room.',
                'icon' => 'ph:video-camera',
            ],
            'whereby_create_room' => [
                'class' => WherebyCreateRoom::class,
                'type' => 'write',
                'name' => 'Create Room',
                'description' => 'Create a new Whereby video meeting room.',
                'icon' => 'ph:video-camera',
            ],
            'whereby_delete_room' => [
                'class' => WherebyDeleteRoom::class,
                'type' => 'write',
                'name' => 'Delete Room',
                'description' => 'Delete a Whereby room.',
                'icon' => 'ph:video-camera',
            ],
            'whereby_list_meetings' => [
                'class' => WherebyListMeetings::class,
                'type' => 'read',
                'name' => 'List Meetings',
                'description' => 'List past meetings with optional filters.',
                'icon' => 'ph:video-camera',
            ],
            'whereby_get_meeting' => [
                'class' => WherebyGetMeeting::class,
                'type' => 'read',
                'name' => 'Get Meeting',
                'description' => 'Get detailed information about a specific past meeting.',
                'icon' => 'ph:video-camera',
            ],
            'whereby_get_current_user' => [
                'class' => WherebyGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Whereby user profile.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/whereby.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.whereby.dev/v1'],
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
            $service = new WherebyService(
                accessToken: $creds->get('whereby', 'access_token', '', $account),
                baseUrl: $creds->get('whereby', 'url', 'https://api.whereby.dev/v1', $account),
            );
            return new $class($service);
        }

        return new $class(app(WherebyService::class));
    }
}
