<?php

namespace OpenCompany\Integrations\ClickUp;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\HasTriggers;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\IntegrationCore\Contracts\Trigger;
use OpenCompany\Integrations\ClickUp\Tools\ClickUpAddComment;
use OpenCompany\Integrations\ClickUp\Tools\ClickUpAddTag;
use OpenCompany\Integrations\ClickUp\Tools\ClickUpAttachFile;
use OpenCompany\Integrations\ClickUp\Tools\ClickUpCreateDocPage;
use OpenCompany\Integrations\ClickUp\Tools\ClickUpCreateFolder;
use OpenCompany\Integrations\ClickUp\Tools\ClickUpCreateList;
use OpenCompany\Integrations\ClickUp\Tools\ClickUpCreateListInFolder;
use OpenCompany\Integrations\ClickUp\Tools\ClickUpCreateTask;
use OpenCompany\Integrations\ClickUp\Tools\ClickUpCurrentTimeEntry;
use OpenCompany\Integrations\ClickUp\Tools\ClickUpDeleteTask;
use OpenCompany\Integrations\ClickUp\Tools\ClickUpFindMember;
use OpenCompany\Integrations\ClickUp\Tools\ClickUpGetDocPages;
use OpenCompany\Integrations\ClickUp\Tools\ClickUpGetFolder;
use OpenCompany\Integrations\ClickUp\Tools\ClickUpGetHierarchy;
use OpenCompany\Integrations\ClickUp\Tools\ClickUpGetList;
use OpenCompany\Integrations\ClickUp\Tools\ClickUpGetTask;
use OpenCompany\Integrations\ClickUp\Tools\ClickUpGetTasks;
use OpenCompany\Integrations\ClickUp\Tools\ClickUpListChannels;
use OpenCompany\Integrations\ClickUp\Tools\ClickUpListDocPages;
use OpenCompany\Integrations\ClickUp\Tools\ClickUpListMembers;
use OpenCompany\Integrations\ClickUp\Tools\ClickUpListTimeEntries;
use OpenCompany\Integrations\ClickUp\Tools\ClickUpLogTime;
use OpenCompany\Integrations\ClickUp\Tools\ClickUpManageDocument;
use OpenCompany\Integrations\ClickUp\Tools\ClickUpReadComments;
use OpenCompany\Integrations\ClickUp\Tools\ClickUpRemoveTag;
use OpenCompany\Integrations\ClickUp\Tools\ClickUpResolveMembers;
use OpenCompany\Integrations\ClickUp\Tools\ClickUpSearch;
use OpenCompany\Integrations\ClickUp\Tools\ClickUpSendMessage;
use OpenCompany\Integrations\ClickUp\Tools\ClickUpStartTimer;
use OpenCompany\Integrations\ClickUp\Tools\ClickUpStopTimer;
use OpenCompany\Integrations\ClickUp\Tools\ClickUpUpdateDocPage;
use OpenCompany\Integrations\ClickUp\Tools\ClickUpUpdateFolder;
use OpenCompany\Integrations\ClickUp\Tools\ClickUpUpdateList;
use OpenCompany\Integrations\ClickUp\Tools\ClickUpUpdateTask;
use OpenCompany\Integrations\ClickUp\Triggers\ClickUpTaskCommentTrigger;
use OpenCompany\Integrations\ClickUp\Triggers\ClickUpTaskCreatedTrigger;
use OpenCompany\Integrations\ClickUp\Triggers\ClickUpTaskUpdatedTrigger;
use OpenCompany\Integrations\ClickUp\Triggers\ClickUpWebhookTrigger;

/**
 * Registers ClickUp tools, triggers, metadata, and credential setup.
 *
 * Supports personal API token authentication with optional workspace scoping
 * for task search, time tracking, chat, docs, and webhook features.
 */
