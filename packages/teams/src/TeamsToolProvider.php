<?php

namespace OpenCompany\Integrations\Teams;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Teams\Tools\TeamsListTeams;
use OpenCompany\Integrations\Teams\Tools\TeamsGetTeam;
use OpenCompany\Integrations\Teams\Tools\TeamsListChannels;
use OpenCompany\Integrations\Teams\Tools\TeamsGetChannel;
use OpenCompany\Integrations\Teams\Tools\TeamsSendMessage;
use OpenCompany\Integrations\Teams\Tools\TeamsListMessages;
use OpenCompany\Integrations\Teams\Tools\TeamsGetCurrentUser;

/**
 * Registers all Microsoft Teams tools and provides integration metadata.
 *
 * Exposes 7 tools covering teams, channels, messages, and users
 * via the ToolProvider contract.
 */
class TeamsToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'teams';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'teams, channels, messages, users',
            'description' => 'Communication',
            'icon' => 'ph:microsoft-teams-logo',
            'logo' => 'simple-icons:microsoftteams',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Microsoft Teams',
            'description' => 'Teams, channels, messages, and users via Microsoft Graph API',
            'icon' => 'ph:microsoft-teams-logo',
            'logo' => 'simple-icons:microsoftteams',
            'category' => 'communication',
            'badge' => 'verified',
            'docs_url' => 'https://learn.microsoft.com/en-us/graph/api/resources/teams-api-overview',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'eyJ0eXAiOi...',
                'hint' => 'Microsoft Graph API access token with the required delegated permissions (e.g. <code>Team.ReadBasic.All</code>, <code>ChannelMessage.Send</code>).',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the Microsoft Teams connection using the provided credentials.
     *
     * @param  array<string, mixed>  $config  Configuration containing 'access_token'
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided. Obtain one from Microsoft Entra ID (Azure AD).'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get('https://graph.microsoft.com/v1.0/me');

            if (! $response->successful()) {
                $body = $response->json() ?? [];
                $error = $body['error']['message'] ?? $response->body();

                return [
                    'success' => false,
                    'error' => 'Microsoft Graph API error: ' . (is_string($error) ? $error : json_encode($error)),
                ];
            }

            $me = $response->json() ?? [];
            $displayName = $me['displayName'] ?? 'Unknown';
            $upn = $me['userPrincipalName'] ?? 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to Microsoft Teams as {$displayName} ({$upn}).",
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
            // Teams
            'teams_list_teams' => [
                'class' => TeamsListTeams::class,
                'type' => 'read',
                'name' => 'List Teams',
                'description' => 'List all Microsoft Teams the user is a member of.',
                'icon' => 'ph:users-three',
            ],
            'teams_get_team' => [
                'class' => TeamsGetTeam::class,
                'type' => 'read',
                'name' => 'Get Team',
                'description' => 'Get detailed information about a Microsoft Team.',
                'icon' => 'ph:users',
            ],
            // Channels
            'teams_list_channels' => [
                'class' => TeamsListChannels::class,
                'type' => 'read',
                'name' => 'List Channels',
                'description' => 'List all channels in a Microsoft Team.',
                'icon' => 'ph:hash',
            ],
            'teams_get_channel' => [
                'class' => TeamsGetChannel::class,
                'type' => 'read',
                'name' => 'Get Channel',
                'description' => 'Get detailed information about a Teams channel.',
                'icon' => 'ph:hash-straight',
            ],
            // Messages
            'teams_send_message' => [
                'class' => TeamsSendMessage::class,
                'type' => 'write',
                'name' => 'Send Message',
                'description' => 'Send a message to a Microsoft Teams channel.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'teams_list_messages' => [
                'class' => TeamsListMessages::class,
                'type' => 'read',
                'name' => 'List Messages',
                'description' => 'List messages in a Microsoft Teams channel.',
                'icon' => 'ph:chat-circle-text',
            ],
            // Users
            'teams_get_current_user' => [
                'class' => TeamsGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get information about the current authenticated Microsoft 365 user.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/teams.md';
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
     * Resolve the TeamsService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): TeamsService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new TeamsService(
                accessToken: $creds->get('teams', 'access_token', '', $account),
            );
        }

        return app(TeamsService::class);
    }
}
