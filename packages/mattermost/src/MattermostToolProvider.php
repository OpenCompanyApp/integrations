<?php

namespace OpenCompany\Integrations\Mattermost;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Mattermost\Tools\MattermostAddChannelMember;
use OpenCompany\Integrations\Mattermost\Tools\MattermostAddTeamMember;
use OpenCompany\Integrations\Mattermost\Tools\MattermostApiDelete;
use OpenCompany\Integrations\Mattermost\Tools\MattermostApiGet;
use OpenCompany\Integrations\Mattermost\Tools\MattermostApiPatch;
use OpenCompany\Integrations\Mattermost\Tools\MattermostApiPost;
use OpenCompany\Integrations\Mattermost\Tools\MattermostApiPut;
use OpenCompany\Integrations\Mattermost\Tools\MattermostCreateChannel;
use OpenCompany\Integrations\Mattermost\Tools\MattermostCreatePost;
use OpenCompany\Integrations\Mattermost\Tools\MattermostCreateReaction;
use OpenCompany\Integrations\Mattermost\Tools\MattermostCreateTeam;
use OpenCompany\Integrations\Mattermost\Tools\MattermostCreateUser;
use OpenCompany\Integrations\Mattermost\Tools\MattermostDeactivateUser;
use OpenCompany\Integrations\Mattermost\Tools\MattermostDeleteChannel;
use OpenCompany\Integrations\Mattermost\Tools\MattermostDeletePost;
use OpenCompany\Integrations\Mattermost\Tools\MattermostDeleteReaction;
use OpenCompany\Integrations\Mattermost\Tools\MattermostGetChannel;
use OpenCompany\Integrations\Mattermost\Tools\MattermostGetCurrentUser;
use OpenCompany\Integrations\Mattermost\Tools\MattermostGetFileInfo;
use OpenCompany\Integrations\Mattermost\Tools\MattermostGetPost;
use OpenCompany\Integrations\Mattermost\Tools\MattermostGetPostThread;
use OpenCompany\Integrations\Mattermost\Tools\MattermostGetTeam;
use OpenCompany\Integrations\Mattermost\Tools\MattermostGetUser;
use OpenCompany\Integrations\Mattermost\Tools\MattermostGetUserByUsername;
use OpenCompany\Integrations\Mattermost\Tools\MattermostListChannelMembers;
use OpenCompany\Integrations\Mattermost\Tools\MattermostListChannels;
use OpenCompany\Integrations\Mattermost\Tools\MattermostListPostReactions;
use OpenCompany\Integrations\Mattermost\Tools\MattermostListPosts;
use OpenCompany\Integrations\Mattermost\Tools\MattermostListTeamChannels;
use OpenCompany\Integrations\Mattermost\Tools\MattermostListTeamMembers;
use OpenCompany\Integrations\Mattermost\Tools\MattermostListTeams;
use OpenCompany\Integrations\Mattermost\Tools\MattermostListUsers;
use OpenCompany\Integrations\Mattermost\Tools\MattermostPatchChannel;
use OpenCompany\Integrations\Mattermost\Tools\MattermostPatchPost;
use OpenCompany\Integrations\Mattermost\Tools\MattermostPatchTeam;
use OpenCompany\Integrations\Mattermost\Tools\MattermostPatchUser;
use OpenCompany\Integrations\Mattermost\Tools\MattermostRemoveChannelMember;
use OpenCompany\Integrations\Mattermost\Tools\MattermostRemoveTeamMember;
use OpenCompany\Integrations\Mattermost\Tools\MattermostSearchChannels;
use OpenCompany\Integrations\Mattermost\Tools\MattermostSearchPosts;
use OpenCompany\Integrations\Mattermost\Tools\MattermostSearchUsers;

