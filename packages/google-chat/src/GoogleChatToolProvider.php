<?php

namespace OpenCompany\Integrations\GoogleChat;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Google Chat.
 *
 * Exposes generated coverage for the official Google Chat API v1 Discovery
 * document, including spaces, messages, memberships, reactions, and media.
 */
class GoogleChatToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => ['strategy' => 'oauth2_manual_token', 'legacy_auth_type' => 'oauth', 'credential_mode' => 'stored_token', 'setup_flows' => ['manual_token'], 'requires_browser_for_setup' => false, 'refreshable' => false, 'token_keys' => ['access_token'], 'notes' => ['Requires a Google OAuth access token with Google Chat API scopes.']],
            'host_availability' => ['web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token'], 'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token', 'runtime_mode' => 'normal']],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string { return 'google-chat'; }
    public function appMeta(): array { return ['label' => 'Google Chat', 'description' => 'Spaces, messages, members, reactions, custom emojis, read state, sections, and media uploads', 'icon' => 'ph:chats-circle', 'logo' => 'logos:google-icon']; }
    public function integrationMeta(): array { return ['name' => 'Google Chat', 'description' => 'Generated coverage for the Google Chat API v1: spaces, messages, memberships, reactions, custom emojis, read states, sections, and media uploads.', 'icon' => 'ph:chats-circle', 'logo' => 'logos:google-icon', 'category' => 'productivity', 'badge' => 'verified', 'docs_url' => 'https://developers.google.com/workspace/chat/api/reference/rest']; }
    public function configSchema(): array { return [['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'placeholder' => 'Google OAuth access token', 'hint' => 'Use a Google OAuth 2.0 token with Google Chat API scopes.', 'required' => true], ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://chat.googleapis.com', 'hint' => 'Override only for a proxy or compatible endpoint.', 'default' => 'https://chat.googleapis.com']]; }

    /**
     * Verify Google Chat credentials with a lightweight spaces list endpoint call.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://chat.googleapis.com'), '/');
        if ($accessToken === '') return ['success' => false, 'error' => 'No access token provided.'];
        try {
            $response = Http::withToken($accessToken)->acceptJson()->timeout(20)->get($baseUrl.'/v1/spaces', ['pageSize' => 1]);
            return $response->successful() ? ['success' => true, 'message' => 'Google Chat credentials verified.'] : ['success' => false, 'error' => 'Google Chat API returned HTTP '.$response->status().'.'];
        } catch (\Throwable $e) { return ['success' => false, 'error' => $e->getMessage()]; }
    }

    public function validationRules(): array { return ['access_token' => 'nullable|string', 'url' => 'nullable|url']; }

    public function tools(): array
    {
        return [
            'google_chat_spaces_setup' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleChat\\Tools\\GoogleChatSpacesSetup',
  'type' => 'write',
  'name' => 'Spaces Setup',
  'description' => 'Spaces Setup (POST /v1/spaces:setup).',
  'icon' => 'ph:chats-circle',
),
            'google_chat_spaces_complete_import' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleChat\\Tools\\GoogleChatSpacesCompleteImport',
  'type' => 'write',
  'name' => 'Spaces Complete Import',
  'description' => 'Spaces Complete Import (POST /v1/{+name}:completeImport).',
  'icon' => 'ph:chats-circle',
),
            'google_chat_spaces_find_group_chats' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleChat\\Tools\\GoogleChatSpacesFindGroupChats',
  'type' => 'read',
  'name' => 'Spaces Find Group Chats',
  'description' => 'Spaces Find Group Chats (GET /v1/spaces:findGroupChats).',
  'icon' => 'ph:magnifying-glass',
),
            'google_chat_spaces_patch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleChat\\Tools\\GoogleChatSpacesPatch',
  'type' => 'write',
  'name' => 'Spaces Patch',
  'description' => 'Spaces Patch (PATCH /v1/{+name}).',
  'icon' => 'ph:chats-circle',
),
            'google_chat_spaces_search' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleChat\\Tools\\GoogleChatSpacesSearch',
  'type' => 'read',
  'name' => 'Spaces Search',
  'description' => 'Spaces Search (GET /v1/spaces:search).',
  'icon' => 'ph:magnifying-glass',
),
            'google_chat_spaces_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleChat\\Tools\\GoogleChatSpacesCreate',
  'type' => 'write',
  'name' => 'Spaces Create',
  'description' => 'Spaces Create (POST /v1/spaces).',
  'icon' => 'ph:chats-circle',
),
            'google_chat_spaces_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleChat\\Tools\\GoogleChatSpacesDelete',
  'type' => 'write',
  'name' => 'Spaces Delete',
  'description' => 'Spaces Delete (DELETE /v1/{+name}).',
  'icon' => 'ph:chats-circle',
),
            'google_chat_spaces_find_direct_message' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleChat\\Tools\\GoogleChatSpacesFindDirectMessage',
  'type' => 'read',
  'name' => 'Spaces Find Direct Message',
  'description' => 'Spaces Find Direct Message (GET /v1/spaces:findDirectMessage).',
  'icon' => 'ph:magnifying-glass',
),
            'google_chat_spaces_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleChat\\Tools\\GoogleChatSpacesList',
  'type' => 'read',
  'name' => 'Spaces List',
  'description' => 'Spaces List (GET /v1/spaces).',
  'icon' => 'ph:magnifying-glass',
),
            'google_chat_spaces_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleChat\\Tools\\GoogleChatSpacesGet',
  'type' => 'read',
  'name' => 'Spaces Get',
  'description' => 'Spaces Get (GET /v1/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_chat_spaces_space_events_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleChat\\Tools\\GoogleChatSpacesSpaceEventsGet',
  'type' => 'read',
  'name' => 'Spaces Space Events Get',
  'description' => 'Spaces Space Events Get (GET /v1/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_chat_spaces_space_events_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleChat\\Tools\\GoogleChatSpacesSpaceEventsList',
  'type' => 'read',
  'name' => 'Spaces Space Events List',
  'description' => 'Spaces Space Events List (GET /v1/{+parent}/spaceEvents).',
  'icon' => 'ph:magnifying-glass',
),
            'google_chat_spaces_members_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleChat\\Tools\\GoogleChatSpacesMembersCreate',
  'type' => 'write',
  'name' => 'Spaces Members Create',
  'description' => 'Spaces Members Create (POST /v1/{+parent}/members).',
  'icon' => 'ph:chats-circle',
),
            'google_chat_spaces_members_patch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleChat\\Tools\\GoogleChatSpacesMembersPatch',
  'type' => 'write',
  'name' => 'Spaces Members Patch',
  'description' => 'Spaces Members Patch (PATCH /v1/{+name}).',
  'icon' => 'ph:chats-circle',
),
            'google_chat_spaces_members_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleChat\\Tools\\GoogleChatSpacesMembersGet',
  'type' => 'read',
  'name' => 'Spaces Members Get',
  'description' => 'Spaces Members Get (GET /v1/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_chat_spaces_members_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleChat\\Tools\\GoogleChatSpacesMembersDelete',
  'type' => 'write',
  'name' => 'Spaces Members Delete',
  'description' => 'Spaces Members Delete (DELETE /v1/{+name}).',
  'icon' => 'ph:chats-circle',
),
            'google_chat_spaces_members_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleChat\\Tools\\GoogleChatSpacesMembersList',
  'type' => 'read',
  'name' => 'Spaces Members List',
  'description' => 'Spaces Members List (GET /v1/{+parent}/members).',
  'icon' => 'ph:magnifying-glass',
),
            'google_chat_spaces_messages_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleChat\\Tools\\GoogleChatSpacesMessagesGet',
  'type' => 'read',
  'name' => 'Spaces Messages Get',
  'description' => 'Spaces Messages Get (GET /v1/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_chat_spaces_messages_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleChat\\Tools\\GoogleChatSpacesMessagesDelete',
  'type' => 'write',
  'name' => 'Spaces Messages Delete',
  'description' => 'Spaces Messages Delete (DELETE /v1/{+name}).',
  'icon' => 'ph:chats-circle',
),
            'google_chat_spaces_messages_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleChat\\Tools\\GoogleChatSpacesMessagesList',
  'type' => 'read',
  'name' => 'Spaces Messages List',
  'description' => 'Spaces Messages List (GET /v1/{+parent}/messages).',
  'icon' => 'ph:magnifying-glass',
),
            'google_chat_spaces_messages_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleChat\\Tools\\GoogleChatSpacesMessagesCreate',
  'type' => 'write',
  'name' => 'Spaces Messages Create',
  'description' => 'Spaces Messages Create (POST /v1/{+parent}/messages).',
  'icon' => 'ph:chats-circle',
),
            'google_chat_spaces_messages_patch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleChat\\Tools\\GoogleChatSpacesMessagesPatch',
  'type' => 'write',
  'name' => 'Spaces Messages Patch',
  'description' => 'Spaces Messages Patch (PATCH /v1/{+name}).',
  'icon' => 'ph:chats-circle',
),
            'google_chat_spaces_messages_update' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleChat\\Tools\\GoogleChatSpacesMessagesUpdate',
  'type' => 'write',
  'name' => 'Spaces Messages Update',
  'description' => 'Spaces Messages Update (PUT /v1/{+name}).',
  'icon' => 'ph:chats-circle',
),
            'google_chat_spaces_messages_attachments_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleChat\\Tools\\GoogleChatSpacesMessagesAttachmentsGet',
  'type' => 'read',
  'name' => 'Spaces Messages Attachments Get',
  'description' => 'Spaces Messages Attachments Get (GET /v1/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_chat_spaces_messages_reactions_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleChat\\Tools\\GoogleChatSpacesMessagesReactionsList',
  'type' => 'read',
  'name' => 'Spaces Messages Reactions List',
  'description' => 'Spaces Messages Reactions List (GET /v1/{+parent}/reactions).',
  'icon' => 'ph:magnifying-glass',
),
            'google_chat_spaces_messages_reactions_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleChat\\Tools\\GoogleChatSpacesMessagesReactionsDelete',
  'type' => 'write',
  'name' => 'Spaces Messages Reactions Delete',
  'description' => 'Spaces Messages Reactions Delete (DELETE /v1/{+name}).',
  'icon' => 'ph:chats-circle',
),
            'google_chat_spaces_messages_reactions_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleChat\\Tools\\GoogleChatSpacesMessagesReactionsCreate',
  'type' => 'write',
  'name' => 'Spaces Messages Reactions Create',
  'description' => 'Spaces Messages Reactions Create (POST /v1/{+parent}/reactions).',
  'icon' => 'ph:chats-circle',
),
            'google_chat_custom_emojis_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleChat\\Tools\\GoogleChatCustomEmojisCreate',
  'type' => 'write',
  'name' => 'Custom Emojis Create',
  'description' => 'Custom Emojis Create (POST /v1/customEmojis).',
  'icon' => 'ph:chats-circle',
),
            'google_chat_custom_emojis_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleChat\\Tools\\GoogleChatCustomEmojisGet',
  'type' => 'read',
  'name' => 'Custom Emojis Get',
  'description' => 'Custom Emojis Get (GET /v1/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_chat_custom_emojis_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleChat\\Tools\\GoogleChatCustomEmojisDelete',
  'type' => 'write',
  'name' => 'Custom Emojis Delete',
  'description' => 'Custom Emojis Delete (DELETE /v1/{+name}).',
  'icon' => 'ph:chats-circle',
),
            'google_chat_custom_emojis_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleChat\\Tools\\GoogleChatCustomEmojisList',
  'type' => 'read',
  'name' => 'Custom Emojis List',
  'description' => 'Custom Emojis List (GET /v1/customEmojis).',
  'icon' => 'ph:magnifying-glass',
),
            'google_chat_media_upload' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleChat\\Tools\\GoogleChatMediaUpload',
  'type' => 'write',
  'name' => 'Media Upload',
  'description' => 'Media Upload (POST /v1/{+parent}/attachments:upload).',
  'icon' => 'ph:chats-circle',
),
            'google_chat_media_download' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleChat\\Tools\\GoogleChatMediaDownload',
  'type' => 'read',
  'name' => 'Media Download',
  'description' => 'Media Download (GET /v1/media/{+resourceName}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_chat_users_spaces_get_space_read_state' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleChat\\Tools\\GoogleChatUsersSpacesGetSpaceReadState',
  'type' => 'read',
  'name' => 'Users Spaces Get Space Read State',
  'description' => 'Users Spaces Get Space Read State (GET /v1/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_chat_users_spaces_update_space_read_state' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleChat\\Tools\\GoogleChatUsersSpacesUpdateSpaceReadState',
  'type' => 'write',
  'name' => 'Users Spaces Update Space Read State',
  'description' => 'Users Spaces Update Space Read State (PATCH /v1/{+name}).',
  'icon' => 'ph:chats-circle',
),
            'google_chat_users_spaces_space_notification_setting_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleChat\\Tools\\GoogleChatUsersSpacesSpaceNotificationSettingGet',
  'type' => 'read',
  'name' => 'Users Spaces Space Notification Setting Get',
  'description' => 'Users Spaces Space Notification Setting Get (GET /v1/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_chat_users_spaces_space_notification_setting_patch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleChat\\Tools\\GoogleChatUsersSpacesSpaceNotificationSettingPatch',
  'type' => 'write',
  'name' => 'Users Spaces Space Notification Setting Patch',
  'description' => 'Users Spaces Space Notification Setting Patch (PATCH /v1/{+name}).',
  'icon' => 'ph:chats-circle',
),
            'google_chat_users_spaces_threads_get_thread_read_state' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleChat\\Tools\\GoogleChatUsersSpacesThreadsGetThreadReadState',
  'type' => 'read',
  'name' => 'Users Spaces Threads Get Thread Read State',
  'description' => 'Users Spaces Threads Get Thread Read State (GET /v1/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_chat_users_sections_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleChat\\Tools\\GoogleChatUsersSectionsDelete',
  'type' => 'write',
  'name' => 'Users Sections Delete',
  'description' => 'Users Sections Delete (DELETE /v1/{+name}).',
  'icon' => 'ph:chats-circle',
),
            'google_chat_users_sections_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleChat\\Tools\\GoogleChatUsersSectionsList',
  'type' => 'read',
  'name' => 'Users Sections List',
  'description' => 'Users Sections List (GET /v1/{+parent}/sections).',
  'icon' => 'ph:magnifying-glass',
),
            'google_chat_users_sections_position' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleChat\\Tools\\GoogleChatUsersSectionsPosition',
  'type' => 'write',
  'name' => 'Users Sections Position',
  'description' => 'Users Sections Position (POST /v1/{+name}:position).',
  'icon' => 'ph:chats-circle',
),
            'google_chat_users_sections_patch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleChat\\Tools\\GoogleChatUsersSectionsPatch',
  'type' => 'write',
  'name' => 'Users Sections Patch',
  'description' => 'Users Sections Patch (PATCH /v1/{+name}).',
  'icon' => 'ph:chats-circle',
),
            'google_chat_users_sections_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleChat\\Tools\\GoogleChatUsersSectionsCreate',
  'type' => 'write',
  'name' => 'Users Sections Create',
  'description' => 'Users Sections Create (POST /v1/{+parent}/sections).',
  'icon' => 'ph:chats-circle',
),
            'google_chat_users_sections_items_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleChat\\Tools\\GoogleChatUsersSectionsItemsList',
  'type' => 'read',
  'name' => 'Users Sections Items List',
  'description' => 'Users Sections Items List (GET /v1/{+parent}/items).',
  'icon' => 'ph:magnifying-glass',
),
            'google_chat_users_sections_items_move' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleChat\\Tools\\GoogleChatUsersSectionsItemsMove',
  'type' => 'write',
  'name' => 'Users Sections Items Move',
  'description' => 'Users Sections Items Move (POST /v1/{+name}:move).',
  'icon' => 'ph:chats-circle',
),
        ];
    }

    public function credentialFields(): array { return $this->configSchema(); }
    public function isIntegration(): bool { return true; }

    /**
     * Create a Google Chat tool from the catalog class name.
     *
     * @param  array<string, mixed>  $context  Optional account context.
     */
    public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); }

    /**
     * Resolve a service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): GoogleChatService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);
            return new GoogleChatService(accessToken: $creds->get('google-chat', 'access_token', '', $account), baseUrl: $creds->get('google-chat', 'url', 'https://chat.googleapis.com', $account));
        }
        return app(GoogleChatService::class);
    }

    public function scriptDocsPath(): ?string { return __DIR__ . '/../script-docs/google-chat.md'; }
}
