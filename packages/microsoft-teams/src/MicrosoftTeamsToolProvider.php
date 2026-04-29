<?php

namespace OpenCompany\Integrations\MicrosoftTeams;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\MicrosoftTeams\Tools\MicrosoftTeamsListTeams;
use OpenCompany\Integrations\MicrosoftTeams\Tools\MicrosoftTeamsGetTeam;
use OpenCompany\Integrations\MicrosoftTeams\Tools\MicrosoftTeamsListChannels;
use OpenCompany\Integrations\MicrosoftTeams\Tools\MicrosoftTeamsGetChannel;
use OpenCompany\Integrations\MicrosoftTeams\Tools\MicrosoftTeamsListMessages;
use OpenCompany\Integrations\MicrosoftTeams\Tools\MicrosoftTeamsSendMessage;
use OpenCompany\Integrations\MicrosoftTeams\Tools\MicrosoftTeamsListChats;
use OpenCompany\Integrations\MicrosoftTeams\Tools\MicrosoftTeamsGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class MicrosoftTeamsToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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

    /**
     * Get the application name identifier.
     */
    public function appName(): string
    {
        return 'microsoft-teams';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Microsoft Teams',
            'description' => 'Microsoft Teams integration for Laravel — list teams, channels, messages, send messages…',
            'icon' => 'ph:plug',
            'logo' => 'ph:plug',
        ];
    }

    /**
     * Canonical integration metadata used by settings and generated catalogs.
     *
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Microsoft Teams',
            'description' => 'Microsoft Teams integration for Laravel — list teams, channels, messages, send messages, and manage chats via the Graph API.',
            'icon' => 'ph:plug',
            'logo' => 'ph:plug',
            'category' => 'other',
            'badge' => 'verified',
        ];
    }
/**
     * Get the configuration schema for this integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Microsoft Graph API access token',
                'hint' => 'Provide an OAuth2 access token with the required Microsoft Graph permissions (Team.ReadBasic.All, Channel.ReadBasic.All, ChannelMessage.Read.All, ChannelMessage.Send, Chat.Read)',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'Graph API Base URL',
                'placeholder' => 'https://graph.microsoft.com/v1.0',
                'hint' => 'Use <code>https://graph.microsoft.com/v1.0</code> for the global endpoint, or a national cloud URL',
                'default' => 'https://graph.microsoft.com/v1.0',
            ],
        ];
    }

    /**
     * Test the connection to the Microsoft Graph API.
     *
     * @param  array<string, mixed>  $config
     * @return array<string, mixed>
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['base_url'] ?? 'https://graph.microsoft.com/v1.0', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/me');

            $json = $response->json();

            if ($response->successful() && isset($json['displayName'])) {
                return [
                    'success' => true,
                    'message' => "Connected to Microsoft Graph API as {$json['displayName']}.",
                ];
            }

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Microsoft Graph API at {$baseUrl}. Check the URL.",
                ];
            }

            $error = $json['error']['message'] ?? $response->body();

            return [
                'success' => false,
                'error' => "Authentication failed: {$error}",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for configuration values.
     *
     * @return array<string, mixed>
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'base_url' => 'nullable|url',
        ];
    }

    /**
     * Get the available tools provided by this integration.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            'microsoft_teams_list_teams' => [
                'class' => MicrosoftTeamsListTeams::class,
                'type' => 'read',
                'name' => 'List Teams',
                'description' => 'List all teams the authenticated user has joined.',
                'icon' => 'ph:users-three',
            ],
            'microsoft_teams_get_team' => [
                'class' => MicrosoftTeamsGetTeam::class,
                'type' => 'read',
                'name' => 'Get Team',
                'description' => 'Get details for a specific team.',
                'icon' => 'ph:users-three',
            ],
            'microsoft_teams_list_channels' => [
                'class' => MicrosoftTeamsListChannels::class,
                'type' => 'read',
                'name' => 'List Channels',
                'description' => 'List all channels in a team.',
                'icon' => 'ph:hash',
            ],
            'microsoft_teams_get_channel' => [
                'class' => MicrosoftTeamsGetChannel::class,
                'type' => 'read',
                'name' => 'Get Channel',
                'description' => 'Get details for a specific channel.',
                'icon' => 'ph:hash',
            ],
            'microsoft_teams_list_messages' => [
                'class' => MicrosoftTeamsListMessages::class,
                'type' => 'read',
                'name' => 'List Messages',
                'description' => 'List recent messages in a channel.',
                'icon' => 'ph:chat-circle-text',
            ],
            'microsoft_teams_send_message' => [
                'class' => MicrosoftTeamsSendMessage::class,
                'type' => 'write',
                'name' => 'Send Message',
                'description' => 'Send a message to a Teams channel.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'microsoft_teams_list_chats' => [
                'class' => MicrosoftTeamsListChats::class,
                'type' => 'read',
                'name' => 'List Chats',
                'description' => 'List chats for the authenticated user.',
                'icon' => 'ph:chat-circle-dots',
            ],
            'microsoft_teams_get_current_user' => [
                'class' => MicrosoftTeamsGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the profile of the currently authenticated user.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/microsoft-teams.md';
    }

    /**
     * Get the credential fields required for this integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'Graph API Base URL', 'required' => false, 'default' => 'https://graph.microsoft.com/v1.0'],
        ];
    }

    /**
     * Confirm this is an integration provider.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally using account-specific credentials.
     *
     * @param  string  $class   The fully-qualified tool class name.
     * @param  array<string, mixed>  $context  Context containing optional 'account' key.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new MicrosoftTeamsService(
                accessToken: $creds->get('microsoft-teams', 'access_token', '', $account),
                baseUrl: $creds->get('microsoft-teams', 'base_url', 'https://graph.microsoft.com/v1.0', $account),
            );

            return new $class($service);
        }

        return new $class(app(MicrosoftTeamsService::class));
    }
}
