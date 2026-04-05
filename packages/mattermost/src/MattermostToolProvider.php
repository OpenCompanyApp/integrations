<?php

namespace OpenCompany\Integrations\Mattermost;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Mattermost\Tools\MattermostCreateChannel;
use OpenCompany\Integrations\Mattermost\Tools\MattermostCreatePost;
use OpenCompany\Integrations\Mattermost\Tools\MattermostDeletePost;
use OpenCompany\Integrations\Mattermost\Tools\MattermostGetChannel;
use OpenCompany\Integrations\Mattermost\Tools\MattermostGetPost;
use OpenCompany\Integrations\Mattermost\Tools\MattermostGetTeam;
use OpenCompany\Integrations\Mattermost\Tools\MattermostGetUser;
use OpenCompany\Integrations\Mattermost\Tools\MattermostListChannels;
use OpenCompany\Integrations\Mattermost\Tools\MattermostListPosts;
use OpenCompany\Integrations\Mattermost\Tools\MattermostListTeams;
use OpenCompany\Integrations\Mattermost\Tools\MattermostListUsers;
use OpenCompany\Integrations\Mattermost\Tools\MattermostUploadFile;

/**
 * Registers all Mattermost tools and provides integration metadata.
 *
 * Exposes 12 tools covering posts, channels, teams, users,
 * and file uploads via the ToolProvider contract.
 */
class MattermostToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'mattermost';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'posts, channels, teams, users',
            'description' => 'Messaging',
            'icon' => 'ph:chat-circle-dots',
            'logo' => 'simple-icons:mattermost',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Mattermost',
            'description' => 'Posts, channels, teams, users, and file uploads',
            'icon' => 'ph:chat-circle-dots',
            'logo' => 'simple-icons:mattermost',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://api.mattermost.com/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'Personal Access Token or Bot Token...',
                'hint' => 'Mattermost Personal Access Token or Bot Token for API authentication.',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'text',
                'label' => 'Base URL',
                'placeholder' => 'https://mattermost.example.com/api/v4',
                'hint' => 'The base URL of your Mattermost server API (e.g. https://mattermost.example.com/api/v4).',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the Mattermost connection using the provided credentials.
     *
     * @param  array<string, mixed>  $config  Configuration containing 'api_token' and 'base_url'
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiToken = $config['api_token'] ?? '';
        $baseUrl = $config['base_url'] ?? '';

        if (empty($apiToken)) {
            return ['success' => false, 'error' => 'No API token provided.'];
        }

        if (empty($baseUrl)) {
            return ['success' => false, 'error' => 'No base URL provided.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get(rtrim($baseUrl, '/') . '/users/me');

            $body = $response->json() ?? [];

            if ($response->successful()) {
                $username = $body['username'] ?? 'Unknown';

                return [
                    'success' => true,
                    'message' => "Connected to Mattermost as {$username}.",
                ];
            }

            $message = $body['message'] ?? $response->body();

            return [
                'success' => false,
                'error' => 'Mattermost API error: ' . (is_string($message) ? $message : json_encode($message)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string> */
    public function validationRules(): array
    {
        return [
            'api_token' => 'nullable|string',
            'base_url'  => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            // Posts
            'mattermost_create_post' => [
                'class' => MattermostCreatePost::class,
                'type' => 'write',
                'name' => 'Create Post',
                'description' => 'Create a new post in a Mattermost channel.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'mattermost_get_post' => [
                'class' => MattermostGetPost::class,
                'type' => 'read',
                'name' => 'Get Post',
                'description' => 'Get a Mattermost post by ID.',
                'icon' => 'ph:chat-circle-text',
            ],
            'mattermost_delete_post' => [
                'class' => MattermostDeletePost::class,
                'type' => 'write',
                'name' => 'Delete Post',
                'description' => 'Delete a Mattermost post.',
                'icon' => 'ph:trash',
            ],
            'mattermost_list_posts' => [
                'class' => MattermostListPosts::class,
                'type' => 'read',
                'name' => 'List Posts',
                'description' => 'List posts in a Mattermost channel.',
                'icon' => 'ph:list-bullets',
            ],
            // Channels
            'mattermost_create_channel' => [
                'class' => MattermostCreateChannel::class,
                'type' => 'write',
                'name' => 'Create Channel',
                'description' => 'Create a channel in a Mattermost team.',
                'icon' => 'ph:plus-circle',
            ],
            'mattermost_list_channels' => [
                'class' => MattermostListChannels::class,
                'type' => 'read',
                'name' => 'List Channels',
                'description' => 'List channels in a Mattermost team.',
                'icon' => 'ph:hash',
            ],
            'mattermost_get_channel' => [
                'class' => MattermostGetChannel::class,
                'type' => 'read',
                'name' => 'Get Channel',
                'description' => 'Get a Mattermost channel by ID.',
                'icon' => 'ph:hash-straight',
            ],
            // Teams
            'mattermost_list_teams' => [
                'class' => MattermostListTeams::class,
                'type' => 'read',
                'name' => 'List Teams',
                'description' => 'List all Mattermost teams.',
                'icon' => 'ph:buildings',
            ],
            'mattermost_get_team' => [
                'class' => MattermostGetTeam::class,
                'type' => 'read',
                'name' => 'Get Team',
                'description' => 'Get a Mattermost team by ID.',
                'icon' => 'ph:building',
            ],
            // Users
            'mattermost_list_users' => [
                'class' => MattermostListUsers::class,
                'type' => 'read',
                'name' => 'List Users',
                'description' => 'List Mattermost users.',
                'icon' => 'ph:users',
            ],
            'mattermost_get_user' => [
                'class' => MattermostGetUser::class,
                'type' => 'read',
                'name' => 'Get User',
                'description' => 'Get a Mattermost user by ID.',
                'icon' => 'ph:user',
            ],
            // Files
            'mattermost_upload_file' => [
                'class' => MattermostUploadFile::class,
                'type' => 'write',
                'name' => 'Upload File',
                'description' => 'Upload a file to Mattermost.',
                'icon' => 'ph:upload-simple',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/mattermost.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
            ['key' => 'base_url', 'type' => 'text', 'label' => 'Base URL', 'required' => true],
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
     * Resolve the MattermostService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): MattermostService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new MattermostService(
                apiToken: $creds->get('mattermost', 'api_token', '', $account),
                baseUrl: $creds->get('mattermost', 'base_url', '', $account),
            );
        }

        return app(MattermostService::class);
    }
}
