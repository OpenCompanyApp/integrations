<?php

namespace OpenCompany\Integrations\Webex;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Webex\Tools\WebexApiDelete;
use OpenCompany\Integrations\Webex\Tools\WebexApiGet;
use OpenCompany\Integrations\Webex\Tools\WebexApiPost;
use OpenCompany\Integrations\Webex\Tools\WebexApiPut;
use OpenCompany\Integrations\Webex\Tools\WebexCreateMessage;
use OpenCompany\Integrations\Webex\Tools\WebexCreateMeeting;
use OpenCompany\Integrations\Webex\Tools\WebexCreateMembership;
use OpenCompany\Integrations\Webex\Tools\WebexCreateRoom;
use OpenCompany\Integrations\Webex\Tools\WebexCreateTeam;
use OpenCompany\Integrations\Webex\Tools\WebexCreateWebhook;
use OpenCompany\Integrations\Webex\Tools\WebexDeleteMeeting;
use OpenCompany\Integrations\Webex\Tools\WebexDeleteMembership;
use OpenCompany\Integrations\Webex\Tools\WebexDeleteMessage;
use OpenCompany\Integrations\Webex\Tools\WebexDeleteRoom;
use OpenCompany\Integrations\Webex\Tools\WebexDeleteTeam;
use OpenCompany\Integrations\Webex\Tools\WebexDeleteWebhook;
use OpenCompany\Integrations\Webex\Tools\WebexGetCurrentUser;
use OpenCompany\Integrations\Webex\Tools\WebexGetMeeting;
use OpenCompany\Integrations\Webex\Tools\WebexGetMessage;
use OpenCompany\Integrations\Webex\Tools\WebexGetPerson;
use OpenCompany\Integrations\Webex\Tools\WebexGetRoom;
use OpenCompany\Integrations\Webex\Tools\WebexGetTeam;
use OpenCompany\Integrations\Webex\Tools\WebexGetWebhook;
use OpenCompany\Integrations\Webex\Tools\WebexListMeetings;
use OpenCompany\Integrations\Webex\Tools\WebexListMemberships;
use OpenCompany\Integrations\Webex\Tools\WebexListMessages;
use OpenCompany\Integrations\Webex\Tools\WebexListPeople;
use OpenCompany\Integrations\Webex\Tools\WebexListRooms;
use OpenCompany\Integrations\Webex\Tools\WebexListTeamMemberships;
use OpenCompany\Integrations\Webex\Tools\WebexListTeams;
use OpenCompany\Integrations\Webex\Tools\WebexListWebhooks;
use OpenCompany\Integrations\Webex\Tools\WebexUpdateMeeting;
use OpenCompany\Integrations\Webex\Tools\WebexUpdateMessage;
use OpenCompany\Integrations\Webex\Tools\WebexUpdateRoom;
use OpenCompany\Integrations\Webex\Tools\WebexUpdateTeam;
use OpenCompany\Integrations\Webex\Tools\WebexUpdateWebhook;