/**
 * Tool catalog and setup metadata for the Mattermost integration.
 *
 * Exposes REST API v4 coverage for users, teams, channels, posts, reactions,
 * file metadata, and raw endpoint calls.
 */
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
                'setup_flows' => ['manual_token'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['access_token'],
                'notes' => ['Use a Mattermost personal access token or bot token with permissions for the target server.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
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
            'label' => 'Mattermost',
            'description' => 'Team messaging, users, teams, channels, posts, reactions, and files',
            'icon' => 'ph:chat-circle-text',
            'logo' => 'simple-icons:mattermost',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Mattermost',
            'description' => 'Mattermost REST API v4 tools for users, teams, channels, posts, reactions, file metadata, and raw API calls.',
            'icon' => 'ph:chat-circle-text',
            'logo' => 'simple-icons:mattermost',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.mattermost.com/api-documentation/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Mattermost personal access token',
                'hint' => 'Generate a personal access token in Mattermost under Account Settings > Security > Personal Access Tokens.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Server URL',
                'placeholder' => 'https://mattermost.example.com',
                'hint' => 'The base URL of your Mattermost server, without a trailing slash.',
                'default' => 'https://mattermost.example.com',
            ],
        ];
    }

    /**
     * Verify Mattermost credentials using the current user endpoint.
     *
     * @param  array<string, mixed>  $config  Credential and server settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://mattermost.example.com'), '/');

        if ($accessToken === '') {
            return ['success' => false, 'error' => 'No access token provided.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl.'/api/v4/users/me');

            if (!$response->successful()) {
                $error = $response->json('message') ?? $response->body();

                return ['success' => false, 'error' => 'Mattermost API error: '.(is_string($error) ? $error : json_encode($error))];
            }

            $json = $response->json();
            if (!is_array($json)) {
                return ['success' => false, 'error' => "Could not reach Mattermost API at {$baseUrl}."];
            }

            $username = $json['username'] ?? 'unknown';

            return ['success' => true, 'message' => "Connected to Mattermost as @{$username} at {$baseUrl}."];
        } catch (\Throwable $e) {
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
            'mattermost_api_get' => ['class' => MattermostApiGet::class, 'type' => 'read', 'name' => 'API GET', 'description' => 'Execute a raw Mattermost API GET request.', 'icon' => 'ph:brackets-curly'],
            'mattermost_api_post' => ['class' => MattermostApiPost::class, 'type' => 'write', 'name' => 'API POST', 'description' => 'Execute a raw Mattermost API POST request.', 'icon' => 'ph:brackets-curly'],
            'mattermost_api_put' => ['class' => MattermostApiPut::class, 'type' => 'write', 'name' => 'API PUT', 'description' => 'Execute a raw Mattermost API PUT request.', 'icon' => 'ph:brackets-curly'],
            'mattermost_api_patch' => ['class' => MattermostApiPatch::class, 'type' => 'write', 'name' => 'API PATCH', 'description' => 'Execute a raw Mattermost API PATCH request.', 'icon' => 'ph:brackets-curly'],
            'mattermost_api_delete' => ['class' => MattermostApiDelete::class, 'type' => 'write', 'name' => 'API DELETE', 'description' => 'Execute a raw Mattermost API DELETE request.', 'icon' => 'ph:brackets-curly'],

            'mattermost_get_current_user' => ['class' => MattermostGetCurrentUser::class, 'type' => 'read', 'name' => 'Get Current User', 'description' => 'Get the currently authenticated user profile.', 'icon' => 'ph:user-circle'],
            'mattermost_list_users' => ['class' => MattermostListUsers::class, 'type' => 'read', 'name' => 'List Users', 'description' => 'List Mattermost users.', 'icon' => 'ph:users'],
            'mattermost_search_users' => ['class' => MattermostSearchUsers::class, 'type' => 'read', 'name' => 'Search Users', 'description' => 'Search Mattermost users.', 'icon' => 'ph:magnifying-glass'],
            'mattermost_get_user' => ['class' => MattermostGetUser::class, 'type' => 'read', 'name' => 'Get User', 'description' => 'Get a Mattermost user by ID.', 'icon' => 'ph:user'],
            'mattermost_get_user_by_username' => ['class' => MattermostGetUserByUsername::class, 'type' => 'read', 'name' => 'Get User By Username', 'description' => 'Get a Mattermost user by username.', 'icon' => 'ph:user-focus'],
            'mattermost_create_user' => ['class' => MattermostCreateUser::class, 'type' => 'write', 'name' => 'Create User', 'description' => 'Create a Mattermost user.', 'icon' => 'ph:user-plus'],
            'mattermost_patch_user' => ['class' => MattermostPatchUser::class, 'type' => 'write', 'name' => 'Patch User', 'description' => 'Patch a Mattermost user.', 'icon' => 'ph:user-gear'],
            'mattermost_deactivate_user' => ['class' => MattermostDeactivateUser::class, 'type' => 'write', 'name' => 'Set User Active', 'description' => 'Deactivate or activate a Mattermost user.', 'icon' => 'ph:user-minus'],

            'mattermost_list_teams' => ['class' => MattermostListTeams::class, 'type' => 'read', 'name' => 'List Teams', 'description' => 'List teams the current user belongs to.', 'icon' => 'ph:users-three'],
            'mattermost_get_team' => ['class' => MattermostGetTeam::class, 'type' => 'read', 'name' => 'Get Team', 'description' => 'Get a Mattermost team.', 'icon' => 'ph:users-three'],
            'mattermost_create_team' => ['class' => MattermostCreateTeam::class, 'type' => 'write', 'name' => 'Create Team', 'description' => 'Create a Mattermost team.', 'icon' => 'ph:plus-circle'],
            'mattermost_patch_team' => ['class' => MattermostPatchTeam::class, 'type' => 'write', 'name' => 'Patch Team', 'description' => 'Patch a Mattermost team.', 'icon' => 'ph:pencil-simple'],
            'mattermost_list_team_members' => ['class' => MattermostListTeamMembers::class, 'type' => 'read', 'name' => 'List Team Members', 'description' => 'List Mattermost team members.', 'icon' => 'ph:users'],
            'mattermost_add_team_member' => ['class' => MattermostAddTeamMember::class, 'type' => 'write', 'name' => 'Add Team Member', 'description' => 'Add a user to a Mattermost team.', 'icon' => 'ph:user-plus'],
            'mattermost_remove_team_member' => ['class' => MattermostRemoveTeamMember::class, 'type' => 'write', 'name' => 'Remove Team Member', 'description' => 'Remove a user from a Mattermost team.', 'icon' => 'ph:user-minus'],

            'mattermost_list_channels' => ['class' => MattermostListChannels::class, 'type' => 'read', 'name' => 'List Channels', 'description' => 'List channels the current user belongs to.', 'icon' => 'ph:hash'],
            'mattermost_list_team_channels' => ['class' => MattermostListTeamChannels::class, 'type' => 'read', 'name' => 'List Team Channels', 'description' => 'List channels in a Mattermost team.', 'icon' => 'ph:hash'],
            'mattermost_search_channels' => ['class' => MattermostSearchChannels::class, 'type' => 'read', 'name' => 'Search Channels', 'description' => 'Search channels in a Mattermost team.', 'icon' => 'ph:magnifying-glass'],
            'mattermost_create_channel' => ['class' => MattermostCreateChannel::class, 'type' => 'write', 'name' => 'Create Channel', 'description' => 'Create a Mattermost channel.', 'icon' => 'ph:plus-circle'],
            'mattermost_get_channel' => ['class' => MattermostGetChannel::class, 'type' => 'read', 'name' => 'Get Channel', 'description' => 'Get details of a specific channel.', 'icon' => 'ph:hash'],
            'mattermost_patch_channel' => ['class' => MattermostPatchChannel::class, 'type' => 'write', 'name' => 'Patch Channel', 'description' => 'Patch a Mattermost channel.', 'icon' => 'ph:pencil-simple'],
            'mattermost_delete_channel' => ['class' => MattermostDeleteChannel::class, 'type' => 'write', 'name' => 'Delete Channel', 'description' => 'Delete a Mattermost channel.', 'icon' => 'ph:trash'],
            'mattermost_list_channel_members' => ['class' => MattermostListChannelMembers::class, 'type' => 'read', 'name' => 'List Channel Members', 'description' => 'List Mattermost channel members.', 'icon' => 'ph:users'],
            'mattermost_add_channel_member' => ['class' => MattermostAddChannelMember::class, 'type' => 'write', 'name' => 'Add Channel Member', 'description' => 'Add a user to a Mattermost channel.', 'icon' => 'ph:user-plus'],
            'mattermost_remove_channel_member' => ['class' => MattermostRemoveChannelMember::class, 'type' => 'write', 'name' => 'Remove Channel Member', 'description' => 'Remove a user from a Mattermost channel.', 'icon' => 'ph:user-minus'],

            'mattermost_create_post' => ['class' => MattermostCreatePost::class, 'type' => 'write', 'name' => 'Create Post', 'description' => 'Post a message to a channel.', 'icon' => 'ph:paper-plane-tilt'],
            'mattermost_list_posts' => ['class' => MattermostListPosts::class, 'type' => 'read', 'name' => 'List Posts', 'description' => 'List posts in a channel.', 'icon' => 'ph:list-bullets'],
            'mattermost_get_post' => ['class' => MattermostGetPost::class, 'type' => 'read', 'name' => 'Get Post', 'description' => 'Get a specific post by ID.', 'icon' => 'ph:chat-text'],
            'mattermost_patch_post' => ['class' => MattermostPatchPost::class, 'type' => 'write', 'name' => 'Patch Post', 'description' => 'Patch a Mattermost post.', 'icon' => 'ph:pencil-simple'],
            'mattermost_delete_post' => ['class' => MattermostDeletePost::class, 'type' => 'write', 'name' => 'Delete Post', 'description' => 'Delete a Mattermost post.', 'icon' => 'ph:trash'],
            'mattermost_search_posts' => ['class' => MattermostSearchPosts::class, 'type' => 'read', 'name' => 'Search Posts', 'description' => 'Search posts in a Mattermost team.', 'icon' => 'ph:magnifying-glass'],
            'mattermost_get_post_thread' => ['class' => MattermostGetPostThread::class, 'type' => 'read', 'name' => 'Get Post Thread', 'description' => 'Get a Mattermost post thread.', 'icon' => 'ph:tree-structure'],
            'mattermost_list_post_reactions' => ['class' => MattermostListPostReactions::class, 'type' => 'read', 'name' => 'List Post Reactions', 'description' => 'List reactions for a Mattermost post.', 'icon' => 'ph:smiley'],
            'mattermost_create_reaction' => ['class' => MattermostCreateReaction::class, 'type' => 'write', 'name' => 'Create Reaction', 'description' => 'Add a reaction to a Mattermost post.', 'icon' => 'ph:smiley'],
            'mattermost_delete_reaction' => ['class' => MattermostDeleteReaction::class, 'type' => 'write', 'name' => 'Delete Reaction', 'description' => 'Delete a Mattermost reaction.', 'icon' => 'ph:smiley-x-eyes'],
            'mattermost_get_file_info' => ['class' => MattermostGetFileInfo::class, 'type' => 'read', 'name' => 'Get File Info', 'description' => 'Get Mattermost file metadata.', 'icon' => 'ph:file'],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__.'/../script-docs/mattermost.md';
    }

    public function credentialFields(): array
    {
        return $this->configSchema();
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a Mattermost tool from the catalog class name.
     *
     * @param  array<string, mixed>  $context  Optional account context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve a service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Optional account context.
     */
    private function resolveService(array $context = []): MattermostService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new MattermostService(
                accessToken: $creds->get('mattermost', 'access_token', '', $account),
                baseUrl: $creds->get('mattermost', 'url', 'https://mattermost.example.com', $account),
            );
        }

        return app(MattermostService::class);
    }
}
