<?php

namespace OpenCompany\Integrations\Mattermost;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Mattermost\Tools\MattermostListChannels;
use OpenCompany\Integrations\Mattermost\Tools\MattermostGetChannel;
use OpenCompany\Integrations\Mattermost\Tools\MattermostCreatePost;
use OpenCompany\Integrations\Mattermost\Tools\MattermostListPosts;
use OpenCompany\Integrations\Mattermost\Tools\MattermostGetPost;
use OpenCompany\Integrations\Mattermost\Tools\MattermostListTeams;
use OpenCompany\Integrations\Mattermost\Tools\MattermostGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class MattermostToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'mattermost';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'channels, posts, teams, messages',
            'description' => 'Team messaging and communication',
            'icon' => 'ph:chat-circle-text',
            'logo' => 'simple-icons:mattermost',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Mattermost',
            'description' => 'Open-source team messaging and communication platform',
            'icon' => 'ph:chat-circle-text',
            'logo' => 'simple-icons:mattermost',
            'category' => 'communication',
            'badge' => 'verified',
            'docs_url' => 'https://developers.mattermost.com/api-documentation/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Mattermost personal access token',
                'hint' => 'Generate a personal access token in Mattermost under Account Settings → Security → Personal Access Tokens',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Server URL',
                'placeholder' => 'https://mattermost.example.com',
                'hint' => 'The base URL of your Mattermost server (no trailing slash)',
                'default' => 'https://mattermost.example.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://mattermost.example.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/api/v4/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Mattermost API at {$baseUrl}. Check the URL.",
                ];
            }

            $username = $json['username'] ?? 'unknown';

            return [
                'success' => true,
                'message' => "Connected to Mattermost as @{$username} at {$baseUrl}.",
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
            'mattermost_list_channels' => [
                'class' => MattermostListChannels::class,
                'type' => 'read',
                'name' => 'List Channels',
                'description' => 'List channels the current user belongs to.',
                'icon' => 'ph:hash',
            ],
            'mattermost_get_channel' => [
                'class' => MattermostGetChannel::class,
                'type' => 'read',
                'name' => 'Get Channel',
                'description' => 'Get details of a specific channel.',
                'icon' => 'ph:hash',
            ],
            'mattermost_create_post' => [
                'class' => MattermostCreatePost::class,
                'type' => 'write',
                'name' => 'Create Post',
                'description' => 'Post a message to a channel.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'mattermost_list_posts' => [
                'class' => MattermostListPosts::class,
                'type' => 'read',
                'name' => 'List Posts',
                'description' => 'List posts in a channel.',
                'icon' => 'ph:list-bullets',
            ],
            'mattermost_get_post' => [
                'class' => MattermostGetPost::class,
                'type' => 'read',
                'name' => 'Get Post',
                'description' => 'Get a specific post by ID.',
                'icon' => 'ph:chat-text',
            ],
            'mattermost_list_teams' => [
                'class' => MattermostListTeams::class,
                'type' => 'read',
                'name' => 'List Teams',
                'description' => 'List teams the current user belongs to.',
                'icon' => 'ph:users-three',
            ],
            'mattermost_get_current_user' => [
                'class' => MattermostGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user profile.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/mattermost.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Server URL', 'required' => false, 'default' => 'https://mattermost.example.com'],
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

            $service = new MattermostService(
                accessToken: $creds->get('mattermost', 'access_token', '', $account),
                baseUrl: $creds->get('mattermost', 'url', 'https://mattermost.example.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(MattermostService::class));
    }
}