/**
 * Tool catalog and setup metadata for the Cisco Webex integration.
 *
 * Exposes messaging, rooms, people, memberships, teams, meetings, webhooks,
 * and generic relative Webex API helpers.
 */
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
            'label' => 'Cisco Webex',
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
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developer.webex.com/docs/api/getting-started',
        ];
    }

    public function configSchema(): array
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
            'webex_create_room' => [
                'class' => WebexCreateRoom::class,
                'type' => 'write',
                'name' => 'Create Room',
                'description' => 'Create a Webex room.',
                'icon' => 'ph:chat-circle-dots',
            ],
            'webex_update_room' => [
                'class' => WebexUpdateRoom::class,
                'type' => 'write',
                'name' => 'Update Room',
                'description' => 'Update Webex room metadata.',
                'icon' => 'ph:pencil-simple',
            ],
            'webex_delete_room' => [
                'class' => WebexDeleteRoom::class,
                'type' => 'write',
                'name' => 'Delete Room',
                'description' => 'Delete a Webex room.',
                'icon' => 'ph:trash',
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
            'webex_get_message' => [
                'class' => WebexGetMessage::class,
                'type' => 'read',
                'name' => 'Get Message',
                'description' => 'Get one Webex message by ID.',
                'icon' => 'ph:chat-text',
            ],
            'webex_update_message' => [
                'class' => WebexUpdateMessage::class,
                'type' => 'write',
                'name' => 'Update Message',
                'description' => 'Update an existing Webex message.',
                'icon' => 'ph:pencil-simple',
            ],
            'webex_delete_message' => [
                'class' => WebexDeleteMessage::class,
                'type' => 'write',
                'name' => 'Delete Message',
                'description' => 'Delete a Webex message.',
                'icon' => 'ph:trash',
            ],
            'webex_list_people' => [
                'class' => WebexListPeople::class,
                'type' => 'read',
                'name' => 'List People',
                'description' => 'List Webex people.',
                'icon' => 'ph:users',
            ],
            'webex_get_person' => [
                'class' => WebexGetPerson::class,
                'type' => 'read',
                'name' => 'Get Person',
                'description' => 'Get one Webex person profile.',
                'icon' => 'ph:user',
            ],
            'webex_list_memberships' => [
                'class' => WebexListMemberships::class,
                'type' => 'read',
                'name' => 'List Memberships',
                'description' => 'List Webex room memberships.',
                'icon' => 'ph:users-three',
            ],
            'webex_create_membership' => [
                'class' => WebexCreateMembership::class,
                'type' => 'write',
                'name' => 'Create Membership',
                'description' => 'Add a person to a Webex room.',
                'icon' => 'ph:user-plus',
            ],
            'webex_delete_membership' => [
                'class' => WebexDeleteMembership::class,
                'type' => 'write',
                'name' => 'Delete Membership',
                'description' => 'Remove a person from a Webex room.',
                'icon' => 'ph:user-minus',
            ],
            'webex_list_teams' => [
                'class' => WebexListTeams::class,
                'type' => 'read',
                'name' => 'List Teams',
                'description' => 'List Webex teams.',
                'icon' => 'ph:users-four',
            ],
            'webex_get_team' => [
                'class' => WebexGetTeam::class,
                'type' => 'read',
                'name' => 'Get Team',
                'description' => 'Get one Webex team by ID.',
                'icon' => 'ph:users-four',
            ],
            'webex_create_team' => [
                'class' => WebexCreateTeam::class,
                'type' => 'write',
                'name' => 'Create Team',
                'description' => 'Create a Webex team.',
                'icon' => 'ph:user-plus',
            ],
            'webex_update_team' => [
                'class' => WebexUpdateTeam::class,
                'type' => 'write',
                'name' => 'Update Team',
                'description' => 'Update a Webex team.',
                'icon' => 'ph:pencil-simple',
            ],
            'webex_delete_team' => [
                'class' => WebexDeleteTeam::class,
                'type' => 'write',
                'name' => 'Delete Team',
                'description' => 'Delete a Webex team.',
                'icon' => 'ph:trash',
            ],
            'webex_list_team_memberships' => [
                'class' => WebexListTeamMemberships::class,
                'type' => 'read',
                'name' => 'List Team Memberships',
                'description' => 'List Webex team memberships.',
                'icon' => 'ph:users-three',
            ],
            'webex_list_meetings' => [
                'class' => WebexListMeetings::class,
                'type' => 'read',
                'name' => 'List Meetings',
                'description' => 'List scheduled Webex meetings.',
                'icon' => 'ph:video-camera',
            ],
            'webex_get_meeting' => [
                'class' => WebexGetMeeting::class,
                'type' => 'read',
                'name' => 'Get Meeting',
                'description' => 'Get one Webex meeting by ID.',
                'icon' => 'ph:video-camera',
            ],
            'webex_create_meeting' => [
                'class' => WebexCreateMeeting::class,
                'type' => 'write',
                'name' => 'Create Meeting',
                'description' => 'Create a Webex meeting.',
                'icon' => 'ph:video-camera',
            ],
            'webex_update_meeting' => [
                'class' => WebexUpdateMeeting::class,
                'type' => 'write',
                'name' => 'Update Meeting',
                'description' => 'Update a Webex meeting.',
                'icon' => 'ph:pencil-simple',
            ],
            'webex_delete_meeting' => [
                'class' => WebexDeleteMeeting::class,
                'type' => 'write',
                'name' => 'Delete Meeting',
                'description' => 'Delete a Webex meeting.',
                'icon' => 'ph:trash',
            ],
            'webex_list_webhooks' => [
                'class' => WebexListWebhooks::class,
                'type' => 'read',
                'name' => 'List Webhooks',
                'description' => 'List Webex webhooks.',
                'icon' => 'ph:webhooks-logo',
            ],
            'webex_get_webhook' => [
                'class' => WebexGetWebhook::class,
                'type' => 'read',
                'name' => 'Get Webhook',
                'description' => 'Get one Webex webhook by ID.',
                'icon' => 'ph:webhooks-logo',
            ],
            'webex_create_webhook' => [
                'class' => WebexCreateWebhook::class,
                'type' => 'write',
                'name' => 'Create Webhook',
                'description' => 'Create a Webex webhook.',
                'icon' => 'ph:webhooks-logo',
            ],
            'webex_update_webhook' => [
                'class' => WebexUpdateWebhook::class,
                'type' => 'write',
                'name' => 'Update Webhook',
                'description' => 'Update a Webex webhook.',
                'icon' => 'ph:pencil-simple',
            ],
            'webex_delete_webhook' => [
                'class' => WebexDeleteWebhook::class,
                'type' => 'write',
                'name' => 'Delete Webhook',
                'description' => 'Delete a Webex webhook.',
                'icon' => 'ph:trash',
            ],
            'webex_get_current_user' => [
                'class' => WebexGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the profile of the authenticated Webex user.',
                'icon' => 'ph:user',
            ],
            'webex_api_get' => [
                'class' => WebexApiGet::class,
                'type' => 'read',
                'name' => 'API GET',
                'description' => 'Call a relative Webex API GET endpoint.',
                'icon' => 'ph:brackets-curly',
            ],
            'webex_api_post' => [
                'class' => WebexApiPost::class,
                'type' => 'write',
                'name' => 'API POST',
                'description' => 'Call a relative Webex API POST endpoint.',
                'icon' => 'ph:brackets-curly',
            ],
            'webex_api_put' => [
                'class' => WebexApiPut::class,
                'type' => 'write',
                'name' => 'API PUT',
                'description' => 'Call a relative Webex API PUT endpoint.',
                'icon' => 'ph:brackets-curly',
            ],
            'webex_api_delete' => [
                'class' => WebexApiDelete::class,
                'type' => 'write',
                'name' => 'API DELETE',
                'description' => 'Call a relative Webex API DELETE endpoint.',
                'icon' => 'ph:brackets-curly',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/webex.md';
    }

    public function credentialFields(): array
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
            $creds = app(CredentialResolver::class);

            $service = new WebexService(
                accessToken: $creds->get('webex', 'access_token', '', $account),
                baseUrl: $creds->get('webex', 'url', 'https://webexapis.com/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(WebexService::class));
    }
}