class ClickUpToolProvider implements ToolProvider, ConfigurableIntegration, HasTriggers, HasIntegrationCapabilities
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
                'strategy' => 'api_token',
                'legacy_auth_type' => 'api_token',
                'credential_mode' => 'secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => [],
                'notes' => [
                    'Triggers require a web-reachable host endpoint even if tool runtime works in CLI.',
                ],
            ],
            'host_availability' => [
                'web' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_secret',
                ],
                'cli' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_secret',
                    'runtime_mode' => 'normal',
                ],
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
        return 'clickup';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'ClickUp',
            'description' => 'Project management',
            'icon' => 'ph:kanban',
            'logo' => 'simple-icons:clickup',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'ClickUp',
            'description' => 'Project management, tasks, docs, chat, and time tracking.',
            'icon' => 'ph:kanban',
            'logo' => 'simple-icons:clickup',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developer.clickup.com',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_token',
                'type' => 'secret',
                'label' => 'Personal API Token',
                'placeholder' => 'pk_...',
                'hint' => 'Generate at ClickUp -> Settings -> Apps. Starts with <code>pk_</code>.',
                'required' => true,
            ],
            [
                'key' => 'workspace_id',
                'type' => 'text',
                'label' => 'Workspace ID',
                'placeholder' => '12345678',
                'hint' => 'From your ClickUp URL: <code>app.clickup.com/{workspace_id}/...</code>. Required for search, time tracking, chat, docs, and members.',
                'required' => false,
            ],
        ];
    }

    /**
     * Test a ClickUp API token by listing accessible workspaces.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiToken = $config['api_token'] ?? '';

        if (empty($apiToken)) {
            return ['success' => false, 'error' => 'No API token provided. Generate one at ClickUp -> Settings -> Apps.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => $apiToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get('https://api.clickup.com/api/v2/team');

            if ($response->successful()) {
                $teams = $response->json('teams') ?? [];
                $names = array_map(fn (array $team): string => $team['name'] ?? 'Unknown', $teams);
                $count = count($teams);

                return [
                    'success' => true,
                    'message' => "Connected to ClickUp. Found {$count} workspace(s): " . implode(', ', $names),
                ];
            }

            $error = $response->json('err') ?? $response->body();

            return [
                'success' => false,
                'error' => 'ClickUp API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_token' => 'required|string',
            'workspace_id' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            'clickup_get_hierarchy' => ['class' => ClickUpGetHierarchy::class, 'type' => 'read', 'name' => 'Get Hierarchy', 'description' => 'List ClickUp workspaces, spaces, folders, and lists.', 'icon' => 'ph:tree-structure'],
            'clickup_search' => ['class' => ClickUpSearch::class, 'type' => 'read', 'name' => 'Search Tasks', 'description' => 'Search tasks across the configured workspace.', 'icon' => 'ph:magnifying-glass'],
            'clickup_list_members' => ['class' => ClickUpListMembers::class, 'type' => 'read', 'name' => 'List Members', 'description' => 'List ClickUp workspace members.', 'icon' => 'ph:users'],
            'clickup_find_member' => ['class' => ClickUpFindMember::class, 'type' => 'read', 'name' => 'Find Member', 'description' => 'Find ClickUp members by name or email.', 'icon' => 'ph:user-focus'],
            'clickup_resolve_members' => ['class' => ClickUpResolveMembers::class, 'type' => 'read', 'name' => 'Resolve Members', 'description' => 'Resolve names or emails to ClickUp user IDs.', 'icon' => 'ph:identification-card'],
            'clickup_get_tasks' => ['class' => ClickUpGetTasks::class, 'type' => 'read', 'name' => 'Get Tasks', 'description' => 'List tasks in a ClickUp list with filters.', 'icon' => 'ph:check-square'],
            'clickup_get_task' => ['class' => ClickUpGetTask::class, 'type' => 'read', 'name' => 'Get Task', 'description' => 'Get one ClickUp task by regular ID or custom task ID.', 'icon' => 'ph:check-circle'],
            'clickup_create_task' => ['class' => ClickUpCreateTask::class, 'type' => 'write', 'name' => 'Create Task', 'description' => 'Create a task in a ClickUp list.', 'icon' => 'ph:plus-circle'],
            'clickup_update_task' => ['class' => ClickUpUpdateTask::class, 'type' => 'write', 'name' => 'Update Task', 'description' => 'Update task fields, dates, assignees, priority, or status.', 'icon' => 'ph:pencil-simple'],
            'clickup_delete_task' => ['class' => ClickUpDeleteTask::class, 'type' => 'write', 'name' => 'Delete Task', 'description' => 'Delete a ClickUp task.', 'icon' => 'ph:trash'],
            'clickup_add_tag' => ['class' => ClickUpAddTag::class, 'type' => 'write', 'name' => 'Add Tag', 'description' => 'Add an existing space tag to a task.', 'icon' => 'ph:tag'],
            'clickup_remove_tag' => ['class' => ClickUpRemoveTag::class, 'type' => 'write', 'name' => 'Remove Tag', 'description' => 'Remove a tag from a task.', 'icon' => 'ph:tag-chevron'],
            'clickup_attach_file' => ['class' => ClickUpAttachFile::class, 'type' => 'write', 'name' => 'Attach File', 'description' => 'Upload a local file attachment to a task.', 'icon' => 'ph:paperclip'],
            'clickup_read_comments' => ['class' => ClickUpReadComments::class, 'type' => 'read', 'name' => 'Read Comments', 'description' => 'Read comments on a ClickUp task.', 'icon' => 'ph:chat-circle-text'],
            'clickup_add_comment' => ['class' => ClickUpAddComment::class, 'type' => 'write', 'name' => 'Add Comment', 'description' => 'Add a comment to a ClickUp task.', 'icon' => 'ph:chat-circle-plus'],
            'clickup_current_time_entry' => ['class' => ClickUpCurrentTimeEntry::class, 'type' => 'read', 'name' => 'Current Time Entry', 'description' => 'Get the currently running ClickUp timer.', 'icon' => 'ph:timer'],
            'clickup_list_time_entries' => ['class' => ClickUpListTimeEntries::class, 'type' => 'read', 'name' => 'List Time Entries', 'description' => 'List tracked time entries for a task.', 'icon' => 'ph:clock-counter-clockwise'],
            'clickup_start_timer' => ['class' => ClickUpStartTimer::class, 'type' => 'write', 'name' => 'Start Timer', 'description' => 'Start a ClickUp time entry on a task.', 'icon' => 'ph:play-circle'],
            'clickup_stop_timer' => ['class' => ClickUpStopTimer::class, 'type' => 'write', 'name' => 'Stop Timer', 'description' => 'Stop the currently running ClickUp timer.', 'icon' => 'ph:stop-circle'],
            'clickup_log_time' => ['class' => ClickUpLogTime::class, 'type' => 'write', 'name' => 'Log Time', 'description' => 'Create a manual ClickUp time entry.', 'icon' => 'ph:clock'],
            'clickup_get_list' => ['class' => ClickUpGetList::class, 'type' => 'read', 'name' => 'Get List', 'description' => 'Get ClickUp list details.', 'icon' => 'ph:list-bullets'],
            'clickup_create_list' => ['class' => ClickUpCreateList::class, 'type' => 'write', 'name' => 'Create Folderless List', 'description' => 'Create a folderless list in a ClickUp space.', 'icon' => 'ph:list-plus'],
            'clickup_create_list_in_folder' => ['class' => ClickUpCreateListInFolder::class, 'type' => 'write', 'name' => 'Create List In Folder', 'description' => 'Create a list inside a ClickUp folder.', 'icon' => 'ph:list-plus'],
            'clickup_update_list' => ['class' => ClickUpUpdateList::class, 'type' => 'write', 'name' => 'Update List', 'description' => 'Update ClickUp list metadata.', 'icon' => 'ph:pencil-simple'],
            'clickup_get_folder' => ['class' => ClickUpGetFolder::class, 'type' => 'read', 'name' => 'Get Folder', 'description' => 'Get ClickUp folder details and lists.', 'icon' => 'ph:folder'],
            'clickup_create_folder' => ['class' => ClickUpCreateFolder::class, 'type' => 'write', 'name' => 'Create Folder', 'description' => 'Create a ClickUp folder in a space.', 'icon' => 'ph:folder-plus'],
            'clickup_update_folder' => ['class' => ClickUpUpdateFolder::class, 'type' => 'write', 'name' => 'Update Folder', 'description' => 'Update ClickUp folder metadata.', 'icon' => 'ph:pencil-simple'],
            'clickup_list_channels' => ['class' => ClickUpListChannels::class, 'type' => 'read', 'name' => 'List Chat Channels', 'description' => 'List ClickUp Chat channels.', 'icon' => 'ph:chats'],
            'clickup_send_message' => ['class' => ClickUpSendMessage::class, 'type' => 'write', 'name' => 'Send Chat Message', 'description' => 'Send a ClickUp Chat message to a channel.', 'icon' => 'ph:paper-plane-tilt'],
            'clickup_manage_document' => ['class' => ClickUpManageDocument::class, 'type' => 'write', 'name' => 'Create Document', 'description' => 'Create a ClickUp Doc.', 'icon' => 'ph:file-doc'],
            'clickup_list_doc_pages' => ['class' => ClickUpListDocPages::class, 'type' => 'read', 'name' => 'List Doc Pages', 'description' => 'List pages in a ClickUp Doc.', 'icon' => 'ph:files'],
            'clickup_get_doc_pages' => ['class' => ClickUpGetDocPages::class, 'type' => 'read', 'name' => 'Get Doc Pages', 'description' => 'Fetch ClickUp Doc pages and content.', 'icon' => 'ph:file-text'],
            'clickup_create_doc_page' => ['class' => ClickUpCreateDocPage::class, 'type' => 'write', 'name' => 'Create Doc Page', 'description' => 'Create a page in a ClickUp Doc.', 'icon' => 'ph:file-plus'],
            'clickup_update_doc_page' => ['class' => ClickUpUpdateDocPage::class, 'type' => 'write', 'name' => 'Update Doc Page', 'description' => 'Update a ClickUp Doc page.', 'icon' => 'ph:file-pencil'],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/clickup.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
            ['key' => 'workspace_id', 'type' => 'string', 'label' => 'Workspace ID', 'required' => false],
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

    public function triggers(): array
    {
        return [
            'clickup_webhook' => [
                'class' => ClickUpWebhookTrigger::class,
                'name' => 'ClickUp Webhook',
                'description' => 'Receive any ClickUp workspace events via webhook.',
                'icon' => 'ph:webhooks-logo',
            ],
            'clickup_task_created' => [
                'class' => ClickUpTaskCreatedTrigger::class,
                'name' => 'Task Created',
                'description' => 'Triggered when a new task is created.',
                'icon' => 'ph:plus-circle',
            ],
            'clickup_task_updated' => [
                'class' => ClickUpTaskUpdatedTrigger::class,
                'name' => 'Task Updated',
                'description' => 'Triggered when a task is updated.',
                'icon' => 'ph:pencil-simple',
            ],
            'clickup_task_comment' => [
                'class' => ClickUpTaskCommentTrigger::class,
                'name' => 'Comment Posted',
                'description' => 'Triggered when a comment is posted on a task.',
                'icon' => 'ph:chat-circle',
            ],
        ];
    }

    /** @param  array<string, mixed>  $context */
    public function createTrigger(string $class, array $context = []): Trigger
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the ClickUp service with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): ClickUpService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new ClickUpService(
                apiToken: $creds->get('clickup', 'api_token', '', $account),
                workspaceId: $creds->get('clickup', 'workspace_id', '', $account),
            );
        }

        return app(ClickUpService::class);
    }
}
