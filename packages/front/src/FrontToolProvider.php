<?php

namespace OpenCompany\Integrations\Front;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Front\Tools\FrontAddComment;
use OpenCompany\Integrations\Front\Tools\FrontAddContactHandle;
use OpenCompany\Integrations\Front\Tools\FrontAddConversationTags;
use OpenCompany\Integrations\Front\Tools\FrontAddInboxAccess;
use OpenCompany\Integrations\Front\Tools\FrontApiDelete;
use OpenCompany\Integrations\Front\Tools\FrontApiGet;
use OpenCompany\Integrations\Front\Tools\FrontApiPatch;
use OpenCompany\Integrations\Front\Tools\FrontApiPost;
use OpenCompany\Integrations\Front\Tools\FrontApiPut;
use OpenCompany\Integrations\Front\Tools\FrontCreateChannel;
use OpenCompany\Integrations\Front\Tools\FrontCreateCompanyTag;
use OpenCompany\Integrations\Front\Tools\FrontCreateContact;
use OpenCompany\Integrations\Front\Tools\FrontCreateDiscussionConversation;
use OpenCompany\Integrations\Front\Tools\FrontCreateDraft;
use OpenCompany\Integrations\Front\Tools\FrontCreateMessage;
use OpenCompany\Integrations\Front\Tools\FrontCreateTag;
use OpenCompany\Integrations\Front\Tools\FrontCreateTeamInbox;
use OpenCompany\Integrations\Front\Tools\FrontCreateTeamTag;
use OpenCompany\Integrations\Front\Tools\FrontCreateTeammateContact;
use OpenCompany\Integrations\Front\Tools\FrontCreateTeammateTag;
use OpenCompany\Integrations\Front\Tools\FrontDeleteContact;
use OpenCompany\Integrations\Front\Tools\FrontDeleteTag;
use OpenCompany\Integrations\Front\Tools\FrontGetContact;
use OpenCompany\Integrations\Front\Tools\FrontGetConversation;
use OpenCompany\Integrations\Front\Tools\FrontGetCurrentUser;
use OpenCompany\Integrations\Front\Tools\FrontGetInbox;
use OpenCompany\Integrations\Front\Tools\FrontGetMessage;
use OpenCompany\Integrations\Front\Tools\FrontGetTag;
use OpenCompany\Integrations\Front\Tools\FrontGetTeam;
use OpenCompany\Integrations\Front\Tools\FrontGetTeammate;
use OpenCompany\Integrations\Front\Tools\FrontImportMessage;
use OpenCompany\Integrations\Front\Tools\FrontListAssignedConversations;
use OpenCompany\Integrations\Front\Tools\FrontListCompanyTags;
use OpenCompany\Integrations\Front\Tools\FrontListContactConversations;
use OpenCompany\Integrations\Front\Tools\FrontListContacts;
use OpenCompany\Integrations\Front\Tools\FrontListConversationComments;
use OpenCompany\Integrations\Front\Tools\FrontListConversationInboxes;
use OpenCompany\Integrations\Front\Tools\FrontListConversations;
use OpenCompany\Integrations\Front\Tools\FrontListInboxAccess;
use OpenCompany\Integrations\Front\Tools\FrontListInboxChannels;
use OpenCompany\Integrations\Front\Tools\FrontListInboxConversations;
use OpenCompany\Integrations\Front\Tools\FrontListInboxes;
use OpenCompany\Integrations\Front\Tools\FrontListMessages;
use OpenCompany\Integrations\Front\Tools\FrontListTaggedConversations;
use OpenCompany\Integrations\Front\Tools\FrontListTags;
use OpenCompany\Integrations\Front\Tools\FrontListTeamContacts;
use OpenCompany\Integrations\Front\Tools\FrontListTeamInboxes;
use OpenCompany\Integrations\Front\Tools\FrontListTeamRules;
use OpenCompany\Integrations\Front\Tools\FrontListTeamTags;
use OpenCompany\Integrations\Front\Tools\FrontListTeammateContacts;
use OpenCompany\Integrations\Front\Tools\FrontListTeammateInboxes;
use OpenCompany\Integrations\Front\Tools\FrontListTeammateRules;
use OpenCompany\Integrations\Front\Tools\FrontListTeammateTags;
use OpenCompany\Integrations\Front\Tools\FrontListTeammates;
use OpenCompany\Integrations\Front\Tools\FrontListTeams;
use OpenCompany\Integrations\Front\Tools\FrontRemoveConversationTags;
use OpenCompany\Integrations\Front\Tools\FrontRemoveInboxAccess;
use OpenCompany\Integrations\Front\Tools\FrontSearchConversations;
use OpenCompany\Integrations\Front\Tools\FrontSendMessage;
use OpenCompany\Integrations\Front\Tools\FrontUpdateContact;
use OpenCompany\Integrations\Front\Tools\FrontUpdateConversation;
use OpenCompany\Integrations\Front\Tools\FrontUpdateConversationReminders;
use OpenCompany\Integrations\Front\Tools\FrontUpdateTag;
use OpenCompany\Integrations\Front\Tools\FrontUpdateTeammate;

