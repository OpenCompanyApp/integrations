<?php

namespace OpenCompany\Integrations\ClickUp;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
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
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\HasTriggers;
use OpenCompany\IntegrationCore\Contracts\Trigger;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\ClickUp\Triggers\ClickUpTaskCommentTrigger;
use OpenCompany\Integrations\ClickUp\Triggers\ClickUpTaskCreatedTrigger;
use OpenCompany\Integrations\ClickUp\Triggers\ClickUpTaskUpdatedTrigger;
use OpenCompany\Integrations\ClickUp\Triggers\ClickUpWebhookTrigger;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
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
            'setup_flows' =>
            [
              0 => 'manual_secret',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
            ],
            'notes' =>
            [
              0 => 'Triggers require a web-reachable host endpoint even if tool runtime works in CLI.',
            ],
          ],
          'host_availability' => [
            'web' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_secret',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_secret',
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
            'description' => 'Project management, tasks, docs, and time tracking',
            'icon' => 'ph:kanban',
            'logo' => 'simple-icons:clickup',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://clickup.com/api',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_token',
                'type' => 'secret',
                'label' => 'Personal API Token',
                'placeholder' => 'pk_...',
                'hint' => 'Generate at ClickUp → Settings → Apps. Starts with <code>pk_</code>.',
                'required' => true,
            ],
            [
                'key' => 'workspace_id',
                'type' => 'text',
                'label' => 'Workspace ID',
                'placeholder' => '12345678',
                'hint' => 'From your ClickUp URL: <code>app.clickup.com/{workspace_id}/...</code>. Required for search, time tracking, and members.',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiToken = $config['api_token'] ?? '';

        if (empty($apiToken)) {
            return ['success' => false, 'error' => 'No API token provided. Generate one at ClickUp → Settings → Apps.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => $apiToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get('https://api.clickup.com/api/v2/team');

            if ($response->successful()) {
                $teams = $response->json('teams') ?? [];
                $names = array_map(fn (array $t) => $t['name'] ?? 'Unknown', $teams);
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
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
            ['key' => 'workspace_id', 'type' => 'string', 'label' => 'Workspace ID', 'required' => true],
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
     * Resolve the ClickUpService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): ClickUpService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new ClickUpService(
                apiToken: $creds->get('clickup', 'api_token', '', $account),
                workspaceId: $creds->get('clickup', 'workspace_id', '', $account),
            );
        }

        return app(ClickUpService::class);
    }
}
