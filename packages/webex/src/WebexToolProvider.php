<?php

namespace OpenCompany\Integrations\Webex;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Webex\Tools\WebexListRooms;
use OpenCompany\Integrations\Webex\Tools\WebexGetRoom;
use OpenCompany\Integrations\Webex\Tools\WebexListMessages;
use OpenCompany\Integrations\Webex\Tools\WebexCreateMessage;
use OpenCompany\Integrations\Webex\Tools\WebexListMeetings;
use OpenCompany\Integrations\Webex\Tools\WebexGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class WebexToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'webex';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'rooms, messages, meetings',
            'description' => 'Messaging & meetings',
            'icon' => 'ph:video-camera',
            'logo' => 'simple-icons:ciscowebex',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Cisco Webex',
            'description' => 'Messaging, meetings, and collaboration platform by Cisco',
            'icon' => 'ph:video-camera',
            'logo' => 'simple-icons:ciscowebex',
            'category' => 'communication',
            'badge' => 'verified',
            'docs_url' => 'https://developer.webex.com/docs/api/getting-started',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Webex access token',
                'hint' => 'Generate a personal access token from <a href="https://developer.webex.com/docs/getting-started" target="_blank">developer.webex.com</a> or use an OAuth integration token',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://webexapis.com/v1',
                'hint' => 'Use the default <code>https://webexapis.com/v1</code> for Webex Cloud, or change for a dedicated instance',
                'default' => 'https://webexapis.com/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://webexapis.com/v1', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/people/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Webex API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['message'] ?? 'Unknown error';
                return [
                    'success' => false,
                    'error' => "Authentication failed: {$error}",
                ];
            }

            $displayName = $json['displayName'] ?? 'Unknown user';

            return [
                'success' => true,
                'message' => "Connected to Webex as {$displayName}.",
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
            'webex_list_rooms' => [
                'class' => WebexListRooms::class,
                'type' => 'read',
                'name' => 'List Rooms',
                'description' => 'List Webex spaces (rooms) the user belongs to.',
                'icon' => 'ph:chat-circle',
            ],
            'webex_get_room' => [
                'class' => WebexGetRoom::class,
                'type' => 'read',
                'name' => 'Get Room',
                'description' => 'Get details for a specific Webex room.',
                'icon' => 'ph:chat-circle',
            ],
            'webex_list_messages' => [
                'class' => WebexListMessages::class,
                'type' => 'read',
                'name' => 'List Messages',
                'description' => 'List messages in a Webex room.',
                'icon' => 'ph:chat-text',
            ],
            'webex_create_message' => [
                'class' => WebexCreateMessage::class,
                'type' => 'write',
                'name' => 'Create Message',
                'description' => 'Post a new message to a Webex room.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'webex_list_meetings' => [
                'class' => WebexListMeetings::class,
                'type' => 'read',
                'name' => 'List Meetings',
                'description' => 'List scheduled Webex meetings.',
                'icon' => 'ph:video-camera',
            ],
            'webex_get_current_user' => [
                'class' => WebexGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the profile of the authenticated Webex user.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/webex.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://webexapis.com/v1'],
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

            $service = new WebexService(
                accessToken: $creds->get('webex', 'access_token', '', $account),
                baseUrl: $creds->get('webex', 'url', 'https://webexapis.com/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(WebexService::class));
    }
}
