<?php

namespace OpenCompany\Integrations\Missive;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Missive\Tools\MissiveListConversations;
use OpenCompany\Integrations\Missive\Tools\MissiveGetConversation;
use OpenCompany\Integrations\Missive\Tools\MissiveCreateComment;
use OpenCompany\Integrations\Missive\Tools\MissiveListTasks;
use OpenCompany\Integrations\Missive\Tools\MissiveCreateTask;
use OpenCompany\Integrations\Missive\Tools\MissiveGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class MissiveToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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




/**
     * The application name used as the integration identifier.
     */
    public function appName(): string
    {
        return 'missive';
    }

/**
     * Short metadata for the app selector UI.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Missive',
            'description' => 'Email & team chat',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:missive',
        ];
    }

/**
     * Full integration metadata for the Integrations UI.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Missive',
            'description' => 'Email and team chat platform — manage conversations, comments, and tasks',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:missive',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://missiveapp.com/docs/developers/rest-api/endpoints',
        ];
    }/**
     * Configuration schema for the integration settings UI.
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
                'placeholder' => 'Enter your Missive API access token',
                'hint' => 'Generate a token in Missive at <strong>Settings → API → Personal access tokens</strong>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://public.missiveapp.com/v1',
                'hint' => 'Use the default Missive Public API URL, or override for testing',
                'default' => 'https://public.missiveapp.com/v1',
            ],
        ];
    }

    /**
     * Test the connection using the provided configuration.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://public.missiveapp.com/v1', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/user');

            $json = $response->json();

            if ($response->successful() && $json !== null) {
                $name = $json['user']['name'] ?? $json['user']['email'] ?? 'Unknown';
                return [
                    'success' => true,
                    'message' => "Connected to Missive as {$name}.",
                ];
            }

            $error = $json['error'] ?? $json['message'] ?? $response->body();

            return [
                'success' => false,
                'error' => 'Missive API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Validation rules for the configuration fields.
     *
     * @return array<string, string|array<int, string>>
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'required|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Register all Missive tools.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            'missive_list_conversations' => [
                'class' => MissiveListConversations::class,
                'type' => 'read',
                'name' => 'List Conversations',
                'description' => 'List conversations with filters and pagination.',
                'icon' => 'ph:envelopes',
            ],
            'missive_get_conversation' => [
                'class' => MissiveGetConversation::class,
                'type' => 'read',
                'name' => 'Get Conversation',
                'description' => 'Get a single conversation by ID.',
                'icon' => 'ph:envelope',
            ],
            'missive_list_conversation_messages' => [
                'class' => 'OpenCompany\\Integrations\\Missive\\Tools\\MissiveListConversationMessages',
                'type' => 'read',
                'name' => 'List Conversation Messages',
                'description' => 'List messages in a Missive conversation with timestamp pagination.',
                'icon' => 'ph:envelope-open',
                'parameters' => [
                    'conversation_id' => ['type' => 'string', 'required' => true, 'description' => 'Conversation UUID.'],
                    'params' => ['type' => 'object', 'description' => 'Optional query parameters such as limit and until.'],
                ],
            ],
            'missive_list_conversation_comments' => [
                'class' => 'OpenCompany\\Integrations\\Missive\\Tools\\MissiveListConversationComments',
                'type' => 'read',
                'name' => 'List Conversation Comments',
                'description' => 'List comments in a Missive conversation with timestamp pagination.',
                'icon' => 'ph:chat-circle-text',
                'parameters' => [
                    'conversation_id' => ['type' => 'string', 'required' => true, 'description' => 'Conversation UUID.'],
                    'params' => ['type' => 'object', 'description' => 'Optional query parameters such as limit and until.'],
                ],
            ],
            'missive_list_conversation_drafts' => [
                'class' => 'OpenCompany\\Integrations\\Missive\\Tools\\MissiveListConversationDrafts',
                'type' => 'read',
                'name' => 'List Conversation Drafts',
                'description' => 'List drafts in a Missive conversation with timestamp pagination.',
                'icon' => 'ph:file-text',
                'parameters' => [
                    'conversation_id' => ['type' => 'string', 'required' => true, 'description' => 'Conversation UUID.'],
                    'params' => ['type' => 'object', 'description' => 'Optional query parameters such as limit and until.'],
                ],
            ],
            'missive_list_conversation_posts' => [
                'class' => 'OpenCompany\\Integrations\\Missive\\Tools\\MissiveListConversationPosts',
                'type' => 'read',
                'name' => 'List Conversation Posts',
                'description' => 'List posts in a Missive conversation with timestamp pagination.',
                'icon' => 'ph:note',
                'parameters' => [
                    'conversation_id' => ['type' => 'string', 'required' => true, 'description' => 'Conversation UUID.'],
                    'params' => ['type' => 'object', 'description' => 'Optional query parameters such as limit and until.'],
                ],
            ],
            'missive_merge_conversation' => [
                'class' => 'OpenCompany\\Integrations\\Missive\\Tools\\MissiveMergeConversation',
                'type' => 'write',
                'name' => 'Merge Conversation',
                'description' => 'Merge a source Missive conversation into a target conversation.',
                'icon' => 'ph:git-merge',
                'parameters' => [
                    'conversation_id' => ['type' => 'string', 'required' => true, 'description' => 'Source conversation UUID.'],
                    'body' => ['type' => 'object', 'required' => true, 'description' => 'Merge payload including target and optional subject.'],
                ],
            ],
            'missive_create_comment' => [
                'class' => MissiveCreateComment::class,
                'type' => 'write',
                'name' => 'Create Comment',
                'description' => 'Add a comment to a conversation.',
                'icon' => 'ph:chat-circle-text',
            ],
            'missive_create_draft' => [
                'class' => 'OpenCompany\\Integrations\\Missive\\Tools\\MissiveCreateDraft',
                'type' => 'write',
                'name' => 'Create Draft',
                'description' => 'Create a Missive draft, or send immediately when send=true.',
                'icon' => 'ph:paper-plane-tilt',
                'parameters' => [
                    'body' => ['type' => 'object', 'required' => true, 'description' => 'Draft payload matching the Missive drafts endpoint.'],
                ],
            ],
            'missive_delete_draft' => [
                'class' => 'OpenCompany\\Integrations\\Missive\\Tools\\MissiveDeleteDraft',
                'type' => 'write',
                'name' => 'Delete Draft',
                'description' => 'Delete a Missive draft by ID.',
                'icon' => 'ph:trash',
                'parameters' => [
                    'draft_id' => ['type' => 'string', 'required' => true, 'description' => 'Draft UUID.'],
                ],
            ],
            'missive_list_messages' => [
                'class' => 'OpenCompany\\Integrations\\Missive\\Tools\\MissiveListMessages',
                'type' => 'read',
                'name' => 'List Messages',
                'description' => 'List Missive messages using documented query parameters such as email_message_id.',
                'icon' => 'ph:envelopes',
                'parameters' => [
                    'params' => ['type' => 'object', 'description' => 'Query parameters such as email_message_id.'],
                ],
            ],
            'missive_create_post' => [
                'class' => 'OpenCompany\\Integrations\\Missive\\Tools\\MissiveCreatePost',
                'type' => 'write',
                'name' => 'Create Post',
                'description' => 'Create a Missive post in a conversation.',
                'icon' => 'ph:note-pencil',
                'parameters' => [
                    'body' => ['type' => 'object', 'required' => true, 'description' => 'Post payload matching the Missive posts endpoint.'],
                ],
            ],
            'missive_delete_post' => [
                'class' => 'OpenCompany\\Integrations\\Missive\\Tools\\MissiveDeletePost',
                'type' => 'write',
                'name' => 'Delete Post',
                'description' => 'Delete a Missive post by ID.',
                'icon' => 'ph:trash',
                'parameters' => [
                    'post_id' => ['type' => 'string', 'required' => true, 'description' => 'Post UUID.'],
                ],
            ],
            'missive_list_tasks' => [
                'class' => MissiveListTasks::class,
                'type' => 'read',
                'name' => 'List Tasks',
                'description' => 'List tasks with filters and pagination.',
                'icon' => 'ph:list-checks',
            ],
            'missive_get_task' => [
                'class' => 'OpenCompany\\Integrations\\Missive\\Tools\\MissiveGetTask',
                'type' => 'read',
                'name' => 'Get Task',
                'description' => 'Get a single Missive task by ID.',
                'icon' => 'ph:check-square',
                'parameters' => [
                    'task_id' => ['type' => 'string', 'required' => true, 'description' => 'Task UUID.'],
                ],
            ],
            'missive_create_task' => [
                'class' => MissiveCreateTask::class,
                'type' => 'write',
                'name' => 'Create Task',
                'description' => 'Create a new task.',
                'icon' => 'ph:plus-circle',
            ],
            'missive_update_task' => [
                'class' => 'OpenCompany\\Integrations\\Missive\\Tools\\MissiveUpdateTask',
                'type' => 'write',
                'name' => 'Update Task',
                'description' => 'Update a Missive task by ID.',
                'icon' => 'ph:pencil-simple',
                'parameters' => [
                    'task_id' => ['type' => 'string', 'required' => true, 'description' => 'Task UUID.'],
                    'body' => ['type' => 'object', 'required' => true, 'description' => 'Task attributes to update.'],
                ],
            ],
            'missive_get_current_user' => [
                'class' => MissiveGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s profile.',
                'icon' => 'ph:user',
            ],
            'missive_list_organizations' => [
                'class' => 'OpenCompany\\Integrations\\Missive\\Tools\\MissiveListOrganizations',
                'type' => 'read',
                'name' => 'List Organizations',
                'description' => 'List organizations the authenticated Missive user is part of.',
                'icon' => 'ph:buildings',
                'parameters' => [
                    'params' => ['type' => 'object', 'description' => 'Query parameters such as limit and offset.'],
                ],
            ],
            'missive_list_users' => [
                'class' => 'OpenCompany\\Integrations\\Missive\\Tools\\MissiveListUsers',
                'type' => 'read',
                'name' => 'List Users',
                'description' => 'List users in organizations the authenticated Missive user is part of.',
                'icon' => 'ph:users',
                'parameters' => [
                    'params' => ['type' => 'object', 'description' => 'Query parameters such as organization, limit, and offset.'],
                ],
            ],
            'missive_list_teams' => [
                'class' => 'OpenCompany\\Integrations\\Missive\\Tools\\MissiveListTeams',
                'type' => 'read',
                'name' => 'List Teams',
                'description' => 'List teams in organizations the authenticated Missive user is part of.',
                'icon' => 'ph:users-three',
                'parameters' => [
                    'params' => ['type' => 'object', 'description' => 'Query parameters such as organization, limit, and offset.'],
                ],
            ],
            'missive_create_teams' => [
                'class' => 'OpenCompany\\Integrations\\Missive\\Tools\\MissiveCreateTeams',
                'type' => 'write',
                'name' => 'Create Teams',
                'description' => 'Create one or more Missive teams.',
                'icon' => 'ph:user-plus',
                'parameters' => [
                    'body' => ['type' => 'object', 'required' => true, 'description' => 'Team creation payload.'],
                ],
            ],
            'missive_list_shared_labels' => [
                'class' => 'OpenCompany\\Integrations\\Missive\\Tools\\MissiveListSharedLabels',
                'type' => 'read',
                'name' => 'List Shared Labels',
                'description' => 'List shared labels in organizations the authenticated user can access.',
                'icon' => 'ph:tag',
                'parameters' => [
                    'params' => ['type' => 'object', 'description' => 'Query parameters such as organization, limit, and offset.'],
                ],
            ],
            'missive_list_contacts' => [
                'class' => 'OpenCompany\\Integrations\\Missive\\Tools\\MissiveListContacts',
                'type' => 'read',
                'name' => 'List Contacts',
                'description' => 'List Missive contacts with contact book, search, pagination, and sync filters.',
                'icon' => 'ph:address-book',
                'parameters' => [
                    'params' => ['type' => 'object', 'description' => 'Query parameters such as contact_book, search, modified_since, include_deleted, limit, and offset.'],
                ],
            ],
            'missive_get_contact' => [
                'class' => 'OpenCompany\\Integrations\\Missive\\Tools\\MissiveGetContact',
                'type' => 'read',
                'name' => 'Get Contact',
                'description' => 'Get a Missive contact by ID.',
                'icon' => 'ph:user',
                'parameters' => [
                    'contact_id' => ['type' => 'string', 'required' => true, 'description' => 'Contact UUID.'],
                ],
            ],
            'missive_create_contacts' => [
                'class' => 'OpenCompany\\Integrations\\Missive\\Tools\\MissiveCreateContacts',
                'type' => 'write',
                'name' => 'Create Contacts',
                'description' => 'Create one or more Missive contacts.',
                'icon' => 'ph:user-plus',
                'parameters' => [
                    'body' => ['type' => 'object', 'required' => true, 'description' => 'Contact creation payload.'],
                ],
            ],
            'missive_update_contacts' => [
                'class' => 'OpenCompany\\Integrations\\Missive\\Tools\\MissiveUpdateContacts',
                'type' => 'write',
                'name' => 'Update Contacts',
                'description' => 'Update one or more Missive contacts by comma-separated IDs.',
                'icon' => 'ph:pencil-simple',
                'parameters' => [
                    'contact_ids' => ['type' => 'string', 'required' => true, 'description' => 'One or more contact IDs, comma separated.'],
                    'body' => ['type' => 'object', 'required' => true, 'description' => 'Contact attributes to update.'],
                ],
            ],
            'missive_list_contact_books' => [
                'class' => 'OpenCompany\\Integrations\\Missive\\Tools\\MissiveListContactBooks',
                'type' => 'read',
                'name' => 'List Contact Books',
                'description' => 'List Missive contact books accessible to the API token user.',
                'icon' => 'ph:address-book-tabs',
                'parameters' => [
                    'params' => ['type' => 'object', 'description' => 'Query parameters such as limit and offset.'],
                ],
            ],
            'missive_list_contact_groups' => [
                'class' => 'OpenCompany\\Integrations\\Missive\\Tools\\MissiveListContactGroups',
                'type' => 'read',
                'name' => 'List Contact Groups',
                'description' => 'List Missive contact groups or organizations linked to a contact book.',
                'icon' => 'ph:users-three',
                'parameters' => [
                    'params' => ['type' => 'object', 'description' => 'Query parameters including contact_book, kind, limit, and offset.'],
                ],
            ],
            'missive_list_responses' => [
                'class' => 'OpenCompany\\Integrations\\Missive\\Tools\\MissiveListResponses',
                'type' => 'read',
                'name' => 'List Responses',
                'description' => 'List Missive canned responses.',
                'icon' => 'ph:chat-text',
                'parameters' => [
                    'params' => ['type' => 'object', 'description' => 'Query parameters such as organization, limit, and offset.'],
                ],
            ],
            'missive_get_response' => [
                'class' => 'OpenCompany\\Integrations\\Missive\\Tools\\MissiveGetResponse',
                'type' => 'read',
                'name' => 'Get Response',
                'description' => 'Get a Missive canned response by ID.',
                'icon' => 'ph:chat-text',
                'parameters' => [
                    'response_id' => ['type' => 'string', 'required' => true, 'description' => 'Response UUID.'],
                ],
            ],
            'missive_create_responses' => [
                'class' => 'OpenCompany\\Integrations\\Missive\\Tools\\MissiveCreateResponses',
                'type' => 'write',
                'name' => 'Create Responses',
                'description' => 'Create one or more Missive canned responses.',
                'icon' => 'ph:plus-circle',
                'parameters' => [
                    'body' => ['type' => 'object', 'required' => true, 'description' => 'Response creation payload.'],
                ],
            ],
            'missive_update_responses' => [
                'class' => 'OpenCompany\\Integrations\\Missive\\Tools\\MissiveUpdateResponses',
                'type' => 'write',
                'name' => 'Update Responses',
                'description' => 'Update one or more Missive canned responses by comma-separated IDs.',
                'icon' => 'ph:pencil-simple',
                'parameters' => [
                    'response_ids' => ['type' => 'string', 'required' => true, 'description' => 'One or more response IDs, comma separated.'],
                    'body' => ['type' => 'object', 'required' => true, 'description' => 'Response attributes to update.'],
                ],
            ],
            'missive_delete_responses' => [
                'class' => 'OpenCompany\\Integrations\\Missive\\Tools\\MissiveDeleteResponses',
                'type' => 'write',
                'name' => 'Delete Responses',
                'description' => 'Delete one or more Missive canned responses by comma-separated IDs.',
                'icon' => 'ph:trash',
                'parameters' => [
                    'response_ids' => ['type' => 'string', 'required' => true, 'description' => 'One or more response IDs, comma separated.'],
                ],
            ],
            'missive_create_analytics_report' => [
                'class' => 'OpenCompany\\Integrations\\Missive\\Tools\\MissiveCreateAnalyticsReport',
                'type' => 'write',
                'name' => 'Create Analytics Report',
                'description' => 'Create an asynchronous Missive analytics report.',
                'icon' => 'ph:chart-line',
                'parameters' => [
                    'body' => ['type' => 'object', 'required' => true, 'description' => 'Analytics report payload with organization, start, end, and time_zone.'],
                ],
            ],
            'missive_get_analytics_report' => [
                'class' => 'OpenCompany\\Integrations\\Missive\\Tools\\MissiveGetAnalyticsReport',
                'type' => 'read',
                'name' => 'Get Analytics Report',
                'description' => 'Get a Missive analytics report by ID after generation.',
                'icon' => 'ph:chart-line',
                'parameters' => [
                    'report_id' => ['type' => 'string', 'required' => true, 'description' => 'Analytics report UUID returned by create_analytics_report.'],
                ],
            ],
            'missive_list_hooks' => [
                'class' => 'OpenCompany\\Integrations\\Missive\\Tools\\MissiveListHooks',
                'type' => 'read',
                'name' => 'List Hooks',
                'description' => 'List Missive webhook subscriptions.',
                'icon' => 'ph:webhooks-logo',
                'parameters' => [
                    'params' => ['type' => 'object', 'description' => 'Query parameters such as organization, limit, and offset.'],
                ],
            ],
            'missive_create_hook' => [
                'class' => 'OpenCompany\\Integrations\\Missive\\Tools\\MissiveCreateHook',
                'type' => 'write',
                'name' => 'Create Hook',
                'description' => 'Create a Missive webhook subscription.',
                'icon' => 'ph:webhooks-logo',
                'parameters' => [
                    'body' => ['type' => 'object', 'required' => true, 'description' => 'Webhook subscription payload.'],
                ],
            ],
            'missive_delete_hook' => [
                'class' => 'OpenCompany\\Integrations\\Missive\\Tools\\MissiveDeleteHook',
                'type' => 'write',
                'name' => 'Delete Hook',
                'description' => 'Delete a Missive webhook subscription by ID.',
                'icon' => 'ph:trash',
                'parameters' => [
                    'hook_id' => ['type' => 'string', 'required' => true, 'description' => 'Hook UUID.'],
                ],
            ],
            'missive_api_get' => [
                'class' => 'OpenCompany\\Integrations\\Missive\\Tools\\MissiveApiGet',
                'type' => 'read',
                'name' => 'Missive API GET',
                'description' => 'Call a documented Missive API GET endpoint relative to /v1.',
                'icon' => 'ph:terminal-window',
                'parameters' => [
                    'path' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint path, such as /contacts or /shared_labels.'],
                    'params' => ['type' => 'object', 'description' => 'Optional query parameters.'],
                ],
            ],
            'missive_api_post' => [
                'class' => 'OpenCompany\\Integrations\\Missive\\Tools\\MissiveApiPost',
                'type' => 'write',
                'name' => 'Missive API POST',
                'description' => 'Call a documented Missive API POST endpoint relative to /v1.',
                'icon' => 'ph:terminal-window',
                'parameters' => [
                    'path' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint path, such as /drafts.'],
                    'body' => ['type' => 'object', 'description' => 'JSON request body.'],
                ],
            ],
            'missive_api_patch' => [
                'class' => 'OpenCompany\\Integrations\\Missive\\Tools\\MissiveApiPatch',
                'type' => 'write',
                'name' => 'Missive API PATCH',
                'description' => 'Call a documented Missive API PATCH endpoint relative to /v1.',
                'icon' => 'ph:terminal-window',
                'parameters' => [
                    'path' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint path, such as /contacts/{id}.'],
                    'body' => ['type' => 'object', 'description' => 'JSON request body.'],
                ],
            ],
            'missive_api_delete' => [
                'class' => 'OpenCompany\\Integrations\\Missive\\Tools\\MissiveApiDelete',
                'type' => 'write',
                'name' => 'Missive API DELETE',
                'description' => 'Call a documented Missive API DELETE endpoint relative to /v1.',
                'icon' => 'ph:terminal-window',
                'parameters' => [
                    'path' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint path, such as /drafts/{id}.'],
                    'params' => ['type' => 'object', 'description' => 'Optional request parameters.'],
                ],
            ],
        ];
    }

    /**
     * Path to the Lua API reference documentation.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/missive.md';
    }

    /**
     * Credential fields for the integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://public.missiveapp.com/v1'],
        ];
    }

    /**
     * Whether this class represents an integration (always true).
     */
    public function isIntegration(): bool
    {        return true;
    }

    /**
     * Create a tool instance, optionally with account-specific credentials.
     *
     * @param  class-string<Tool>  $class   The tool class to instantiate.
     * @param  array<string, mixed>  $context  Optional context with 'account' for multi-account support.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the MissiveService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context  May contain 'account' key for multi-account resolution.
     */
    private function resolveService(array $context = []): MissiveService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new MissiveService(
                accessToken: $creds->get('missive', 'access_token', '', $account),
                baseUrl: $creds->get('missive', 'url', 'https://public.missiveapp.com/v1', $account),
            );
        }

        return app(MissiveService::class);
    }
}