/**
 * Tool provider for Front Core API resources.
 *
 * Exposes typed tools for conversations, messages, comments, contacts,
 * inboxes, tags, teams, and teammates plus raw API helpers for newer routes.
 */
class FrontToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'notes' => [],
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
        return 'front';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Front',
            'description' => 'Customer communication, inbox, and contact management',
            'icon' => 'ph:chat-circle-dots',
            'logo' => 'simple-icons:front',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Front',
            'description' => 'Customer conversations, messages, comments, contacts, inboxes, tags, teams, and teammates',
            'icon' => 'ph:chat-circle-dots',
            'logo' => 'simple-icons:front',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://dev.frontapp.com/reference/channel-api',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Front API access token',
                'hint' => 'Generate an API token in Front under Settings > Plugins & API > API',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api2.frontapp.com',
                'hint' => 'Use the default https://api2.frontapp.com unless using a custom API endpoint',
                'default' => 'https://api2.frontapp.com',
            ],
        ];
    }

    /**
     * Test the connection to the Front API using the provided config.
     *
     * @param  array<string, mixed>  $config  Configuration values to test.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api2.frontapp.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/me');

            if (!$response->successful()) {
                return ['success' => false, 'error' => 'Front API error (' . $response->status() . '): ' . $response->body()];
            }

            $json = $response->json();

            if (!is_array($json)) {
                return ['success' => false, 'error' => "Could not reach Front API at {$baseUrl}. Check the URL."];
            }

            $name = trim(($json['first_name'] ?? '') . ' ' . ($json['last_name'] ?? ''));
            $name = $name !== '' ? $name : ($json['email'] ?? 'authenticated user');

            return ['success' => true, 'message' => "Connected to Front API as {$name}."];
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
            'front_api_get' => ['class' => FrontApiGet::class, 'type' => 'read', 'name' => 'API GET', 'description' => 'Call any Front GET endpoint.', 'icon' => 'ph:plug'],
            'front_api_post' => ['class' => FrontApiPost::class, 'type' => 'write', 'name' => 'API POST', 'description' => 'Call any Front POST endpoint.', 'icon' => 'ph:plug'],
            'front_api_patch' => ['class' => FrontApiPatch::class, 'type' => 'write', 'name' => 'API PATCH', 'description' => 'Call any Front PATCH endpoint.', 'icon' => 'ph:plug'],
            'front_api_put' => ['class' => FrontApiPut::class, 'type' => 'write', 'name' => 'API PUT', 'description' => 'Call any Front PUT endpoint.', 'icon' => 'ph:plug'],
            'front_api_delete' => ['class' => FrontApiDelete::class, 'type' => 'write', 'name' => 'API DELETE', 'description' => 'Call any Front DELETE endpoint.', 'icon' => 'ph:plug'],

            'front_get_current_user' => ['class' => FrontGetCurrentUser::class, 'type' => 'read', 'name' => 'Get Current User', 'description' => 'Get the authenticated Front user.', 'icon' => 'ph:user'],
            'front_list_conversations' => ['class' => FrontListConversations::class, 'type' => 'read', 'name' => 'List Conversations', 'description' => 'List Front conversations.', 'icon' => 'ph:chats'],
            'front_search_conversations' => ['class' => FrontSearchConversations::class, 'type' => 'read', 'name' => 'Search Conversations', 'description' => 'Search Front conversations using search syntax.', 'icon' => 'ph:magnifying-glass'],
            'front_get_conversation' => ['class' => FrontGetConversation::class, 'type' => 'read', 'name' => 'Get Conversation', 'description' => 'Get a Front conversation.', 'icon' => 'ph:chat-circle'],
            'front_create_discussion_conversation' => ['class' => FrontCreateDiscussionConversation::class, 'type' => 'write', 'name' => 'Create Discussion Conversation', 'description' => 'Create a comment-only discussion conversation.', 'icon' => 'ph:plus'],
            'front_update_conversation' => ['class' => FrontUpdateConversation::class, 'type' => 'write', 'name' => 'Update Conversation', 'description' => 'Update a Front conversation.', 'icon' => 'ph:pencil-simple'],
            'front_update_conversation_reminders' => ['class' => FrontUpdateConversationReminders::class, 'type' => 'write', 'name' => 'Update Conversation Reminders', 'description' => 'Snooze or unsnooze a Front conversation.', 'icon' => 'ph:clock'],
            'front_list_conversation_inboxes' => ['class' => FrontListConversationInboxes::class, 'type' => 'read', 'name' => 'List Conversation Inboxes', 'description' => 'List inboxes for a conversation.', 'icon' => 'ph:tray'],

            'front_list_messages' => ['class' => FrontListMessages::class, 'type' => 'read', 'name' => 'List Messages', 'description' => 'List messages in a conversation.', 'icon' => 'ph:envelope-open'],
            'front_get_message' => ['class' => FrontGetMessage::class, 'type' => 'read', 'name' => 'Get Message', 'description' => 'Get a Front message.', 'icon' => 'ph:envelope-simple'],
            'front_send_message' => ['class' => FrontSendMessage::class, 'type' => 'write', 'name' => 'Send Message Reply', 'description' => 'Reply to a Front conversation.', 'icon' => 'ph:paper-plane-tilt'],
            'front_create_message' => ['class' => FrontCreateMessage::class, 'type' => 'write', 'name' => 'Create Message', 'description' => 'Send a new message from a Front channel.', 'icon' => 'ph:paper-plane-right'],
            'front_import_message' => ['class' => FrontImportMessage::class, 'type' => 'write', 'name' => 'Import Message', 'description' => 'Import an external message into a Front inbox.', 'icon' => 'ph:download-simple'],
            'front_create_draft' => ['class' => FrontCreateDraft::class, 'type' => 'write', 'name' => 'Create Draft', 'description' => 'Create a draft in a Front channel.', 'icon' => 'ph:file-text'],

            'front_list_conversation_comments' => ['class' => FrontListConversationComments::class, 'type' => 'read', 'name' => 'List Conversation Comments', 'description' => 'List comments in a conversation.', 'icon' => 'ph:chat-text'],
            'front_add_comment' => ['class' => FrontAddComment::class, 'type' => 'write', 'name' => 'Add Comment', 'description' => 'Add a comment to a conversation.', 'icon' => 'ph:chat-teardrop-text'],
            'front_add_conversation_tags' => ['class' => FrontAddConversationTags::class, 'type' => 'write', 'name' => 'Add Conversation Tags', 'description' => 'Add tags to a conversation.', 'icon' => 'ph:tag'],
            'front_remove_conversation_tags' => ['class' => FrontRemoveConversationTags::class, 'type' => 'write', 'name' => 'Remove Conversation Tags', 'description' => 'Remove tags from a conversation.', 'icon' => 'ph:tag'],

            'front_list_inboxes' => ['class' => FrontListInboxes::class, 'type' => 'read', 'name' => 'List Inboxes', 'description' => 'List Front inboxes.', 'icon' => 'ph:tray'],
            'front_get_inbox' => ['class' => FrontGetInbox::class, 'type' => 'read', 'name' => 'Get Inbox', 'description' => 'Get a Front inbox.', 'icon' => 'ph:tray'],
            'front_list_inbox_conversations' => ['class' => FrontListInboxConversations::class, 'type' => 'read', 'name' => 'List Inbox Conversations', 'description' => 'List conversations in an inbox.', 'icon' => 'ph:chats-circle'],
            'front_list_inbox_channels' => ['class' => FrontListInboxChannels::class, 'type' => 'read', 'name' => 'List Inbox Channels', 'description' => 'List channels in an inbox.', 'icon' => 'ph:broadcast'],
            'front_create_channel' => ['class' => FrontCreateChannel::class, 'type' => 'write', 'name' => 'Create Channel', 'description' => 'Create a Front inbox channel.', 'icon' => 'ph:broadcast'],
            'front_list_inbox_access' => ['class' => FrontListInboxAccess::class, 'type' => 'read', 'name' => 'List Inbox Access', 'description' => 'List teammates with inbox access.', 'icon' => 'ph:users'],
            'front_add_inbox_access' => ['class' => FrontAddInboxAccess::class, 'type' => 'write', 'name' => 'Add Inbox Access', 'description' => 'Give teammates access to an inbox.', 'icon' => 'ph:user-plus'],
            'front_remove_inbox_access' => ['class' => FrontRemoveInboxAccess::class, 'type' => 'write', 'name' => 'Remove Inbox Access', 'description' => 'Remove teammate access from an inbox.', 'icon' => 'ph:user-minus'],

            'front_list_contacts' => ['class' => FrontListContacts::class, 'type' => 'read', 'name' => 'List Contacts', 'description' => 'List Front contacts.', 'icon' => 'ph:address-book'],
            'front_get_contact' => ['class' => FrontGetContact::class, 'type' => 'read', 'name' => 'Get Contact', 'description' => 'Get a Front contact.', 'icon' => 'ph:user-circle'],
            'front_create_contact' => ['class' => FrontCreateContact::class, 'type' => 'write', 'name' => 'Create Contact', 'description' => 'Create a Front contact.', 'icon' => 'ph:user-plus'],
            'front_create_teammate_contact' => ['class' => FrontCreateTeammateContact::class, 'type' => 'write', 'name' => 'Create Teammate Contact', 'description' => 'Create a teammate contact.', 'icon' => 'ph:user-plus'],
            'front_update_contact' => ['class' => FrontUpdateContact::class, 'type' => 'write', 'name' => 'Update Contact', 'description' => 'Update a Front contact.', 'icon' => 'ph:pencil-simple'],
            'front_delete_contact' => ['class' => FrontDeleteContact::class, 'type' => 'write', 'name' => 'Delete Contact', 'description' => 'Delete a Front contact.', 'icon' => 'ph:trash'],
            'front_add_contact_handle' => ['class' => FrontAddContactHandle::class, 'type' => 'write', 'name' => 'Add Contact Handle', 'description' => 'Add a handle to a Front contact.', 'icon' => 'ph:at'],
            'front_list_contact_conversations' => ['class' => FrontListContactConversations::class, 'type' => 'read', 'name' => 'List Contact Conversations', 'description' => 'List conversations for a contact.', 'icon' => 'ph:chats'],
            'front_list_team_contacts' => ['class' => FrontListTeamContacts::class, 'type' => 'read', 'name' => 'List Team Contacts', 'description' => 'List contacts for a team.', 'icon' => 'ph:address-book-tabs'],
            'front_list_teammate_contacts' => ['class' => FrontListTeammateContacts::class, 'type' => 'read', 'name' => 'List Teammate Contacts', 'description' => 'List contacts for a teammate.', 'icon' => 'ph:address-book'],

            'front_list_teammates' => ['class' => FrontListTeammates::class, 'type' => 'read', 'name' => 'List Teammates', 'description' => 'List Front teammates.', 'icon' => 'ph:users-three'],
            'front_get_teammate' => ['class' => FrontGetTeammate::class, 'type' => 'read', 'name' => 'Get Teammate', 'description' => 'Get a Front teammate.', 'icon' => 'ph:user'],
            'front_update_teammate' => ['class' => FrontUpdateTeammate::class, 'type' => 'write', 'name' => 'Update Teammate', 'description' => 'Update a Front teammate.', 'icon' => 'ph:pencil-simple'],
            'front_list_assigned_conversations' => ['class' => FrontListAssignedConversations::class, 'type' => 'read', 'name' => 'List Assigned Conversations', 'description' => 'List conversations assigned to a teammate.', 'icon' => 'ph:chats'],
            'front_list_teammate_inboxes' => ['class' => FrontListTeammateInboxes::class, 'type' => 'read', 'name' => 'List Teammate Inboxes', 'description' => 'List inboxes for a teammate.', 'icon' => 'ph:tray'],
            'front_list_teammate_rules' => ['class' => FrontListTeammateRules::class, 'type' => 'read', 'name' => 'List Teammate Rules', 'description' => 'List rules for a teammate.', 'icon' => 'ph:flow-arrow'],

            'front_list_teams' => ['class' => FrontListTeams::class, 'type' => 'read', 'name' => 'List Teams', 'description' => 'List Front teams or workspaces.', 'icon' => 'ph:buildings'],
            'front_get_team' => ['class' => FrontGetTeam::class, 'type' => 'read', 'name' => 'Get Team', 'description' => 'Get a Front team.', 'icon' => 'ph:building-office'],
            'front_list_team_inboxes' => ['class' => FrontListTeamInboxes::class, 'type' => 'read', 'name' => 'List Team Inboxes', 'description' => 'List inboxes for a team.', 'icon' => 'ph:tray'],
            'front_create_team_inbox' => ['class' => FrontCreateTeamInbox::class, 'type' => 'write', 'name' => 'Create Team Inbox', 'description' => 'Create an inbox for a team.', 'icon' => 'ph:plus'],
            'front_list_team_rules' => ['class' => FrontListTeamRules::class, 'type' => 'read', 'name' => 'List Team Rules', 'description' => 'List rules for a team.', 'icon' => 'ph:flow-arrow'],

            'front_list_tags' => ['class' => FrontListTags::class, 'type' => 'read', 'name' => 'List Tags', 'description' => 'List Front tags.', 'icon' => 'ph:tags'],
            'front_get_tag' => ['class' => FrontGetTag::class, 'type' => 'read', 'name' => 'Get Tag', 'description' => 'Get a Front tag.', 'icon' => 'ph:tag'],
            'front_create_tag' => ['class' => FrontCreateTag::class, 'type' => 'write', 'name' => 'Create Tag', 'description' => 'Create a legacy Front tag.', 'icon' => 'ph:tag'],
            'front_create_company_tag' => ['class' => FrontCreateCompanyTag::class, 'type' => 'write', 'name' => 'Create Company Tag', 'description' => 'Create a company tag.', 'icon' => 'ph:tag'],
            'front_create_team_tag' => ['class' => FrontCreateTeamTag::class, 'type' => 'write', 'name' => 'Create Team Tag', 'description' => 'Create a team tag.', 'icon' => 'ph:tag'],
            'front_create_teammate_tag' => ['class' => FrontCreateTeammateTag::class, 'type' => 'write', 'name' => 'Create Teammate Tag', 'description' => 'Create a teammate tag.', 'icon' => 'ph:tag'],
            'front_update_tag' => ['class' => FrontUpdateTag::class, 'type' => 'write', 'name' => 'Update Tag', 'description' => 'Update a Front tag.', 'icon' => 'ph:pencil-simple'],
            'front_delete_tag' => ['class' => FrontDeleteTag::class, 'type' => 'write', 'name' => 'Delete Tag', 'description' => 'Delete a Front tag.', 'icon' => 'ph:trash'],
            'front_list_tagged_conversations' => ['class' => FrontListTaggedConversations::class, 'type' => 'read', 'name' => 'List Tagged Conversations', 'description' => 'List conversations for a tag.', 'icon' => 'ph:chats'],
            'front_list_company_tags' => ['class' => FrontListCompanyTags::class, 'type' => 'read', 'name' => 'List Company Tags', 'description' => 'List company tags.', 'icon' => 'ph:tags'],
            'front_list_team_tags' => ['class' => FrontListTeamTags::class, 'type' => 'read', 'name' => 'List Team Tags', 'description' => 'List team tags.', 'icon' => 'ph:tags'],
            'front_list_teammate_tags' => ['class' => FrontListTeammateTags::class, 'type' => 'read', 'name' => 'List Teammate Tags', 'description' => 'List teammate tags.', 'icon' => 'ph:tags'],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/front.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api2.frontapp.com'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally using account-specific credentials.
     *
     * @param  class-string<Tool>  $class  The fully-qualified tool class name.
     * @param  array<string, mixed>  $context  Optional context containing an account key.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve default or account-specific Front credentials.
     *
     * @param  array<string, mixed>  $context  Optional context containing an account key.
     */
    private function resolveService(array $context = []): FrontService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new FrontService(
                accessToken: $creds->get('front', 'access_token', '', $account),
                baseUrl: $creds->get('front', 'url', 'https://api2.frontapp.com', $account),
            );
        }

        return app(FrontService::class);
    }
}
